<?php
    namespace App\Models;
    
	use App\Database\Connection;
    class Client {
        public $id;
        public $name;
        public $inserted;
        public $cpf;
        public $cnpj;
        public $bornDate;
        public $age;
        public $email;
        public $natRegistration;

        public function insert($client) {
            
        }
		
		public function remove($id) {
			$db = Connection::openConn();
			$stmt = $db->prepare("DELETE from CLIENTS where id = ?;");
			$stmt->bind_param("i", $id);
			
			$result = $stmt->execute();
			$stmt->close();
			
			if($result === true) {
				return $result;
			} else {
					throw new \Exception("Erro ao remover o cliente do banco de dados!");
			}
		}
    };
?>

