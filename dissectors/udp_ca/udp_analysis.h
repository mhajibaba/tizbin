/* udp_analysis.h
 * Dissector extract UDP informations
 *
 */

#include <sys/types.h>

#ifndef __UDP_ANALYSIS_H__
#define __UDP_ANALYSIS_H__

/* path & buffer size */
#define UDP_CA_FILENAME_PATH_SIZE      256
#define UDP_CA_LINE_MAX_SIZE           1024

/* packets limit for dependency */
#define UDP_CA_PKT_LIMIT               0
#define UDP_CA_PKT_LIMIT_CFG           "UDP_CA_PKT_LIMIT"


typedef struct _uca_priv uca_priv;
struct _uca_priv {
    bool port_diff;         /* connection with different port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip_s;             /* ip source */
    ftval ip_d;             /* ip destination */
    unsigned short port_s;  /* source port */
    unsigned short port_d;  /* destination port */
    const pstack_f *stack;  /* protocol stack */
    size_t bsent;
    size_t breceiv;
    unsigned long pkt_sent;
    unsigned long pkt_receiv;
    size_t *tarce_sent;
    size_t *tarce_receiv;
    char img1[UDP_CA_FILENAME_PATH_SIZE];
    char img2[UDP_CA_FILENAME_PATH_SIZE];
};

#endif /* __UDP_ANALYSIS_H__ */
