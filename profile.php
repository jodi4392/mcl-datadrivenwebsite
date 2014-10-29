<?php
require_once 'core/init.php';
define('ABSPATH',dirname(__FILE__).'/');
include(ABSPATH.'top.php');
include(ABSPATH.'includes.php');
?>
<title>my community profile</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Helping communities come together."> <meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="keyword" content="My community letter"> <meta http-equiv="content-type" content="text/html;charset=UTF-8">

<script type="text/javascript"></script>
</head>
<body>
<!--Content-->
<?php
if(Session::exists('admin'))
{// flashes at the very top of the page
	echo '<p>' . Session::flash('admin') . '</p>';
}
$user = new User(); // Current user
if($user->isLoggedIn())
{	//echo '<br />You are logged in<br />';
?>
<!---------------LOGGED IN---------------->
<?php include(ABSPATH.'includes/menus/navmenu.php'); ?>
<h4 id="darklabel">Profile details</h4>
<div id="profilelist">
	<ul>
		<li class="profilebtn"><a href="update.php">Update details</a></li>
		<li class="profilebtn"><a href="changepassword.php">Change password</a></li>
	</ul>

<?php
	if($user->hasPermission('Admin'))
	{	
?>	
<!-----------------ADMIN-------------------->

	<ul>
		<li class="profilebtn"><a href="upload.php">Upload</li>
		<li></li>
	</ul>
</div>
<?php
	}
}
else
{
	Redirect::to('index.php');
}
?>
<!-----------------BOTTOM------------------->
</div>
<?php include(ABSPATH.'bottom.php');?>
</body>
</html>