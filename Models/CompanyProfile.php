<?php

class CompanyProfile
{
	public $CompanyName;
	public $CompanySiret;
	
	public function __construct()
	{
		$this->CompanyName   = "";
		$this->CompanySiret  = "";
	}
	
	public function getCompanyName() 		{return $this->CompanyName;}
	public function getCompanySiret() 		{return $this->CompanySiret;}
	
	
	public function setCompanyName 	($CompanyName) 		{ return ($this->CompanyName=$CompanyName); }
	public function setCompanySiret	($CompanySiret) 	{ return ($this->CompanySiret=$CompanySiret); }
   
	public function getAttributes ()
    {
		$list = array (	'Name' 			=> $this->CompanyName, 
				   		'Siret'    		=> $this->CompanySiret);
		return $list;
	}
  	
  	public function encodeJSON()
  	{
  	    $json = new StdClass();
  		foreach ($this as $key => $value){

  			$lowerKey = strtolower($key);
  			if (is_object($this->$key) && method_exists($this->$key, 'encodeJson')) {
  				$value = json_decode($this->$key->encodeJson());
  			} 
  			if (!empty($value)) {
  				$json->$lowerKey = $value;
  			}
  		}

  		return json_encode($json);
  	}
	
	public function init($CompanyName, $CompanySiret)
	{
		$this->CompanyName    = $CompanyName;
		$this->CompanySiret   = $CompanySiret;
	}
	
	public function initObject($array)
	{
		$this->CompanyName  = $array["Name"];
		$this->CompanySiret = $array["Siret"];
	}
}
