<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>ServFácil (SF)</title>
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
  <main><?= $content ?></main>
  <footer></footer>
</body>
</html>