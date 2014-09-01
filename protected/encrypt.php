<?php
//We never store plaintext passwords, only their hashes. Meaning the password is never exposed.


function passwordToHash ($password) {

  // A higher "cost" is more secure but consumes more processing power
  $cost = 10;

  // Create a random salt
  $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

  // Prefix information about the hash so PHP knows how to verify it later.
  // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
  $salt = sprintf("$2a$%02d$", $cost) . $salt;

  // Value:
  // $2a$10$eImiTXuWVxfM37uY4JANjQ==

  // Hash the password with the salt
  $hash = crypt($password, $salt);
  //echo "\n".$hash."\n";
  // Value:
  // $2a$10$eImiTXuWVxfM37uY4JANjOL.oTxqp7WylW7FCzx2Lc7VLmdJIddZq

  return $hash;
}

function projHash ($proj) {

  // Create a random salt
  $salt = strtr(base64_encode(mcrypt_create_iv(12, MCRYPT_DEV_URANDOM)), '+', '.');

  // Prefix information about the hash so PHP knows how to verify it later.
  // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
  

  // Value:
  // $2a$10$eImiTXuWVxfM37uY4JANjQ==

  // Hash the password with the salt
  $hash = crypt($proj, $salt);
  //echo "\n".$hash."\n";
  // Value:
  // $2a$10$eImiTXuWVxfM37uY4JANjOL.oTxqp7WylW7FCzx2Lc7VLmdJIddZq

  return $hash;
}

function idHash ($user, $email) {

  // Create a random salt
  $salt = strtr(base64_encode(mcrypt_create_iv(9, MCRYPT_DEV_URANDOM)), '+', '.');

  // Prefix information about the hash so PHP knows how to verify it later.
  // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
  

  // Value:
  // $2a$10$eImiTXuWVxfM37uY4JANjQ==

  // Hash the password with the salt
  $hash = crypt($user.$email, $salt);
  //echo "\n".$hash."\n";
  // Value:
  // $2a$10$eImiTXuWVxfM37uY4JANjOL.oTxqp7WylW7FCzx2Lc7VLmdJIddZq

  return $hash;
}

function checkPasswordAgainstHash($password, $hash) {
  return (crypt($password, $hash) == $hash );
}

function verifyFormToken($form) {
    
    // check if a session is started and a token is transmitted, if not return an error
	if(!isset($_SESSION[$form.'_token'])) { 
		return false;
    }
	
	// check if the form is sent with token in it
	if(!isset($_POST['token'])) {
		return false;
    }
	
	// compare the tokens against each other if they are still the same
	if ($_SESSION[$form.'_token'] !== $_POST['token']) {
		return false;
    }
	
	return true;
}

/* $input = $_POST or $_GET
 * $expected = Array of expected fields ['user', 'password', ...]
 *
 * Returns:    true -- If the expected fields match the fields in $input
 *             false -- Otherwise
 */
function validateArray($input, $expected){
   
  // First check for size (saves some computation time)
  if (sizeof($input) != sizeof($expected))
    return false;
  
  // Sort aphabetically. If they're the same, should have the same sorting
  $inkeys = array_keys($input); // Grabs the keys i.e. "key" => "value"
  $inkeys = sort($inkeys);
  $expected = sort($expected);
  
  // Next check that each key is in the same spot (same arrays should have the same sorts)
  for ($i = 0; $i < sizeof($inkeys); $i++) {
    if ($inkeys[$i] != $expected[$i]){
      return false;
    }
  }
  return true;
}

?>