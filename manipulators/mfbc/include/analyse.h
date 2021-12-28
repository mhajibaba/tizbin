/* analise.h
 *
 * $Id:  $
 *
 
 * 
 *
 *
     *
 *
 */


#ifndef __ANALYSE_H__
#define __ANALYSE_H__

#include "pei.h"
#include "packet.h"

/* facebook chat: time constrains */
#define FBC_MSG_QUEUE           15
#define FBC_ADD_CHAT            10
#define FBC_STR_DIM             1024
#define FBC_MSG_TO              (300) /* sec */


typedef struct _fb_chat_msg fb_chat_msg;
struct _fb_chat_msg {
    time_t mtime;   /* message time */
    char *from;     /* message from ... */
    char *msg;      /* message text */
    int size;       /* message size */
};

typedef struct _fb_chat fb_chat;
struct _fb_chat {
    char *cid;      /* client id */
    char *fid;      /* friend id */
    char *file;     /* file path */
    time_t first;   /* firs message time */
    time_t last;    /* last message time */
    pei *ppei;      /* chat pei */
    int ind;        /* msg index */
    time_t store;   /* last store time */
    fb_chat_msg *msg[FBC_MSG_QUEUE]; /* chat messages */
};


int AnalyseInit(void);
int AnalysePei(pei *ppei);
int AnalyseEnd(void);


#endif /* __ANALYSE_H__ */
