<?php 
	$res = $conex->query("SELECT * FROM produtos WHERE id_produto = {$_GET['id_produto']}") or die($conn->error);
	$row = $res->fetch_object();
?>
<div class="w-50 container shadow-lg mt-4 pb-3 rounded">
	<h1 class="text-center pt-3">Editar item da lista</h1>
	<form class="form-row mx-auto my-3 px-4" method="POST" action="?page=produtos" onsubmit="return confirm('Editar produto?')">
		<input type="hidden" name="operacao" value="editar">
		<input type="hidden" name="id_produto" value="<?php echo $row->id_produto; ?>">
		<div class="input-group">
			<label class="input-group-text" for="nome">Nome</label>
			<input type="text" class="form-control is-invalid w-50" id="nome" placeholder="<?php echo $row->nome_produto; ?>" name="nome_produto" value="<?php echo $row->nome_produto; ?>" name="nome_produto" required aria-describedby="nomeinfo">
			<label class="input-group-text" for="qtd">Qtd.</label>
			<input type="number" class="form-control" id="qtd" value="<?php echo $row->qtd_produto; ?>" min="1" name="qtd_produto">
			<small id="nomeinfo" class="invalid-feedback">Apenas o nome é necessário.</small>
		</div>
		<div class="d-flex">
			<button class="btn btn-success w-50 text-center mt-3 mx-1">Editar</button>
			<a onclick="if (confirm('Abandonar formulário?')) location.href='?page=produtos'" class="btn btn-secondary w-50 text-center mt-3 mx-1">Voltar</a>
		</div>
	</form>
</div>