<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>ServFácil (SF)</title>
  <link rel="stylesheet" href="/../../Projeto/public/assets/css/layout.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/modal.css">
  <?php if (!empty($style) && is_array($style)): ?>
    <?php foreach ($style as $href): ?>
      <link rel="stylesheet" href="<?= htmlspecialchars($href) ?>">
    <?php endforeach; ?>
  <?php endif; ?>
</head>

<body>
  <div class="general-nav">
    <nav class="general" id="main-nav">
      <div id="toast-container">
        <div id="message-modal" class="modal hidden">
          <div class="modal__window">
            <p class="modal__message"></p>
          </div>
        </div>
    </nav>
  </div>
  <nav id="sidebarNav">
      <div id="accessButtons">
        <a type="button" id="btnCliente" class="navButtons" href="<?= $_SERVER['SCRIPT_NAME'] ?>/client/index">
          <svg xmlns="http://www.w3.org/2000/svg" id="svgClient" height="22" width="22" fill="currentColor" viewBox="0 0 24 24" data-name="svgClient"><path d="m7.5 13a4.5 4.5 0 1 1 4.5-4.5 4.505 4.505 0 0 1 -4.5 4.5zm6.5 11h-13a1 1 0 0 1 -1-1v-.5a7.5 7.5 0 0 1 15 0v.5a1 1 0 0 1 -1 1zm3.5-15a4.5 4.5 0 1 1 4.5-4.5 4.505 4.505 0 0 1 -4.5 4.5zm-1.421 2.021a6.825 6.825 0 0 0 -4.67 2.831 9.537 9.537 0 0 1 4.914 5.148h6.677a1 1 0 0 0 1-1v-.038a7.008 7.008 0 0 0 -7.921-6.941z"/></svg>
          <span class="btn-text">Clientes</span>
        </a>
        <a id="btnProdutos" class="navButtons">
          <svg xmlns="http://www.w3.org/2000/svg" id="svgProduto" data-name="svgProduto" fill="currentColor" viewBox="0 0 24 24" height="22" width="22"><path d="M11,13H3c-1.657,0-3,1.343-3,3v5c0,1.657,1.343,3,3,3H11V13Zm-7.5,4h0c0-.552,.448-1,1-1h2c.552,0,1,.448,1,1h0c0,.552-.448,1-1,1h-2c-.552,0-1-.448-1-1Zm17.5-4H13v11h8c1.657,0,3-1.343,3-3v-5c0-1.657-1.343-3-3-3Zm-1.5,5h-2c-.552,0-1-.448-1-1h0c0-.552,.448-1,1-1h2c.552,0,1,.448,1,1h0c0,.552-.448,1-1,1ZM15,0h-6c-1.657,0-3,1.343-3,3V11h12V3c0-1.657-1.343-3-3-3Zm-2,5h-2c-.552,0-1-.448-1-1h0c0-.552,.448-1,1-1h2c.552,0,1,.448,1,1h0c0,.552-.448,1-1,1Z"/></svg>
          <span class="btn-text">Produtos</span>
        </a>
      </div>
  </nav>
  </div>
  <main><?= $content ?></main>
  <footer>
  </footer>
  <script src="../../assets/js/modal.js" defer></script>
</body>

</html>