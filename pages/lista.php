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
	<table class='table table-hover' id='table_lista_final'>
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
		if (isset($produtos)) {
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
			echo "
		</tbody>
	</table>
	<script>
		// font: https://www.codexworld.com/export-html-table-data-to-excel-using-javascript/
		// acess: 11/11/2021
		const exportTableToExcel = (tableID) => {
			let downloadLink;
			let tableSelected = document.getElementById(tableID);
			let tableHTML = tableSelected.outerHTML.replace(/ /g, '%20');
			downloadLink = document.createElement(\"a\");
			document.body.appendChild(downloadLink);
			if (navigator.msSaveOrOpenBlob) {
				var blob = new Blob(['\ufeff', tableHTML], {
					type: 'application/vnd.ms-excel'
				});
				navigator.msSaveOrOpenBlob( blob, 'sua_lista.xls');
			} else {
			downloadLink.href = 'data:' + 'application/vnd.ms-excel' + ', ' + tableHTML;
			downloadLink.download = 'sua_lista.xls';
			downloadLink.click();
			}
		}
	</script>
	<div class='text-end'>
		<button onclick=\"exportTableToExcel('table_lista_final', )\" class='btn btn-success'>Baixar lista</button>
	</div>
		";
		} else {
			echo "
			<tr>
				<td colspan='5'><p class='mt-1 mb-0'>Você não tem nenhum produto cadastrado, para adicionar produtos a lista clique <a href='?page=cadastrar_produto'>aqui</a></p></td>
			</tr>
		</tbody>
	</table>
			";
		}
	?>
</div>

