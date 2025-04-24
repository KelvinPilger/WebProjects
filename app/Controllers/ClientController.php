<?php
    namespace App\Controllers;

    use App\Models\Client;

    class ClientController {
        public function create() {
            include __DIR__ . '/../Views/client.php';
        }

        public function store() {
            $client = new Client();
            $client->id = $_POST['id'];
            $client->name = $_POST['name'] ?? '';
            $client->inserted = $_POST['inserted_at'];
            $client->cpf = $_POST['cpf'] ?? '';
            $client->cnpj = $_POST['cnpj'] ?? '';
            $client->bornDate = $_POST['bornDate'];
            $client->age = $_POST['age'];
            $client->email = $_POST['email'] ?? '';
            $client->natRegistration = $_POST['nat_registration'];

            $result = $client->insert($client);
        }

        public function index() {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            $clientModel = new Client();
            $clientes   = $clientModel->getAll();
                
            include BASE_PATH . '/app/Views/client_list.php';
        }

        public function delete() {
            $id = $_POST['id'] ?? null;       
            if($id) {
                try {
                    $client = new Client();
                    $client->remove($id);
                    header("Location: ?action=listar&msg=Cliente removido com sucesso!");
                    exit;
                } catch (\Exception $e) {
                    echo "Erro ao excluir o cliente: " . $e->getMessage();
                }
            } else {
                echo "A linha não corresponde a um cliente!";
            }
        }
    }
?>