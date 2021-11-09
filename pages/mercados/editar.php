<?php 
	$res = $conex->query("SELECT * FROM mercados WHERE id_mercado = {$_GET['id_mercado']}") or die($conn->error);
	$row = $res->fetch_object();
?>
<div class="w-50 container shadow-lg mt-4 pb-3 rounded">
	<h1 class="text-center pt-3">Editar local</h1>
	<form class="form-row mx-auto my-3 px-4" method="POST" action="?page=mercados" onsubmit="return confirm('Confirmar edição?')">
		<input type="hidden" name="operacao" value="editar">
		<input type="hidden" name="id_mercado" value="<?php echo $row->id_mercado; ?>">
		<div class="form-group">
			<div class="input-group">
				<label class="input-group-text" for="nome">Nome</label>
				<input type="text" class="form-control is-invalid" id="nome" placeholder="<?php echo $row->nome_mercado; ?>" value="<?php echo $row->nome_mercado; ?>" name="nome_mercado" required aria-describedby="nomeinfo">
				<small id="nomeinfo" class="invalid-feedback">Por favor, não deixe esse campo em branco.</small>
			</div>
			<div class="input-group mt-3">
				<label class="input-group-text" for="endereco">Endereço</label>
				<input type="text" class="form-control" id="endereco" placeholder="<?php echo $row->local_mercado; ?>" value="<?php echo $row->local_mercado; ?>" name="local_mercado">
			</div>
			<div class="input-group mt-3">
				<label class="input-group-text" for="site">Site/Contato</label>
				<input type="text" class="form-control" id="site" placeholder="<?php echo $row->site_mercado; ?>" value="<?php echo $row->site_mercado; ?>" name="site_mercado">
			</div>
		</div>
		<div class="d-flex">
			<button class="btn btn-success w-50 text-center mt-3 mx-1">Editar</button>
			<a onclick="if (confirm('Abandonar formulário?')) location.href='?page=mercados'" class="btn btn-secondary w-50 text-center mt-3 mx-1">Voltar</a>
		<div>
	</form>
</div>