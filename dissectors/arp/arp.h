/* arp.h
 * ARP and RARP dissector
 */


#ifndef __ARP_H__
#define __ARP_H__

#define ARPOP_REQUEST       1    /* ARP request.  */
#define ARPOP_REPLY         2    /* ARP reply.  */
#define ARPOP_RREQUEST      3    /* RARP request.  */
#define ARPOP_RREPLY        4    /* RARP reply.  */

#define MEDIA_ADDR_LEN      6
#define IP_ADDR_LEN         4
#define ARP_IP_STR_SIZE     100

struct arp_header {
   unsigned short ar_hrd;          /* Format of hardware address.  */
   unsigned short ar_pro;          /* Format of protocol address.  */
   unsigned char  ar_hln;          /* Length of hardware address.  */
   unsigned char  ar_pln;          /* Length of protocol address.  */
   unsigned short ar_op;           /* ARP opcode (command).  */
};


struct arp_eth_header {
   unsigned char arp_sha[MEDIA_ADDR_LEN];     /* sender hardware address */
   unsigned char arp_spa[IP_ADDR_LEN];      /* sender protocol address */
   unsigned char arp_tha[MEDIA_ADDR_LEN];     /* target hardware address */
   unsigned char arp_tpa[IP_ADDR_LEN];      /* target protocol address */
};


#endif

