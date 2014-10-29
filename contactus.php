<?php
require_once 'core/init.php';
define('ABSPATH',dirname(__FILE__).'/');
include(ABSPATH.'top.php');
include(ABSPATH.'includes.php');
?>
<title>contact us</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Helping communities come together."> <meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="keyword" content="My community letter"> <meta http-equiv="content-type" content="text/html;charset=UTF-8">

<script type="text/javascript"></script>
</head>
<body>
<!--Content-->
<?php
if(Session::exists('contact'))
{
	echo '<p>' . Session::flash('contact') . '</p>';
}
$user = new User();
if($user->isLoggedIn())
{
?>
<!---------------LOGGED IN---------------->
<?php include(ABSPATH.'includes/menus/navmenu.php'); ?>
<h4 id="darklabel">Send us a message!</h4><br/>
<div id="contactusform">

	<form id="contactusformlabels"action="post">
		<h4 id="darklabel2">Email us</h4><br/>
		<td>Name</td><br/> <input class="forminputs" size="52" type="text" id="name" name="contactname"><br/>
		<td>Email</td><br/> <input class="forminputs" size="52"type="text" id="email"name="contactemail"><br/>
		<td>Message</td><br/><textarea class="forminputs" id="message" rows="6" cols="40"></textarea><br/>
		<input id="formbtn" type="submit" value="Send">
	</form>
</div>

<div id="contactgeneral">
	<h4 id="darklabel2">General</h4>
	<ul id="paddingtext">
		<h4>mycommunityletter</h4>
		<p>Sandy Spring Road</p>
		<p>Burtonsville, MD</p><br/>
		<p>301 123 4321</p><br/>
		<h4>Director of Operations</h4>
		<p>Bob Bobberson</p>
		<p>301 123 1234</p>	
		<p>bob@bobberson.com</p>	
	</ul>
</div>
<?php
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