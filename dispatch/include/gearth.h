/* gearth.h
 * Create, from pei, the kml file to rappresent all connetcion with Google Earth
 */

#ifndef __GEARTH_H__
#define __GEARTH_H__

#include "pei.h"

/* IMPORTANT: those functions can be used ONLY inside dispatcers */
int GearthNew(unsigned long id, const char *kml_path, const char *kml_tmp, const char *sem_name);
int GearthPei(unsigned long id, const pei *ppei);
int GearthClose(unsigned long id);

#endif /* __GEARTH_H__ */
