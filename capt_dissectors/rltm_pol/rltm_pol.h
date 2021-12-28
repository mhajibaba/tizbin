/* rltm_pol.h
 *
 */


#ifndef __RLTM_POL_DEF_H__
#define __RLTM_POL_DEF_H__

#define RLTM_POL_PATH_DIM          4096
#define RLTM_POL_INIT_SESSION_FILE    "pol_sinit.cfg"
#define RLTM_POL_END_SESSION_FILE     "pol_send.cfg"
#define RLTM_POL_SESSION_ID           "SESSION_ID"
#define RLTM_POL_ID                   "POL_ID"

#include <unistd.h>

struct pcap_ref {
    unsigned int dlt;
    unsigned long cnt;
    size_t offset;
    char *dev;
    unsigned long ses_id;
    unsigned long pol_id;
};

#endif /* __RLTM_POL_DEF_H__ */
