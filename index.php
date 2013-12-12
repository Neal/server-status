<?php include __dir__ . '/script/model.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?=$config->name?> Server Status</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="refresh" content="100">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
		<style>
			body { padding-top: 80px; }
			.table-center th { vertical-align: middle; text-align: center; }
			.table-center td { vertical-align: middle; text-align: center; }
		</style>
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				<a class="navbar-brand" href="#">Server Status</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#status" data-toggle="tab">Status</a></li>
						<li><a href="#servers" data-toggle="tab">Servers</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>

		<div class="container">

			<div class="tabbable" style="margin-bottom: 20px;">

				<div class="tab-content">

					<div class="tab-pane active" id="status">

						<table class="table table-bordered table-center">
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
<?php foreach ($servers as $name => $info): ?>
								<tr>
									<td><?=$name?></td>
									<td><?=$info->status->uptime?></td>
									<td>
										<?=size_readable($info->status->memory->used)?> / <?=size_readable($info->status->memory->total)?><br />
										<div class="progress" style="height:15px;margin-bottom:0px;">
											<div class="progress-bar progress-bar-<?=$info->status->memory->level?>" style="width: <?=$info->status->memory->progress?>%;"></div>
										</div>
									</td>
									<td>
										<?=size_readable($info->status->disk->used)?> / <?=size_readable($info->status->disk->total)?><br />
										<div class="progress" style="height:15px;margin-bottom:0px;">
											<div class="progress-bar progress-bar-<?=$info->status->disk->level?>" style="width: <?=$info->status->disk->progress?>%;"></div>
										</div>
									</td>
									<td>
										<span class="label label-success"><?=$info->status->load->one?></span>
										<span class="label label-success"><?=$info->status->load->five?></span>
										<span class="label label-success"><?=$info->status->load->fifteen?></span>
									</td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>

					</div>

					<div class="tab-pane" id="servers">

						<table class="table table-bordered table-center">
							<thead>
								<tr>
									<th class="span2" scope="col">Hostname</th>
									<th class="span2" scope="col">Type</th>
									<th class="span2" scope="col">OS</th>
									<th class="span2" scope="col">Host</th>
									<th class="span2" scope="col">Location</th>
									<th class="span2" scope="col">RAM</th>
									<th class="span2" scope="col">Storage</th>
									<th class="span2" scope="col">Bandwidth</th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($servers as $name => $info): ?>
								<tr>
									<td><?=$name?></td>
									<td><?=$info->type?></td>
									<td><?=$info->os?></td>
									<td><?=$info->host?></td>
									<td><?=$info->location?></td>
									<td><?=$info->ram?></td>
									<td><?=$info->storage?></td>
									<td><?=$info->bandwidth?></td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>

					</div>

				</div>

			</div>

			<hr>
			<footer class="footer">
				<p class="pull-right"><a href="#">Back to top</a></p>
				<p>Copyright &copy; 2013 <?=$config->name?><br /><a href="<?=$config->github_url?>">Fork me on GitHub!</a></p>
			</footer>
		</div> <!-- /container -->

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	</body>
</html>
