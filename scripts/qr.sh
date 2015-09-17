#!/bin/bash
TEXT=$(echo $* | cut -d "|" -f5-)
#qrencode -o qr.png "$TEXT"
echo "$TEXT" | python /scripts/qr.py
#lp -d Brother_QL-700 qrcode.png
#/scripts/ql570/ql570 /dev/usb/lp0 w qrcode.png
screen -dm mpg123 /scripts/yt/printed.mp3
#rm qrcode.png
DATE=$(date "+%Y/%m/%d|%H:%M:%S")
echo $DATE"|"$* >> /var/www/printlog