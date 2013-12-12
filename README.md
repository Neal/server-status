# server-status
A very simple server status web frontend. Inspired by various others found on the internet, but were complicated.

## files

* `api.php` - json data with all server data
* `index.php` - web frontend
* `script/config.php` - config and server info
* `script/model.php` - php work for the frontend
* `statusupdate.txt` - client update script
* `statusupdate.php` - print the client update script (easier to wget)

## set-up

* Clone the repo on the server. (eg. http://status.ineal.me/)
* Update `script/config.php` with all your server info.
* On every client: `wget http://status.ineal.me/statusupdate.php` on the web root (or whatever matches your config). (eg. http://felix.ineal.me/statusupdate.php)
* Open the example http://status.ineal.me/ and see all your clients!
