# QR-code-printer
Raspberry Pi based QR code printer, based on Tornado and the Brother QL line of thermal sticker printers. The first version of this codebase was based on some scrappy php and bash.

## Installation
Copy the files from `www` into the root of your web server, and copy `scripts` into the root of your Pi. Make sure to set the permissions correctly, as that is what usually breaks (particularly for the files in the `scripts` directory, as well as the `/dev/usb/lp0` device). 

### Printer library
Install the neccesary dependencies:
```bash
sudo aptitude install build-essential libpng12-0 libpng12-dev pkg-config
```
You will then need to run `make` in order to use the `ql570` library (in the `scripts/ql570` directory).

### autostart file
You will need to create an autostart file. Edit `/home/pi/.config/autostart/kiosk.desktop` and add the following:
```
[Desktop Entry]
Type=Application
Name=Kiosk
Exec=/home/pi/kiosk.sh
X-GNOME-Autostart-enabled=true
```

Next, you'll need the following in your home repository in the file `kiosk.sh`:
```
#!/bin/bash
 
# Run this script in display 0 - the monitor
export DISPLAY=:0
 
# If Chrome crashes (usually due to rebooting), clear the crash flag so we don't have the annoying warning bar
sed -i 's/"exited_cleanly":false/"exited_cleanly":true/' /home/pi/.config/chromium/Default/Preferences
sed -i 's/"exit_type":"Crashed"/"exit_type":"Normal"/' /home/pi/.config/chromium/Default/Preferences
 
# Run Chromium and open tabs
/usr/bin/chromium-browser -kiosk https://kiwicampus.com & 
```

To disable the screensaver from switching off the display, you need to edit `/etc/lightdm/lightdm.conf` and add the following to a section with `[SeatDefaults]` or `[Seat*]` in its name:
```
xserver-command=X -s 0 dpms
```

Note - I changed the instructions recently, and didn't figure out how to set the correct permissions on the printer. It's `chmod 777 /dev/usb/lp0` run at boot. This is important for several reaons - first of all, this disables screen blanking, then it fixes the permissions for the printer, then it opens up chromium whilst ignoring any errors that may clutter the screen.

## Usage
Go to the `/web` page from your computer or phone, or set up the `/kiosk` page to autostart in fullscreen kiosk mode on your Pi.

#### Useful shortcuts
```bash
# export your screen
export DISPLAY=:0

# see what's breaking
tail -f /var/log/apache2/access.log
tail -f /var/log/apache2/error.log

# print a file manually
/home/pi/ql570/ql570 /dev/usb/lp0 w /scripts/qrcode.png
```
