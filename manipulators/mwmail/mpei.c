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

    /* service */
    peic.abbrev = "serv";
    peic.desc = "Mail service";
    ProtPeiComponent(&peic);

    /* to */
    peic.abbrev = "to";
    peic.desc = "To Addresses";
    ProtPeiComponent(&peic);

    /* from */
    peic.abbrev = "from";
    peic.desc = "From Addresses";
    ProtPeiComponent(&peic);

    /* cc */
    peic.abbrev = "cc";
    peic.desc = "Cc Addresses";
    ProtPeiComponent(&peic);

    /* date */
    peic.abbrev = "sent";
    peic.desc = "Sent date";
    ProtPeiComponent(&peic);

    /* date */
    peic.abbrev = "rec";
    peic.desc = "Received date";
    ProtPeiComponent(&peic);

    /* message id */
    peic.abbrev = "id";
    peic.desc = "Message ID";
    ProtPeiComponent(&peic);

    /* subject */
    peic.abbrev = "subject";
    peic.desc = "Subject";
    ProtPeiComponent(&peic);

    /* eml */
    peic.abbrev = "eml";
    peic.desc = "MIME type";
    ProtPeiComponent(&peic);

    /* html */
    peic.abbrev = "html";
    peic.desc = "HTML email";
    ProtPeiComponent(&peic);

    /* txt */
    peic.abbrev = "txt";
    peic.desc = "Txt email";
    ProtPeiComponent(&peic);

    return 0;
}
