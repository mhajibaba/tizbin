/* pjl.h
 *
 *
 *
 
  *
 *
     *
 *
 */


#ifndef __PJL_H__
#define __PJL_H__

/* path buffer size */
#define PJL_FILENAME_PATH_SIZE        256
#define PJL_CMD_NAME                  20

/* packets limit for PjlVerify, PjlCheck */
#define PJL_PKT_VER_LIMIT              10


typedef enum _pjl_client_dir  pjl_client_dir;
enum _pjl_client_dir {
    PJL_CLT_DIR_NONE,
    PJL_CLT_DIR_OK,
    PJL_CLT_DIR_REVERS
};


typedef struct _pjl_priv pjl_priv;
struct _pjl_priv {
    bool port_diff;         /* connection with different port */
    pjl_client_dir dir;     /* real direction of client */
    unsigned short port;    /* source port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip;               /* ip source */
};


#endif /* __PJL_H__ */
