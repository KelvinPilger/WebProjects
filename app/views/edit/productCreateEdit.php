<div class="infoContainer">
  <!-- painel 1 -->
  <div class="containerGeneralInfo">
    <span class="containerTitle">Informações Gerais</span>

    <label for="description">Descrição do Produto</label>
    <input id="description" type="text" placeholder="Informe a descrição do produto">

    <label for="application">Tipo de Aplicação</label>
    <select id="application">
      <option>1 – Mercadoria para revenda</option>
      <!-- … -->
    </select>

    <label for="gtin">Cód. de Barras (GTIN)</label>
    <input id="gtin" type="text" placeholder="Só números">
  </div>

  <!-- painel 2 -->
  <div class="containerTribInfo">
    <span class="containerTitle">Tributações do Produto</span>

    <label for="ncm">NCM / NBS</label>
    <input id="ncm" type="text" placeholder="Ex: 01020300">

    <label for="cest">CEST</label>
    <input id="cest" type="text" placeholder="XXXXX.X">

    <label for="csosn">CSOSN</label>
    <input id="csosn" type="text" placeholder="Pesquisar…">

    <label for="cfop">CFOP</label>
    <input id="cfop" type="text" placeholder="Pesquisar…">
  </div>

  <!-- painel 3 -->
  <div class="containerValues">
    <span class="containerTitle">Valores do Produto</span>

    <label for="cost">Preço de Custo</label>
    <input id="cost" type="number" value="0,00">

    <label for="profit">% Lucro</label>
    <input id="profit" type="number" value="0,00">

    <label for="price">Preço de Venda</label>
    <input id="price" type="number" value="0,00">
  </div>
</div>
