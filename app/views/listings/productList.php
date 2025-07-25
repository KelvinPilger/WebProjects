
<div class="tableContainer">
	<div id="headerButtons">
		<strong>
			<a href="<?= BASE_URL ?>/product/create" class="btnIncluir">
				Cadastrar
			</a>
		</strong>
	</div>
	<table class="myTable">
		<form action="<?= BASE_URL ?>/product/index" id="filterForm" method="get">
			<input
				type="hidden"
				name="page"
				id="pageInput"
				value="<?= htmlspecialchars($_GET['page'] ?? 1) ?>">
			<div id="searchOptions">
				<label for="rowLimit" id="lblLimit">Número de Registros: </label>
				<select name="rowLimit" id="rowLimit" onchange="javascript:replySelectValue()">
					<option value="10" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 10)  ? 'selected' : '' ?>>10</option>
					<option value="20" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 20)  ? 'selected' : '' ?>>20</option>
					<option value="50" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 50)  ? 'selected' : '' ?>>50</option>
					<option value="100" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 100) ? 'selected' : '' ?>>100</option>
					<option value="all" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 'all') ? 'selected' : '' ?>>Todos</option>
				</select>

				<nav id="pagination">
					<?php if ($currentPage > 1): ?>
						<a class="paginationBtn" href="?page=<?= 1 ?>&rowLimit=<?= $rowLimit ?>">
							<<</a>

								<a class="paginationBtn" href="?page=<?= $currentPage - 1 ?>&rowLimit=<?= $rowLimit ?>">
									<</a>
									<?php endif; ?>

									<?php if ($rowLimit === 'all'): ?>
										1 - <?= htmlspecialchars($total) ?> de <?= htmlspecialchars($total) ?> produtos
									<?php elseif ($total > 0): ?>
										<?= htmlspecialchars($offset + 1) ?>
										-
										<?= htmlspecialchars(min($offset + $limit, $total)) ?>
										de <?= htmlspecialchars($total) ?> produtos
									<?php else: ?>
										<?= htmlspecialchars($total) ?>
										-
										<?= htmlspecialchars($total) ?>
										de <?= htmlspecialchars($total) ?> produtos
									<?php endif; ?>

									<?php if ($currentPage < $totalPages): ?>
										<a class="paginationBtn" href="?page=<?= $currentPage + 1 ?>&rowLimit=<?= $rowLimit ?>">></a>

										<a class="paginationBtn" href="?page=<?= $totalPages ?>&rowLimit=<?= $rowLimit ?>"> >></a>
									<?php endif; ?>
				</nav>
				<input type="hidden" name="page" value="<?= $_GET['page'] ?? 1 ?>">
			</div>
			<thead>
				<tr>
					<th>Código</th>
					<th>Produto</th>
					<th>Cód. Barras GTIN</th>
					<th>Qtde.</th>
					<th>Preço de Custo</th>
					<th>Preço de Venda</th>
					<th>CFOP</th>
					<th>CSOSN/CST</th>
					<th id="actionTh">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php if (!empty($products)): ?>
					<?php foreach ($products as $p): ?>
						<tr id="row-<?= $p['id'] ?>">
							<td id="idTd"><?= htmlspecialchars($p['id']) ?></td>
							<td id="produtoTd"><?= htmlspecialchars($p['product_name'] ?? 'N/A') ?></td>
							<td id="codBarrasTd"><?= htmlspecialchars($p['gtin_barcode']  ?? '') ?></td>
							<td id="qtdeTd"><?= number_format($p['quantity'], 2, ',', '.') ?></td>
							<td id="custoTd">R$ <?= number_format($p['cost_price'], 2, ',', '.') ?></td>
							<td id="vendaTd">R$ <?= number_format($p['sell_price'], 2, ',', '.') ?></td>
							<td id="cfopTd"><?= htmlspecialchars($p['cfop'])?></td>
							<td id="csosnTd"><?= htmlspecialchars($p['csosn_cst'])?></td>
							<td id="actionTd">
								<a id="btnEdit" href="<?= BASE_URL ?>/product/edit/<?= htmlspecialchars($p['id'], ENT_QUOTES, 'UTF-8') ?>">
									<svg xmlns="http://www.w3.org/2000/svg" id="editSvg" data-name="Layer 1" viewBox="0 0 24 24" width="17" height="17" fill="currentColor">
										<path d="m18.813,10c.309,0,.601-.143.79-.387s.255-.562.179-.861c-.311-1.217-.945-2.329-1.833-3.217l-3.485-3.485c-1.322-1.322-3.08-2.05-4.95-2.05h-4.515C2.243,0,0,2.243,0,5v14c0,2.757,2.243,5,5,5h3c.552,0,1-.448,1-1s-.448-1-1-1h-3c-1.654,0-3-1.346-3-3V5c0-1.654,1.346-3,3-3h4.515c.163,0,.325.008.485.023v4.977c0,1.654,1.346,3,3,3h5.813Zm-6.813-3V2.659c.379.218.732.488,1.05.806l3.485,3.485c.314.314.583.668.803,1.05h-4.338c-.551,0-1-.449-1-1Zm11.122,4.879c-1.134-1.134-3.11-1.134-4.243,0l-6.707,6.707c-.755.755-1.172,1.76-1.172,2.829v1.586c0,.552.448,1,1,1h1.586c1.069,0,2.073-.417,2.828-1.172l6.707-6.707c.567-.567.879-1.32.879-2.122s-.312-1.555-.878-2.121Zm-1.415,2.828l-6.708,6.707c-.377.378-.879.586-1.414.586h-.586v-.586c0-.534.208-1.036.586-1.414l6.708-6.707c.377-.378,1.036-.378,1.414,0,.189.188.293.439.293.707s-.104.518-.293.707Z" />
									</svg>
								</a>
								<button id="btnExcluir" type="button" onclick="javascript:openRemoveModal(<?= htmlspecialchars($p['id'] ?? null) ?>)">
									<svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
										<path d="M14.121,12,18,8.117A1.5,1.5,0,0,0,15.883,6L12,9.879,8.11,5.988A1.5,1.5,0,1,0,5.988,8.11L9.879,12,6,15.882A1.5,1.5,0,1,0,8.118,18L12,14.121,15.878,18A1.5,1.5,0,0,0,18,15.878Z" />
									</svg>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</form>
	</table>
	<div id="searchOptions2">
		<label for="rowLimit" id="lblLimit2">Número de Registros: </label>
		<select name="rowLimit" id="rowLimit2">
			<option value="10" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 10)  ? 'selected' : '' ?>>10</option>
			<option value="20" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 20)  ? 'selected' : '' ?>>20</option>
			<option value="50" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 50)  ? 'selected' : '' ?>>50</option>
			<option value="100" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 100) ? 'selected' : '' ?>>100</option>
			<option value="all" <?= (isset($_GET['rowLimit']) && $_GET['rowLimit'] == 'all') ? 'selected' : '' ?>>Todos</option>
		</select>
		<nav id="pagination">
			<?php if ($currentPage > 1): ?>
				<a class="paginationBtn" href="?page=<?= 1 ?>&rowLimit=<?= $rowLimit ?>">
					<<</a>

						<a class="paginationBtn" href="?page=<?= $currentPage - 1 ?>&rowLimit=<?= $rowLimit ?>">
							<</a>
							<?php endif; ?>

							<?php if ($rowLimit === 'all'): ?>
								1 - <?= htmlspecialchars($total) ?> de <?= htmlspecialchars($total) ?> produtos
							<?php elseif ($total > 0): ?>
								<?= htmlspecialchars($offset + 1) ?>
								-
								<?= htmlspecialchars(min($offset + $limit, $total)) ?>
								de <?= htmlspecialchars($total) ?> produtos
							<?php else: ?>
								<?= htmlspecialchars($total) ?>
								-
								<?= htmlspecialchars($total) ?>
								de <?= htmlspecialchars($total) ?> produtos
							<?php endif; ?>

							<?php if ($currentPage < $totalPages): ?>
								<a class="paginationBtn" href="?page=<?= $currentPage + 1 ?>&rowLimit=<?= $rowLimit ?>">></a>

								<a class="paginationBtn" href="?page=<?= $totalPages ?>&rowLimit=<?= $rowLimit ?>">>></a>
							<?php endif; ?>
		</nav>
	</div>
	</form>
