<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>../assets/css/login.css">
</head>
<body>

	<div class="login-area">
	<img src="../Sistema-ERP-master/assets/img/LogoSample_ByTailorBrands.jpg" alt="Logotipo da empresa" width="300" height="200">
		<h3>Login</h3>
		<?php if(isset($error) && !empty($error)): ?>
		<div class="alert-danger"><?php echo $error; ?></div>
		<?php endif; ?>
		<form method="POST">
			<input type="email" name="email" placeholder="E-mail" required="required"/><br/>
			<input type="password" name="password" placeholder="Senha" required="required"/><br/>
			<input type="submit" value="Entrar"/>
		</form>
	</div>

</body>
</html>