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
    peic.desc = "User nick name";
    ProtPeiComponent(&peic);

    /* chat */
    peic.abbrev = "chat";
    peic.desc = "Chat";
    ProtPeiComponent(&peic);

    /* duration */
    peic.abbrev = "duration";
    peic.desc = "Chat duration";
    ProtPeiComponent(&peic);

    return 0;
}
