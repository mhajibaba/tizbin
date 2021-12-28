/* pol.h
 *
 */


#ifndef __PCAP_DEF_H__
#define __PCAP_DEF_H__

#define PCAP_PATH_DIM                4096
#define POL_INIT_SESSION_FILE    "pol_sinit.cfg"
#define POL_END_SESSION_FILE     "pol_send.cfg"
#define POL_SESSION_ID           "SESSION_ID"
#define POL_POL_ID               "POL_ID"
#define POL_POL_STATUS           "elab_status.log"

#include <unistd.h>

struct cap_ref {
    unsigned int dlt;
    unsigned long cnt;
    size_t offset;
    char *file_name;
    unsigned long ses_id;
    unsigned long pol_id;
};

#endif /* __PCAP_DEF_H__ */
