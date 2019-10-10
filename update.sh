#!/bin/bash
read -p "Start installation? (Y/N)? " -n 1 -r
echo
case "$REPLY" in 
  y|Y )
    rm -r /home/xtreamcodes/iptv_xtream_codes/admin/*
    wget https://github.com/Nilbertocs/XtreamUI/archive/master.zip -O /tmp/update.zip -o /dev/null
    unzip /tmp/update.zip -d /tmp/update/
    mv /tmp/update/XtreamUI-master/* /home/xtreamcodes/iptv_xtream_codes/admin/
    rm /tmp/update.zip
    rm -r /tmp/update
    chmod -R 0777 /home/xtreamcodes/iptv_xtream_codes/admin
    chown -R xtreamcodes:xtreamcodes /home/xtreamcodes/iptv_xtream_codes/admin
    rm /home/xtreamcodes/iptv_xtream_codes/admin/README.md
n|N ) echo "Stop Installation ..."; tput sgr0; ;;
* ) echo "Type only Y or N";tput sgr0; ;;
esac
exit 0