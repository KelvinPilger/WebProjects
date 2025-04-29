<?php 

namespace App\Controllers\main;
use app\models\Client;
use Core\Controller;

class ClientController extends Controller{

    public function index() {
        $clientModel = new Client();

        $clients = $clientModel->findAll();

        $this->renderView('listings/clientList', [
            'clients' => $clients,
            'style' => [
                '../../assets/css/clientList.css'
            ],
        ]);
    }

    public function show($request): void {
        
        $id = isset($request->parameter)
            ? (int) $request->parameter
            : 0;

        $clientModel = new Client();

        $client = $clientModel->searchById($id);
		
		$clients = $client ? [ $client ] : [];
        if($clients !== []) {
			$this->renderView('listings/clientList', [
            'clients' => $clients,
            'style' => [
                '../../../assets/css/clientList.css'
            ],
        ]);
		}
    }

    public function store() {

    }

    public function edit($id) {

    }
	
	public function remove($id) {
		
	}

}

?>