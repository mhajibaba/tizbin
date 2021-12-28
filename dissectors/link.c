/* link.c
 * link all source to be used from hoder modules
 */


extern void in_cksum_link(void);
extern void http_link(void);
extern void sdp_link(void);


void DissectorLink(void)
{
    in_cksum_link();
    http_link();
    sdp_link();
}
