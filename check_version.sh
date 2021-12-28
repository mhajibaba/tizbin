#!/bin/bash
PATH=${PATH}:/usr/local/sbin:/usr/sbin:/sbin:/usr/local/bin:/usr/bin:/bin
################################################################################

latest_version_absurl="http://projects.tizbin.org/version/tizbin_ver.txt"
this_version_relpath="include/version.h"

timeout=1
if [ "$1" = "" ]; then
    timeout=20
fi

this_version_a="`cat "$this_version_relpath" | grep TIZBIN_VER_MAG  | cut -f 3 -d ' ' `"
this_version_b="`cat "$this_version_relpath" | grep TIZBIN_VER_MIN  | cut -f 3 -d ' ' `"
this_version_c="`cat "$this_version_relpath" | grep TIZBIN_VER_REV  | cut -f 3 -d ' ' `"
this_version=$this_version_a.$this_version_b.$this_version_c
latest_version="`wget -T $timeout  --user-agent=\"tizbin "$this_version"\" -t 1 -qO- "$latest_version_absurl" 2> /dev/null | cut -f2- -d=`"

if [ "$latest_version" != "" ] ;
  then
    if [ "$latest_version" = "$this_version" ] ;
       then
        if [ "$1" = "" ]; then
            echo "You have the latest available version!"
        fi
    else
        if [[ "$latest_version" > "$this_version" ]];
            then
            echo ""
            echo "There is a NEW version of tizbin. (ver: $latest_version)"
            echo ""
        fi
    fi
fi





