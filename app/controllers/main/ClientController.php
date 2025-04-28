<?php 

namespace app\controllers\main;
use app\Models\Client;
use core\Controller;

class ClientController extends Controller{

    public function index() {
        $clientModel = new Client();

        $clients = $clientModel->findAll();

        $this->renderView('/listings/clientList', [
            'clients' => $clients
        ]);
    }

    public function show($request) {
        
        $id = isset($request->next)
            ? (int) $request->next
            : 0;

        $clientModel = new Client();

        $client = $clientModel->searchById($id);
        
        $this->renderView('/listings/clientList', [
            'clients' => $client
        ]);
    }

    public function create() {
        
    }

    public function store() {

    }

    public function edit($id) {

    }

}

?>