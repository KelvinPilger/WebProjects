<form id="productForm" method="POST" action="<?= $_SERVER['SCRIPT_NAME'] ?>/product/store">
  <div class="infoContainer">
    <div class="containerGeneralInfo">
      <label for="containerGeneralInfo" class="containerTitle">Informações Gerais</label>
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
    </div>
    <div class="containerTribInfo">
      <label for="ncm">NCM/NBS</label>
      <input id="ncm" type="text">
      <label for="cest">CEST</label>
      <input id="cest" type="text">
      <label for="csosn">CSOSN</label>
      <input id="csosn" type="text" placeholder="Pesquisar…">
      <label for="cfop">CFOP</label>
      <input id="cfop" type="text" placeholder="Pesquisar…">
    </div>
    <div class="containerValues">
      <label for="cost">Preço de Custo</label>
      <input id="cost" type="number" value="0,00">
      <label for="profit">% Lucro</label>
      <input id="profit" type="number" value="0,00">
      <label for="price">Preço de Venda</label>
      <input id="price" type="number" value="0,00">
    </div>
    <button class="btnSave" type="submit">Salvar</button>
  </div>
</form>
<script>

</script>