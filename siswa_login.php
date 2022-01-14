<?php
session_start();
if (isset($_SESSION['login']) ) {
	header('Location: index.php');
} 

// menghubungkan php dengan koneksi siswabase
include 'koneksi.php';

// menangkap siswa yang dikirim dari form login
if ($_SERVER['REQUEST_METHOD']=='POST' ) {
	$user  = $_POST['username'];
	$pass  = $_POST['password'];
	$p     = hash('sha1', $pass);

	if ( $user == "" || $p == ""){
		$error = true;
	}else {
		$siswa = $konek -> query("SELECT * FROM siswa WHERE username ='".$user."' AND password = '".$p."'");
	$sw = mysqli_num_rows($siswa);
	

	if ($sw > 0) {
		$swa = mysqli_fetch_Assoc($siswa);

	// cek jika user login sebagai admin
		session_start();
		$_SESSION['login']    = TRUE;
		$_SESSION['username'] = $swa['username'];
		$_SESSION['id']		  = $swa['idsiswa'];
		header('Location: siswa_index.php');

	}else{
		echo "
		<script>
		alert('username atau password anda salah');
		document.location.href = 'siswa_login.php';
		</script>
		";
	}
	}
	
}

?>

	  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wiswh=device-wiswh, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>HALAMAN LOGIN SISWA</title>
    <style >
    	.col-md-4col-md-offset-4{
    		margin-top: 20px;
    	}
    	body{
    		background:url('img/kotak.jpg');
    		background-size: 200px;
    	}
    </style>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

  </head>
</head>
<body>

	
	<div class="container">
	<div class="col-md-4 col-md-offset-4">
		<div  class="panel panel-info">
		<div class="panel-heading">
			<h2>MENU LOGIN SISWA</h2>
			<h3>Aplikasi Pembayaran SPP</h3>
			<?php if (isset($error) ) :  ?>
				<div class="alert alert-warning">
		<span><b>Peringatan!!</b>Form Belum Lengkap</span>
		</div>
	<?php endif;  ?>

	</div>	
	<div class="panel-body">
		
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>Username</td>
				<td>:</td>
				<td>
					<input class="form-control" type="text" name="username" placeholder="Masukan Username">
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td>
					<input class="form-control" type="Password" name="password" placeholder="password">
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<button class="btn btn-success" name="login">LOGIN</button>
				</td>
			</tr>
		</table>
		<p>Login sebagai <a href="login.php">ADMIN</a> </p> 
	</form>
</div>
</div>
</div>
	</div>
</body>
</html>
<?php include 'footer.php';  ?>