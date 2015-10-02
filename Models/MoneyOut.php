<?php

class MoneyOut extends MoneyOutQuote
{
	public $Id = null;
	
	public function __construct()
	{
		parent::__construct();
        $this->Id = null;
	}
	
	public function getId() 		{return $this->Id;}
	public function setId ($Id) 	{return ($this->Id=$Id);}
	
	public function getAttributes()
	{
		$list = parent::getAttributes();
        array_push($list, 'Id', $this->Id);
		return $list;
	}
	
    public function initObject($array)
    {
		parent::initObject($array);
        $this->Id = $array["Id"];
    }
}
