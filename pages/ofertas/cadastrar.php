<div class="w-50 container shadow-lg mt-4 pb-3 rounded">
	<h1 class="text-center pt-3">Anotar preços</h1>
	<form class="form-row mx-auto my-3 px-4" method="POST" action="?page=ofertas" onsubmit="return confirm('Guardar preço?')">
		<input type="hidden" name="operacao" value="cadastrar">
		<div class="input-group">
			<label class="input-group-text" for="produto">Produto</label>
			<select name="produtos_id_produto" id="produto" class="form-control is-invalid w-25" required aria-describedby="produtoinfo">
				<option selected disabled>Escolha o Produto:</option>
				<?php
					$res = $conex->query("SELECT * FROM produtos") or die($conex->error);

					if ($res->num_rows > 0) {
						while ($row = $res->fetch_object()) {
							echo "
				<option value='{$row->id_produto}'>{$row->nome_produto}</option>
							";
						}
					} else {
						echo "
				<option disabled>Nenhum produto cadastrado</option>
						";
					}
				?>
			</select>
			<label class="input-group-text" for="preco">Preco R$</label>
			<input type="number" name="preco_oferta" class="form-control is-invalid" value="0.00" min="0.00" step="0.01" required>
			<small id="produtoinfo" class="invalid-feedback">Todos os campos são obrigatórios, exceto o comentário.</small>
		</div>
		<div class="input-group mt-3">
			<label class="input-group-text" for="local">Lugar</label>
			<select name="mercados_id_mercado" id="local" class="form-control">
				<option selected disabled value="0">Onde tem a esse preço?</option>
				<?php
					$res = $conex->query("SELECT * FROM mercados") or die($conex->error);

					if ($res->num_rows > 0) {
						while ($row = $res->fetch_object()) {
							echo "
				<option value='{$row->id_mercado}'>{$row->nome_mercado}</option>
							";
						}
					} else {
						echo "
				<option disabled>Nenhum local cadastrado</option>
						";
					}
				?>
			</select>
		</div>
		<label for="cometario" class="mt-3 mb-1">Comentario:</label>
      <textarea class="form-control" id="comentario" placeholder="Escreva a marca, até que dia dura a promoção, a opção caso não encontre...&#10;Maximo 400 caracteres!" maxlength="400" rows="6" style="resize: none;" name="comentario_oferta"></textarea>
      <div class="d-flex">
			<button class="btn btn-success w-50 text-center mt-3 mx-1">Guardar oferta</button>
			<a onclick="if (confirm('Abandonar cadastro?')) location.href='?page=ofertas'" class="btn btn-secondary w-50 text-center mt-3 mx-1">Voltar</a>
		<div>
	</form>
</div>