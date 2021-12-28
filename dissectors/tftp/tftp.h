/* tftp.h
 *
 */


#ifndef __TFTP_H__
#define __TFTP_H__

#include <stdio.h>

#include "packet.h"

/* packets check */
#define TFTP_PKT_CHECK             9

/* packets limit for TftpVerify, TftpCheck */
#define TFTP_PKT_VER_LIMIT         11

/* standard port */
#define UDP_PORT_TFTP              69

/* path buffer size */
#define TFTP_FILENAME_PATH_SIZE    256
#define TFTP_DATA_BUFFER           20480
#define TFTP_CMD_NAME              20
#define TFTP_PKT_TIMEOUT           50
#define TFTP_DATA_SIZE             512
#define TFTP_DATA_HEADER           4

/* opcode value */
#define	TFTP_RRQ	1
#define	TFTP_WRQ	2
#define	TFTP_DATA	3
#define	TFTP_ACK	4
#define	TFTP_ERROR	5
#define	TFTP_OACK	6
#define	TFTP_INFO	255

/* opcode sting */
#define TFTP_MSG_STRING { \
        "RRQ",            \
            "WRQ",        \
            "DATA",       \
            "ACK",        \
            "ERROR",      \
            "OACK",       \
            "INFO"        \
            }


typedef enum _tftp_oc tftp_oc;
enum _tftp_oc {
    TFTP_OC_RRQ = 0,
    TFTP_OC_WRQ,
    TFTP_OC_DATA,
    TFTP_OC_ACK,
    TFTP_OC_ERROR,
    TFTP_OC_OACK,
    TFTP_OC_INFO,
    TFTP_OC_NONE
};


typedef struct _optn optn;
struct _optn {
    char *option; /* option */
    char *val;    /* value */
    optn *nxt;    /* next option */
};


typedef struct _oreq oreq;
struct _oreq {
    char *file;   /* file name */
    char *mode;   /* mode */
    optn *options; /* options */
};


typedef struct _odat odat;
struct _odat {
    unsigned short block;  /* block number */
};


typedef struct _oerr oerr;
struct _oerr {
    unsigned short error; /* error code */
    char *msg;            /* error message */
};


typedef struct _tftp_msg tftp_msg;
struct _tftp_msg {
    tftp_oc oc;  /* opcode type */
    union {
        oreq rq;
        odat data;
        odat ack;
        oerr err;
    } m;
};


typedef struct _tftp_con tftp_con;
struct _tftp_con {
    char *file_cmd;  /* main comunication; cmd data */
    time_t cap_end;  /* capture end time */
    int ipv_id;      /* tftp IP version type */
    ftval ip;        /* tftp IP */
    unsigned short port;   /* tftp port */
    int up_n;        /* number of file uploaded */
    int down_n;      /* number of file downloaded */          
    int rule;        /* last rule id */
};


typedef struct _tftp_data tftp_data;
struct _tftp_data {
    int fid;             /* flow id */
    char *filename;      /* file name */
    char *file;          /* file path */
    FILE *fp;            /* file pointer */
    bool end;            /* file completed */
    bool convert;        /* convert data file */
    char conv_c;         /* convert support data */
    int blk;             /* last block */
    int blk_size;        /* block data size */
    time_t cap_start;    /* capture start time */
    time_t cap_end;      /* capture end time */
    unsigned long serial;    /* serial pkt num */
    pstack_f *stack;         /* stack info */
    pstack_f *gstack;        /* group stack info */
    bool lost;           /* data lost */
    bool download;       /* download or upload */
    tftp_data *nxt;      /* next */
};


typedef struct _tpkt_con tpkt_con;
struct _tpkt_con {
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip_s;             /* pkt ip source */
    unsigned short port_s;  /* pkt source port */
    ftval ip_d;             /* pkt ip destination */
    unsigned short port_d;  /* pkt destination port */
};


typedef struct _tftp_priv tftp_priv;
struct _tftp_priv {
    bool port_diff;         /* connection with different port */
    bool ipv6;              /* ipv6 or ipv4 */
    unsigned short port;    /* source port */
    ftval ip;               /* ip source */
    unsigned short portd;   /* destination port */
    ftval ipd;              /* ip destination */
};



#endif /* __TFTP_H__ */
