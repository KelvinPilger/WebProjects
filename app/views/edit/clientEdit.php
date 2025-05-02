<div class="infoContainer">
    <?php if (!empty($clients)): ?>
        <?php foreach ($clients as $c): ?>
        <div class="containerNatRegistr">
            <label class="containerTitle">Tipo</label>
            
            <input type="radio" id="fisica" name="registrationType">
            <label for="fisica">Física</label>

            <input type="radio" id="juridica" name="registrationType">
            <label for="juridica">Jurídica</label>
        </div>
        <div class="containerGeneralInfo">
            <label class="containerTitle">Dados Gerais</label>

            <label for="name">Nome</label>
            <input type="text" placeholder="Insira o Nome" id="name" value="<?= htmlspecialchars($c['name']) ?>">
            
            <label for="bornDate">Data de Nascimento</label>
            <input type="date" id='bornDate' value="<?= htmlspecialchars($c['born_at']) ?>">
        </div>
        <div class="containerCnpjCpf">
            <label class="containerTitle">Registro Nacional</label>

            <label for="cpf">CPF</label>
            <input type="text" id="cpf" value="<?= htmlspecialchars($c['cpf']) ?>">

            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" value="<?= htmlspecialchars($c['cnpj']) ?>">
        </div>
        <div class="containerContacts">
            <label class="containerTitle">Contatos</label>
            
            <label for="email">E-mail</label>
            <input type="text" id="email">

            <label for="celular">Celular</label>
            <input type="text" id="celular">
        </div>
        <?php endforeach;?>
    <?php endif; ?>
    <div class="buttons">
        <button type="submit" class="btnSave">Salvar</button>
    </div>
</div>