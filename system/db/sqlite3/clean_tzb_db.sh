#! /bin/bash
#

if [ "$1" = "" ]; then
    DIR_BASE=/opt/tizbin
else
    DIR_BASE=$1
fi

sqlite3 $DIR_BASE/tzb.db < clean.sql








