<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="CEK CARAK TEMPUH KOTA">
<meta name="author" content="MUHAMMAD FAIRUZZADI">
<title>Jarak Tempuh Kota</title>
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
<link href="assets/css/sb-admin-2.css" rel="stylesheet">
<link href="assets/fonts/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://ikiganteng.photography/assets/css/main-style.css" rel="stylesheet">
<link rel="Shortcut Icon" type="image/x-icon" href="icon.png">
<!-- Bootstrap 3.3.4 -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--></head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Cek Jarak dan Waktu Tempuh</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Kota Asal" name="asal" type="text" value=""></div>
							<div class="form-group">
								<input class="form-control" placeholder="Kota Tujuan" name="tujuan" type="text" value=""></div>
							<!-- Change this to a button or input when using this as a form -->
							<button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Submit</button>
						</fieldset>
					</form>
<?php
	
	if(isset($_POST['submit'])){
		$from = $_POST['asal'];
		$to = $_POST['tujuan'];
		$from = urlencode($from);
		$to = urlencode($to);
		$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=id-ID&sensor=false");
		$data = json_decode($data);
		$time = 0;
		$distance = 0;
		foreach($data->rows[0]->elements as $road) {
			$time += $road->duration->value;
			$distance += $road->distance->value;
		}

		echo "<b><font color='green'>Asal:</font></b> ".$data->destination_addresses[0]."<br>";
		echo "<b><font color='green'>Tujuan: </font></b>".$data->origin_addresses[0]."<br>";
		echo "<b><font color='green'>Estimasi Waktu: </font></b>".$time." detik atau setara dengan " . gmdate('H', $time) . " jam " . gmdate('i', $time) . " menit <br>";
		echo "<b><font color='green'>Jarak: </font></b>".$distance." m atau " .floor($distance / 1000). " km <br>";
	}

	?>
					</div>
			</div>
		</div>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="assets/js/sb-admin-2.js"></script>
		</body>
		</html>