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

#include <time.h>
#include <stdio.h>

#include "pei.h"
#include "packet.h"

#define PLTEX_WAIT_TIME        10    /* sec */
#define PLTEX_BUFFER_SIZE      (1024*1204)
#define PLTEX_CMD_SIZE         (3*1024)
#define PLTEX_TMP_DIR          "paltalck_exp"

/* strings */
#define PLTEX_STR_START           "<pfont"
#define PLTEX_STR_END             "</pfont>"

/* paltalk express chat: time constrains */
typedef struct _pt_chat pt_chat;
struct _pt_chat {
    char id[PLTEX_CMD_SIZE];   /* chat id and user name */
    char chat[PLTEX_CMD_SIZE]; /* file messages */
    FILE *fp;                  /* file pointer */
    time_t first; /* date of first message */
    time_t last;  /* date of last message */
    pei *ppei;
    pt_chat *nxt;
};


typedef struct _pei_msg pei_msg;
struct _pei_msg {
    time_t t;     /* arrival time */
    pei *pei;     /* pei */
    pei_msg * volatile nxt; /* next */
};

int AnalyseInit(void);
int AnalysePei(pei *ppei);
int AnalyseEnd(void);


#endif /* __ANALYSE_H__ */
