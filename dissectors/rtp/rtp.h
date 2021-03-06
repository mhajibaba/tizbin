/* rtp.h
 *
 *
 *
 
 
 *
 *
     *
 *
 */


#ifndef __RTP_H__
#define __RTP_H__

#include <sys/types.h>
#include <sys/time.h>

#include "packet.h"

/* packets trashold to check rtp header */
#define RTP_PKT_LIMIT             25

/* packets check */
#define RTP_PKT_CHECK             7
#define RTP_PKT_ERR_CHECK         7

/* packets limit for RtpVerify, RtpCheck */
#define RTP_PKT_VER_LIMIT        (RTP_PKT_LIMIT + RTP_PKT_CHECK + RTP_PKT_ERR_CHECK)


typedef struct _rtp_hdr rtp_hdr;
struct _rtp_hdr {
#if __BYTE_ORDER == __BIG_ENDIAN
    unsigned char version:2;   /**< protocol version */
    unsigned char p:1;         /**< padding flag */
    unsigned char x:1;         /**< header extension flag */
    unsigned char cc:4;        /**< CSRC count */
    unsigned char m:1;         /**< marker bit */
    unsigned char pt:7;        /**< payload type */
#elif __BYTE_ORDER == __LITTLE_ENDIAN
    unsigned char cc:4;        /**< CSRC count */
    unsigned char x:1;         /**< header extension flag */
    unsigned char p:1;         /**< padding flag */
    unsigned char version:2;   /**< protocol version */
    unsigned char pt:7;        /**< payload type */
    unsigned char m:1;         /**< marker bit */
#else
# error "Please fix <bits/endian.h>"
#endif
    unsigned short seq;        /**< sequence number */
    unsigned int ts;           /**< timestamp */
    unsigned int ssrc;         /**< synchronization source */
} __attribute__((__packed__));


typedef struct _rtp_media rtp_media;
struct _rtp_media {
    unsigned short port;    /* port */
    struct timeval s_time;  /* start time */
    struct timeval e_time;  /* end time */
    unsigned char pt;       /* payload type */
    unsigned short seq;     /* sequence */
    unsigned int ssrc;      /* synchronization source of media*/
    rtp_media *nxt;         /* same media but different payload type */
};


typedef struct _rtp_priv rtp_priv;
struct _rtp_priv {
    bool port_diff;         /* connection with different port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip_s;             /* ip source */
    ftval ip_d;             /* ip destination */
    unsigned short port_s;  /* source port */
    unsigned short port_d;  /* destination port */
    const pstack_f *stack;  /* protocol stack */
};

#endif /* __RTP_H__ */
