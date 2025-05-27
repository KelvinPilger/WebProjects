<?php

namespace App\Controllers\main;

use app\models\Client;
use Core\Controller;

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Origin: *");

class ClientController extends Controller
{

    public function index()
    {
        $page     = isset($_GET['page'])     ? max(1, (int) $_GET['page'])    : 1;
        $rowLimit = $_GET['rowLimit'] ?? '10';
        $offset   = ($page - 1) * ($rowLimit === 'all' ? PHP_INT_MAX : (int) $rowLimit);

        $clientModel = new Client();
        $total       = $clientModel->countAll();

        if ($rowLimit === 'all') {
            $clients    = $clientModel->findAll();
            $totalPages = 1;
        } else {
            $limit      = (int) $rowLimit;
            $clients    = $clientModel->getPage($offset, $limit);
            $totalPages = (int) ceil($total / $limit);
        }

        $this->renderView('listings/clientList', [
            'clients'     => $clients,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
            'rowLimit'    => $rowLimit,
            'style'       => ['../../assets/css/clientList.css'],
        ]);
    }

    public function show($request): void
    {

        $id = isset($request->parameter)
            ? (int) $request->parameter
            : 0;

        $clientModel = new Client();

        $client = $clientModel->searchById($id);

        $clients = $client ? [$client] : [];
        if ($clients !== []) {
            $this->renderView('listings/clientList', [
                'clients' => $clients,
                'style' => [
                    '../../../assets/css/clientList.css'
                ],
            ]);
        }
    }

    public function store(): void
    {
        $clientData = $_POST;

        var_dump($_POST);
        $clientJson = json_encode($clientData, true);
        $clientModel = new Client();

        $clientModel->save($clientJson);
    }

    public function create(): void
    {
        $this->renderView('edit/clientCreate', [
            'clients' => null,
            'style' => [
                '../../assets/css/clientCreate.css'
            ],
        ]);
    }

    public function edit($request): void
    {
        $id = isset($request->parameter)
            ? (int) $request->parameter
            : 0;
        $clientModel = new Client();

        $client = $clientModel->edit($id);

        $clientEdit = $client ? [$client] : [];

        if ($clientEdit !== []) {
            $this->renderView('edit/clientEdit', [
                'clients' => $clientEdit,
                'style' => [
                    '../../../assets/css/clientEdit.css'
                ],
            ]);
        }
    }

    public function remove($request): void
    {
        $id = isset($request->parameter)
            ? (int) $request->parameter
            : 0;

        $clientModel = new Client();
        $clientModel->delete($id);

        header('Location: ' . $_SERVER['SCRIPT_NAME'] . '/client/index');
    }
}
