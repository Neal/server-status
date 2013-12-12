<?php

$config = (object) array(
	'name' => 'Xee Labs, LLC.',
	'github_url' => 'http://github.com/Neal/server-status'
);

$servers = (object) array(
	'felix' => (object) array(
		'type' => 'Virtual Private Server',
		'os' => 'Linux',
		'host' => 'Linode',
		'location' => 'Dallas, TX',
		'ram' => '1024 MB',
		'storage' => '48 GB',
		'bandwidth' => '2 TB',
		'url' => 'http://felix.ineal.me/statusupdate'
	),
	'carbon' => (object) array(
		'type' => 'Virtual Private Server',
		'os' => 'Linux',
		'host' => 'Digital Ocean',
		'location' => 'Amsterdam',
		'ram' => '512 MB',
		'storage' => '20 GB',
		'bandwidth' => '1 TB',
		'url' => 'http://carbon.ineal.me/statusupdate'
	),
	'oryx' => (object) array(
		'type' => 'Virtual Private Server',
		'os' => 'Linux',
		'host' => 'Backupsy',
		'location' => 'Chicago, IL',
		'ram' => '512 MB',
		'storage' => '250 GB',
		'bandwidth' => '1 TB',
		'url' => 'http://oryx.ineal.me/statusupdate'
	)
);
