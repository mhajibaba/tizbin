/* radiotap.c
 * radiotap dissector
 */

#include <pcap.h>
#include <netinet/ip.h>
#include <arpa/inet.h>
#include <string.h>
#include <sys/types.h>

#include "proto.h"
#include "dmemory.h"
#include "etypes.h"
#include "log.h"
#include "configs.h"

#ifndef swap16
#if __BYTE_ORDER == __BIG_ENDIAN
#  define swap16(x) ((((x) >> 8) & 0xffu) | (((x) & 0xffu) << 8))
#elif __BYTE_ORDER == __LITTLE_ENDIAN
#  define swap16(x) x
#else
# error "Please fix <bits/endian.h>"
#endif
#endif

/* info id */
static int prot_id;
static int wlan_id;

typedef struct _radiotap_hd radiotap_hd;
struct _radiotap_hd {
	unsigned char it_version;
	unsigned char it_pad;
	unsigned short it_len;
	unsigned long it_present;
} __attribute__((__packed__));


static packet* RadiotapDissector(packet *pkt)
{
    pstack_f *frame;
    size_t rt_len;
    radiotap_hd *hd;

    if (pkt->len < sizeof(radiotap_hd)) {
        LogPrintf(LV_WARNING, "Radiotap size error");
        //ProtStackFrmDisp(pkt->stk, TRUE);
        PktFree(pkt);
        return NULL;
    }
    hd = (radiotap_hd *)pkt->data;
    rt_len = swap16(hd->it_len);
    if (rt_len > pkt->len) {
        LogPrintf(LV_WARNING, "Radiotap packet length error");
        //ProtStackFrmDisp(pkt->stk, TRUE);
        PktFree(pkt);
        return NULL;
    }

    /* add frame */
    frame = ProtCreateFrame(prot_id);
    ProtSetNxtFrame(frame, pkt->stk);
    pkt->stk = frame;
    
    /* pdu */
    pkt->data += rt_len;
    pkt->len -= rt_len;
    
    /* call wlan dissector */
    if (wlan_id != -1)
        return ProtDissecPkt(wlan_id, pkt);
    
    PktFree(pkt);
    return NULL;
}


int DissecRegist(const char *file_cfg)
{
    proto_dep dep;

    memset(&dep, 0, sizeof(proto_dep));

    /* protocol name */
    ProtName("802.11 Radiotap", "radiotap");

    /* pcapf dependence */
    dep.name = "pcapf";
    dep.attr = "pcapf.layer1";
    dep.type = FT_UINT16;
    dep.val.uint16 = DLT_IEEE802_11_RADIO;
    ProtDep(&dep);
    
    /* pol dependence */
    dep.name = "pol";
    dep.attr = "pol.layer1";
    dep.type = FT_UINT16;
    dep.val.uint16 = DLT_IEEE802_11_RADIO;
    ProtDep(&dep);

    /* dissectors registration */
    ProtDissectors(RadiotapDissector, NULL, NULL, NULL);

    return 0;
}


int DissectInit(void)
{
    prot_id = ProtId("radiotap");
    wlan_id = ProtId("wlan");
    
    return 0;
}
