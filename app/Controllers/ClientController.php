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
    }
?>