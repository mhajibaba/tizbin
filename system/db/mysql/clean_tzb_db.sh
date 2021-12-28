#! /bin/bash
#


if [ "$1" = "" ]; then 
   echo "Usage: ./clean_tzb_db.sh <mysql_root_password>";
   exit;
fi


user="root"
password=$1

mysql --user=$user --password=$password tizbin < clean.sql








