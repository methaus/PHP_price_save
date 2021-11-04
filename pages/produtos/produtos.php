<div class="container shadow-lg mt-4 rounded pb-3">
	<h1 class="pt-3">Lista de Produtos</h1>
	<h2 class="fs-5">&nbsp;- Adicione qualquer coisa que pretende comprar!</h2>
	<hr>
	<?php
		switch (@$_POST['operacao']) {
			case 'cadastrar':
				$res = $conex->query("INSERT INTO produtos (nome_produto, qtd_produto) VALUES ('{$_POST['nome_produto']}', '{$_POST['qtd_produto']}')") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Item adicionado com sucesso!');</script>";
				} else {
					echo "<script>alert('ERRO - Não foi possível adicionar item!');</script>";
				}
				break;
		}

		$res = $conex->query("SELECT * FROM produtos") or die($conex->error);
		echo "
	<p class='ms-2'>Encontrou <b>{$res->num_rows}</b> resultado(s)</p>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col' class='fs-5 w-75'>Nome</th>
				<th scope='col' class='fs-5'>Qtd. (L,kg,un)</th>
			</tr>
		</thead>
		<tbody>
		";
		if ($res->num_rows > 0) {
			while ($row = $res->fetch_object()) {
				echo "
			<tr>
				<td><p class='mt-1 mb-0 fs-5'>{$row->nome_produto}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$row->qtd_produto}</p></td>
			</tr>
				";
			}
			echo "
			<tr>
				<td colspan='2'><p class='mt-1 mb-0'>Para adicionar mais itens clique <a href='?page=cadastrar_produto'>aqui</a></p></td>
			</tr>
			";
		} else {
			echo "
			<tr>
				<td colspan='2'><p class='mt-1 mb-0'>Você não tem nenhum item na sua lista, para adicionar clique <a href='?page=cadastrar_produto'>aqui</a></p></td>
			</tr>
			";
		}
		echo "
		</tbody>
	</table>
		";
	?>
</div>