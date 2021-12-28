/* mpei.c
 * PEI component definition of manupulator
 *
 */

#include "log.h"
#include "mpei.h"
#include "proto.h"

int ManipPeiComponent(void)
{
    pei_cmpt peic;
    
    /* user */
    peic.abbrev = "user";
    peic.desc = "Starting User";
    ProtPeiComponent(&peic);

    /* friend */
    peic.abbrev = "friend";
    peic.desc = "User called";
    ProtPeiComponent(&peic);

    /* chat friend */
    peic.abbrev = "chat";
    peic.desc = "Chat";
    ProtPeiComponent(&peic);

    /* duration */
    peic.abbrev = "duration";
    peic.desc = "Chat duration";
    ProtPeiComponent(&peic);

    return 0;
}
