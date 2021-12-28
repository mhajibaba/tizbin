/* pcap.h
 *
 * $Id: pcapd.h,v 1.2 2007/05/30 06:03:53 Exp $
 */


#ifndef __PCAP_DEF_H__
#define __PCAP_DEF_H__

#define PCAP_PATH_DIM          4096


struct cap_ref {
    unsigned int dlt;
    unsigned long cnt;
    char *file_name;
};

#endif /* __PCAP_DEF_H__ */
