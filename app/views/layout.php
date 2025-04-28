<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>ServFácil (SF)</title>
  <?php if(!empty($style) && is_array($style)): ?>
	<?php foreach ($style as $href):?>
		<link rel="stylesheet" href="<?= htmlspecialchars($href) ?>">
	<?php endforeach; ?>
  <?php endif; ?>
</head>
<body>
  <main><?= $content // aqui cai o HTML da view específica ?></main>
  <footer></footer>
</body>
</html>