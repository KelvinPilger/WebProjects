<?php 

namespace App\Controllers\Main;

use Core\Controller;
use app\models\ServiceOrder;
use core\ControllerMethods;
use Dom\Comment;

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Origin: *");

class ServiceOrderController extends Controller {

    public function index()
    {
        $page     = isset($_GET['page'])     ? max(1, (int) $_GET['page'])    : 1;
        $rowLimit = $_GET['rowLimit'] ?? '10';
        $offset   = ($page - 1) * ($rowLimit === 'all' ? PHP_INT_MAX : (int) $rowLimit);

        $serviceModel = new ServiceOrder();
        $total       = $serviceModel->countAll();

        if ($rowLimit === 'all') {
            $os    = $serviceModel->findAll();
            $totalPages = 1;
        } else {
            $limit      = (int) $rowLimit;
            $os    = $serviceModel->getPage($offset, $limit);
            $totalPages = (int) ceil($total / $limit);
        }

        $this->renderView('listings/serviceOrderList', [
            'os'          => $os,
            'total'       => $total,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
            'rowLimit'    => $rowLimit,
            'limit'       => $limit,
            'offset'      => $offset,
            'style'       => [BASE_URL . '/assets/css/serviceOrderList.css'],
        ]);
    }

    public function show() {

    }

    public function store() {

    }

    public function create() {

    }

    public function edit() {

    }

    public function remove() {

    }
}















?>