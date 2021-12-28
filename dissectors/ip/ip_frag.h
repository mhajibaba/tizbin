/* ip_frag.h
 *
 *
 *
 
  *
 *
     *
 *
 */

#ifndef __IP_FRAG_H__
#define __IP_FRAG_H__

#include <netinet/ip.h>

#include "packet.h"
#include "istypes.h"

/* not swaped */
#define IP_FRG_MASK    0xff1f
#define IP_FRG_DF      0x40
#define IP_FRG_MF      0x20
#define IP_FRG_HSH     0x00ff


#define IP_HSH_TBL      256
#define IP_TO_SEC       60
#define IP_PKT_MAX_DIM  (10*1024)

typedef struct _ipv4_frag_t  ipv4_frag;
struct _ipv4_frag_t {
    struct iphdr *ip;
    bool last;
    packet *pkt;
    ipv4_frag *frg;
    ipv4_frag *nxt;
};


#endif
