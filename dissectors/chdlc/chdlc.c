/* cdlc.c
 * Cisco HDLC dissector
 * See section 4.3.1 of RFC 1547, and http://www.nethelp.no/net/cisco-hdlc.txt
 *
 */

#include <pcap.h>
#include <stdio.h>
#include <netinet/if_ether.h>
#include <arpa/inet.h>
#include <string.h>

#include "proto.h"
#include "dmemory.h"
#include "log.h"


static int prot_id;
static int proto_id;

/* Field address */
#define CHDLC_ADDR_UNICAST	0x0f
#define CHDLC_ADDR_MULTICAST	0x8f

static packet* ChdlcDissector(packet *pkt)
{
    pstack_f *frame;
    ftval val;
    int len;
    int proto_offset;
    unsigned short chdlc_prot;

    len = 0;
    proto_offset = 2;
    
    /* new frame */
    frame = ProtCreateFrame(prot_id);
    ProtSetNxtFrame(frame, pkt->stk);
    pkt->stk = frame;

    /* set attribute */
    chdlc_prot = ntohs(*((uint16_t *)(pkt->data + proto_offset)));
    len = 2;
    val.uint16 = chdlc_prot;
    ProtInsAttr(frame, proto_id, &val);

    /* pdu */
    pkt->data += len + proto_offset;
    pkt->len -= len + proto_offset;

    return pkt;
}


int DissecRegist(const char *file_cfg)
{
    proto_info info;
    proto_dep dep;

    memset(&info, 0, sizeof(proto_info));
    memset(&dep, 0, sizeof(proto_dep));

    /* protocol name */
    ProtName("Cisco HDLC", "chdlc");
    
    /* Protocol */
    info.name = "Protocol";
    info.abbrev = "chdlc.protocol";
    info.type = FT_UINT16;
    proto_id = ProtInfo(&info);
    
    /* dep: pcapf */
    dep.name = "pcapf";
    dep.attr = "pcapf.layer1";
    dep.type = FT_UINT16;
    dep.val.uint16 = DLT_CHDLC;
    ProtDep(&dep);
    
    /* dep: pol */
    dep.name = "pol";
    dep.attr = "pol.layer1";
    dep.type = FT_UINT16;
    dep.val.uint16 = DLT_CHDLC;
    ProtDep(&dep);

    /* dissectors registration */
    ProtDissectors(ChdlcDissector, NULL, NULL, NULL);

    return 0;
}


int DissectInit(void)
{
    prot_id = ProtId("chdlc");

    return 0;
}