</div>
<div id="removeModal" hidden="true">
	<object id="warningSvg" type="image/svg+xml" data="<?= BASE_URL ?>/assets/images/warningTriangle.svg"></object>
	<div id="modalHeader">Confirmar Exclusão
	</div>
	<div id="modalContent">
		Deseja realmente realizar a exclusão do registro?
	</div>
	<div id="modalButtons">
		<button type="button" id="btnConfirm">Confirmar</button>
		<button type="button" id="btnCancel">
			<svg id="closeSvg" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
				<polygon points="18.707 6.707 17.293 5.293 12 10.586 6.707 5.293 5.293 6.707 10.586 12 5.293 17.293 6.707 18.707 12 13.414 17.293 18.707 18.707 17.293 13.414 12 18.707 6.707" />
			</svg>
		</button>
	</div>
</div>
<div id="modalOverlay" hidden="true">
</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const main = document.querySelector('main');
  		main.classList.add('slide-in');
		replySelectValue();

		const form = document.getElementById('filterForm');
		const topSel = document.getElementById('rowLimit');
		const bottomSel = document.getElementById('rowLimit2');
		const pageInput = document.getElementById('pageInput');

		bottomSel.value = topSel.value;

		function onLimitChange(e) {
			const v = e.target.value;
			topSel.value = v;
			bottomSel.value = v;
			pageInput.value = 1;
			form.submit();
		}

		topSel.addEventListener('change', onLimitChange);
		bottomSel.addEventListener('change', onLimitChange);

		function replySelectValue() {
		const topSel = document.getElementById('rowLimit');
		const bottomSel = document.getElementById('rowLimit2');
		const form = document.getElementById('filterForm');

		bottomSel.value = topSel.value;

		topSel.addEventListener('change', onLimitChange);
		bottomSel.addEventListener('change', onLimitChange);


		[topSel, bottomSel].forEach(sel =>
			sel.addEventListener('change', () => {
				topSel.value = sel.value;
				bottomSel.value = sel.value;
			}));
		}

		function redirectWithTransition(url, delay = 800) {
			document.body.classList.add('fade-out');
			setTimeout(() => {
				window.location.href = url;
			}, delay);
		}
	});

	
	function openRemoveModal(id) {
		const modalId = id;
		const modal = document.getElementById('removeModal');
		const overlay = document.getElementById('modalOverlay');
		overlay.hidden = false;
		modal.hidden = false;
		modal.classList.remove('modal--close');
		modal.classList.add('modal--open');

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
		const overlay = document.getElementById('modalOverlay');
		modal.classList.remove('modal--open');
		modal.classList.add('modal--close');

		setTimeout(function() {
			modal.hidden = true;
			overlay.hidden = true;
		}, 200);
	}

	async function confirmRemoval(id) {
		try {
			const resp = await fetch(`<?= BASE_URL ?>/product/remove/${id}`, {
				method: 'POST',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				}
			});
			if (!resp.ok) throw new Error(`HTTP ${resp.status}`);

			const data = await resp.json();

			if (data.status === 'success') {
				const row = document.getElementById(`row-${id}`);
				if (row) row.remove();
				MessageModal.show('success', data.message);
			} else {
				MessageModal.show('warning', data.message);
			}
		} catch (err) {
			console.log(err)
			MessageModal.show('error', 'Erro inesperado: ' + err.message);
		} finally {
			closeRemoveModal();
		};
	}
</script>