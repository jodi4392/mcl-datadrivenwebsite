<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn())
{
	Redirect::to('index.php');
}
if(Input::exists())
{
	if(Token::check(Input::get('token')))
	{
		$validate = new Validate();
		$validate = $validate->check($_POST, array(
			'firstname' => array(
				'required' => true,
				'minimum' => 2,
				'maximum' => 30),
			'lastname' => array(
				'required' => true,
				'minimum' => 2,
				'maximum' => 30),
			'address1' => array(
				//'required' => true,
				'minimum' => 5,
				'maximum' => 30),			
			'address2' => array(
				//'required' => false,
				'minimum' => 5,
				'maximum' => 30),
			'city' => array(
				//'required' => true,
				'minimum' => 2,
				'maximum' => 30),	
			'state' => array(
				//'required' => true,
				'minimum' => 2,
				'maximum' => 30),
			'zip' => array(
				//'required' => true,
				'minimum' => 5,
				'maximum' => 15),
			'phone' => array(
				//'required' => false,
				'minimum' => 10,
				'maximum' => 30),
			'email' => array(
				'required' => true,
				'minimum' => 5,
				'maximum' => 30)				
			/*'username' => array(
				'required' => true,
				'minimum' => 3,
				'maximum' => 20,
				'unique' => 'users')*/
			));
			if($validate->passed())
			{
				try
				{
					$user->update(array(
						'firstname' => Input::get('firstname'),
						'lastname' => Input::get('lastname'),
						'address1' => Input::get('address1'),
						'address2' => Input::get('address2'),
						'city' => Input::get('city'),
						'state' => Input::get('state'),
						'zip' => Input::get('zip'),
						'phone' => Input::get('phone'),
						'email' => Input::get('email')
						//'username' => Input::get('username')
						));
					Session::flash('admin', 'Your details have been updated.');
					Redirect::to('profile.php');
				}
				catch(Exception $e)
				{
					die($e->getMessage());
				}
			}
			else
			{
				//loop through errors
				foreach($validate->errors() as $error)
				{
					echo $error, '<br />';
				}
			}
	}
}
?>
<form action="" method="post">
	<div class="field">
		<div class="field">
		<label for="firstname">First Name</label>
		<input type="text" name="firstname" id="firstname" value="<?php echo escape($user->data()->firstname); ?>">
	</div>
	<div class="field">
		<label for="lastname">Last Name</label>
		<input type="text" name="lastname" id="lastname" value="<?php echo escape($user->data()->lastname); ?>">
	</div>
	<div class="field">
		<label for="address1">Address 1</label>
		<input type="text" name="address1" id="address1" value="<?php echo escape($user->data()->address1); ?>">
	</div>
	<div class="field">
		<label for="address2">Address 2</label>
		<input type="text" name="address2" id="address2" value="<?php echo escape($user->data()->address2); ?>">
	</div>
	<div class="field">
		<label for="city">City</label>
		<input type="text" name="city" id="city" value="<?php echo escape($user->data()->city); ?>">
	</div>
	<div class="field">
		<label for="state">State</label>
		<input type="text" name="state" id="state" value="<?php echo escape($user->data()->state); ?>">
	</div>
	<div class="field">
		<label for="zip">Zip</label>
		<input type="text" name="zip" id="zip" value="<?php echo escape($user->data()->zip); ?>">
	</div>
	<div class="field">
		<label for="phone">Phone</label>
		<input type="text" name="phone" id="phone" value="<?php echo escape($user->data()->phone); ?>">
	</div>
	<div class="field">
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="<?php echo escape($user->data()->email); ?>">
	</div>		
		<input type="submit" value="Update">
		<a href="index.php"><input type="button" value="Cancel" /></a>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	</div>
</form>























