#!/usr/bin/env python2
# -*- coding: utf-8 -*-
import qrcode
from PIL import Image
import sys
import pdb

qr_data = sys.stdin.read()
qrcode_image = qrcode.make(qr_data, border=0)
qrcode_image = qrcode_image.resize((720, 720), Image.NEAREST)
qrcode_image.save("qrcode.png")