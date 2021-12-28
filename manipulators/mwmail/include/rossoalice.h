/* rossoalice.h
 *
 */


#ifndef __ROSSOALICE_H__
#define __ROSSOALICE_H__

#include <time.h>

#define RALICE_STR_SIZE       2048

typedef struct _ra_attach_t ra_attach;
struct _ra_attach_t {
    char attach[RALICE_STR_SIZE];
    ra_attach *nxt;
};

typedef struct _ralice_t ralice;
struct _ralice_t {
    char ref[RALICE_STR_SIZE];
    char uid[RALICE_STR_SIZE];
    char header[RALICE_STR_SIZE];
    char body[RALICE_STR_SIZE];
    pei *ppei;                     /* first pei (but all stacks) */
    ra_attach *attach;
    time_t start;
    ralice *nxt;
};

#endif /* __ROSSOALICE_H__ */
