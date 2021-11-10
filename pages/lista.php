<div class="container shadow-lg mt-4 rounded pb-3">
	<h1 class="pt-3">Sua Lista</h1>
	<h2 class="fs-5">&nbsp;- Veja sua lista com as melhores opções anotadas por você!</h2>
	<hr>
	<?php
		$res = $conex->query("SELECT * FROM produtos INNER JOIN ofertas ON ofertas.produtos_id_produto = produtos.id_produto INNER JOIN mercados ON mercados.id_mercado = ofertas.mercados_id_mercado") or die($conex->error);
		while ($row = $res->fetch_object()) {
			$produtos[] = (array) $row;
		}
		echo "
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col' class='fs-5'>Produto</th>
				<th scope='col' class='fs-5'>Preço</th>
				<th scope='col' class='fs-5'>Mercado</th>
				<th scope='col' class='fs-5'>Qtd.</th>
				<th scope='col' class='fs-5'>Comentário</th>
			</tr>
		</thead>
		<tbody>
		";
		if (count($produtos) > 0) {
			foreach ($produtos as $row) {
				$id_produtos[] = $row['id_produto'];
			}
			$duplicates = array_diff_assoc($id_produtos, array_unique($id_produtos));
			foreach ($produtos as $row) {
				$produto_id = "produto_{$row['id_produto']}";

				if (in_array($row['id_produto'], $duplicates)) {
					if (isset($$produto_id)) {
						unset($duplicates[array_search($row['id_produto'], $duplicates)]);
						if ($$produto_id['preco_oferta'] > $row['preco_oferta']) {
							$$produto_id['nome_produto'] = $row['nome_produto'];
							$$produto_id['qtd_produto'] = $row['qtd_produto'];
							$$produto_id['preco_oferta'] = $row['preco_oferta'];
							$$produto_id['comentario_oferta'] = $row['comentario_oferta'];
							$$produto_id['nome_mercado'] = $row['nome_mercado'];
						}
					} else {
						$$produto_id = array(
							'preco_oferta' => $row['preco_oferta'],
							'comentario_oferta' => $row['comentario_oferta'],
							'nome_mercado' => $row['nome_mercado'],
						);
						$count[] = $row['id_produto'];
					}
				} else {
					$$produto_id = $row;
					$count[] = $row['id_produto'];
				}
			}
			foreach ($count as $row) {
				$produto_id = "produto_{$row}";
				echo "
			<tr>
				<td><p class='mt-1 mb-0 fs-5'>{$$produto_id['nome_produto']}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$$produto_id['preco_oferta']}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$$produto_id['nome_mercado']}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$$produto_id['qtd_produto']}</p></td>
				";
				if ($$produto_id['comentario_oferta'] != null) {
					echo "
				<td>
					<p class='mt-1 mb-0 fs-5 text-center'>
						<a 
							class='link-success'
							style='cursor: pointer;'
							onclick='alert(\"Seu comentário sobre este preço é:\\n{$$produto_id['comentario_oferta']}\")'
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
			</tr>
				";
			}
		}
		echo "
		</tbody>
	</table>
		";
	?>
</div>

<!--
Array ( 
	[0] => Array (
		[mercados_id_mercado] => 16
		[preco_oferta] => 14.89
		[comentario_oferta] => Eh, pão de batata...
		[id_mercado] => 16
		[nome_mercado] => Casa da Mãe Joana Marks
		[local_mercado] => Puta que te Pariu N° 8
		[site_mercado] =>
	)
	[2] => Array (
		[mercados_id_mercado] => 17
		[preco_oferta] => 10.99
		[comentario_oferta] =>
		[id_mercado] => 17
		[nome_mercado] => Rei dos Bolos
		[local_mercado] => Não sei
		[site_mercado] => Não ligo
	)
	[3] => Array (
		[id_produto] => 8
		[nome_produto] => Mel de Abelha Aurora
		[qtd_produto] => 2
		[mercados_id_mercado] => 18
		[produtos_id_produto] => 8
		[id_oferta] => 0
		[preco_oferta] => 17.89
		[comentario_oferta] =>
		[id_mercado] => 18
		[nome_mercado] => Tenda do Exu Caveira e Pai Vatapá
		[local_mercado] =>
		[site_mercado] => Faz encruzilhada 4° Feira
	)
)
-->