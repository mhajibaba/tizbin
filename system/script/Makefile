# Makefile
#

PYCMPL = python3 -m compileall

# root directory
ROOT_DIR = $(shell pwd)
ifndef INSTALL_DIR
INSTALL_DIR = /opt/tizbin
endif


# src file
SRC = session_mng.py mimedump.py

# To make it visible
export CC CCPP ROOT_DIR CFLAGS LDFLAGS INCLUDE_DIR INSTALL_DIR

all: pycmpl


pycmpl: $(SRC:.py=.pyc)
	chmod +x *.pyc
	rm -rf __pycache__


%.pyc: %.py
	rm -f $@
	$(PYCMPL) $<
	if [ -d "__pycache__" ]; then mv __pycache__/*.pyc $@; fi

clean:
	rm -f *~
	rm -rf __pycache__
	rm -f *.pyc

install:
