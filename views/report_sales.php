<h1>Relatório de Vendas</h1>

<form method="GET" onsubmit="return openPopUp(this)">

	<div class="report-container">
		
		<div class="report-grid">
			<span>Nome do Cliente</span>
			<input type="text" name="client_name"/>
		</div>

		<div class="report-grid">
			<span>Período</span><br/>
			<input type="date" name="period1"/><br/>até <br/>
			<input type="date" name="period2"/>		
		</div>

		<div class="report-grid">
			<span>Status da Venda</span><br/>
			<select name="status">
				<option value="">Todos os status</option>
				<?php foreach($statuses as $statusKey => $statusValue): ?>
					<option value="<?php echo $statusKey; ?>"><?php echo $statusValue; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="report-grid">
			<span>Ordenação</span><br/>
			<select name="order">
				<option value="date_desc">Mais Recentes</option>
				<option value="date_asc">Mais Antigos</option>
				<option value="status">Por Status</option>
			</select>
		</div>	

		<div style="clear:both;"></div>
	</div>

	<div style="text-align:center;">
		<input type="submit" value="Gerar Relatório"/>
	</div>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>../assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>../assets/js/report_sales.js"></script>
