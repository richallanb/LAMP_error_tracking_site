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
    
    public function addError($e){
      $this->Errors[] = $e;
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
    
    public function getErrors(){
      return $this->Errors;
    }
    
  }

  class Project{
    private $name;                  
    private $idhash;
    private $Owner;                 
    private $Users;
    //private $Errors = array();
       
    public function __construct($n, $i=null, $o=null, $u=array()){
      $this->name = $n;
      $this->idhash = $i;
      $this->Owner = $o;
      $this->Users = $u;
    }
    
    public function __destruct(){
      unset($users);
      unset($owner);
    }
    
    public function addUser($u){
      $this->Users[] = $u;
    }
    
    public function addOwner($o){
      $this->Owner = $o;
    }
    
    public function getUsers(){
      return $this->Users;
    }
    
    public function getName(){
      return $this->name;
    }
    public function getOwner(){
      return $this->Owner;
    }
    public function getIdHash(){
      return $this->idhash;
    }
    
  }

  class Error{
    
    // For ajax identification
    private $id;
    
    // Information variables
    private $name;
    private $create_date;
    private $severity;
    
    // Detail variables
    private $line;
    private $source;
    private $method;
    private $comment;
    
    // Resolution variables
    private $resolved_comment;
    private $resolved_date;
    private $resolved_user;
    
    public function __construct($i, $n, $cd, $sl, $l, $s, $m, $c = NULL, $rc = NULL, $rd = NULL, $ru = NULL){
      $this->id = $i;
      $this->name = $n;
      $this->create_date = $cd;
      $this->severity = $sl;
      $this->line = $l;
      $this->source = $s;
      $this->method = $m;
      $this->comment = $c;
      $this->resolved_comment = $rc;
      $this->resolved_date = $rd;
      $this->resolved_user = $ru;
    }
    
    public function getId(){
      return $this->id;
    }
    
    public function getName(){
      return $this->name;
    }
    
    public function getCreateDate(){
      return $this->create_date;
    }
    
    public function getSeverity(){
      return $this->severity;
    }

    public function getLine(){
      return $this->line; 
    }
    
    public function getSource(){
      return $this->source;
    }
    
    public function getMethod(){
      return $this->method;
    }
    
    public function getComment(){
      return $this->comment;
    }
    
    public function getResolvedComment(){
      return $this->resolved_comment;
    }
    
    public function getResolvedDate(){
      return $this->resolved_date;
    }
    
    public function getResolvedUser(){
      return $this->resolved_user;
    }
    
  }

?>