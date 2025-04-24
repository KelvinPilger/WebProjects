<?php

  define('BASE_PATH', realpath(__DIR__ . '/..'));
  require BASE_PATH . '/vendor/autoload.php';

  use App\Controllers\ClientController;

  $action = $_REQUEST['action'] ?? 'listar';
  $ctrl   = new ClientController();

  switch ($action) {
    case 'create':  $ctrl->create();  break;
    case 'store':   $ctrl->store();   break;
    case 'delete':  $ctrl->delete();  break;
    case 'listar':
    default:        $ctrl->index();   break;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/index.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  <title>Menu (ServFácil)</title>
</head>
<body>
  <header>
    <div class="general-nav">
    <nav class="general" id="main-nav">
      <ul class="dropdown-nav">
        <li class="nav-item dropdown">
          <a href="#" class="nav-content">Listagens</a>
            <ul class="dropdown-content">
            <li><a href="index.php?action=listar">Clientes</a></li>
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
              <li><a href="registrations/cad_clients.php">Clientes</a></li>
              <li><a href="registrations/cad_product.html">Produtos</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-content">Outros</a>
          <ul class="dropdown-content">
          </ul>
        </li>
        <li class="logout">
          <a href="#" class="nav-content">
            <svg
              id="btnSair"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="22"
              height="22"
              fill="currentColor"
            >
              <path d="M3,3H8V0H3A3,3,0,0,0,0,3V21a3,3,0,0,0,3,3H8V21H3Z" />
              <path
                d="M22.948,9.525,18.362,4.939,16.241,7.061l3.413,3.412L5,10.5,5,13.5l14.7-.027-3.466,3.466,2.121,2.122,4.587-4.586A3.506,3.506,0,0,0,22.948,9.525Z"
              />
            </svg>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <nav class="left-nav" id="left-nav">
    <div class="emitente">
      <img src="resources/icon.png" class="imgEmitente">
      <p class="lblEmitente">
        Kelvin Enterprises Company & Pilger Inc.
      </p>
    </div>
  </nav>
  </header>
  <main>
  </main>
  <footer>
  </footer>
</body>