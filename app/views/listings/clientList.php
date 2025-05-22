<div class="clientsTitle">
	<h1>Clientes</h1>
</div>
<div class="tableContainer">
	<table class="myTable">
		<strong>
			<a href="<?= $_SERVER['SCRIPT_NAME'] ?>/client/create" class="btnIncluir">
				Incluir
			</a>
		</strong>
		<thead>
			<tr>
				<th>Código</th>
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
						<td id="idTd"><?= htmlspecialchars($c['id']) ?></td>
						<td id="nameTd"><?= htmlspecialchars($c['name'] ?? 'N/A') ?></td>
						<td id="cpfTd"><?= htmlspecialchars($c['cpf']) ?? '' ?></td>
						<td id="cnpjTd"><?= htmlspecialchars($c['cnpj']) ?? '' ?></td>
						<td><?= htmlspecialchars($c['age'] ?? '') ?></td>
						<td><?= htmlspecialchars($c['email'] ?? 'Sem e-mail') ?></td>
						<td><?= date('d/m/Y H:i:s', strtotime($c['inserted_at'])) ?></td>
						<td>
							<a>👁️</a>
							<a href="<?= $_SERVER['SCRIPT_NAME'] ?>/client/edit/<?= htmlspecialchars($c['id'], ENT_QUOTES, 'UTF-8') ?>">✏️</a>
							<button id="btnExcluir" onclick="javascript:openRemoveModal(<?= htmlspecialchars($c['id'] ?? null) ?>)">❌</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>
	<div id="removeModal" hidden="true">
		<div id="modalHeader">Confirmar Exclusão
		<div id="modalContent">
			Deseja realmente realizar a exclusão do registro?
		</div>
		<div id="modalButtons">
			<button id="btnConfirm">Confirmar</button>
			<button id="btnCancel">Cancelar</button>
		</div>
	</div>
</div>
<script>
	function openRemoveModal(id) {
		const modalId = id;
		const modal = document.getElementById('removeModal');
		modal.hidden = false;
		
		const btnExcluir = document.getElementById('btnExcluir');
		const btnCancel = document.getElementById('btnCancel');

		const btnConfirm = document.getElementById('btnConfirm');

		btnConfirm.onclick = (event) => {
			event.preventDefault();
			confirmRemoval(modalId);
		}

		btnCancel.onclick = () => closeRemoveModal();
	}

	function closeRemoveModal() {
		const modal = document.getElementById('removeModal');
		const button = document.getElementById('btnCancel');
		modal.hidden = true;
	}

	function confirmRemoval(id) {
		window.location.href = 'remove/'+id;
	}

	function createDataClient() {
		const form = document.querySelector('clientForm');

		form.addEventListener('submit', async event => {
			event.preventDefault();

			const formData = new FormData(form);

			console.log(formData);

			const data = await fetch('client/store', {
				method: 'POST',
				mode: 'cors',
				body: formData
			})
			const response = await data.json();
		});
	};
</script>
</div>