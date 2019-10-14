# XtreamUI
Xtream Codes 2.93 - Admin Interface



For installation, visit us at https://xtream-ui.com



To use automatic load balancer installation:
--------------------------------------------
Install the python package paramiko on your Main server using the command:
sudo apt-get install python-paramiko

For automatic-updates (once installed):
---------------------------------------
Edit settings.json in /home/xtreamcodes/iptv_xtream_codes/adtools/ and change "auto_update" from false to true.

For manual updates run this command from your XC server as root:
----------------------------------------------------------------
apt-get install unzip e2fsprogs python-paramiko -y && chattr -i /home/xtreamcodes/iptv_xtream_codes/GeoLite2.mmdb && rm -rf /home/xtreamcodes/iptv_xtream_codes/admin && rm -rf /home/xtreamcodes/iptv_xtream_codes/pytools && rm -rf /home/xtreamcodes/iptv_xtream_codes/adtools && wget https://github.com/xtreamui/XtreamUI/archive/master.zip -O /tmp/update.zip -o /dev/null && unzip /tmp/update.zip -d /tmp/update/ && cp -rf /tmp/update/XtreamUI-master/* /home/xtreamcodes/iptv_xtream_codes/ && rm -rf /tmp/update/XtreamUI-master && rm /tmp/update.zip && rm -rf /tmp/update && rm /home/xtreamcodes/iptv_xtream_codes/README.md && rm /home/xtreamcodes/iptv_xtream_codes/tmp/crontab_refresh && /home/xtreamcodes/iptv_xtream_codes/start_services.sh && chattr +i /home/xtreamcodes/iptv_xtream_codes/GeoLite2.mmdb