/* imap.h
 * 
 */


#ifndef __IMAP_H__
#define __IMAP_H__

#include "packet.h"

/* path buffer size */
#define IMAP_FILENAME_PATH_SIZE        256
#define IMAP_TAG_SIZE                  20
#define IMAP_DATA_BUFFER               20480

/* packets limit for ImapVerify, ImapCheck */
#define IMAP_PKT_VER_LIMIT             10

typedef enum _imap_cmd imap_cmd;
enum _imap_cmd {
    IMAP_CMD_APPEND,         /* RFC 3501 */
    IMAP_CMD_AUTHENTICATE,
    IMAP_CMD_CAPABILITY,
    IMAP_CMD_CHECK,
    IMAP_CMD_CLOSE,
    IMAP_CMD_COPY,
    IMAP_CMD_COMPRESS,
    IMAP_CMD_CREATE,
    IMAP_CMD_DELETE,
    IMAP_CMD_EXAMINE,
    IMAP_CMD_EXPUNGE,
    IMAP_CMD_FETCH,
    IMAP_CMD_ID,
    IMAP_CMD_LIST,
    IMAP_CMD_LOGIN,
    IMAP_CMD_LOGOUT,
    IMAP_CMD_LSUB,
    IMAP_CMD_NOOP,
    IMAP_CMD_RENAME,
    IMAP_CMD_SEARCH,
    IMAP_CMD_SELECT,
    IMAP_CMD_STARTTLS,
    IMAP_CMD_STATUS,
    IMAP_CMD_STORE,
    IMAP_CMD_SUBSCRIBE,
    IMAP_CMD_UID,            /* see also RFC 4315 */
    IMAP_CMD_UNSUBSCRIBE,
    IMAP_CMD_XATOM,
    IMAP_CMD_DELETEACL,      /* RFC 4314 */
    IMAP_CMD_GETACL,
    IMAP_CMD_LISTRIGHTS,
    IMAP_CMD_MYRIGHTS,
    IMAP_CMD_SETACL,
    IMAP_CMD_GETQUOTA,       /* RFC 2087 */
    IMAP_CMD_GETQUOTAROOT,
    IMAP_CMD_SETQUOTA,
    IMAP_CMD_UNSELECT,       /* RFC 3691 */
    IMAP_CMD_NAMESPACE,      /* RFC 2342 */
    IMAP_CMD_IDLE,           /* RFC 2177 */
    IMAP_CMD_NONE
};


typedef enum _imap_status imap_status;
enum _imap_status {
    IMAP_ST_BAD,
    IMAP_ST_BYE,
    IMAP_ST_NO,
    IMAP_ST_OK,
    IMAP_ST_PREAUTH,
    IMAP_ST_NONE
};


typedef enum _imap_tag imap_tag;
enum _imap_tag {
    IMAP_TAG_ID,      /* ID tag */
    IMAP_TAG_INCO,    /* incomplete tag response */
    IMAP_TAG_CON      /* continuation tag */
};


typedef struct _imap_conv imap_conv;
struct _imap_conv {
    char *clnt;          /* client data */
    int clnt_size;       /* client data size */
    int clnt_dim;        /* client data end dimension = {xxx}*/
    char *srv_cnt;       /* server data definition */
    char *srv;           /* server data */
    int srv_size;        /* server data szie */
    int srv_dim;         /* server data end dimension = {xxx}*/
    bool lost;           /* if data have hole */
    imap_conv *nxt;      /* next conversation */
};


typedef struct _imap_msg imap_msg;
struct _imap_msg {
    char tag[IMAP_TAG_SIZE];       /* command tag */
    char *cmd;                     /* command from client */
    int cmd_size;                  /* command buffer dim */
    char *repl;                    /* reply from server */
    int repl_line;                 /* line don't parsed */
    int repl_size;                 /* reply buffer dim */
    imap_conv *multp_conv;         /* multi conversation */
    bool first;                    /* first reply */
    imap_cmd cmdt;                 /* command type */
    imap_status st;                /* reply status */
    imap_conv *psrv_data;          /* server data */
    bool srv_data;                 /* data from server */
    bool complete;                 /* message complete */
    bool compress;                 /* flow compressed */
    time_t capt_start;             /* start time of message */
    time_t capt_end;               /* end time of message */
    imap_msg *nxt;                 /* next messagge (cmd + repl) */
};


typedef struct _imap_con imap_con;
struct _imap_con {
    bool port_diff;         /* connection with different port */
    unsigned short port;    /* source port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip;               /* ip source */
    imap_msg *login;        /* message with user name and password */
    const pstack_f *stack;  /* protocol stack */
};


#endif /* __IMAP_H__ */
