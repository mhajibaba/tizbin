/*
 * msn.c
 *
 *
 */

#ifndef __MSN_H__
#define __MSN_H__

#include <stdio.h>

#include "pei.h"

/* standard port  */
#define TCP_PORT_MSN        1863

/* path buffer size */
#define MAXROWLEN          10240
#define MAXCHAR              300
#define ROWBUFDIM             20
#define MAXTOKEN              10


typedef struct _msn_chat msn_chat;
struct _msn_chat {
    int flow_id;
    char file_name[MAXCHAR];
    char receiver[MAXROWLEN];
    char client[MAXROWLEN];
    char name[MAXROWLEN*2];
    FILE *fp;
    pei *ppei;
};


#endif /* __MSN_H__ */
