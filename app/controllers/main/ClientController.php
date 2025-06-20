<?php

namespace App\Controllers\main;

use app\models\Client;
use Core\Controller;
use Error;
use Throwable;

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
            'total'       => $total,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
            'rowLimit'    => $rowLimit,
            'limit'       => $limit,
            'offset'      => $offset,
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
        header('Content-Type: application/json; charset=UTF-8');

        $clientData = $_POST;
        $clientModel = new Client();

        try {
            $saved = $clientModel->save($clientData);
            if ($saved !== false) {
                http_response_code(200);
                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Dados cadastrados com sucesso!'
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'O cliente não pode ser incluso no sistema!'
                ]);
            }
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao registrar o cliente: ' . $e->getMessage()
            ]);
        }
        exit;
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

        $model = new Client();
        $data  = $model->edit($id);

        if ($data !== []) {
            $this->renderView('edit/clientEdit', [
                'clients'  => [$data['client']],
                'contacts' =>   $data['contacts'],
                'style'    => [
                    '../../../assets/css/clientEdit.css'
                ],
            ]);
        }
    }

    public function remove($request): void
    {
        header('Content-Type: application/json; charset=UTF-8');

        try {
            $id = isset($request->parameter)
                ? (int) $request->parameter
                : 0;

            $clientModel = new Client();
            $deleted = $clientModel->delete($id);

            if ($deleted) {
                http_response_code(200);
                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Cliente removido com sucesso!'
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status'  => 'warning',
                    'message' => 'Não foi possível encontrar o cliente para remover!'
                ]);
            }
        } catch (\Throwable $e) {
            if ($e->getCode() === '23000') {
                http_response_code(409);
                echo json_encode([
                    'status'  => 'warning',
                    'message' => 'Não é possível remover cliente pois há contatos vinculados.'
                ]);
            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Erro ao remover: ' . $e->getMessage()
                ]);
            }
            exit;
        }
    }
}
