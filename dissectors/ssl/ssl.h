/* ssl.h
 * Dissector to extract SSL information
 */


#ifndef __SSL_H__
#define __SSL_H__


/* packets limit for dependency and cfg */
#define TCP_SSL_PKT_LIMIT               4
#define TCP_PORTS_SSL                   {443}

typedef struct _ssl_rcnst ssl_rcnst;
struct _ssl_rcnst {
    unsigned short dim;
    unsigned short len;
    unsigned char *msg;
    ssl_rcnst *nxt;
};



typedef struct _ssl_priv ssl_priv;
struct _ssl_priv {
    bool port_diff;         /* connection with different port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip_s;             /* ip source */
    unsigned short port_s;  /* source port */
    const pstack_f *stack;  /* protocol stack */
};

#endif /* __SSL_H__ */
