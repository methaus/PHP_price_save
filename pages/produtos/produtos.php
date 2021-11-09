<div class="container shadow-lg mt-4 rounded pb-3">
	<h1 class="pt-3">Lista de Produtos</h1>
	<h2 class="fs-5">&nbsp;- Adicione qualquer coisa que pretende comprar!</h2>
	<hr>
	<?php
		switch (@$_REQUEST['operacao']) {
			case 'cadastrar':
				$res = $conex->query("INSERT INTO produtos (nome_produto, qtd_produto) VALUES ('{$_POST['nome_produto']}', '{$_POST['qtd_produto']}')") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Item adicionado com sucesso!');</script>";
				} else {
					echo "<script>alert('ERRO - Não foi possível adicionar item!');</script>";
				}
				break;
			case 'editar':
				$res = $conex->query("UPDATE produtos 
					SET nome_produto = '{$_POST['nome_produto']}', qtd_produto = '{$_POST['qtd_produto']}' 
					WHERE id_produto = {$_POST['id_produto']}") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Item editado com sucesso!');</script>";
				} else {
					echo "<script>alert('ERRO - Não foi possível editar esse item!');</script>";
				}
				break;
			case 'excluir':
				$res = $conex->query("SELECT produtos_id_produto FROM ofertas WHERE produtos_id_produto = {$_GET['id_produto']}");
				if ($res->fetch_assoc() == null) {
					$res = $conex->query("DELETE FROM produtos WHERE id_produto = {$_GET['id_produto']}") or die($conex->error);
					if ($res == true) {
						echo "<script>alert('Item excluido com sucesso!'); location.href='?page=produtos';</script>";
					} else {
						echo "<script>alert('Não foi possível excluir esse item!'); location.href='?page=produtos';</script>";
					}
				} else {
					$res = $conex->query("DELETE produtos, ofertas FROM produtos INNER JOIN ofertas WHERE produtos.id_produto = {$_GET['id_produto']} AND ofertas.produtos_id_produto = {$_GET['id_produto']}") or die($conex->error);
					if ($res == true) {
						echo "<script>alert('Item excluido com sucesso!'); location.href='?page=produtos';</script>";
					} else {
						echo "<script>alert('Não foi possível excluir esse item!'); location.href='?page=produtos';</script>";
					}
				}
				break;
		}

		$res = $conex->query("SELECT * FROM produtos") or die($conex->error);
		echo "
	<p class='ms-2'>Encontrou <b>{$res->num_rows}</b> resultado(s)</p>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col' class='fs-5 w-50'>Nome</th>
				<th scope='col' class='fs-5'>Qtd. (L,kg,un)</th>
				<th scope='col' class='fs-5 text-center'>Ações</th>
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
				<td class='text-center'>
					<button 
						class='btn btn-success'
						onclick='location.href=\"?page=editar_produto&id_produto={$row->id_produto}\"'
					>
						Editar
					</button>
					<button 
						class='btn btn-danger'
						onclick=
							'if (confirm(\"Tem certeza que deseja excluir?\\nExcluindo o produto você também excluirá suas ofertas!\")) {
								location.href=\"?page=produtos&operacao=excluir&id_produto={$row->id_produto}\"
							} else {
								false
							}'
					>
						Excluir
					</button>
				</td>
			</tr>
				";
			}
			echo "
			<tr>
				<td colspan='3'><p class='mt-1 mb-0'>Para adicionar mais itens clique <a href='?page=cadastrar_produto'>aqui</a></p></td>
			</tr>
			";
		} else {
			echo "
			<tr>
				<td colspan='3'><p class='mt-1 mb-0'>Você não tem nenhum item na sua lista, para adicionar clique <a href='?page=cadastrar_produto'>aqui</a></p></td>
			</tr>
			";
		}
		echo "
		</tbody>
	</table>
		";
	?>
</div>