<div class="container shadow-lg mt-4 rounded pb-3">
	<h1 class="pt-3">Preços, Ofertas e Promoções</h1>
	<h2 class="fs-5">&nbsp;- Anote os preços para comparar antes de comprar!</h2>
	<hr>
	<?php
		switch (@$_POST['operacao']) {
			case 'cadastrar':
				$res = $conex->query("INSERT INTO ofertas (mercados_id_mercado, produtos_id_produto, preco_oferta, comentario_oferta) VALUES ('{$_POST['mercados_id_mercado']}', '{$_POST['produtos_id_produto']}', '{$_POST['preco_oferta']}', '{$_POST['comentario_oferta']}')") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Preço anotado com sucesso!');</script>";
				} else {
					echo "<script>alert('ERRO - Não foi anotar esse preço!');</script>";
				}
				break;
		}

		$res = $conex->query("SELECT * FROM ofertas") or die($conex->error);
		echo "
	<p class='ms-2'>Encontrou <b>{$res->num_rows}</b> resultado(s)</p>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col' class='fs-5'>Mercado</th>
				<th scope='col' class='fs-5'>Produto</th>
				<th scope='col' class='fs-5'>Preço</th>
				<th scope='col' class='fs-5'>Comentário?</th>
			</tr>
		</thead>
		<tbody>
		";
		if ($res->num_rows > 0) {
			while ($row = $res->fetch_object()) {
				echo "
			<tr>
				<td><p class='mt-1 mb-0 fs-5'>{$row->mercados_id_mercado}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$row->produtos_id_produto}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$row->preco_oferta}</p></td>";
				if ($row->comentario_oferta == true) {
					echo "
				<td>
					<p class='mt-1 mb-0 fs-5'>
						<script type='text/javascript'>
							const showComment = () => {
								alert('Seu comentário sobre este preço é:\\n{$row->comentario_oferta}')
							}
						</script>
						<a 
							class='link-success'
							style='cursor: pointer;'
							onclick='showComment()'
						>
							ver
						</a>
					</p>
				</td>
			</tr>
					";
				} else {
					echo "
				<td></td>
			</tr>
					";
				}
			}
			echo "
			<tr>
				<td colspan='3'><p class='mt-1 mb-0'>Para anotar mais preços e ofertas clique <a href='?page=cadastrar_ofertas'>aqui</a></p></td>
			</tr>
			";
		} else {
			echo "
			<tr>
				<td colspan='3'><p class='mt-1 mb-0'>Você não tem nenhum preco de produto anotado, para anotar preços clique <a href='?page=cadastrar_ofertas'>aqui</a></p></td>
			</tr>
			";
		}
		echo "
		</tbody>
	</table>
		";
	?>
</div>