/* arp.c
 * ARP and RARP dissector
 */

#include <pcap.h>
#include <netinet/ip.h>
#include <arpa/inet.h>
#include <string.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <sys/types.h>

#include "proto.h"
#include "dmemory.h"
#include "etypes.h"
#include "log.h"
#include "embedded.h"
#include "configs.h"
#include "arp.h"
#include "arptypes.h"
#include "pei.h"


#define ARP_HW_IS_ETHER(ar_hrd, ar_hln)                         \
  (((ar_hrd) == ARPHRD_ETHER || (ar_hrd) == ARPHRD_IEEE802)     \
   && (ar_hln) == 6)
#define ARP_PRO_IS_IPv4(ar_pro, ar_pln)         \
  ((ar_pro) == ETHERTYPE_IP && (ar_pln) == 4)



/* info id */
static int prot_id;

/* pei id */
static int pei_mac_id;
static int pei_ip_id;


static void ArpPei(char *ips, char *mac, const packet *pkt)
{
    pei_component *cmpn;
    pei *ppei;

    /* create pei */
    PeiNew(&ppei, prot_id);
    PeiCapTime(ppei, pkt->cap_sec);
    PeiMarker(ppei, pkt->serial);
    PeiStackFlow(ppei, pkt->stk);

    /* new components */
    PeiNewComponent(&cmpn, pei_mac_id);
    PeiCompCapTime(cmpn, ppei->time_cap);
    PeiCompAddStingBuff(cmpn, mac);
    PeiAddComponent(ppei, cmpn);

    PeiNewComponent(&cmpn, pei_ip_id);
    PeiCompCapTime(cmpn, ppei->time_cap);
    PeiCompAddStingBuff(cmpn, ips);
    PeiAddComponent(ppei, cmpn);
    
    PeiIns(ppei);
}


