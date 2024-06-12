<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Painel - <?php echo $viewData['company_name']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>../assets/css/template.css"/>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.js"></script>
	<script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>'</script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</head>
<body>	

	<div class="left-menu">
		<div class="company-name"><?php echo $viewData['company_name']; ?></div>
		<div class="menu-area">
		<ul>
			<li><a href="<?php echo BASE_URL; ?>">Home</a></li>
			<li><a href="<?php echo BASE_URL; ?>/permissions">Permissões</a></li>
			<li><a href="<?php echo BASE_URL; ?>/users">Usuários</a></li> 
			<li><a href="<?php echo BASE_URL; ?>/clients">Clientes</a></li> 
			<li><a href="<?php echo BASE_URL; ?>/inventory">Estoque</a></li> 
			<li><a href="<?php echo BASE_URL; ?>/sales">Vendas</a></li>
			<li><a href="<?php echo BASE_URL; ?>/purchases">Compras</a></li>
			<li><a href="<?php echo BASE_URL; ?>/resellers">Fornecedores</a></li> 
			<li><a href="<?php echo BASE_URL; ?>/report">Relatórios</a></li>
		</ul>
	</div>
	</div>

	<div class="container">
		<div class="top">
			<div class="top-right"><a href="<?php echo BASE_URL; ?>/login/logout">Sair</a></div>
			<div class="top-right"><?php echo $viewData['user_email']; ?></div>
		</div>
		<div class="area-main">
			<?php $this->loadViewInTemplate($viewName, $viewData); ?>
		</div>
	</div>
</body>
</html>