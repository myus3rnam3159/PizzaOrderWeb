<?php
#Pizza Exception để catch lỗi
class PizzaException extends Exception{}

class Pizza {
    public $_productid;
	public $_comboname;
	public $_description;
	public $_price;
	

    public function __construct($productid, $comboname, $description, $price)
    {
        $this->setProductId($productid);
		$this->setComboName($comboname);
		$this->setDescription($description);
		$this->setPrice($price);
    }

	public function getProductId(){
		return $this->_productid;
	}

	public function getComboName(){
		return $this->_comboname;
	}

	public function getDescription(){
		return $this->_description;
	}

	public function getPrice(){
		return $this->_price;
	}

	public function setProductId($productid) {
		$this->_productid = $productid;
	}

	public function setComboName($comboname) {
		$this->_comboname = $comboname;
	}

	public function setDescription($description) {
		$this->_description = $description;
	}

	public function setPrice($price) {
    	
		$this->_price = $price;
	}

	public function returnPizzaAsArray() {
		$Pizza= array();
		$Pizza['productid'] = $this->getProductId();
		$Pizza['comboname'] = $this->getComboName();
		$Pizza['description'] = $this->getDescription();
		$Pizza['price'] = $this->getPrice();
		return $Pizza;
	}
}
?>