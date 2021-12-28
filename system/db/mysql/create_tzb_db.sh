#! /bin/bash
#


if [ "$1" = "" ]; then 
    echo "Usage: ./create_tzb_db.sh <mysql_root_password> <tizbin_db_password> [-u]";
    exit;
fi

if [ "$2" = "" ]; then 
    echo "Usage: ./create_tzb_db.sh <mysql_root_password> <tizbin_db_password> [-u]";
    exit;
fi

update=0
if [ "$3" = "-u" ]; then
    update=1
else
    if [ "$3" != "" ]; then
        echo "Usage: ./create_tzb_db.sh <mysql_root_password> <tizbin_db_password> [-u]";
        exit;
    fi
fi


user="root"
password=$1
tizbin_pass=$2

# delete tizbin db and user if exist
if [ $update = 0 ]; then
    echo "DROP DATABASE IF EXISTS tizbin;" | mysql --user=$user --password=$password
    echo "DROP USER 'tizbin'@'localhost';" | mysql --user=$user --password=$password >& /dev/null

# create tizbin DB and user
    echo "CREATE DATABASE tizbin;" | mysql --user=$user --password=$password
    echo "CREATE USER 'tizbin'@'localhost' IDENTIFIED BY '"$tizbin_pass"';" | mysql --user=$user --password=$password
    echo "GRANT ALL PRIVILEGES ON tizbin.* TO 'tizbin'@'localhost';" | mysql --user=$user --password=$password
fi

# create tables
mysql --user=$user --password=$password tizbin < params.sql
mysql --user=$user --password=$password tizbin < groups.sql
mysql --user=$user --password=$password tizbin < users.sql
mysql --user=$user --password=$password tizbin < pols.sql
mysql --user=$user --password=$password tizbin < sols.sql
mysql --user=$user --password=$password tizbin < sources.sql
mysql --user=$user --password=$password tizbin < emails.sql
mysql --user=$user --password=$password tizbin < sips.sql
mysql --user=$user --password=$password tizbin < rtps.sql
mysql --user=$user --password=$password tizbin < inputs.sql
mysql --user=$user --password=$password tizbin < webs.sql
mysql --user=$user --password=$password tizbin < ftps.sql
mysql --user=$user --password=$password tizbin < ftp_files.sql
mysql --user=$user --password=$password tizbin < pjls.sql
mysql --user=$user --password=$password tizbin < mms.sql
mysql --user=$user --password=$password tizbin < mmscontents.sql
mysql --user=$user --password=$password tizbin < feeds.sql
mysql --user=$user --password=$password tizbin < feed_xmls.sql
mysql --user=$user --password=$password tizbin < tftps.sql
mysql --user=$user --password=$password tizbin < tftp_files.sql
mysql --user=$user --password=$password tizbin < dns_messages.sql
mysql --user=$user --password=$password tizbin < nntp_groups.sql
mysql --user=$user --password=$password tizbin < nntp_articles.sql
mysql --user=$user --password=$password tizbin < fbuchats.sql
mysql --user=$user --password=$password tizbin < fbchats.sql
mysql --user=$user --password=$password tizbin < telnets.sql
mysql --user=$user --password=$password tizbin < webmail.sql
mysql --user=$user --password=$password tizbin < httpfiles.sql
mysql --user=$user --password=$password tizbin < unknows.sql
mysql --user=$user --password=$password tizbin < arps.sql
mysql --user=$user --password=$password tizbin < ircs.sql
mysql --user=$user --password=$password tizbin < irc_channels.sql
mysql --user=$user --password=$password tizbin < paltalk_exps.sql
mysql --user=$user --password=$password tizbin < paltalks.sql
mysql --user=$user --password=$password tizbin < msns.sql
mysql --user=$user --password=$password tizbin < icmpv6s.sql
mysql --user=$user --password=$password tizbin < syslogs.sql
mysql --user=$user --password=$password tizbin < unkfiles.sql
mysql --user=$user --password=$password tizbin < webymsgs.sql
mysql --user=$user --password=$password tizbin < mgcps.sql
mysql --user=$user --password=$password tizbin < whatsapps.sql

if [ $update = 0 ]; then
    mysql --user=$user --password=$password tizbin < default.sql
fi





