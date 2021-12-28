/* ca.h
 *
 */


#ifndef __PCAP_DEF_H__
#define __PCAP_DEF_H__

#define PCAP_PATH_DIM           4096
#define CA_END_FILE             "ds_end.cfg"
#define CA_DS_STATUS            "elab_status.log"

#include <unistd.h>

struct cap_ref {
    unsigned int dlt;
    unsigned long cnt;
    size_t offset;
    char *file_name;
    unsigned long file_id;
    unsigned long ds_id;
};

#endif /* __PCAP_DEF_H__ */
