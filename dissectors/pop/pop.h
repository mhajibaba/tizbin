/* pop.h
 *
 */


#ifndef __POP_H__
#define __POP_H__

#include "packet.h"


/* path buffer size */
#define POP_FILENAME_PATH_SIZE        256
#define POP_DATA_BUFFER               20480
#define POP_CRYPTED                   "ENCRYPTED"

/* standard port */
#define TCP_PORT_POP           110

/* packets limit for PopVerify, PopCheck */
#define POP_PKT_VER_LIMIT      10

typedef enum _pop_cmd pop_cmd;
enum _pop_cmd {
    POP_CMD_APOP,      /* RFC1939 */
    POP_CMD_DELE,
    POP_CMD_LIST,
    POP_CMD_NOOP,
    POP_CMD_PASS,
    POP_CMD_QUIT,
    POP_CMD_RETR,
    POP_CMD_RSET,
    POP_CMD_STAT,
    POP_CMD_TOP,
    POP_CMD_UIDL,
    POP_CMD_USER,
    POP_CMD_CAPA,      /* RFC 2449 */
    POP_CMD_STLS,      /* RFC 2595 */
    POP_CMD_AUTH,      /* RFC 1734 */
    POP_CMD_XTND,      /* RFC 1082 */
    POP_CMD_AUTH_CONT,  /* unknow command, continuation of AUTH */
    POP_CMD_NONE
};


typedef enum _pop_status pop_status;
enum _pop_status {
    POP_ST_OK,
    POP_ST_ERR,
    POP_ST_CONT,
    POP_ST_NONE
};


typedef struct _pop_msg pop_msg;
struct _pop_msg {
    char *cmd;                     /* command from client */
    int cmd_size;                  /* command buffer dim */
    char *repl;                    /* reply from server */
    int repl_size;                 /* reply buffer dim */
    char *multp_resp;              /* multi-line response */
    int mlp_res_size;              /* multi-line response size */
    bool first;                    /* first reply */
    pop_cmd cmdt;                  /* command type */
    pop_status st;                 /* reply status */
    bool auth_cont;                /* auth continuation command */
    bool complete;                 /* message complete */
    time_t capt_start;             /* start time of message */
    time_t capt_end;               /* end time of message */
    char *file_eml;                /* data file name */
    int fd_eml;                    /* file descriptor */
    char data[3*POP_DATA_BUFFER];  /* buffer to find \r\n.\r\n */
    int dsize;                     /* data buffer size */
    pop_msg *nxt;                  /* next messagge (cmd + repl) */
};


typedef struct _pop_con pop_con;
struct _pop_con {
    bool port_diff;         /* connection with different port */
    unsigned short port;    /* source port */
    bool ipv6;              /* ipv6 or ipv4 */
    ftval ip;               /* ip source */
    pop_msg *user;          /* message with user name */
    pop_msg *passwd;        /* message with password */
    const pstack_f *stack;  /* protocol stack */
};


#endif /* __POP_H__ */
