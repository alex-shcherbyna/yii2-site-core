<?php

namespace ashch\sitecore\components;

//abstract
class BlockData
{

    protected $id = 0;
    protected $data = [];

    public function __construct($data)
    {
        if (is_array($data)) {
            $this->data = $data;
        } else {
            $this->data = unserialize($data);
        }
        if (isset($this->data['id'])) {
            $this->id = intval($this->data['id']);
        } else {
            $this->id = 777;
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case 'id' :
                return $this->id;
            default :
                if (isset($this->data[$name])) {
                    return $this->data[$name];
                }
        }
    }

    public function serialize()
    {
        return serialize($this->data);
    }

}
