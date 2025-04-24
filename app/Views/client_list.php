<?php if (!isset($clientes)) $clientes = []; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes (ServFácil)</title>
  <link rel="stylesheet" href="../../styles/client.css">
</head>
<body>
  <h2>Clientes</h2>
  <div class="tableContainer">
    <table class="myTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Data Nascimento</th>
          <th>Data Cadastro</th>
          <th>Idade</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clientes as $cliente): ?>
          <tr>
            <td><?= htmlspecialchars($cliente['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($cliente['name'] ?? '') ?></td>
            <td><?= htmlspecialchars($cliente['born_at'] ?? '') ?></td>
            <td><?= htmlspecialchars($cliente['inserted_at'] ?? '') ?></td>
            <td><?= htmlspecialchars($cliente['age'] ?? '') ?></td>
            <td>
              <a class="btnVisualizar" title="Visualizar" href="?action=listar&id=<?= $cliente['id'] ?>">
                <svg class="eyeSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 509.348 509.348" width="24" height="24" fill="currentColor">
                  <g>
                    <path d="M488.935,188.541C437.397,109.024,349.407,60.662,254.652,59.773C159.898,60.662,71.908,109.024,20.37,188.541   c-27.16,39.859-27.16,92.279,0,132.139c51.509,79.566,139.504,127.978,234.283,128.896   c94.754-0.889,182.744-49.251,234.283-128.768C516.153,280.919,516.153,228.429,488.935,188.541z M436.199,284.541   c-39.348,62.411-107.769,100.488-181.547,101.035c-73.777-0.546-142.198-38.624-181.547-101.035   c-12.267-18.022-12.267-41.712,0-59.733c39.348-62.411,107.769-100.488,181.547-101.035   c73.777,0.546,142.198,38.624,181.547,101.035C448.466,242.829,448.466,266.519,436.199,284.541z"/>
                    <circle cx="254.652" cy="254.674" r="85.333"/>
                  </g>
                </svg>
              </a>
              <a class="btnAlterar" title="Editar" href="?action=edit&id=<?= $cliente['id'] ?>">
                <svg class="pencilSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                  <g id="_01_align_center" data-name="01 align center">
                    <path d="M22.94,1.06a3.626,3.626,0,0,0-5.124,0L0,18.876V24H5.124L22.94,6.184A3.627,3.627,0,0,0,22.94,1.06ZM4.3,22H2V19.7L15.31,6.4l2.3,2.3ZM21.526,4.77,19.019,7.277l-2.295-2.3L19.23,2.474a1.624,1.624,0,0,1,2.3,2.3Z"/>
                  </g>
                </svg>
              </a>
              <form method="POST" action="?action=delete" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir este cliente?');">
                <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                <button class="btnExcluir" title="Excluir" type="submit">
                  <svg class="trashSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.991 511.991" width="24" height="24" fill="currentColor">
                    <g>
                      <path d="M286.161,255.867L505.745,36.283c8.185-8.474,7.951-21.98-0.523-30.165c-8.267-7.985-21.375-7.985-29.642,0   L255.995,225.702L36.411,6.118c-8.475-8.185-21.98-7.95-30.165,0.524c-7.985,8.267-7.985,21.374,0,29.641L225.83,255.867   L6.246,475.451c-8.328,8.331-8.328,21.835,0,30.165l0,0c8.331,8.328,21.835,8.328,30.165,0l219.584-219.584l219.584,219.584   c8.331,8.328,21.835,8.328,30.165,0l0,0c8.328-8.331,8.328-21.835,0-30.165L286.161,255.867z"/>
                    </g>
                  </svg>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="adicionar-div">
      <button type="button" class="btnAdicionar" onclick="window.location.href='?action=create'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
          <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        Adicionar
      </button>
    </div>
  </div>
</body>
</html>
