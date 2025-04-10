<?php include("../config/config.php")?>
<?php
    switch(@$_REQUEST["page"]){
        case "incluir":
            include("../registrations/cad_clients.php");
        break;
        case "listar":
            include("../listings/list_clients.php");
        break;
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <script src="../scripts/general.js"></script>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

</body>