<?php  ?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>MPXD Data Capture System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/bootstrap.css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/style.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/bootswatch.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/font.css" media="screen">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/customcss/custom.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/ilyas/css/bootstrap-multiselect.css">
		<script src="<?php echo base_url(); ?>/bootstrap/jquery-1.10.2.min.js"></script>
		<script src="<?php echo base_url(); ?>/ilyas/jquery-migrate-1.2.1.min.js"></script>
		<script src="<?php echo base_url(); ?>/ilyas/polyfills.js"></script>
		<!--<script type="text/javascript" src="<?php echo base_url(); ?>/bootstrap/bootstrap-2.0.2.js"></script>-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="<?php echo base_url(); ?>/bower_components/html5shiv/dist/html5shiv.js"></script>
		<script src="<?php echo base_url(); ?>/bower_components/respond/dest/respond.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url(); ?>/bootstrap/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>/ilyas/bootstrap-multiselect.js"></script>
		<script src="<?php echo base_url(); ?>/bootstrap/bootswatch.js"></script>
		<script src="<?php echo base_url(); ?>/bootstrap/jquery.confirm.js"></script>
		<script src="<?php echo base_url(); ?>/bootstrap/jquery-ui.js"></script>
		<!--<script src="<?php echo base_url(); ?>/ilyas/jquery.mjs.nestedSortable.js"></script>-->
		<script src="<?php echo base_url(); ?>/ilyas/jquery.loader.js"></script>
		<script src="<?php echo base_url(); ?>/ilyas/numeral.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>/ilyas/loader.css"></link>
		<link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/jquery-ui.css">
		<script>
		
		
		function showloader() {
			$('body').loader('show');
		}

		function hideloader(cb) {
			setTimeout(function(){$('body').loader('hide'); if (typeof cb == "function") cb();},200);
		}
			$(document).ready(function()
			{
				$(document).on("click", ".alerthide", function ()
				{
					if(confirm("Do you want to delete?"))
					{
						var id = $(this).data('id');
						$.post( "/home/hidealert",{id:id}, function( data ) {
							location.reload();
						});
					}
				});
				$(document).on("click", ".reminderhide", function ()
				{
					if(confirm("Do you want to delete?"))
					{
						var id = $(this).data('id');
						$.post( "home/hidereminder",{id:id}, function( data ) {
							location.reload();
						});
					}
				});
			});
		</script>
	</head>
	<body>
	<?php

	$ses_data = $this->session->userdata('logged_in');
	$ses_data1 = $this->session->userdata('cpass');
	$chpass=$ses_data1['cpass'];
	$umenu=$ses_data['datap'];
	$umenuobj=explode(",777," , $umenu);
	$cnt=count($umenuobj)-1;

	//Alert Label
		$alabelnames='';
		foreach ($alabels as $label):
			$alabelnames .= ','.$label->sec_label_desc;
		endforeach;
		$alabelnames=substr($alabelnames,1);
		$alabelname=explode(",",$alabelnames);

		//Reminders Label
				$rlabelnames='';
				foreach ($rlabels as $label):
					$rlabelnames .= ','.$label->sec_label_desc;
				endforeach;
				$rlabelnames=substr($rlabelnames,1);
		$rlabelname=explode(",",$rlabelnames);
