<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
include("../config/config.php");

$message = $_SESSION['message'] ?? '';
$message_type = $_SESSION['message_type'] ?? '';
unset($_SESSION['message'], $_SESSION['message_type']);

$action = $_GET['action'] ?? 'create';

if (isset($_GET['id'])) {
  $idCliente = $_GET['id'];
  $query = $mysqli->prepare("SELECT * FROM clients WHERE id = $idCliente;");
  $query->execute();
  $result = $query->get_result();
  $returnedClient = $result->fetch_assoc();
  $query->close();
}  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idCliente = $_POST['id'] ?? null;

  $name = $_POST['name'] ?? null;
  $cpf = $_POST['cpf'] ?? null;
  $cnpj = $_POST['cnpj'] ?? null;
  $bornDate = $_POST['born_date'] ?? null;
  $email = $_POST['email'] ?? null;
  $nowDateTime = date('Y-m-d H:i:s');
  $nat_registration = 'F';

  if (!empty($cpf) && !empty($cnpj)) {
    $_SESSION['message'] = "Você deve preencher apenas um dos campos: CPF ou CNPJ.";
    header(header: "Location: " . $_SERVER['PHP_SELF']);
    exit;
  } else {
    if (!empty($cpf)) {
      $nat_registration = 'F';
    } else if (!empty($cnpj)) {
      $nat_registration = 'J';
    }

    if (!empty($name) && !empty($bornDate) && !empty($email)) {
      $born = new DateTime(datetime: $bornDate);
      $now = new DateTime(datetime: $nowDateTime);
      $diff = $now->diff(targetObject: $born);
      $age = $diff->y;

      if ($action === 'edit' && $idCliente) {
        $query = $mysqli->prepare("UPDATE clients set name = ?, born_at = ?, age = ?, email = ? WHERE id = ?");
        $query->bind_param("ssisi", $name, $bornDate, $age, $email, $idCliente);
        if($query->execute() === true) {
          $_SESSION['message'] = "O cliente foi atualizado com sucesso!";
          $_SESSION['message_type'] = "PC";
          $query->close();
          header("Location: " . $_SERVER['PHP_SELF']);
          exit;
        } else {
          $_SESSION['message'] = "Preencha todos os campos obrigatórios!";
          $_SESSION['message_type'] = "WA";
          exit;
        }
      } else if ($action === 'create') {
        $stmt = $mysqli->prepare("INSERT INTO clients (name, born_at, inserted_at, age, nat_registration, cpf, cnpj, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $bornDate, $nowDateTime, $age, $nat_registration, $cpf, $cnpj, $email);
        $stmt->execute();
        $_SESSION['message'] = "O cliente foi cadastrado com sucesso!";
        $_SESSION['message_type'] = "PC";
        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
      } else {
        $_SESSION['message'] = "Preencha todos os campos obrigatórios!";
        $_SESSION['message_type'] = "WA";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro de Clientes</title>
  <link rel="stylesheet" href="../styles/styles.css" />
  <script src="../scripts/general.js"></script>
</head>

<body>
  <div class="container">
    <h1>Cadastro de Clientes</h1>

    <?php if (!empty($message)): ?>
      <div class="modal-overlay active" id="modalOverlay">
        <div class="modal" id="modal">
          <p id="modalMessage"><?= htmlspecialchars($message) ?></p>
        </div>
      </div>
      <script>
        openModal("<?= htmlspecialchars($message_type) ?>");
        setTimeout(() => {
          closeModal();
        }, 2250);
      </script>
    <?php endif; ?>

    <form method="POST">
      <input type="hidden" name="id" value="<?= htmlspecialchars($returnedClient['id']); ?>" />
      <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" name="name" id="name" placeholder="Digite seu nome completo" autocomplete="off"
          autocorrect="off" autocapitalize="off" spellcheck="false"
          value="<?= htmlspecialchars($returnedClient['name'] ?? null); ?>" />
      </div>

      <div class="form-group">
        <label for="born_date">Data de Nascimento</label>
        <input type="date" name="born_date" id="born_date" autocomplete="off" autocorrect="off" autocapitalize="off"
          spellcheck="false" value="<?= htmlspecialchars($returnedClient['born_at'] ?? null); ?>" />
      </div>

      <div class="form-group">
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" oninput="validateCpfCnpj()" placeholder="Insira seu CPF"
          autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
          value="<?= htmlspecialchars($returnedClient['cpf'] ?? null); ?>" />
      </div>

      <div class="form-group">
        <label for="cnpj">CNPJ</label>
        <input type="text" name="cnpj" id="cnpj" oninput="validateCpfCnpj()" placeholder="Insira seu CNPJ"
          autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
          value="<?= htmlspecialchars($returnedClient['cnpj'] ?? null); ?>" />
      </div>

      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" placeholder="E-mail" autocorrect="off" spellcheck="false"
          value="<?= htmlspecialchars($returnedClient['email'] ?? null); ?>" />
      </div>

      <button type="submit" class="btn-submit">Próximo</button>
    </form>
  </div>
  <script src="../scripts/general.js"></script>
</body>
</html>