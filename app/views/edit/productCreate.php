<form id="productForm" method="POST" action="<?= $_SERVER['SCRIPT_NAME'] ?>/product/store">
  <div class="infoContainer">
    <fieldset class="fieldsetBlockInfo">
      <legend>Informações Gerais</legend>
      <label for="description">Descrição do Produto</label>
      <input id="description" type="text" placeholder="Informe a descrição do produto">

      <label for="application">Tipo de Aplicação</label>
      <select id="application">
        <option>1 – Mercadoria para revenda</option>
        <option>2 – Serviços</option>
        <option>3 – Material de uso e consumo</option>
      </select>

      <label for="gtin">Cód. de Barras (GTIN)</label>
      <input id="gtin" type="text" maxlength="14">
    </fieldset>

    <fieldset class="fieldsetBlockTributes">
      <legend>Tributações</legend>
      <label for="ncm">NCM/NBS</label>
      <input id="ncm" type="text">

      <label for="cest">CEST</label>
      <input id="cest" type="text">

      <label for="csosn">CSOSN</label>
      <input id="csosn" type="text" placeholder="Pesquisar…">

      <label for="cfop">CFOP</label>
      <input id="cfop" type="text" placeholder="Pesquisar…">
    </fieldset>

    <fieldset class="fieldsetBlockValues">
      <legend>Valores do Produto</legend>
      <label for="cost">Preço de Custo</label>
      <input id="cost" type="number" value="0.00">

      <label for="profit">% Lucro</label>
      <input id="profit" type="number" value="0.00">

      <label for="price">Preço de Venda</label>
      <input id="price" type="number" value="0.00">

      <label for="quantity">Quantidade</label>
      <input id="quantity" type="number" value="0">
    </fieldset>

    <button class="btnSave" type="submit">Salvar</button>
  </div>
</form>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('productForm');

    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      const data = {
        action: 'insert',
        product_name: document.getElementById('description').value.trim(),
        product_application: document.getElementById('application').value,
        gtin_barcode: document.getElementById('gtin').value.trim(),
        ncm: document.getElementById('ncm').value.trim(),
        cest: document.getElementById('cest').value.trim(),
        csosn_cst: document.getElementById('csosn').value.trim(),
        cfop: document.getElementById('cfop').value.trim(),
        cost_price: document.getElementById('cost').value,
        profit_percentual: document.getElementById('profit').value,
        sell_price: document.getElementById('price').value,
        quantity: document.getElementById('quantity').value,
        origin: '0'
      };

      console.log('JSON final:', JSON.stringify(data, null, 2));

      try {
        const resp = await fetch(`<?= $_SERVER['SCRIPT_NAME'] ?>/product/store`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        });

        const json = await resp.json();
        console.log(json);

        if (resp.ok && json.status === 'success') {
          MessageModal.show('success', json.message);
          setTimeout(() => {
            window.location.href = `<?= $_SERVER['SCRIPT_NAME'] ?>/product/index`;
          }, 2500);
        } else {
          MessageModal.show('error', json.message || 'Erro desconhecido ao salvar.');
        }
      } catch (err) {
        MessageModal.show('error', 'Erro na requisição:' + err);
      }
    });
  });
</script>