/* dispatch_dev.h
 * Dispatch interface private functions and structures
 */


#ifndef __DISPATCH_DEV_H__
#define __DISPATCH_DEV_H__

#include <pthread.h>

#include "pei.h"

#define DISP_D_STR_DIM          256
#define DISP_MANIP_START_PORT   23456


/* pei list, used in thread serial insert */
typedef struct _pei_list {
    pei *ppei;
    pthread_cond_t cond;
    struct _pei_list *nxt;
} pei_list;


/* manipulator connection info */
typedef struct {
    char name[DISP_D_STR_DIM];   /* protocol manipulator */
    char host[DISP_D_STR_DIM];   /* host name or ip address */
    char bin[DISP_D_STR_DIM];    /* binary file */
    unsigned short port;         /* port */
    int pid;                     /* protocol id */
    pthread_mutex_t *mux;        /* mutex to accesses and control connection events */
    int sock;                    /* socket */
    volatile bool wait;          /* wait manipulator restart */
    pei_list * volatile peil;    /* pei list in wait condiction */
    pei_list * volatile peilast; /* last pei in the queue */
} manip_con;


manip_con *DispatManip(int prot_id);
void DispatManipOff(int prot_id);
manip_con *DispatManipOffLine(void);
manip_con *DispatManipWait(void);
const char *DispatManipModulesCfg(void);



#endif /* __DISPATCH_DEV_H__ */
