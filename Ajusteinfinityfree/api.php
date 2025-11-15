<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'consumo.php';

$database = new Database();
$db = $database->getConnection();
$consumo = new Consumo($db);

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        // Ler todos os registros
        $stmt = $consumo->read();
        $num = $stmt->rowCount();
        
        if($num > 0) {
            $consumos_arr = array();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $consumo_item = array(
                    "id" => $id,
                    "bairro" => $bairro,
                    "hora" => $hora,
                    "consumo" => $consumo_kwh,
                    "residencias" => $num_residencia
                );
                array_push($consumos_arr, $consumo_item);
            }
            echo json_encode($consumos_arr);
        } else {
            echo json_encode(array());
        }
        break;

    case 'POST':
        // Criar ou atualizar registro
        $data = json_decode(file_get_contents("php://input"));
        
        if(isset($data->action) && $data->action == 'delete') {
            $consumo->id = $data->id;
            
            if($consumo->delete()) {
                echo json_encode(array("message" => "Registro deletado."));
            } else {
                echo json_encode(array("message" => "Erro ao deletar."));
            }
        }
        
        if(isset($data->id) && !empty($data->id)) {
            // UPDATE
            $consumo->id = $data->id;
            $consumo->bairro = $data->bairro;
            $consumo->hora = $data->hora;
            $consumo->consumo = $data->consumo;
            $consumo->residencias = $data->residencias;
            
            if($consumo->update()) {
                echo json_encode(array("message" => "Registro atualizado."));
            } else {
                echo json_encode(array("message" => "Erro ao atualizar."));
            }
        } else {
            // CREATE
            $consumo->bairro = $data->bairro;
            $consumo->hora = $data->hora;
            $consumo->consumo = $data->consumo;
            $consumo->residencias = $data->residencias;
            
            if($consumo->create()) {
                echo json_encode(array("message" => "Registro criado."));
            } else {
                echo json_encode(array("message" => "Erro ao criar."));
            }
        }
        break;
	


   /* case 'DELETE':
        // Deletar registro
        $data = json_decode(file_get_contents("php://input"));
        $consumo->id = $data->id;
        
        if($consumo->delete()) {
            echo json_encode(array("message" => "Registro deletado."));
        } else {
            echo json_encode(array("message" => "Erro ao deletar."));
        }
        break;*/
}
?>