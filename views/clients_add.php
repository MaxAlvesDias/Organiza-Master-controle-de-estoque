<h1>Clientes - Adicionar</h1>

<form method="POST">
	<label for="name">Nome</label><br/>
	<input type="text" name="name" required/><br/><br/>

	<label for="phone">Telefone</label><br/>
	<input type="text" name="phone" required/><br/><br/>

	<label for="email">E-mail</label><br/>
	<input type="text" name="email" required/><br/><br/>

	<label>Estrelas</label>
	<select name="stars" id="stars">
		<option value="1">1 estrela</option>
		<option value="2">2 estrelas</option>
		<option value="3" selected>3 estrelas</option>
		<option value="4">4 estrelas</option>
		<option value="5">5 estrelas</option>
	</select><br/><br/>

	<label for="internal_obs">Observações Internais:</label><br/>
	<textarea id="internal_obs" name="internal_obs"></textarea><br/><br/>

	<label for="address_zipCode">Cep</label>
	<input type="text" id="address_zipCode" name="address_zipCode" required/><br/><br/>

	<label for="address">Rua</label>
	<input type="text" id="address" name="address" required/><br/><br/>

	<label for="address_number">Número</label>
	<input type="text" id="address_number" name="address_number"/><br/><br/>

	<label for="address2">Complemento</label>
	<input type="text" id="address2" name="address2"/><br/><br/>

	<label for="address_neighborhood">Bairro</label>
	<input type="text" id="address_neighborhood" name="address_neighborhood" required/><br/><br/>

	<label for="address_city">Cidade</label>
	<input type="text" id="address_city" name="address_city" required/><br/><br/>

	<label for="address_state">Estado</label>
	<input type="text" id="address_state" name="address_state" required/><br/><br/>

	<label for="address_country">Pais</label>
	<input type="text" id="address_country" name="address_country" required/><br/><br/>

	<input type="submit" value="Adicionar"/>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients.js"></script>

