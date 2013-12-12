<?php

function size_readable($size, $retstring = '%01.2f %s') {
	$prefix = array('B', 'K', 'MB', 'GB', 'TB', 'PB');

	$i = 0;
	while ($size >= 1024 && $i < count($prefix)-1) {
		$size /= 1024;
		$i++;
	}

	return sprintf($retstring, $size, $prefix[$i]);
}

function get_level($progress) {
	return (($progress > 90) ? 'danger' : (($progress > 70) ? 'warning' : 'success'));
}

include __dir__ . '/config.php';

foreach ($servers as $name => $info) {

	$status = json_decode(file_get_contents($info->url));

	if (empty($status->uptime)) $status->uptime = '<span class="label label-important">DOWN</span>';

	$status->load[0]          = sprintf('%.2f', $status->load[0]);
	$status->load[1]          = sprintf('%.2f', $status->load[1]);
	$status->load[2]          = sprintf('%.2f', $status->load[2]);

	$status->memory->progress = $status->memory->used / $status->memory->total * 100;
	$status->memory->level    = get_level($status->memory->progress);

	$status->disk->progress   = $status->disk->used / $status->disk->total * 100;
	$status->disk->level      = get_level($status->disk->progress);

	$servers->$name->status   = $status;
}