static packet* ArpDissector(packet *pkt)
{
    struct arp_header *arp;
    struct arp_eth_header *earp;
    char ips[ARP_IP_STR_SIZE];
    char macs[ARP_IP_STR_SIZE];
    struct in_addr ip_addr;
    char ip_str[INET6_ADDRSTRLEN];

    /* size check */
    if (pkt->len < sizeof(struct arp_header)) {
        LogPrintf(LV_ERROR, "ARP size error");
        return NULL;
    }
    arp = (struct arp_header *)pkt->data;
    if (ARP_HW_IS_ETHER(ntohs(arp->ar_hrd), arp->ar_hln) &&
        ARP_PRO_IS_IPv4(ntohs(arp->ar_pro), arp->ar_pln)) {
        earp = (struct arp_eth_header *)(arp + 1);
        
        switch (ntohs(arp->ar_op)) {
        case ARPOP_REQUEST:
            ip_addr.s_addr = *((unsigned int *)(earp->arp_spa));
            sprintf(ips, "%s", inet_ntop(AF_INET, &ip_addr, ip_str, INET6_ADDRSTRLEN));
            sprintf(macs, "%.2x:%.2x:%.2x:%.2x:%.2x:%.2x", earp->arp_sha[0], earp->arp_sha[1], earp->arp_sha[2], earp->arp_sha[3], earp->arp_sha[4], earp->arp_sha[5]);
            ArpPei(ips, macs, pkt);
            break;
            
        case ARPOP_REPLY:
            ip_addr.s_addr = *((unsigned int *)(earp->arp_spa));
            sprintf(ips, "%s", inet_ntop(AF_INET, &ip_addr, ip_str, INET6_ADDRSTRLEN));
            sprintf(macs, "%.2x:%.2x:%.2x:%.2x:%.2x:%.2x", earp->arp_sha[0], earp->arp_sha[1], earp->arp_sha[2], earp->arp_sha[3], earp->arp_sha[4], earp->arp_sha[5]);
            ArpPei(ips, macs, pkt);
            ip_addr.s_addr = *((unsigned int *)(earp->arp_tpa));
            sprintf(ips, "%s", inet_ntop(AF_INET, &ip_addr, ip_str, INET6_ADDRSTRLEN));
            sprintf(macs, "%.2x:%.2x:%.2x:%.2x:%.2x:%.2x", earp->arp_tha[0], earp->arp_tha[1], earp->arp_tha[2], earp->arp_tha[3], earp->arp_tha[4], earp->arp_tha[5]);
            ArpPei(ips, macs, pkt);
            break;
            
        case ARPOP_RREQUEST:
            ip_addr.s_addr = *((unsigned int *)(earp->arp_spa));
            sprintf(ips, "%s", inet_ntop(AF_INET, &ip_addr, ip_str, INET6_ADDRSTRLEN));
            sprintf(macs, "%.2x:%.2x:%.2x:%.2x:%.2x:%.2x", earp->arp_sha[0], earp->arp_sha[1], earp->arp_sha[2], earp->arp_sha[3], earp->arp_sha[4], earp->arp_sha[5]);
            ArpPei(ips, macs, pkt);
            break;
            
        case ARPOP_RREPLY:
            ip_addr.s_addr = *((unsigned int *)(earp->arp_spa));
            sprintf(ips, "%s", inet_ntop(AF_INET, &ip_addr, ip_str, INET6_ADDRSTRLEN));
            sprintf(macs, "%.2x:%.2x:%.2x:%.2x:%.2x:%.2x", earp->arp_sha[0], earp->arp_sha[1], earp->arp_sha[2], earp->arp_sha[3], earp->arp_sha[4], earp->arp_sha[5]);
            ArpPei(ips, macs, pkt);
            ip_addr.s_addr = *((unsigned int *)(earp->arp_tpa));
            sprintf(ips, "%s", inet_ntop(AF_INET, &ip_addr, ip_str, INET6_ADDRSTRLEN));
            sprintf(macs, "%.2x:%.2x:%.2x:%.2x:%.2x:%.2x", earp->arp_tha[0], earp->arp_tha[1], earp->arp_tha[2], earp->arp_tha[3], earp->arp_tha[4], earp->arp_tha[5]);
            ArpPei(ips, macs, pkt);
            break;
            
        default:
            return NULL;
        }
    }

    return NULL;
}


int DissecRegist(const char *file_cfg)
{
    proto_dep dep;
    pei_cmpt peic;

    memset(&dep, 0, sizeof(proto_dep));

    /* protocol name */
    ProtName("Address Resolution Protocol", "arp");

    /* ethernet dependence */
    dep.name = "eth";
    dep.attr = "eth.type";
    dep.type = FT_UINT16;
    dep.val.uint16 = ETHERTYPE_ARP;
    ProtDep(&dep);

    dep.name = "eth";
    dep.attr = "eth.type";
    dep.type = FT_UINT16;
    dep.val.uint16 = ETHERTYPE_REVARP;
    ProtDep(&dep);

    /* vlan dependence */
    dep.name = "vlan";
    dep.attr = "vlan.type";
    dep.type = FT_UINT16;
    dep.val.uint16 = ETHERTYPE_ARP;
    ProtDep(&dep);

    dep.name = "vlan";
    dep.attr = "vlan.type";
    dep.type = FT_UINT16;
    dep.val.uint16 = ETHERTYPE_REVARP;
    ProtDep(&dep);

    /* PEI components */
    peic.abbrev = "mac";
    peic.desc = "MAC address";
    ProtPeiComponent(&peic);

    peic.abbrev = "ip";
    peic.desc = "IP address";
    ProtPeiComponent(&peic);

    /* dissectors registration */
    ProtDissectors(ArpDissector, NULL, NULL, NULL);

    return 0;
}


int DissectInit(void)
{
    prot_id = ProtId("arp");
    
    /* pei id */
    pei_mac_id = ProtPeiComptId(prot_id, "mac");
    pei_ip_id = ProtPeiComptId(prot_id, "ip");

    return 0;
}
