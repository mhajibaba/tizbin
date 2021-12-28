/* webmail.c
 * Web Mial services of AOL, Hotmail, Yahoo!
 */

#include <pcap.h>
#include <arpa/inet.h>
#include <string.h>
#include <stdio.h>

#include "proto.h"
#include "dmemory.h"
#include "etypes.h"
#include "log.h"
#include "pei.h"
#include "http.h"
#include "paltalk_exp.h"

static int prot_id;
static int pei_url_id;
static int pei_client_id;
static int pei_host_id;
static int pei_req_header_id;
static int pei_req_body_id;
static int pei_res_header_id;
static int pei_res_body_id;

static PktDissector HttpPktDis;  /* this functions create the http pei for all http packets */

static int PaltalkExpPei(packet* pkt)
{
    http_msg *msg;
    pei *ppei;
    pei_component *cmpn;

    ppei = NULL;

    /* display info */
    msg = (http_msg *)pkt->data;
    
    /* pei */
    PeiNew(&ppei, prot_id);
    PeiCapTime(ppei, pkt->cap_sec);
    PeiMarker(ppei, pkt->serial);
    PeiStackFlow(ppei, pkt->stk);
    /*   url */
    PeiNewComponent(&cmpn, pei_url_id);
    PeiCompCapTime(cmpn, msg->start_cap);
    PeiCompCapEndTime(cmpn, msg->end_cap);
    PeiCompAddStingBuff(cmpn, msg->uri);
    PeiAddComponent(ppei, cmpn);
    /*   clent */
    PeiNewComponent(&cmpn, pei_client_id);
    PeiCompCapTime(cmpn, msg->start_cap);
    PeiCompCapEndTime(cmpn, msg->end_cap);
    PeiCompAddStingBuff(cmpn, msg->client);
    PeiAddComponent(ppei, cmpn);
    /*   host */
    PeiNewComponent(&cmpn, pei_host_id);
    PeiCompCapTime(cmpn, msg->start_cap);
    PeiCompCapEndTime(cmpn, msg->end_cap);
    PeiCompAddStingBuff(cmpn, msg->host);
    PeiAddComponent(ppei, cmpn);
    /*   req hdr */
    if (msg->req_hdr_file) {
        PeiNewComponent(&cmpn, pei_req_header_id);
        PeiCompCapTime(cmpn, msg->start_cap);
        PeiCompCapEndTime(cmpn, msg->end_cap);
        PeiAddComponent(ppei, cmpn);
        PeiCompAddFile(cmpn, NULL, msg->req_hdr_file, msg->req_hdr_size);
        if (msg->error && msg->req_body_size == 0 && msg->res_hdr_size == 0) {
            PeiCompError(cmpn, ELMT_ER_PARTIAL);
        }
    }
    /*   req body */
    if (msg->req_body_size) {
        PeiNewComponent(&cmpn, pei_req_body_id);
        PeiCompCapTime(cmpn, msg->start_cap);
        PeiCompCapEndTime(cmpn, msg->end_cap);
        PeiAddComponent(ppei, cmpn);
        PeiCompAddFile(cmpn, NULL, msg->req_body_file, msg->req_body_size);
        if (msg->error && msg->res_hdr_size == 0) {
            PeiCompError(cmpn, ELMT_ER_PARTIAL);
        }
    }
    /*   res hdr */
    if (msg->res_hdr_size) {
        PeiNewComponent(&cmpn, pei_res_header_id);
        PeiCompCapTime(cmpn, msg->start_cap);
        PeiCompCapEndTime(cmpn, msg->end_cap);
        PeiAddComponent(ppei, cmpn);
        PeiCompAddFile(cmpn, NULL, msg->res_hdr_file, msg->res_hdr_size);
        if (msg->error && msg->res_body_size == 0) {
            PeiCompError(cmpn, ELMT_ER_PARTIAL);
        }
    }
    /*   res body */
    if (msg->res_body_size) {
        PeiNewComponent(&cmpn, pei_res_body_id);
        PeiCompCapTime(cmpn, msg->start_cap);
        PeiCompCapEndTime(cmpn, msg->end_cap);
        PeiAddComponent(ppei, cmpn);
        PeiCompAddFile(cmpn, NULL, msg->res_body_file, msg->res_body_size);
        if (msg->error == 2) {
            PeiCompError(cmpn, ELMT_ER_HOLE);
        }
        else if (msg->error != 0) {
            PeiCompError(cmpn, ELMT_ER_PARTIAL);
        }
    }
    
    /* insert pei */
    PeiIns(ppei);

    return 0;
}


