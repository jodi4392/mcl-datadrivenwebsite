<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn())
{
	Redirect::to('index.php');
}
if(Input::exists())
{
<?php
	$pass=0;
	$name=filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	$email=filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
	$message=filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS);
	if($name==''||$email==''||$cmessage=='')
	{
		Session::flash('contact', 'Please fill out the form to send us a message.');
	}
	else
	{
		/* Sending the Email to the Admin */
		/*$toEmail="jodi4392@impresst.com" . ", ";*/
		$toEmail.="jobs4392@gmail.com";
		$subject="Message from mycommunityletter";
		$message="
		Name: $name 
		Email: $email
		Message : $message";
		$headers="From: noreply@onlineserver.cc";
		if (mail($toEmail, $subject, $message, $headers))
		{ 
			Session::flash('contact', 'Thank you, your message was sent.');
			Redirect::to('contactus.php');
		}
		else
		{
			Session::flash('contact', 'Please fill out the form to send us a message.');
			Redirect::to('contactus.php');
		}
	}
?>