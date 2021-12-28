/* ipsec_analysis.h
 * Dissector extract ESP informations
 */

#include <sys/types.h>

#ifndef __ESP_ANALYSIS_H__
#define __ESP_ANALYSIS_H__

/* path & buffer size */
#define ESP_CA_FILENAME_PATH_SIZE      256


typedef struct _espca_priv espca_priv;
struct _espca_priv {
    bool port_diff;         /* connection with different port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip_s;             /* ip source */
    ftval ip_d;             /* ip destination */
    const pstack_f *stack;  /* protocol stack */
    size_t bsent;
    size_t breceiv;
    unsigned long pkt_sent;
    unsigned long pkt_receiv;
    size_t *tarce_sent;
    size_t *tarce_receiv;
};

#endif /* __ESP_ANALYSIS_H__ */
