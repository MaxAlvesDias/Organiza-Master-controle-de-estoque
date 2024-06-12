<div class="dashboard-row row1">

	<div class="dashboard-grid-1">
		<div class="dashboard-grid-area">
			<div class="dashboard-grid-area-count"><?php echo $products_sold; ?></div>
			<div class="dashboard-grid-area-legend">Produtos Vendidos</div>
		</div>
	</div>

	<div class="dashboard-grid-1">
		<div class="dashboard-grid-area">
			<div class="dashboard-grid-area-count">R$ <?php echo number_format($revenue, 2, ",", "."); ?></div>
			<div class="dashboard-grid-area-legend">Receitas</div>
		</div>
	</div>

	<div class="dashboard-grid-1">
		<div class="dashboard-grid-area">
			<div class="dashboard-grid-area-count">R$ <?php echo number_format($expenses, 2, ",", "."); ?></div>
			<div class="dashboard-grid-area-legend">Despesas</div>
		</div>
	</div>
</div>

<div class="dashboard-row row2">
	<div class="dashboard-grid-2">
		<div class="dashboard-info">
			<div class="dashboard-info-title">Despesas e Receitas dos últimos 30 dias</div>
			<div class="dashboard-info-body" style="height:320px;">
				<canvas id="rel1"></canvas>
			</div>
		</div>
	</div>
	<div class="dashboard-grid-1">
		<div class="dashboard-info">
			<div class="dashboard-info-title">Status de Pagamento</div>
			<div class="dashboard-info-body">
				<canvas id="rel2" height="310"></canvas>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">var days = <?php echo json_encode($days_list); ?>;</script>
<script type="text/javascript">var revenue_list = <?php echo json_encode(array_values($revenue_list)); ?>;</script>
<script type="text/javascript">var expenses_list = <?php echo json_encode(array_values($expenses_list)); ?>;</script>
<script type="text/javascript">var status_name = <?php echo json_encode(array_values($statuses)); ?>;</script>
<script type="text/javascript">var status_list = <?php echo json_encode(array_values($status_list)); ?>;</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/chart.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/home.js"></script>