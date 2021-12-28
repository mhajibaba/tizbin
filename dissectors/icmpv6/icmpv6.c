/* icmpv6.c
 * ICMPv6 dissector
 */

#include <arpa/inet.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <netinet/icmp6.h>
#include <stdio.h>
#include <string.h>

#include "proto.h"
#include "dmemory.h"
#include "etypes.h"
#include "ipproto.h"
#include "in_cksum.h"
#include "log.h"
#include "pei.h"


/* info id */
static int eth_id;
static int eth_mac_id;
static int ipv6_id;
static int ipv6_src_id;
static int ipv6_dst_id;
static int prot_id;

/* pei id */
static int pei_mac_id;
static int pei_ip_id;


#define ICMP6_ND_NEIGHBOR_SOLICIT       135
#define ICMP6_ND_NEIGHBOR_ADVERT        136
#define ICMP6_IND_SOLICIT               141
#define ICMP6_IND_ADVERT                142


static void Icmpv6Pei(char *ips, char *mac, const packet *pkt)
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


static packet *Icmpv6Dissector(packet *pkt)
{
    struct icmp6_hdr *hdr;
#if (XPL_DIS_IP_CHECKSUM == 0)
    vec_t cksum_vec[4];
    unsigned int phdr[2];
    ftval ipv6_src, ipv6_dst;
    unsigned short computed_cksum;
#endif
    ftval val;
    struct nd_neighbor_solicit *nd_sol;
    struct nd_neighbor_advert *nd_adv;
    const pstack_f *frame;
    char ip_str[INET6_ADDRSTRLEN];
    char mac_str[INET6_ADDRSTRLEN];
    
    if (pkt->len < sizeof(struct icmp6_hdr)) {
        LogPrintf(LV_WARNING, "ICMPv6 size error");
        PktFree(pkt);
        pkt = NULL;
        
        return NULL;
    }

    hdr = (struct icmp6_hdr *)pkt->data;
    /* checksum check */
#if (XPL_DIS_IP_CHECKSUM == 0)
    if (ProtFrameProtocol(pkt->stk) != ipv6_id) {
        LogPrintf(LV_ERROR, "not IPv6 layer");
        ProtStackFrmDisp(pkt->stk, TRUE);
        
        PktFree(pkt);
        pkt = NULL;
        
        return pkt;
    }
    /* IPv6 */
    ProtGetAttr(pkt->stk, ipv6_src_id, &ipv6_src);
    ProtGetAttr(pkt->stk, ipv6_dst_id, &ipv6_dst);
    cksum_vec[0].ptr = (const unsigned char *)&ipv6_src.ipv6;
    cksum_vec[0].len = 16;
    cksum_vec[1].ptr = (const unsigned char *)&ipv6_dst.ipv6;
    cksum_vec[1].len = 16;
    cksum_vec[2].ptr = (const unsigned char *)&phdr;
    phdr[0] = htonl(pkt->len);
    phdr[1] = htonl(IP_PROTO_ICMPV6);
    cksum_vec[2].len = 8;
    cksum_vec[3].ptr = (unsigned char *)pkt->data;
    cksum_vec[3].len = pkt->len;
    computed_cksum = in_cksum(&cksum_vec[0], 4);
    if (computed_cksum != 0) {
        LogPrintf(LV_WARNING, "ICMPv6 packet chechsum error 0x%x", computed_cksum);
        ProtStackFrmDisp(pkt->stk, TRUE);
        PktFree(pkt);
        exit(-1);
        return NULL;
    }
#endif
    /* we decode only "neighbor solicitation" and "neighbor advertisement" icmpv6 type */
    switch (hdr->icmp6_type) {
    case ICMP6_ND_NEIGHBOR_SOLICIT:
        nd_sol = (struct nd_neighbor_solicit *)pkt->data;
        break;

    case ICMP6_ND_NEIGHBOR_ADVERT:
        nd_adv = (struct nd_neighbor_advert *)pkt->data;
        frame = ProtStackSearchProt(pkt->stk, eth_id);
        if (frame != NULL) {
            /* mac address */
            ProtGetAttr(frame, eth_mac_id, &val);
            FTString(&val, FT_ETHER, mac_str);
            memcpy(val.ipv6, nd_adv->nd_na_target.s6_addr, 16);
            FTString(&val, FT_IPv6, ip_str);
            Icmpv6Pei(ip_str, mac_str, pkt);
        }
        break;
    }
    
    PktFree(pkt);
    pkt = NULL;

    return pkt;
}


int DissecRegist(const char *file_cfg)
{
    proto_info info;
    proto_dep dep;
    pei_cmpt peic;

    memset(&info, 0, sizeof(proto_info));
    memset(&dep, 0, sizeof(proto_dep));

    /* protocol name */
    ProtName("Internet Control Message Protocol v6", "icmpv6");

    /* info */
    #warning "to be implement"

    /* dep: IP */
    dep.name = "ipv6";
    dep.attr = "ipv6.nxt";
    dep.type = FT_UINT8;
    dep.val.uint8 = IP_PROTO_ICMPV6;
    ProtDep(&dep);

    /* PEI components */
    peic.abbrev = "mac";
    peic.desc = "MAC address";
    ProtPeiComponent(&peic);

    peic.abbrev = "ipv6";
    peic.desc = "IPv6 address";
    ProtPeiComponent(&peic);

    /* dissector registration */
    ProtDissectors(Icmpv6Dissector, NULL, NULL, NULL);

    return 0;
}


int DissectInit(void)
{
    eth_id = ProtId("eth");
    if (eth_id != -1)
        eth_mac_id = ProtAttrId(eth_id, "eth.src");
    else
        eth_mac_id = -1;
    ipv6_id = ProtId("ipv6");
    prot_id = ProtId("icmpv6");
    ipv6_dst_id = ProtAttrId(ipv6_id, "ipv6.dst");
    ipv6_src_id = ProtAttrId(ipv6_id, "ipv6.src");
    
    /* pei id */
    pei_mac_id = ProtPeiComptId(prot_id, "mac");
    pei_ip_id = ProtPeiComptId(prot_id, "ip");

    return 0;
}