static packet* PaltalkExpDissector(packet *pkt)
{
    http_msg *msg;
    bool ins;

    /* display info */
    msg = (http_msg *)pkt->data;
    ins = FALSE;

#ifdef XPL_CHECK_CODE
    if (msg->serial == 0) {
        LogPrintf(LV_FATAL, "Paltalk Express serial error");
        exit(-1);
    }
#endif
    
    /* yahoo! web mail */
    if (strstr(msg->host, "express.paltalk.com") != NULL) {
        if (strstr(msg->uri, "chat/") != NULL) {
            /* send to manipulator */
            PaltalkExpPei(pkt);
            ins = TRUE;
        }
    }
    
    if (ins == FALSE && HttpPktDis != NULL) {
        /* http pei generation and insertion */
        HttpPktDis(pkt);
    }
    else {
        /* free memory */
        HttpMsgFree(msg);
        PktFree(pkt);
    }

    return NULL;
}


int DissecRegist(const char *file_cfg)
{
    proto_dep dep;
    pei_cmpt peic;

    memset(&dep, 0, sizeof(proto_dep));
    memset(&peic, 0, sizeof(pei_cmpt));

    /* protocol name */
    ProtName("Paltalk Express", "paltalk_exp");

    /* http dependence */
    dep.name = "http";
    dep.attr = "http.host";
    dep.type = FT_STRING;
    dep.op = FT_OP_REX;
    dep.val.str = DMemMalloc(strlen(PLTEX_HOST_NAME_REX)+1);
    strcpy(dep.val.str, PLTEX_HOST_NAME_REX);
    ProtDep(&dep);

    /* PEI components */
    peic.abbrev = "url";
    peic.desc = "Uniform Resource Locator";
    ProtPeiComponent(&peic);

    peic.abbrev = "client";
    peic.desc = "Client";
    ProtPeiComponent(&peic);

    peic.abbrev = "host";
    peic.desc = "Host";
    ProtPeiComponent(&peic);

    peic.abbrev = "req.header";
    peic.desc = "Request header";
    ProtPeiComponent(&peic);

    peic.abbrev = "req.body";
    peic.desc = "Request body";
    ProtPeiComponent(&peic);

    peic.abbrev = "res.header";
    peic.desc = "Response header";
    ProtPeiComponent(&peic);

    peic.abbrev = "res.body";
    peic.desc = "Response body";
    ProtPeiComponent(&peic);
    
    /* dissectors registration */
    ProtDissectors(PaltalkExpDissector, NULL, NULL, NULL);

    return 0;
}


int DissectInit(void)
{
    int http_id;

    prot_id = ProtId("paltalk_exp");

    /* Http pei generator */
    HttpPktDis = NULL;
    http_id = ProtId("http");
    if (http_id != -1) {
        HttpPktDis = ProtPktDefaultDis(http_id);
    }

    /* pei id */
    pei_url_id = ProtPeiComptId(prot_id, "url");
    pei_client_id = ProtPeiComptId(prot_id, "client");
    pei_host_id = ProtPeiComptId(prot_id, "host");
    pei_req_header_id = ProtPeiComptId(prot_id, "req.header");
    pei_req_body_id = ProtPeiComptId(prot_id, "req.body");
    pei_res_header_id = ProtPeiComptId(prot_id, "res.header");
    pei_res_body_id = ProtPeiComptId(prot_id, "res.body");
    
    return 0;
}
