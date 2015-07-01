<?php

/*
 * "firstAmount": 520, (obligatoire)
 * "count": 2, (obligatoire)
 * "period": 30, (obligatoire)
 * "firstFee":180 (optionnel)
 */

class PaymentSchedule
{
	public $firstAmount;
	public $firstFee;
	public $count;
	public $period;
	
	public function __construct()
	{
		$this->firstAmount  =0;
		$this->firstFee		=null;
		$this->count        =0;
		$this->period       =0;
	
	}
	
	public function getFirstAmount()		{return $this->Amount;}
	public function getFirstFee()   		{return $this->Fee;}
	public function getCount()			{return $this->count;}
	public function getPeriod()         {return $this->period;}
	
	public function setFirstAmount 	($FirstAmount) 	{ return ($this->firstAmount=$FirstAmount); }
	public function setFirstFee 	($FirstFee) 	{ return ($this->firstFee=$FirstFee); }
	public function setCount 		($Count) 		{ return ($this->count=$Count); }
	public function setPeriod       ($Period) 	    { return ($this->period=$Period); }
	
	public function getAttributes ()
	{
		$list = array (	'firstAmount' 			=> $this->firstAmount,
						'firstFee' 	            => $this->firstFee,
						'count' 		        => $this->count,
						'period' 			    => $this->period
						);
		return $list;
	}
	
  	public function encodeJSON()
  	{
  	    $json = new StdClass();
  		foreach ($this as $key => $value){
  			if (!is_null($value)) {
	  			$lowerKey = strtolower($key);
	  			$json->$lowerKey = $value;
  			}
  		}
  		return json_encode($json);
  	}

	public function init($Amount=0, $Period=30, $Count=3, $Fee = 0)
	{
		$this->firstAmount		=$Amount;
        if ($Fee!=0)
		    $this->firstFee		=$Fee;
		$this->count            =$Count;
		$this->period   		=$Period;
	}

	public function initObject($array)
	{
		$this->firstAmount  =$array["firstAmount"];
		$this->firstFee     =$array["firstFee"];
		$this->count        =$array["count"];
		$this->period       =$array["period"];
	}
}
