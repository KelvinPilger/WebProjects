<?php 
    namespace App\Controllers\Main;

    use Core\Controller;
    use app\models\Product;
    use core\ControllerMethods;

    header("Access-Control-Allow-Headers: Content-Type");
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Origin: *");

    class ProductController extends Controller {

        public function index() {

            $page     = isset($_GET['page'])     ? max(1, (int) $_GET['page'])    : 1;
            $rowLimit = $_GET['rowLimit'] ?? '10';
            $offset   = ($page - 1) * ($rowLimit === 'all' ? PHP_INT_MAX : (int) $rowLimit);

            $productModel = new Product();
            $total       = $productModel->countAll();

            if ($rowLimit === 'all') {
                $product    = $productModel->findAll();
                $totalPages = 1;
            } else {
                $limit      = (int) $rowLimit;
                $product    = $productModel->getPage($offset, $limit);
                $totalPages = (int) ceil($total / $limit);
            }

            $this->renderView('listings/productList', [
                'products'    => $product,
                'total'       => $total,
                'currentPage' => $page,
                'totalPages'  => $totalPages,
                'rowLimit'    => $rowLimit,
                'limit'       => $limit,
                'offset'      => $offset,
                'style'       => [BASE_URL . '/assets/css/productList.css'],
            ]);
        }

        public function create(): void
        {
            $this->renderView('edit/productCreate', [
                'products' => null,
                'style' => [
                    BASE_URL . '/assets/css/productCreateEdit.css'
                ],
            ]);
        }

        public function edit($request): void {
            $id = isset($request->parameter)
                ? (int) $request->parameter
                : 0;

            $productModel = new Product();
            $product = $productModel->edit($id);

            if($product !== []) {
                $this->renderView('edit/productEdit', [
                    'product' => $product,
                    'style' => [
                        BASE_URL . '/assets/css/productCreateEdit.css'
                    ],
                ]);
            }
        }

        public function show() {}


        public function remove($request) {
        header('Content-Type: application/json; charset=UTF-8');

        try {
            $id = isset($request->parameter)
                ? (int) $request->parameter
                : 0;

            $productModel = new Product();
            $deleted = $productModel->delete($id);

            if ($deleted) {
                http_response_code(200);
                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Produto removido com sucesso!'
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status'  => 'warning',
                    'message' => 'Não foi possível encontrar o produto para remoção!'
                ]);
            }

        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Erro ao remover: ' . $e->getMessage()
            ]);
        }
        exit;
        }

        public function store(): void {
            
        header('Content-Type: application/json; charset=UTF-8');

        $product = json_decode(file_get_contents('php://input'), true);
        $productModel = new Product();

            try {
                $saved = $productModel->save($product);

                if($saved !== false) {
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Dados atualizados com sucesso!'
                    ]);
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'status' => 'warning',
                        'message' => 'Não foi possível realizar a inclusão do produto!'
                    ]);
                }
            } catch (\Throwable $e) {
                http_response_code(500);
                echo $e->getMessage();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Ocorreu um erro ao registrar o produto: ' . $e->getMessage()
                ]);
            }
        }
    }
?>