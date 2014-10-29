<?php
require_once 'core/init.php';
define('ABSPATH',dirname(__FILE__).'/');
include(ABSPATH.'top.php');
include(ABSPATH.'includes.php');
?>
<title>News and Events</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Helping communities come together."> <meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="keyword" content="My community letter"> <meta http-equiv="content-type" content="text/html;charset=UTF-8">

<script type="text/javascript"></script>
</head>
<body>
<!--Content-->
<?php
if(Session::exists('newsevents'))
{// flashes at the very top of the page
	echo '<p>' . Session::flash('newsevents') . '</p>';

}
$user = new User();
if(!$user->isLoggedIn())
{
	Redirect::to('index.php');
}
// for posting
if(Input::exists())
{
	if(Token::check(Input::get('token')))
	{
		$validate = new Validate();
		$validate = $validate->check($_POST, array(
			'user_text' => array(
				'required' => true,
				'minimum' => 1,
				'maximum' => 3000)
			));
			if($validate->passed())
			{
				try
				{
					$user->createpost(array(
						'user_id' => escape($user->data()->username),
						'user_text' => Input::get('user_text'),
						'date_post' => date('Y-m-d')
						));
					Session::flash('newsevents', 'Your post has been added.');
					Redirect::to('newsevents.php');
				}
				catch(Exception $e)
				{
					die($e->getMessage());
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
}
?>	
<!---------------LOGGED IN---------------->
<?php include(ABSPATH.'includes/menus/navmenu.php');?>
<h4 id="darklabel">News and Events</h4> 
<div id="displayforumdiv">
<?php
$users_post = DB::getInstance()->query('SELECT * FROM users_post ORDER BY id DESC');
if(!$users_post->count())
{
	echo "There are no posts.<br />";
}
else
{
?>
<form action="" method="post">
<table>
	<div class="field">	
<?php
	foreach($users_post->results() as $row)
	{
?>
		<div class="field" id="singlepost">
			<textarea type="text" class="displaytextarea" id="displaypost" readonly><?php echo escape($row->user_text)?></textarea>
			<input type="text" class="displaytextdate" name="date" value="<?php echo escape($row->user_id)?>" readonly>
			<input type="text" class="displaytextuser"name="date" value="<?php echo escape($row->date_post)?>" readonly>			
		</div>	

<?php	
	}
?>

</table>
<?php
}
?>	  
</div>
<div id="postbtnforumdiv">
	<div id="forum">
	<form action="" method="post">
		<div class="field">
			<label for="user_text">Post your news and events here.</label><br/>
			<textarea class="postbtntextarea" type="text" name="user_text" id="user_text"></textarea>
		</div>		
			<a href="newsevents.php"><input id="postbtn" type="submit" value="Post"></a>
			<input type="reset" id="postbtn" type="button" value="Clear" /></a>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		</div>
	</form>
	</div>
</div>

<?php

?>
<!-----------------BOTTOM------------------->
</div>
<?php include(ABSPATH.'bottom.php');?>
</body>
</html>