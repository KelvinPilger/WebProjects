<div class="clientsTitle">
	<h1>Clientes</h1>
</div>
<div class="tableContainer">
	<table class="myTable">
		<thead>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>CNPJ</th>
				<th>Idade</th>
				<th>E-mail</th>
				<th>Data e Hora do Cadastro</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($clients)): ?>
				<?php foreach ($clients as $c): ?>
					<tr>
					<td><?= htmlspecialchars($c['name'] ?? 'N/A') ?></td>
					<td><?= htmlspecialchars($c['cpf']) ?></td>
					<td><?= htmlspecialchars($c['cnpj']) ?></td>
					<td><?= htmlspecialchars($c['age'] ?? '') ?></td>
					<td><?= htmlspecialchars($c['email'] ?? 'Sem e-mail') ?></td>
					<td><?= date('d/m/Y H:i:s', strtotime($c['inserted_at'])) ?></td>
					<td class="btnActions">
						<a href="">👁️</a>
						<a href="">✏️</a>
						<a href="">❌</a>
					</td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<p>Nenhum cliente encontrado.</p>
			<?php endif; ?>
		</tbody>
	</table>
	<strong>
		<a href="" class="btnIncluir">
		Incluir Cliente
		</a>
	</strong>
</div>
