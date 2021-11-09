<div class="container shadow-lg mt-4 rounded pb-3">
	<h1 class="pt-3">Locais de Compra</h1>
	<h2 class="fs-5">&nbsp;- Cadastre os lugares que pretende comprar!</h2>
	<hr>
	<?php
		switch (@$_REQUEST['operacao']) {
			case 'cadastrar':
				$res = $conex->query("INSERT INTO mercados (nome_mercado, local_mercado, site_mercado) VALUES ('{$_POST['nome_mercado']}', '{$_POST['local_mercado']}', '{$_POST['site_mercado']}')") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Local cadastrado com sucesso!');</script>";
				} else {
					echo "<script>alert('ERRO - Não foi possível cadastrar local!');</script>";
				}
				break;
			case 'editar':
				$res = $conex->query("UPDATE mercados SET nome_mercado = '{$_POST['nome_mercado']}', local_mercado = '{$_POST['local_mercado']}', site_mercado = '{$_POST['site_mercado']}' WHERE id_mercado = {$_POST['id_mercado']}") or die($conex->error);
				if ($res == true) {
					echo "<script>alert('Local editado com sucesso!');</script>";
				} else {
					echo "<script>alert('ERRO - Não foi possível editar local!');</script>";
				}
				break;
			case 'excluir':
				$res = $conex->query("SELECT mercados_id_mercado FROM ofertas WHERE mercados_id_mercado = {$_GET['id_mercado']}");
				if ($res->fetch_assoc() == null) {
					$res = $conex->query("DELETE FROM mercados WHERE id_mercado = {$_GET['id_mercado']}") or die($conex->error);
					if ($res == true) {
						echo "<script>alert('Excluiu local com sucesso!'); location.href='?page=mercados';</script>";
					} else {
						echo "<script>alert('Não foi possível excluir esse local!'); location.href='?page=mercados';</script>";
					}
				} else {
					$res = $conex->query("DELETE mercados, ofertas FROM mercados INNER JOIN ofertas WHERE mercados.id_mercado = {$_GET['id_mercado']} AND ofertas.mercados_id_mercado = {$_GET['id_mercado']}") or die($conex->error);
					if ($res == true) {
						echo "<script>alert('Excluiu local com sucesso!'); location.href='?page=mercados';</script>";
					} else {
						echo "<script>alert('Não foi possível excluir esse local!'); location.href='?page=mercados';</script>";
					}
				}
				break;
		}

		$res = $conex->query("SELECT * FROM mercados") or die($conex->error);
		echo "
	<p class='ms-2'>Encontrou <b>{$res->num_rows}</b> resultado(s)</p>
	<table class='table table-hover'>
		<thead>
			<tr>
				<th scope='col' class='fs-5'>Nome</th>
				<th scope='col' class='fs-5'>Local</th>
				<th scope='col' class='fs-5'>Site/contato</th>
				<th scope='col' class='fs-5 text-center'>Ações</th>
			</tr>
		</thead>
		<tbody>
		";
		if ($res->num_rows > 0) {
			while ($row = $res->fetch_object()) {
				echo "
			<tr>
				<td><p class='mt-1 mb-0 fs-5'>{$row->nome_mercado}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$row->local_mercado}</p></td>
				<td><p class='mt-1 mb-0 fs-5'>{$row->site_mercado}</p></td>
				<td class='text-center'>
					<button 
						class='btn btn-success'
						onclick='location.href=\"?page=editar_mercado&id_mercado={$row->id_mercado}\"'
					>
						Editar
					</button>
					<button 
						class='btn btn-danger'
						onclick=
							'if (confirm(\"Tem certeza que deseja excluir?\\nExcluindo o local você também excluirá os seus preços!\")) {
								location.href=\"?page=mercados&operacao=excluir&id_mercado={$row->id_mercado}\"
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
				<td colspan='4'><p class='mt-1 mb-0'>Para cadastrar mais locais clique <a href='?page=cadastrar_mercado'>aqui</a></p></td>
			</tr>
			";
		} else {
			echo "
			<tr>
				<td colspan='4'><p class='mt-1 mb-0'>Você não tem nenhum local cadastrado, para cadastrar clique <a href='?page=cadastrar_mercado'>aqui</a></p></td>
			</tr>
			";
		}
		echo "
		</tbody>
	</table>
		";
	?>
</div>