/* geoiploc.h
 *
 */


#ifndef __GEOIPLOC_H__
#define __GEOIPLOC_H__

#include "ftypes.h"

int GeoIPLocInit(const char *file_cfg);
int GeoIPLocIP(ftval *ip, enum ftype itype, float *latitude, float *longitude, char **country_code);

#endif

