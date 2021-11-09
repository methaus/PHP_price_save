<div class="container shadow-lg mt-4 rounded pb-3">
	<h1 class="pt-3">Preços, Ofertas e Promoções</h1>
	<h2 class="fs-5">&nbsp;- Anote os preços para comparar antes de comprar!</h2>
	<hr>
	<?php
		switch (@$_REQUEST['operacao']) {
			case 'cadastrar':
				$res = $conex->query("SELECT id_oferta FROM ofertas WHERE mercados_id_mercado = '{$_POST['mercados_id_mercado']}' AND produtos_id_produto = '{$_POST['produtos_id_produto']}'");
				if ($res->fetch_assoc() == null) {
					$res = $conex->query("INSERT INTO ofertas (mercados_id_mercado, produtos_id_produto, preco_oferta, comentario_oferta) VALUES ('{$_POST['mercados_id_mercado']}', '{$_POST['produtos_id_produto']}', '{$_POST['preco_oferta']}', '{$_POST['comentario_oferta']}')") or die($conex->error);
					if ($res == true) {
						echo "<script>alert('Preço anotado com sucesso!');</script>";
					} else {
						echo "<script>alert('ERRO - Não foi anotar esse preço!');</script>";
					}
				} else {
					echo "<script>alert('ERRO - Um produto só pode ter um preço em cada mercado!');</script>";
				}
				break;
			case 'editar':
				$res = $conex->query("UPDATE ofertas SET preco_oferta = {$_POST['preco_oferta']}, comentario_oferta = '{$_POST['comentario_oferta']}' WHERE mercados_id_mercado = {$_POST['mercados_id_mercado']} AND produtos_id_produto = {$_POST['produtos_id_produto']} ") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Preço editado com sucesso!');</script>";
				} else {
					echo "<script>alert('ERRO - Não foi editar esse preço!');</script>";
				}
				break;
			case 'excluir':
				$res = $conex->query("DELETE FROM ofertas WHERE mercados_id_mercado = {$_GET['mercado']} produtos_id_produto = {$_GET['produto']}") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Excluiu oferta com sucesso!'); location.href='?page=ofertas';</script>";
				} else {
					echo "<script>alert('Não foi possível excluir essa oferta!'); location.href='?page=ofertas';</script>";
				}
				break;
		}

		$res = $conex->query("SELECT * FROM ofertas INNER JOIN mercados ON mercados.id_mercado = ofertas.mercados_id_mercado INNER JOIN produtos ON produtos.id_produto = ofertas.produtos_id_produto") or die($conex->error);
		echo "
	<p class='ms-2'>Encontrou <b>{$res->num_rows}</b> resultado(s)</p>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col' class='fs-5 w-25'>Produto</th>
				<th scope='col' class='fs-5'>Preço</th>
				<th scope='col' class='fs-5 w-25'>Mercado</th>
				<th scope='col' class='fs-5 text-center'>Comentário?</th>
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
				<td><p class='mt-1 mb-0 fs-5'>{$row->preco_oferta}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$row->nome_mercado}</p></td>
				";
				if ($row->comentario_oferta == true) {
					echo "
				<td>
					<p class='mt-1 mb-0 fs-5 text-center'>
						<a 
							class='link-success'
							style='cursor: pointer;'
							onclick='alert(\"Seu comentário sobre este preço é:\\n{$row->comentario_oferta}\")'
						>
							ver
						</a>
					</p>
				</td>
					";
				} else {
					echo "
				<td></td>
					";
				}
				echo "
				<td class='text-center'>
					<button 
						class='btn btn-success'
						onclick='location.href=\"?page=editar_oferta&produto={$row->produtos_id_produto}&mercado={$row->mercados_id_mercado}\"'
					>
						Editar
					</button>
					<button 
						class='btn btn-danger'
						onclick=
							'if (confirm(\"Tem certeza que deseja excluir? Excluindo o produto você também excluirá suas ofertas!\")) {
								location.href=\"?page=ofertas&operacao=excluir&produto={$row->produtos_id_produto}&mercado={$row->mercados_id_mercado}\"
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
				<td colspan='5'><p class='mt-1 mb-0'>Para anotar mais preços e ofertas clique <a href='?page=cadastrar_ofertas'>aqui</a></p></td>
			</tr>
			";
		} else {
			echo "
			<tr>
				<td colspan='5'><p class='mt-1 mb-0'>Você não tem nenhum preco de produto anotado, para anotar preços clique <a href='?page=cadastrar_ofertas'>aqui</a></p></td>
			</tr>
			";
		}
		echo "
		</tbody>
	</table>
		";
	?>
</div>