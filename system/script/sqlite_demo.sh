#! /bin/bash
#


# ulimit
ulimit -n 200000
ulimit -c unlimited
ulimit -m unlimited
ulimit -u unlimited
ulimit -v unlimited

# kill
killall dema

# add tizbin path
export PATH=$PATH:/opt/tizbin/bin
rm -f /opt/tizbin/bin/core*

# start dema
(cd /opt/tizbin/bin; ./dema -d /opt/tizbin -b sqlite) &


