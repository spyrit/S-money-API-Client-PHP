<?php

class FileAttachmentRef
{
    public $Id;
    public $Name;
    public $Type;
    public $Size;
    public $href;

    public function __construct()
    {
        $this->Id = 0;
        $this->Name = '';
        $this->Type = '';
        $this->Size = 0;
        $this->href = '';
    }

    public function getId()
    {
        return $this->Id;
    }
    public function getName()
    {
        return $this->Name;
    }
    public function getType()
    {
        return $this->Type;
    }
    public function getSize()
    {
        return $this->Size;
    }
    public function gethref()
    {
        return $this->href;
    }

    public function setId($Id)
    {
        return ($this->Id = $Id);
    }
    public function setName($Name)
    {
        return ($this->Name = $Name);
    }
    public function setType($Type)
    {
        return ($this->Type = $Type);
    }
    public function setSize($Size)
    {
        return ($this->Size = $Size);
    }
    public function sethref($href)
    {
        return ($this->href = $href);
    }

    public function getAttributes()
    {
        $list = array('Id' => $this->Id,
                        'Name' => $this->Name,
                        'Type' => $this->Type,
                        'Size' => $this->Size,
                        'href' => $this->href, );

        return $list;
    }

    public function encodeJSON()
    {
        $json = new StdClass();
        foreach ($this as $key => $value) {
            $lowerKey = strtolower($key);
            $json->$lowerKey = $value;
        }

        return json_encode($json);
    }

    public function init($Id, $Name, $Type, $Size, $href)
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Type = $Type;
        $this->Size = $Size;
        $this->href = $href;
    }

    public function initObject($array)
    {
        $this->Id = $array['Id'];
        $this->Name = $array['Name'];
        $this->Type = $array['ContentType'];
        $this->Size = $array['Size'];
        $this->href = $array['Href'];
    }
}
