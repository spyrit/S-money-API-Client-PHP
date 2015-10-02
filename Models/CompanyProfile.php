<?php

class CompanyProfile
{
	public $Name;
	public $Siret;
	
	public function __construct()
	{
		$this->Name   = "";
		$this->Siret  = "";
	}
	
	public function getName() 		{return $this->Name;}
	public function getSiret() 		{return $this->Siret;}
	
	
	public function setName 	($Name) 		{ return ($this->Name=$Name); }
	public function setSiret	($Siret) 	{ return ($this->Siret=$Siret); }
   
	public function getAttributes ()
    {
		$list = array (	'Name' 			=> $this->Name, 
				   		'Siret'    		=> $this->Siret);
		return $list;
	}
  	
  	public function encodeJSON()
  	{
  	    $json = new StdClass();
  		foreach ($this as $key => $value){

            if ($key=="Siret")
                $lowerKey = strtoupper($key);
            else
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
	
	public function init($Name, $Siret)
	{
		$this->Name    = $Name;
		$this->Siret   = $Siret;
	}
	
	public function initObject($array)
	{
		$this->Name  = $array["Name"];
		$this->Siret = $array["SIRET"];
	}
}
