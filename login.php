<?php
require_once 'core/init.php';
if(Input::exists())
{
	if(Token::check(Input::get('token')))
	{
		$validate = new Validate();
		$validate = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)));
		if($validate->passed())
		{
			//log user in
			$user = new User();
			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);
			if($login)
			{
				//echo 'Successful Login';
				Redirect::to('index.php');
			}
			else
			{
				Session::flash('home','The username or password was incorrect. Please try again.');
				Redirect::to('index.php');
			}
		}
		else
		{
			foreach($validate->errors() as $error)
			{
				echo $error, '<br />';
			}
		}
	}
	else
	{
		echo 'token failed';
	}
}
?>
<div id="loginform">
	<h2 id="loginlabel">Login</h2>
	<form action="" method="post">
		<div class="field" id="formtitle1">
			<!--<label for="username">Username</label>-->
			<span>Username</span>
			<input size="30" type="text" name="username" id="username" autocomplete="off">
		</div>
		<div class="field" id="formtitle2">
			<!--<label for="password">Password</label>-->
			<span>Password</span>
			<input size="31" type="password"name="password" id="password" autocomplete="off">
		</div>
		<div class="field" id="rememberme">
			<label for="remember">
			<input type="checkbox" name="remember" id="remember">Remember me
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input  id="loginbtn" type="submit" value="Log in">
	</form>
</div>