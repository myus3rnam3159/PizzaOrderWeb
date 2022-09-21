<?php
    require_once('../db/db1.php');
    require_once('../model/Order.php');
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

if(array_key_exists("registerCode", $_GET)){
    $regCod = $_GET['registerCode'];

    try{
        $query = $readDB->prepare("select OrderID, CustomerName, Phone, Address, CreatedTime, Status, ModifiedTime, ProductID, Quantity, Amount, Note, RegisterCode from pizzadb.order where RegisterCode = :rc;");
        $query->bindParam(':rc', $regCod, PDO::PARAM_STR);
        $query->execute();

        $rowCount = $query->rowCount();
        $orderArray = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $order = new Order(
                $row['OrderID'],
                $row['CustomerName'],
                $row['Phone'],
                $row['Address'],
                $row['CreatedTime'],
                $row['Status'],
                $row['ModifiedTime'],
                $row['ProductID'],
                $row['Quantity'],
                $row['Amount'],
                $row['Note'],
                $row['RegisterCode'],
            );
            $orderArray[] = $order->returnOrderAsArray();
        }

         #Trả về kết quả
         $response = new Response();
         $response->setHttpStatusCode(200);
         $response->setSuccess(true);
         $response->toCache(true);
         $response->setData($orderArray);
         $response->send();
         exit;
    }
    catch(PlayerException $ex){
        sendResponse(500, false, $ex->getMessage());
        exit;
    } catch(PDOException $ex){
        error_log("Database query error - ". $ex, 0);
        sendResponse(500, false, "Failed to get players");
        exit;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
        #Lấy posted data
        $rawPostData = file_get_contents('php://input');
        #Kiểm tra định dạng json của data có đúng ko?
        $jsonData = json_decode($rawPostData);

        

        $query = $readDB->prepare('select max(Orderid) as orderLatest from pizzadb.order;');
        $query->execute();
        $latestOrder = $query->fetch(PDO::FETCH_ASSOC);

        #Tạo Order id mới
        $newOrderId = intval($latestOrder['orderLatest']) + 1;

        

        $query = $writeDB->prepare(
            "insert into pizzadb.order 
            (OrderID, CustomerName, Phone, Address, CreatedTime, Status, ModifiedTime, ProductID, Quantity, Amount, Note, RegisterCode) 
            values
            (:odi, :cusname, :phone, :addr, now(), :stt, now(), :pid, :quant, :am, :nt, FLOOR(RAND()*(1000000000-10000000)+10) );"
        );

        $query->bindParam(':odi', $newOrderId, PDO::PARAM_INT);
        $query->bindParam(':cusname', $jsonData->customername, PDO::PARAM_STR);

        $query->bindParam(':phone', $jsonData->phone, PDO::PARAM_STR);
        $query->bindParam(':addr', $jsonData->address, PDO::PARAM_STR);

        $query->bindParam(':stt', $jsonData->status, PDO::PARAM_STR);
        $query->bindParam(':pid', $jsonData->productid, PDO::PARAM_INT);

        $query->bindParam(':quant', $jsonData->quantity, PDO::PARAM_STR);
        $query->bindParam(':am', $jsonData->amount, PDO::PARAM_STR);

        $query->bindParam(':nt', $jsonData->note, PDO::PARAM_STR);

        $query->execute();
        $rowCount = $query->rowCount();

        if($rowCount === 0){
            sendResponse(500, false, "Failed to create order");
            exit;
        }


        $query = $writeDB->prepare(
            "select OrderID, CustomerName, Phone, Address, CreatedTime, Status, ModifiedTime, ProductID, Quantity, Amount, Note, RegisterCode from pizzadb.order where orderid = :oid;"
        );
        $query->bindParam(':oid', $newOrderId, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        //$regCd = array();
        //$regCd['registercode'] = $row['RegisterCode'];

        $order = new Order(
            $row['OrderID'],
		    $row['CustomerName'],
		    $row['Phone'],
		    $row['Address'],
            $row['CreatedTime'],
		    $row['Status'],
		    $row['ModifiedTime'],
		    $row['ProductID'],
            $row['Quantity'],
		    $row['Amount'],
		    $row['Note'],
		    $row['RegisterCode'],
        );
        
        $response = new Response();
        $response->setHttpStatusCode(200);
        $response->setSuccess(true);
        $response->addMessage("Order created");
        $response->setData($order->returnOrderAsArray());
        $response->send();
        exit;

    }
    catch(OrderException $ex){
        sendResponse(400, false, $ex->getMessage());
        exit;
    }
    catch(PDOException $ex){
        sendResponse(405, false, $ex->getMessage());
        exit;
    }
}


?>