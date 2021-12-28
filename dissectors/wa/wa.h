/* wa.h
 * Dissector for WahtsApp
 */


#ifndef __WA_H__
#define __WA_H__

/* path & buffer size */
#define WA_FILENAME_PATH_SIZE          512
#define WA_LINE_MAX_SIZE               1024

/* packets limit for dependency and cfg */
#define TCP_WA_PKT_LIMIT               5
#define TCP_PORTS_WA                   {443, 5222}


/* flags mask */
#define WA_FLAG_CRYP                   0x80

#define WA_MSG_LISTS                   0xf8
#define WA_MSG_STR                     0xfc
#define WA_MSG_STR_LG                  0xfd


#define WA_LBL_STREAM                  0x01
#define WA_LBL_ALL                     0x0c
#define WA_LBL_PAUSED                  0x88
#define WA_LBL_PICTURE                 0x89
#define WA_LBL_SOUND                   0xb5


typedef struct _wa_rcnst wa_rcnst;
struct _wa_rcnst {
    unsigned short dim;
    unsigned short len;
    unsigned char *msg;
    wa_rcnst *nxt;
};


typedef struct _wa_data wa_data;
struct _wa_data {
    char *device;
    char *phone;
};


typedef struct _wa_priv wa_priv;
struct _wa_priv {
    bool port_diff;         /* connection with different port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip_s;             /* ip source */
    ftval ip_d;             /* ip destination */
    unsigned short port_s;  /* source port */
    unsigned short port_d;  /* destination port */
    const pstack_f *stack;  /* protocol stack */
    size_t bsent;
    size_t breceiv;
    size_t blost_sent;
    size_t blost_receiv;
    unsigned long pkt_sent;
    unsigned long pkt_receiv;
};

#endif /* __WA_H__ */
