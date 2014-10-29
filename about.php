<?php
require_once 'core/init.php';
define('ABSPATH',dirname(__FILE__).'/');
include(ABSPATH.'top.php');
include(ABSPATH.'includes.php');
?>
<title>my community letter about</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Helping communities come together."> <meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="keyword" content="My community letter"> <meta http-equiv="content-type" content="text/html;charset=UTF-8">

<script type="text/javascript"></script>
</head>
<body>
<!--Content-->
<?php
$user = new User(); // Current user
if($user->isLoggedIn())
{	//echo '<br />You are logged in<br />';
?>
<!---------------LOGGED IN---------------->
	<?php include(ABSPATH.'includes/menus/navmenu.php'); ?>
	<h4 id="darklabel">About mycommunityletter</h4>
	<div id="atext">
		<p class="atext">mycommunityletter is an interactive community newsletter with the goal of bringing communities
		 closer together by sharing and creating events in the community. Help keep everyone notified about 
		 what is going on around the community, give helpful tips and insights into maintaining homes. There 
		 is also a spot to give small businesses a change to advertise to their community. Out goal is bringing 
		 neighbors close together to turn community into family.</p><br/>
		<p class="atext">Take this opportunity to get involved! Submit your content by clicking any of the 
		events listed on the home page. It's fun to share events, stories, committee news, recipes, or anything 
		at all that you would like to see in your newsletter.</p><br/>
		<p class="atext">And always remember to love your community!</p>
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