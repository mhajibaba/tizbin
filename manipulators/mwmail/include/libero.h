/* libero.h
 *
 */


#ifndef __LIBERO_H__
#define __LIBERO_H__

#include "pei.h"

/* webmail service: structures and define */
/*  Libero */
#define LIBERO_STR_SIZE        1024
typedef struct _email_libero_t email_libero;
struct _email_libero_t {
    char pid[LIBERO_STR_SIZE];     /* email pid */
    char header[LIBERO_STR_SIZE];  /* email header file */
    char body[LIBERO_STR_SIZE];    /* email body file */
    pei *ppei;                     /* first pei (but all stacks) */
    email_libero *next;            /* next element */
};

#endif /* __LIBERO_H__ */
