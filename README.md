# tizbin

## Install on Ubuntu

```
sudo apt-get update
sudo apt-get install git
sudo apt-get install make
sudo apt-get install build-essential
sudo apt-get install dh-autoreconf tcpdump tshark apache2 build-essential perl libzip-dev libpcap-dev libsqlite3-dev libx11-dev libxt-dev libxaw7-dev python3 python3-httplib2 python3-psycopg2 sqlite3 recode sox lame libnet1 libnet1-dev binfmt-support libssl-dev
sudo apt-get install libmaxminddb-dev postgresql libpq-dev libmysqlclient-dev pkg-config libjson-c-dev

tar -xvzf nDPI-2.8.tar.gz

git clone https://github.com/mhajibaba/tizbin.git

cd tizbin

sudo make install 
```

Run tizbin with web interface with root permission:
```
/opt/tizbin/script/sqlite_demo.sh
```
And finally restart Apache:
```
systemctl restart apache2
```
Now open the browser and type http://127.0.0.1:9876/ui/

***
The default username and password are:

 - username: *tizbin*
 - password: *tizbin*

The default admin username and password are: 

 - username: *admin*
 - password: *tizbin*
***
