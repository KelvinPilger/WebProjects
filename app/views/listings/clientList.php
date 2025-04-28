<h2>Teste Render</h2>

<?php if (!empty($clients)): ?>
  <ul>
    <?php foreach ($clients as $c): ?>
      <ul>
        <li><?= htmlspecialchars($c['name'] ?? 'N/A') ?></li>
        <li><?= htmlspecialchars($c['cpf']) ?></li>
        <li><?= htmlspecialchars($c['cnpj']) ?></li>
        <li><?= htmlspecialchars($c['age'] ?? '') ?></li>
        <li><?= htmlspecialchars($c['email'] ?? 'Sem e-mail') ?></li>
      </ul>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>Nenhum cliente encontrado.</p>
<?php endif; ?>