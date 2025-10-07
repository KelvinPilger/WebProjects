<section class="infoContainer">
    <h2 class="containerTitle">Nova Ordem de Serviço</h2>

    <fieldset class="fieldsetBlockInfo">
        <legend>Identificação</legend>

        <label for="id">OS #</label>
        <input id="id" name="id" type="text" placeholder="(auto)" readonly>

        <label for="created_at">Criada em</label>
        <input id="created_at" name="created_at" type="date">

        <label for="situation_id">Situação</label>
        <select id="situation_id" name="situation_id">
            <option value="">Selecione…</option>
            <option value="1">Aberta</option>
            <option value="2">Em andamento</option>
            <option value="3">Concluída</option>
            <option value="4">Cancelada</option>
        </select>
    </fieldset>

    <fieldset class="fieldsetBlockTributes">
        <legend>Cliente</legend>

        <label for="client-select">Selecione o cliente</label>
        <select></select>
    </fieldset>

    <fieldset class="fieldsetBlockTributes">
        <legend>Objeto / Equipamento</legend>

        <label for="object_id">ID Objeto</label>
        <input id="object_id" name="object_id" type="number" min="0" step="1" placeholder="0000">

        <label for="object_name">Nome do Objeto</label>
        <input id="object_name" name="object_name" type="text" maxlength="125" placeholder="Ex.: Impressora HP 2050">

        <label for="forecast_date">Previsão</label>
        <input id="forecast_date" name="forecast_date" type="date">
    </fieldset>

    <fieldset class="fieldsetBlockWide" id="itemsCard">
        <legend>Itens da OS</legend>

        <div class="items-search">
            <label for="itemSearch">Buscar produto (código, nome, aplicação)</label>
            <div class="searchbox">
                <input id="itemSearch" type="text" placeholder="Ex.: 12345 ou ‘Impressora HP’" autocomplete="off">
                <div class="searchResults" id="searchResults" hidden></div>
            </div>
        </div>

        <div class="items-table-wrap">
            <table class="items-table" id="itemsTable">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Aplicação</th>
                        <th class="num">Qtde</th>
                        <th class="num">Unit. (R$)</th>
                        <th class="num">Desc. (R$)</th>
                        <th class="num">Acrés. (R$)</th>
                        <th class="num">Total (R$)</th>
                        <th class="min">Conf.</th>
                        <th class="min">Ação</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="right">Subtotal Itens</td>
                        <td class="num" id="itemsSubtotal">0,00</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </fieldset>

    <fieldset class="fieldsetBlockWide">
        <legend>Detalhes</legend>

        <label for="solicitation">Solicitação do Cliente</label>
        <textarea id="solicitation" name="solicitation" rows="4" placeholder="O que o cliente solicitou?"></textarea>

        <label for="observation">Observações</label>
        <textarea id="observation" name="observation" rows="4" placeholder="Observações gerais…"></textarea>

        <label for="service_report">Relatório de Serviço</label>
        <textarea id="service_report" name="service_report" rows="5" placeholder="Descreva os serviços executados…"></textarea>
    </fieldset>

    <fieldset class="fieldsetBlockValues">
        <legend>Valores</legend>

        <label for="items_value">Itens (R$)</label>
        <input id="items_value" name="items_value" type="text" inputmode="decimal" placeholder="0,00">

        <label for="services_value">Serviços (R$)</label>
        <input id="services_value" name="services_value" type="text" inputmode="decimal" placeholder="0,00">

        <label for="total_value">Total (R$)</label>
        <input id="total_value" name="total_value" type="text" placeholder="0,00" readonly>
    </fieldset>

    <div class="actions">
        <a class="btnSave" id="btnSave" href="#" role="button">Salvar</a>
    </div>
</section>