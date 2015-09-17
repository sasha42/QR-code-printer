#!/usr/bin/env python2
# -*- coding: utf-8 -*-
import qrcode
from PIL import Image
import sys
import subprocess
import datetime

# Set variables
string = sys.stdin.read()
qr_data = string.split("|")[4]
time = datetime.datetime.now().strftime("%Y-%m-%d|%H:%M:%S|")

# Create and print QR
qrcode_image = qrcode.make(qr_data, border=0)
qrcode_image = qrcode_image.resize((720, 720), Image.NEAREST)
qrcode_image.save("/scripts/qrcode.png")
subprocess.call(["/scripts/ql570/ql570", "/dev/usb/lp0", "w", "/scripts/qrcode.png"])

# Log what happened
with open("/var/www/printlog", "a") as logfile:
    logfile.write(time + string)