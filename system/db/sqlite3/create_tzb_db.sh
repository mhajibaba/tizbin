#! /bin/bash
#

if [ "$1" = "" ]; then
    DIR_BASE=/opt/tizbin
else
    DIR_BASE=$1
fi

def=0
if [ -e $DIR_BASE/tzb.db ]; then
    def=1
fi

sqlite3 $DIR_BASE/tzb.db < params.sql
sqlite3 $DIR_BASE/tzb.db < groups.sql
sqlite3 $DIR_BASE/tzb.db < users.sql
sqlite3 $DIR_BASE/tzb.db < pols.sql
sqlite3 $DIR_BASE/tzb.db < sols.sql
sqlite3 $DIR_BASE/tzb.db < sources.sql
sqlite3 $DIR_BASE/tzb.db < emails.sql
sqlite3 $DIR_BASE/tzb.db < sips.sql
sqlite3 $DIR_BASE/tzb.db < rtps.sql
sqlite3 $DIR_BASE/tzb.db < inputs.sql
sqlite3 $DIR_BASE/tzb.db < webs.sql
sqlite3 $DIR_BASE/tzb.db < ftps.sql
sqlite3 $DIR_BASE/tzb.db < ftp_files.sql
sqlite3 $DIR_BASE/tzb.db < pjls.sql
sqlite3 $DIR_BASE/tzb.db < mms.sql
sqlite3 $DIR_BASE/tzb.db < mmscontents.sql
sqlite3 $DIR_BASE/tzb.db < feeds.sql
sqlite3 $DIR_BASE/tzb.db < feed_xmls.sql
sqlite3 $DIR_BASE/tzb.db < tftps.sql
sqlite3 $DIR_BASE/tzb.db < tftp_files.sql
sqlite3 $DIR_BASE/tzb.db < dns_messages.sql
sqlite3 $DIR_BASE/tzb.db < nntp_groups.sql
sqlite3 $DIR_BASE/tzb.db < nntp_articles.sql
sqlite3 $DIR_BASE/tzb.db < fbuchats.sql
sqlite3 $DIR_BASE/tzb.db < fbchats.sql
sqlite3 $DIR_BASE/tzb.db < telnets.sql
sqlite3 $DIR_BASE/tzb.db < webmail.sql
sqlite3 $DIR_BASE/tzb.db < httpfiles.sql
sqlite3 $DIR_BASE/tzb.db < unknows.sql
sqlite3 $DIR_BASE/tzb.db < arps.sql
sqlite3 $DIR_BASE/tzb.db < ircs.sql
sqlite3 $DIR_BASE/tzb.db < irc_channels.sql
sqlite3 $DIR_BASE/tzb.db < paltalk_exps.sql
sqlite3 $DIR_BASE/tzb.db < paltalks.sql
sqlite3 $DIR_BASE/tzb.db < msns.sql
sqlite3 $DIR_BASE/tzb.db < icmpv6s.sql
sqlite3 $DIR_BASE/tzb.db < syslogs.sql
sqlite3 $DIR_BASE/tzb.db < unkfiles.sql
sqlite3 $DIR_BASE/tzb.db < webymsgs.sql
sqlite3 $DIR_BASE/tzb.db < mgcps.sql
sqlite3 $DIR_BASE/tzb.db < whatsapps.sql

if [ $def = 0 ]; then
    sqlite3 $DIR_BASE/tzb.db < default.sql
fi


chmod 666 $DIR_BASE/tzb.db






