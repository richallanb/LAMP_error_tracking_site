<?php
  class User{
    private $name;           
    private $email;          
    private $idhash;  
    private $created;
    private $last_login;
    private $Errors = array();
    
    public function __construct($n, $e, $i, $c, $l){
      $this->name = $n;
      $this->email = $e;
      $this->idhash = $i;
      $this->create_date = $c;
      $this->last_login = $l;
    }
    
    public function __destruct(){
      unset($this->Errors);
    }
    
    public function getName(){
      return $this->name;
    }
    
    public function getEmail(){
      return $this->email;
    }
    
    public function getIdHash(){
      return $this->idhash;
    }
    
    public function getCreateDate(){
      return $this->create_date;
    }
    
    public function getLastLogin(){
      return $this->last_login;
    }
    
  }

  class Project{
    private $name;                  
    private $idhash;
    private $owner;                 
    private $users;
    //private $Errors = array();
       
    public function __construct($n, $i=null, $o=null, $u=array()){
      $this->name = $n;
      $this->idhash = $i;
      $this->owner = $o;
      $this->users = $u;
    }
    
    public function __destruct(){
      unset($users);
      unset($owner);
    }
    
    public function addUser($u){
      $this->users[] = $u;
    }
    
    public function addOwner($o){
      $this->owner = $o;
    }
    
    public function getUsers(){
      return $this->users;
    }
    
    public function getName(){
      return $this->name;
    }
    public function getOwner(){
      return $this->owner;
    }
    public function getIdHash(){
      return $this->idhash;
    }
    
  }

  class Error{
    public $name;
    
    public function __construct($n = 'wtf'){
      $this->name = $n;
    }
    
  }

?>