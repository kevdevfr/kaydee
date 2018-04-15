<?php
include_once(dirname(__FILE__)."/class.sing.php");
include_once(dirname(__FILE__)."/functions.php");
$contact = new Sing('contact');

$Subject = $contact->get('sujet');
$emetteur = Trim((isset($_POST['nom'])?$_POST['nom']:'')." ".(isset($_POST['prenom'])?$_POST['prenom']:''));
$Message = '';
if(isset($_POST['message'])&&!empty($_POST['message'])&&$_POST['message']!='undefined')
$Message = Trim(stripslashes($_POST['message']));
$Body = '';
$EmailTo = $contact->get('contact-mail');
$EmailFrom = $contact->get('form-mail');
if(isset($_POST['mail']))
  $EmailFrom = $_POST['mail'];

if(isset($_POST['societe'])&&!empty($_POST['societe'])&&$_POST['societe']!='undefined') {
  $Body .= "Société :";
  $Body .= $_POST['societe'];
  $Body .= "\n";
}
if(isset($_POST['telephone'])&&!empty($_POST['telephone'])&&$_POST['telephone']!='undefined') {
  $Body .= "Tel :";
  $Body .= $_POST['telephone'];
  $Body .= "\n";
}
$Body .= $Message;

// send email
$headers = 'From: '.$emetteur.' <'.$EmailFrom . '>' . "\r\n"
 . 'Reply-To: '.$emetteur.' <'.$EmailFrom . '>' . "\r\n"
 . 'X-Mailer: PHP/' . phpversion();

$success = mail(''.$EmailTo.'', ''.$Subject.'', ''.$Body.'', $headers );


echo $success;

?>
