# server-status
A very simple server status web frontend. Inspired by various others found on the internet, but were complicated.

## files

* `index.php` - web frontend
* `statusconfig.php` - array of server info
* `statusupdate.txt` - client update script
* `statusupdate.php` - print the client update script (easier to wget)

## set-up

* Clone the repo on the server. (eg. http://status.ineal.me/)
* Update `statusconfig.php` with all your server info.
* On every client: `wget http://status.ineal.me/statusupdate.php` on the web root (or whatever matches your config). (eg. http://felix.ineal.me/statusupdate.php)
* Open the example http://status.ineal.me/ and see all your clients!
