<?php
require_once('../db/db1.php');
require_once('../model/Pizza.php');
require_once('../model/Response.php');
require_once('../SendRespone.php');


#Kết nối với db
try {
    $writeDB = DB1::connectWriteDB();
    $readDB = DB1::connectReadDB();
}catch(PDOException $ex) {  
    error_log("Connection Error: ".$ex, 0);
    sendResponse(500, false, "Database connection error");
    exit;
}

#Lấy combos
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    #query

    try{
        $query = $readDB->prepare('select ProductId, ComboName, Description, Price from pizza;');
        $query->execute();

        $pizzaArray = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $pizza = new Pizza($row['ProductId'], $row['ComboName'], $row['Description'], $row['Price']);
            $pizzaArray[] = $pizza->returnPizzaAsArray();
        }

        $returnArray = array();
        $returnArray['combos'] = $pizzaArray;

        $response = new Response();
        $response->setHttpStatusCode(200);
        $response->setSuccess(true);
        $response->toCache(true);
        $response->setData($returnArray);
        $response->send();
        exit;
    } 
    catch(PizzaException $ex){
        sendResponse(500, false, $ex->getMessage());
        exit;
    }
    catch(PDOException $ex){
        error_log("Database query error - ". $ex, 0);
        sendResponse(500, false, "Failed to get players");
        exit;
    }
}
