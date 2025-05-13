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

<<<<<<< HEAD
    public function store() {
        var_dump('CHEGUEI NO STORE'); 
        exit;
=======
    public function store($request): void {
        $req = file_get_contents('php://input');

        $client = json_decode($req, true);

        $clientModel = new Client();

        $clientModel->save($client);
>>>>>>> ca3929098b07c9ae0d6f6b97cc46c95d0c0c8365
    }

    public function edit($request): void {
        $id = isset($request->parameter)
            ? (int) $request->parameter
            : 0;
        $clientModel = new Client();

        $client = $clientModel->edit($id);

        $clientEdit = $client ? [$client] : [];

        if($clientEdit !== []) {
            $this->renderView('edit/clientEdit', [
                'clients' => $clientEdit,
                'style' => [
                    '../../../assets/css/clientEdit.css'
                ],
            ]);
        }
    }

    
	
	public function remove($request): void {
        $id = isset($request->parameter)
        ?(int) $request->parameter
        : 0;

        $clientModel = new Client();
        $clientModel->delete($id);

        header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/client/index');
	}

}

?>