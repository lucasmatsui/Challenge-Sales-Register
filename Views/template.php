<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/styles.css">
	<title>Cadastro de vendedores</title>
</head>
<body>
	<header>
		<div id="messageReport">Enviado com sucesso</div>
		<button id="SendReport" class="SendReport" onclick="sendReport()">Gerar relátorio</button>
		<div class="container_SallersRegistred">
			<div class="SallersRegistred">
				<h1><i class="fas fa-users"></i></h1>
				<p class="quantitySellers">0</p>
			</div>
		</div>
		<div class="container_notify">
			<div onclick="showModalNotify(event)" id="notify">
				<i class="far fa-bell"></i>
				<div id="quantity">0</div>
			</div>
			<div class="modal_notify" id="modal_notify">

			</div>
		</div>
	</header>
	

	<div class="container">
		<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	</div>

	<div class="modal_main_container">
		<div class="modal_main"></div>
	</div>

	<script type="text/javascript">var BASE_URL = '<?php echo BASE_URL; ?>';</script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/ajax.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>	
</body>
</html>