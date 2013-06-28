<?php
function size_readable($size, $retstring = '%01.2f %s') {
	$prefix = array('B', 'K', 'MB', 'GB', 'TB', 'PB');

	$i = 0;
	while ($size >= 1000 && $i < count($prefix)-1) {
		$size /= 1000;
		$i++;
	}

	return sprintf($retstring, $size, $prefix[$i]);
}

include (__DIR__ . '/statusconfig.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>iNeal.ME Server Status</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Le styles -->
		<link href="http://twitter.github.io/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
		<link href="http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">
		<style>
			body { padding-top: 60px; }
			.table-center th { vertical-align: middle; text-align: center; }
			.table-center td { vertical-align: middle; text-align: center; }
			.custombar { height: 15px; margin-bottom: 0px; }
		</style>
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">iNeal.ME Server Status</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li class="active"><a href="#status" data-toggle="tab">Status</a></li>
							<li><a href="#servers" data-toggle="tab">Servers</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">

			<div class="tabbable" style="margin-bottom: 20px;">

				<div class="tab-content">

					<div class="tab-pane active" id="status">

						<table class="table table-bordered table-hover table-center">
							<thead>
								<tr>
									<th class="span2" scope="col">Name</th>
									<th class="span2" scope="col">Uptime</th>
									<th class="span3" scope="col">RAM</th>
									<th class="span3" scope="col">Disk</th>
									<th class="span2" scope="col">Load</th>
								</tr>
							</thead>
							<tbody>
<?php

foreach ($servers as $serverinfo) {

	$server = (array) json_decode(file_get_contents($serverinfo['url']));
	foreach ($server as $serveritemkey=>$serveritemvalue) {
		if (is_object($server[$serveritemkey])) {
			$server[$serveritemkey] = (array) $server[$serveritemkey];
		}
	}

	$uptime = $server['uptime'];
	if(empty($uptime)) $uptime = '<span class="label label-important">DOWN</span>';

	$memused = ($server['memory']['used'] * 1024) - ($server['memory']['bufcac'] * 1024);
	$memtotal = $server['memory']['total'] * 1024;
	$memprogress = $memused / $memtotal * 100;

	if ($memprogress < '70') { $memlevel = "success"; }
	elseif ($memprogress < '90') { $memlevel = "warning"; }
	else { $memlevel = "danger"; }

	$hddused = size_readable($server['disk']['used'] * 1024);
	$hddtotal = size_readable($server['disk']['total'] * 1024);
	$hddprogress = $hddused / $hddtotal * 100;

	if ($hddprogress < '70') { $hddlevel = "success"; }
	elseif ($hddprogress < '90') { $hddlevel = "warning"; }
	else { $hddlevel = "danger"; }

	$loadone = $server['load']['one'];
	$loadfive = $server['load']['five'];
	$loadfifteen = $server['load']['fifteen'];

?>
								<tr style="text-align: center">
									<td><?php echo $serverinfo['name']; ?></td>
									<td><?php echo $uptime; ?></td>
									<td>
										<?php echo size_readable($memused) . ' / ' . size_readable($memtotal); ?>
										<div class="custombar progress progress-<?php echo $memlevel; ?>">
											<div class="bar" style="width: <?php echo $memprogress; ?>%;"></div>
										</div>
									</td>
									<td>
										<?php echo $hddused . ' / ' . $hddtotal; ?>
										<div class="custombar progress progress-<?php echo $hddlevel; ?>">
											<div class="bar" style="width: <?php echo $hddprogress; ?>%;"></div>
										</div>
									</td>
									<td>
										<span class="label label-success"><?php echo $loadone; ?></span>
										<span class="label label-success"><?php echo $loadfive; ?></span>
										<span class="label label-success"><?php echo $loadfifteen; ?></span>
									</td>
								</tr>
<?php } ?>
							</tbody>
						</table>

					</div>

					<div class="tab-pane" id="servers">

						<table class="table table-bordered table-hover table-center">
							<thead>
								<tr>
									<th class="span2" scope="col">Hostname</th>
									<th class="span2" scope="col">Host</th>
									<th class="span2" scope="col">Location</th>
									<th class="span2" scope="col">RAM</th>
									<th class="span2" scope="col">Storage</th>
									<th class="span2" scope="col">Bandwidth</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($servers as $serverinfo) { ?>
								<tr>
									<td><?php echo $serverinfo['name']; ?></td>
									<td><?php echo $serverinfo['host']; ?></td>
									<td><?php echo $serverinfo['location']; ?></td>
									<td><?php echo $serverinfo['ram']; ?></td>
									<td><?php echo $serverinfo['storage']; ?></td>
									<td><?php echo $serverinfo['bandwidth']; ?></td>
								</tr>
<?php } ?>
							</tbody>
						</table>

					</div>

				</div>

			</div>

			<hr>
			<footer class="footer">
				<p class="pull-right"><a href="#">Back to top</a></p>
				<p>&copy; 2013 iNeal.ME</p>
			</footer>
		</div> <!-- /container -->
		
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="http://twitter.github.io/bootstrap/assets/js/bootstrap.js"></script>
	</body>
</html>