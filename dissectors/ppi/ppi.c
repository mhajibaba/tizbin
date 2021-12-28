/* ppi.c
 * PPI Packet Header dissection
 * Routines for PPI Packet Header dissection
 */

#include <pcap.h>
#include <stdio.h>
#include <netinet/if_ether.h>
#include <arpa/inet.h>
#include <string.h>

#include "proto.h"
#include "dmemory.h"
#include "ntoh.h"
#include "log.h"
#include "ppi.h"


static int prot_id;
static int dlt_id;

static packet *PpiDissector(packet *pkt)
{
    pstack_f *frame;
    ftval val;
    unsigned int offset;
    ppi_header *ppih;
    
    offset = 0;
    
    if (pkt->len < sizeof(ppi_header)) {
        PktFree(pkt);
        return NULL;
    }

    /* new frame */
    frame = ProtCreateFrame(prot_id);
    ProtSetNxtFrame(frame, pkt->stk);
    pkt->stk = frame;

    /* set attribute */
    ppih = (ppi_header *)pkt->data;
    offset = kswaps(&ppih->len);
    val.uint32 = kswapsl(&ppih->dlt);
    ProtInsAttr(frame, dlt_id, &val);
    
    /* pdu */
    pkt->data += offset;
    pkt->len -= offset;

    return pkt;
}


int DissecRegist(const char *file_cfg)
{
    proto_info info;
    proto_dep dep;

    memset(&info, 0, sizeof(proto_info));
    memset(&dep, 0, sizeof(proto_dep));

    /* protocol name */
    ProtName("PPI Packet Header", "ppi");
    
    /* Protocol */
    info.name = "Data Link Type (DLT)";
    info.abbrev = "ppi.dlt";
    info.type = FT_UINT32;
    dlt_id = ProtInfo(&info);
    
    /* dep: pcapf */
    dep.name = "pcapf";
    dep.attr = "pcapf.layer1";
    dep.type = FT_UINT16;
    dep.val.uint16 = DLT_PPI;
    ProtDep(&dep);
    
    /* dep: pol */
    dep.name = "pol";
    dep.attr = "pol.layer1";
    dep.type = FT_UINT16;
    dep.val.uint16 = DLT_PPI;
    ProtDep(&dep);

    /* dissectors registration */
    ProtDissectors(PpiDissector, NULL, NULL, NULL);

    return 0;
}


int DissectInit(void)
{
    prot_id = ProtId("ppi");

    return 0;
}
