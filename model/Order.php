<?php
#Order Exception để catch lỗi
class OrderException extends Exception{}

class Order {
    public $_orderid;
	public $_customername;
	public $_phone;
	public $_address;
    public $_createdtime;
    public $_status;
    public $_modifiedtime;
    public $_productid;
    public $_quantity;
    public $_amount;
    public $_note;
    public $_registercode;
	

    public function __construct(
        $orderid, 
        $customername, 
        $phone, 
        $address,
        $createdtime,
        $status,
        $modifiedtime,
        $productid,
        $quantity,
        $amount,
        $note,
        $registercode
    )
    {
        $this->_orderid = $orderid;
		$this->_customername = $customername;
		$this->_phone = $phone;
		$this->_address = $address;
        $this->_createdtime = $createdtime;
        $this->_status = $status;
        $this->_modifiedtime = $modifiedtime;
        $this->_productid = $productid;
        $this->_quantity = $quantity;
        $this->_amount = $amount;
        $this->_note = $note;
        $this->_registercode = $registercode;
    }

	public function returnOrderAsArray() {
		$order= array();
		$order['orderid'] = $this->_orderid;
		$order['customername'] = $this->_customername;
		$order['phone'] = $this->_phone;
		$order['address'] = $this->_address;
        $order['createdtime'] = $this->_createdtime;
		$order['status'] = $this->_status;
		$order['modifiedtime'] = $this->_modifiedtime;
		$order['productid'] = $this->_productid;
        $order['quantity'] = $this->_quantity;
		$order['amount'] = $this->_amount;
		$order['note'] = $this->_note;
		$order['registercode'] = $this->_registercode;
		return $order;
	}
}
?>