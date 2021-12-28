/* mpei.c
 * PEI component definition of manupulator
 */

#include "log.h"
#include "mpei.h"
#include "proto.h"

int ManipPeiComponent(void)
{
    pei_cmpt peic;

    /* part */
    peic.abbrev = "parts";
    peic.desc = "File of parts";
    ProtPeiComponent(&peic);
    
    peic.abbrev = "complete";
    peic.desc = "Complete pencentual";
    ProtPeiComponent(&peic);

    return 0;
}
