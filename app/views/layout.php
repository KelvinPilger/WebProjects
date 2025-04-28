<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meu App MVC</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <header><h1>Logo / Menu</h1></header>
  <main><?= $content // aqui cai o HTML da view específica ?></main>
  <footer>© <?= date('Y') ?></footer>
</body>
</html>