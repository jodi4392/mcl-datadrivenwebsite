<?php
	require_once 'core/init.php';
	// checks to see if token check is returning false if csrf has happened
	//var_dump(Token::check(Input::get('token')));
	if(Input::exists())
	{
		if(Token::check(Input::get('token')))
		{
			//echo Input::get('username');
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
					'maximum' => 30),				
				'username' => array(
					'required' => true,
					'minimum' => 3,
					'maximum' => 20,
					'unique' => 'users'),
				'password' => array(
					'required' => true,
					'minimum' => 5,
					'maximum' => 30),
				'retype_password' => array(
					'required' => true,
					'matches' => 'password')
			));
			if($validate->passed())
			{
				/*Check to see if flash works
				Session::flash('Success', 'You registered successfully.<br />');
				echo "Passed<br />";
				header('Location: index.php');
				*/
				$user = new User();
				$salt = Hash::salt(32);
				try
				{
					$user->create(array(
						'firstname' => Input::get('firstname'),
						'lastname' => Input::get('lastname'),
						'address1' => Input::get('address1'),
						'address2' => Input::get('address2'),
						'city' => Input::get('city'),
						'state' => Input::get('state'),
						'zip' => Input::get('zip'),
						'phone' => Input::get('phone'),
						'email' => Input::get('email'),						
						'username' => Input::get('username'),
						'password' => Hash::make(Input::get('password'), $salt),
						'salt' => $salt,
						'joined' => date('Y-m-d H:i:s'),
						'group' => 1,
						'active' => 2));
					Session::flash('home','You have been registered.');
					//header('Location: index.php');
					Redirect::to('index.php');
				}
				catch(Exception $e)
				{
					// die() or redirect to a user friendly page
					die($e->getMessage());
				}
			}
			else
			{
				foreach($validate->errors() as $error)
				{
					echo $error, "<br />";
				}
			}
		}
	}
	/*	For Later when we select a community and build that into it
	<div class="field">
		<label for="community">Choose your community *</label>
		<select name="community">
			<option value=""></option>
			<option value="shadypines">Shady Pines</option>
			<option value="orangeacres">Orange Acres</option>
			<option value="meadowridge">Meadow Ridge</option>
		</select>
	</div>*/
?>
<p>* are required</p>
<form action="" method="post">
	<div class="field">
		<label for="firstname">First Name *</label>
		<input type="text" name="firstname" id="firstname" value="<?php echo escape(Input::get('firstname')); ?>">
	</div>
	<div class="field">
		<label for="lastname">Last Name *</label>
		<input type="text" name="lastname" id="lastname" value="<?php echo escape(Input::get('lastname')); ?>">
	</div>
	<div class="field">
		<label for="address1">Address 1</label>
		<input type="text" name="address1" id="address1" value="<?php echo escape(Input::get('address1')); ?>">
	</div>
	<div class="field">
		<label for="address2">Address 2</label>
		<input type="text" name="address2" id="address2" value="<?php echo escape(Input::get('address2')); ?>">
	</div>
	<div class="field">
		<label for="city">City</label>
		<input type="text" name="city" id="city" value="<?php echo escape(Input::get('city')); ?>">
	</div>
	<div class="field">
		<label for="state">State</label>
		<input type="text" name="state" id="state" value="<?php echo escape(Input::get('state')); ?>">
	</div>
	<div class="field">
		<label for="zip">Zip</label>
		<input type="text" name="zip" id="zip" value="<?php echo escape(Input::get('zip')); ?>">
	</div>
	<div class="field">
		<label for="phone">Phone</label>
		<input type="text" name="phone" id="phone" value="<?php echo escape(Input::get('phone')); ?>">
	</div>
	<div class="field">
		<label for="email">Email *</label>
		<input type="text" name="email" id="email" value="<?php echo escape(Input::get('email')); ?>">
	</div>
	<div class="field">
		<label for="username">Username *</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>
	<div class="field">
		<label for="password">Choose a password *</label>
		<input type="password" name="password" id="password">
	</div>
	<div class="field">
		<label for="retype_password">Retype your password *</label>
		<input type="password" name="retype_password" id="retype_password">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Register">
	<a href="index.php"><input type="button" value="Cancel" /></a>
</form>