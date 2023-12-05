<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos estão definidos antes de acessá-los
    $ldapUser = isset($_POST['email']) ? $_POST['email'] : null;
    $ldapPass = isset($_POST['pass']) ? $_POST['pass'] : null;


	if (empty($ldapUser) || empty($ldapPass)) {
        $_SESSION['login_error'] = "Por favor, forneça um email e uma senha.";
        header("Location: login-area-restrita.php");
        exit();
    }

    $ldapServer = "ldap://seu-servidor-ldap";
    $ldapConn = ldap_connect($ldapServer);
    ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);

    if ($ldapConn) {
        $bind = ldap_bind($ldapConn, $ldapUser . "@servidor.local", $ldapPass);

        if ($bind) {
			session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            header("Location: area-restrita.php");
            exit();
        } else {
			// Exibir alerta JavaScript informando que a senha está incorreta
			echo '<script>';
			echo 'alert("Senha incorreta. Tente novamente.");';
			echo '</script>';
			header("Location: login-area-restrita.php");
			exit();
			
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="assets/img/pneufavicon.png" rel="icon">
	<title>Área Colaborador</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsvendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsfonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assetsfonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util-restrita.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main-restrita.css">
<!--===============================================================================================-->
</head>
<body>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="POST" >
					<span class="login100-form-title p-b-26" style="color:#f26522">
						Seja bem Vindo!
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn" style="margin-bottom:20px">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type = "submit" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
					<a class="navbar-brand" href="https://conlogsa.com.br" style="display:flex; align-items:center; justify-content: space-between; margin-left:17px">
						<img src="https://conlogsa.com.br/assets/img/logo_laranja.png" class="logo-light" alt="logo" style="width:15rem"/>
					</a>
				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>
</html>