?>
		<div id="wrap">
			<div class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<!--HEADER-->
					<div class="headermenu">
						<div class="row">
							<div class="col-md-13">
								<div class="header_top">
									<div class="row">
										<div class="col-md-8">

											<a href="#" class="navbar-brand"><img src="<?php echo base_url(); ?>/img/logo_1.png" width="70">&nbsp;MPXD Data Capture System</a>
										</div>
										<div class="col-md-4">
										</div>
									</div>
								</div>
								<div class="header_bottom">
									<div class="row">
										<div class="col-md-8">
										<?php if ($chpass!=1) { ?>
											<ul class="nav navbar-nav">
												<?php
												$gname="";
												for ($i=0;$i<$cnt;$i++)
												{
									$umenuobj1=explode("," , $umenuobj[$i]);
										$url=base_url().$umenuobj1[2];
										if($gname=="" || $gname!=$umenuobj1[0]) {
										if($gname!="") {
										echo "</ul><li>";
										}
										?>
										<li class="dropdown">
									    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="<?php echo $umenuobj1[3];?>">&nbsp;</span><?php echo $umenuobj1[0]; ?><b class="caret"></b></a>
									    <ul class="dropdown-menu">
														<li><a href='<?php echo $url; ?>'><?php echo $umenuobj1[1];?></a></li>
										<?php
										$gname=$umenuobj1[0];
										} else { ?>
										<li><a href='<?php echo $url; ?>'><?php echo $umenuobj1[1];?></a></li>
										<?php
										}
										}
										?>

												</ul>
												</li>
												<li><a href="#"><span class="glyphicon glyphicon-info-sign">&nbsp;</span><i class="fa fa-cloud"></i>About</a></li>
											</ul>
											<?php } ?>
										</div>
										<div class="col-md-4">
											<ul class="nav navbar-nav navbar-right">
												<!-- alert -->
												<li class="header_alert">
													<a href="#" data-toggle="modal" data-target=".bs-example-modal-md_alert">
														<span class="glyphicon glyphicon-warning-sign">&nbsp;</span><i class="fa fa-cloud"></i><span class="badge pull-right"><?php echo $alertcount; ?></span>
													</a>
												</li>
												<!--  -->
												<!-- reminder -->
												<li class="header_reminder">
													<a href="#" data-toggle="modal" data-target=".bs-example-modal-md_reminders">
														<span class="glyphicon glyphicon-bullhorn">&nbsp;</span><i class="fa fa-cloud"></i><span class="badge pull-right"><?php echo $remindercount; ?></span>
													</a>
												</li>
												<!--  -->
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <br><?php function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}; echo truncate($username, 15); ?><b class="caret"></b></a>
													<ul class="dropdown-menu">
														<li><a href="#">Edit account</a></li>
														<li><a href="/login/logout">Logout</a></li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--TUTUP HEADER-->
			<!-- alert ---->
			<div class="modal fade bs-example-modal-md_alert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md">
				<div class="modal-content">
				  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

					<h4 class="modal-title" id="myModalLabel"><?php echo $alabelobject; ?></h4>
				  </div>
				  <div class="modal-body">
					<table class="table table-striped table-hover">
					  <thead>
						<tr>
						  <th>No</th>
						  <th><?php echo $alabelname[0]; ?></th>
						  <th><?php echo $alabelname[1]; ?></th>
						  <th><?php echo $alabelname[2]; ?></th>
						  <th><?php echo $alabelname[3]; ?></th>
						</tr>
						
					  </thead>
					  <tbody>
						<?php
							$sno=1;
							//var_dump($alerts);
							foreach ($alerts as $record):
							//var_dump($record);
							
						?>
						<!-- <?php var_dump($record); 
						$message = $record->alert_message;
						$isnonp = isset($record->nonp_journal_id);
						$href = "#";
						//$pro_journal_id = $record->
						$isaccepted = !(strpos($message, "Accepted") === FALSE);
						$isrejected = !(strpos($message, "Rejected") === FALSE);
						$ispublished = !(strpos($message, "Published") === FALSE);
						if ($isnonp) {
							$jid = $record->nonp_journal_id;
							
							if ($isaccepted) {}
							if ($ispublished) {$href = "/index.php/ilyasvalidate?jid=$jid"; }
							if ($isrejected) { $href = "/index.php/ilyas?jid=$jid"; }
						} else {
							$jid = $record->data_validate_no;
							$den = $record->data_entry_no;
							if ($ispublished) { $href = "/journalvalidationview?id=$jid"; }
							if ($isrejected) { $href = "/journaldataentryadd?jid=$den"; }
						}
						
						?> -->
						<tr>
									<td><?php echo $sno; ?></td>
									<!--td><a class="clicked_alert" href="/journalvalidationview?id=<?php echo $record->data_validate_no; ?>"><?php echo $record->journal_name." ".$record->alert_message; ?></a></td-->
									<td><a class="clicked_alert" href="<?php echo $href;  ?>" onclick="stop();var l=this.href;this.href='javascript:';location.href=l"><?php echo $record->journal_name." ".$record->alert_message; ?></a></td>
									<td><?php echo $record->alert_date; ?></td>
									<td><?php echo $record->frequency_period; ?></td>
									<td><a href="#" data-toggle="modal" class="alerthide" data-id="<?php echo $record->alert_no; ?>"><span class="glyphicon glyphicon-trash">&nbsp;</span></a></td>
								</tr>
						<?php
								$sno=$sno+1;
							endforeach;
							if($sno==1)
							{
								echo "<tr><td colspan='5' class='row text-center text-danger'> No Alert Found</td></tr>";
							}
						?>
					  </tbody>
					</table>
				  </div>
				</div>
			  </div>
			</div>
			<!-- alert ---->
			<!-- Reminders ---->
			<div class="modal fade bs-example-modal-md_reminders" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-md">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel"><?php echo $rlabelobject; ?></h4>
				  </div>
				  <div class="modal-body">
					<table class="table table-striped table-hover">
					  <thead>
						<tr>
						  <th>No</th>
						  <th><?php echo $rlabelname[0]; ?></th>
						  <th><?php echo $rlabelname[1]; ?></th>
						  <th><?php echo $rlabelname[2]; ?></th>
						  <th><?php echo $rlabelname[3]; ?></th>
						</tr>
					  </thead>
					  <tbody>
						<?php
							$sno=1;
							foreach ($reminders as $record):
						?>
								<tr>
									<td><?php echo $sno; ?></td>
									<td><?php echo $record->journal_name." ".$record->reminder_message; ?></td>
									<td><?php echo $record->reminder_date; ?></td>
									<td><?php echo $record->frequency_period; ?></td>
									<td><a href="#" data-toggle="modal" class="reminderhide" data-id="<?php echo $record->reminder_no; ?>"><span class="glyphicon glyphicon-trash">&nbsp;</span></a></td>
								</tr>
						<?php
								$sno=$sno+1;
							endforeach;
							if($sno==1)
							{
								echo "<tr><td colspan='5' class='row text-center text-danger'> No Reminder Found</td></tr>";
							}
						?>
					  </tbody>
					</table>
				  </div>
				</div>
			  </div>
			</div>
			
			
			
			<!-- Reminders ---->