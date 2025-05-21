<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>ServFácil (SF)</title>
  <link rel="stylesheet" href="/../../Projeto/public/assets/css/layout.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  <?php if(!empty($style) && is_array($style)): ?>
	<?php foreach ($style as $href):?>
		<link rel="stylesheet" href="<?= htmlspecialchars($href) ?>">
	<?php endforeach; ?>
  <?php endif; ?>
</head>
<body>
  <div class="general-nav">
      <nav class="general" id="main-nav">
        <ul class="dropdown-nav">
          <li class="nav-item dropdown">
            <a href="#" class="nav-content">Listagens</a>
              <ul class="dropdown-content">
                <li><a href="<?= $_SERVER['SCRIPT_NAME'] . '/client/index' ?>">Clientes</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Fornecedores</a></li>
                <li><a href="#">Recebimentos</a></li>
                <li><a href="#">Pagamentos</a></li>
                <li><a href="#">Caixa</a></li>
              </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-content">Cadastros</a>
              <ul class="dropdown-content">
                <li><a href="#">Clientes</a></li>
                <li><a href="#">Produtos</a></li>
              </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-content">Outros</a>
            <ul class="dropdown-content">
            </ul>
        </ul>
      </nav>
    </div>
  <main><?= $content ?></main>
  <footer></footer>
</body>
</html>