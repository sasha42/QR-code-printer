# QR-code-printer
Raspberry Pi based QR code printer, based on Tornado and the Brother QL line of thermal sticker printers. The first version of this codebase was based on some scrappy php and bash.

## Installation
Copy the files from `www` into the root of your web server, and copy `scripts` into the root of your Pi. Make sure to set the permissions correctly, as that is what usually breaks. You will need to run `make` in order to use the `ql570` library.

### autostart file
Make sure that your `/etc/xdg/lxsession/LXDE/autostart` file on your Raspberry Pi looks something like this:
```bash
@lxpanel --profile LXDE
@pcmanfm --desktop --profile LXDE
@xset s off
@xset -dpms
@xset s noblank
@sudo chmod 777 /dev/usb/lp0
@sed -i 's/"exited_cleanly": false/"exited_cleanly": true/' ~/.config/chromium/Default/Preferences
@chromium --noerrdialogs --kiosk http://localhost/kiosk.html
```

This is important for several reaons - first of all, this disables screen blanking, then it fixes the permissions for the printer, then it opens up chromium whilst ignoring any errors that may clutter the screen.

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