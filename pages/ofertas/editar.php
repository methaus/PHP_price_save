<?php
	$res = $conex->query("SELECT * FROM ofertas INNER JOIN mercados ON mercados.id_mercado = ofertas.mercados_id_mercado INNER JOIN produtos ON produtos.id_produto = ofertas.produtos_id_produto WHERE mercados_id_mercado = {$_GET['mercado']} AND produtos_id_produto = {$_GET['produto']}") or die($conn->error);
	$row = $res->fetch_object();
?>
<div class="w-50 container shadow-lg mt-4 pb-3 rounded">
	<h1 class="text-center pt-3">Editar oferta</h1>
	<form class="form-row mx-auto my-3 px-4" method="POST" action="?page=ofertas" onsubmit="return confirm('Editar preço?')">
		<input type="hidden" name="operacao" value="editar">
		<div class="input-group">
			<label class="input-group-text" for="produto">Produto</label>
			<input type="hidden" name="produtos_id_produto" value="<?php echo $row->id_produto; ?>">
			<span class="form-control w-25 user-select-none" style="background: #E9ECEF;"><?php echo $row->nome_produto; ?></span>
			<label class="input-group-text" for="preco">Preco R$</label>
			<input type="number" name="preco_oferta" class="form-control is-invalid" value="<?php echo $row->preco_oferta; ?>" min="0.00" step="0.01" required>
		</div>
		<div class="input-group mt-3">
			<label class="input-group-text" for="local">Lugar</label>
			<input type="hidden" name="mercados_id_mercado" value="<?php echo $row->id_mercado; ?>">
			<span class="form-control user-select-none" style="background: #E9ECEF;"><?php echo $row->nome_mercado; ?></span>
		</div>
		<label for="cometario" class="mt-3 mb-1">Comentario:</label>
      <textarea class="form-control" id="comentario" placeholder="<?php if ($row->comentario_oferta == null) { echo 'Escreva a marca, até que dia dura a promoção, a opção caso não encontre...&#10;Maximo 400 caracteres!'; } else { echo $row->comentario_oferta; }; ?>" value="<?php echo $row->comentario_oferta; ?>" maxlength="400" rows="6" style="resize: none;" name="comentario_oferta"></textarea>
		<div class="d-flex">
			<button class="btn btn-success w-50 text-center mt-3 mx-1">Editar</button>
			<a onclick="if (confirm('Abandonar formulário?')) location.href='?page=ofertas'" class="btn btn-secondary w-50 text-center mt-3 mx-1">Voltar</a>
		</div>
	</form>
</div>