/* tcp_garbage.h
 * Dissector to group together packet of tcp flow that haven't a specific dissector
 *  *
 *
 */

#include <sys/types.h>

#ifndef __TCP_GARBAGE_H__
#define __TCP_GARBAGE_H__

/* threshold limit */
#define TCP_GRB_PERCENTAGE              80

/* path & buffer size */
#define TCP_GRB_THRESHOLD               (10*1024)
#define TCP_GRB_FILENAME_PATH_SIZE      512
#define TCP_CFG_LINE_MAX_SIZE           1024

/* packets limit for dependency and cfg */
#define TCP_GRB_PKT_LIMIT               50
#define TCP_GRB_PKT_LIMIT_CFG           "TCP_GRB_PKT_LIMIT"
#define TCP_GRB_CFG_FILE                "TCP_GRB_CFG_FILE"


typedef struct _tgrb_priv tgrb_priv;
struct _tgrb_priv {
    bool port_diff;         /* connection with different port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip_s;             /* ip source */
    ftval ip_d;             /* ip destination */
    unsigned short port_s;  /* source port */
    unsigned short port_d;  /* destination port */
    const pstack_f *stack;  /* protocol stack */
};


#endif /* __TCP_GARBAGE_H__ */
