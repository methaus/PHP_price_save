<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<title>Price Save - Lista de Compras</title>
	</head>
	<body>
		<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid w-100 bg-success">
				<div class="text-light navbar-brand ms-1">
					<h1 class="fs-2">Price Save - Lista de Compras</h1>
					<h2 class="fs-5">Anote todas as promoções que puder e compare os preços aqui!</h2>
				</div>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item"><a class="nav-link active" aria-current="page" href="?page=home">Home <i class="fas fa-home"></i></a></li>
						<li class="nav-item"><a class="nav-link" aria-current="page" href="?page=mercados">Locais de Compra <i class="fas fa-store"></i></a></li>
						<li class="nav-item"><a class="nav-link" aria-current="page" href="?page=produtos">Lista de Produtos <i class="fas fa-list"></i></a></li>
						<li class="nav-item"><a class="nav-link" aria-current="page" href="?page=ofertas">Ofertas <i class="fas fa-money-bill-wave"></i></a></li>
						<li class="nav-item"><a class="nav-link" aria-current="page" href="?page=lista">Gerar Lista <i class="fas fa-shopping-basket"></i></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
			define('HOST', 'localhost');
			define('USER', 'root');
			define('PASS', '');
			define('BASE', 'price_save');
			$conex = new MySQLi(HOST,USER,PASS,BASE);

			switch (@$_GET['page']) {
				case 'mercados':
					include('./pages/mercados/mercados.php');
					break;
				case 'cadastrar_mercado':
					include('./pages/mercados/cadastrar.html');
					break;
				case 'editar_mercado':
					include('./pages/mercados/editar.php');
					break;
				case 'produtos':
					include('./pages/produtos/produtos.php');
					break;
				case 'cadastrar_produto':
					include('./pages/produtos/cadastrar.html');
					break;
				case 'editar_produto':
					include('./pages/produtos/editar.php');
					break;
				case 'ofertas':
					include('./pages/ofertas/ofertas.php');
					break;
				case 'cadastrar_ofertas':
					include('./pages/ofertas/cadastrar.php');
					break;
				case 'editar_oferta':
					include('./pages/ofertas/editar.php');
					break;
				case 'lista':
					include('./pages/lista.php');
					break;
				default:
					include('./pages/home.php');
					break;
			}
		?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>