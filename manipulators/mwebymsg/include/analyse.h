/* analise.h
 *
 */


#ifndef __ANALISE_H__
#define __ANALISE_H__

#include "pei.h"
#include "packet.h"

/* Yahoo chat: time constrains */
#define WYMSG_MSG_QUEUE           15
#define WYMSG_ADD_CHAT            10
#define WYMSG_STR_DIM             1024
#define WYMSG_MSG_TO              (300) /* sec */
#define WYMSG_MSG_MAX_SIZE        (1024*1024)

typedef struct _wymsg_chat_msg wymsg_chat_msg;
struct _wymsg_chat_msg {
    time_t mtime;   /* message time */
    char *from;     /* message from ... */
    char *to;       /* message to */
    char *msg;      /* message text */
    int size;       /* message size */
};


typedef struct _wymsg_chat wymsg_chat;
struct _wymsg_chat {
    char *user ;    /* client (first message) */
    char *friend;   /* friend */
    char *file;     /* file path */
    time_t first;   /* firs message time */
    time_t last;    /* last message time */
    pei *ppei;      /* chat pei */
    int ind;        /* msg index */
    time_t store;   /* last store time */
    wymsg_chat_msg *msg[WYMSG_MSG_QUEUE]; /* chat messages */
};


int AnalyseInit(void);
int AnalysePei(pei *ppei);
int AnalyseEnd(void);


#endif /* __ANALISE_H__ */
