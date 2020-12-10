<?php
namespace Model;

require_once 'Valitron/Validator.php';

use Valitron\Validator as V;

class Model_BD {

public $link_db;

public function __construct()
{
   require './config/config.php';
   $link = new \PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_password);
   $query = "set names utf8";
   $pstmt = $link->prepare($query);
   $pstmt->execute();
   $this->link_db=$link;
   V::langDir(__DIR__.'/validator_lang'); // always set langDir before lang.
   V::lang('en');
}

public function funcValidate($email)
{
   $v = new V(array('email_input' => $email));
   $v->rule('email', 'email_input');
   $result_validate=$v->validate();
   $this->error_validation=$v->errors();
   return $result_validate;
}

public function funcEmailCheck($email)
{
   $qeury = 'select contact from contacts where contact=:email';
   $pstmt = $this->link_db->prepare($qeury);
   $pstmt->bindParam(':email', $email, \PDO::PARAM_STR);
   $pstmt->execute();
   return $pstmt->fetchAll();
}

public function funcSignUp($email) 
{
   $qeury = 'insert into contacts (contact) values(:email)';
   $pstmt = $this->link_db->prepare($qeury);
   $pstmt->bindParam(':email', $email, \PDO::PARAM_STR);
   return $pstmt->execute();
}

public function funcEmailSend($email) 
{
	$title = 'SIGN UP!';
	$message = '<h2>You have signed up successfully</h2>';
	return file_get_contents('http://api.25one.com.ua/api_mail.php?email_to=' . urlencode($email) . '&title=' . urlencode($title) . '&message=' . urlencode($message));
}

}

?>
