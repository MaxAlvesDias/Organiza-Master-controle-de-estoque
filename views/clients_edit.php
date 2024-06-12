<h1>Clientes - Editar</h1>

<form method="POST">
	<label for="name">Nome *</label><br/>
	<input type="text" name="name" required value="<?php echo $client_info['name']; ?>"/><br/><br/>

	<label for="phone">Telefone *</label><br/>
	<input type="text" name="phone" required value="<?php echo $client_info['phone']; ?>"/><br/><br/>

	<label for="email">E-mail</label><br/>
	<input type="text" name="email" required value="<?php echo $client_info['email']; ?>"/><br/><br/>

	<label>Estrelas</label>
	<select name="stars" id="stars">
		<option value="1" <?php echo($client_info['stars']=='1')?'selected':''; ?>>1 estrela</option>
		<option value="2" <?php echo($client_info['stars']=='2')?'selected':''; ?>>2 estrelas</option>
		<option value="3" <?php echo($client_info['stars']=='3')?'selected':''; ?>>3 estrelas</option>
		<option value="4" <?php echo($client_info['stars']=='4')?'selected':''; ?>>4 estrelas</option>
		<option value="5" <?php echo($client_info['stars']=='5')?'selected':''; ?>>5 estrelas</option>
	</select><br/><br/>

	<label for="internal_obs">Observações Internais:</label><br/>
	<textarea id="internal_obs" name="internal_obs""><?php echo $client_info['internal_obs']; ?>"</textarea><br/><br/>

	<label for="address_zipCode">Cep *</label>
	<input type="text" id="address_zipCode" name="address_zipCode" required value="<?php echo $client_info['address_zipcode']; ?>"/><br/><br/>

	<label for="address">Rua *</label>
	<input type="text" id="address" name="address" required value="<?php echo $client_info['address']; ?>"/><br/><br/>

	<label for="address_number">Número</label>
	<input type="text" id="address_number" name="address_number" value="<?php echo $client_info['address_number']; ?>"/><br/><br/>

	<label for="address2">Complemento</label>
	<input type="text" id="address2" name="address2" value="<?php echo $client_info['address2']; ?>"/><br/><br/>

	<label for="address_neighborhood">Bairro *</label>
	<input type="text" id="address_neighborhood" name="address_neighborhood" required value="<?php echo $client_info['address_neighborhood']; ?>"/><br/><br/>

	<label for="address_city">Cidade *</label>
	<input type="text" id="address_city" name="address_city" required value="<?php echo $client_info['address_city']; ?>"/><br/><br/>

	<label for="address_state">Estado *</label>
	<input type="text" id="address_state" name="address_state" required value="<?php echo $client_info['address_state']; ?>"/><br/><br/>

	<label for="address_country">Pais *</label>
	<input type="text" id="address_country" name="address_country" required value="<?php echo $client_info['address_country']; ?>"/><br/><br/>

	<input type="submit" value="Salvar"/>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_clients.js"></script>
