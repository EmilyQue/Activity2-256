<?php
namespace App\Model;

class UserModel implements \JsonSerializable {
    private $id;
    private $username;
    private $password;
    
    public function __construct($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
}