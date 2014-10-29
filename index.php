<?php
require_once 'core/init.php';
define('ABSPATH',dirname(__FILE__).'/');
include(ABSPATH.'top.php');
include(ABSPATH.'includes.php');
?>
<title>my community letter home</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Helping communities come together."> <meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="keyword" content="My community letter"> <meta http-equiv="content-type" content="text/html;charset=UTF-8">

<script type="text/javascript"></script>
<?php
/*
echo Config::get('mysql/host');
var_dump(Config::get());
//Query to get specific item in db
//$user = DB::getInstance()->get('users', array('username', '=', 'jodi'));
$user = DB::getInstance()->query('SELECT * FROM users');
if(!$user->count())
{
	echo "No user<br />";
}
else
{
	echo "Ok! First:<br />";
	echo $user->first()->username, '<br />';
	echo "Ok! All:<br />";
	foreach($user->results() as $user)
	{
		echo $user->username, '<br />';
	}
}
echo Session::flash('Success');
*/
?>
</head>
<body>
<!--Content-->
<?php
if(Session::exists('home'))
{// flashes at the very top of the page
	echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User(); // Current user
//$anotheruser = new User(11); // another user

//echo $user->data()->username;
if($user->isLoggedIn())
{	//echo '<br />You are logged in<br />';
?>
<!---------------LOGGED IN---------------->
<?php include(ABSPATH.'includes/menus/navmenu.php'); ?>
<div id="dotteddiv">
	<h4 id="darklabel" style="text-align: center;">keep in touch with the people in your community</h4>
	<div id="links"><a href="newsevents.php"><img src="images/newsandevents.png" height="90" width="90"/></a></div>
	<div id="links"><a href="#"><img src="images/kidskorner.png" height="90" width="90"/></a></div>
	<div id="links"><a href="#"><img src="images/funtidbit.png" height="90" width="90"/></a></div>
	<div id="links"><a href="#"><img src="images/helpwanted.png" height="90" width="90"/></a></div>
	<div id="links"><a href="#"><img src="images/homesforsale.png" height="90" width="90"/></a></div>
	<div id="links"><a href="#"><img src="images/shareyourbusiness.png" height="90" width="90"/></a></div>
</div>
<div id="dottedbottomdiv">
	<!--Banner Ads 250x250 -->
	<div id="greyblocks">
		<div id="greylist">
			<h4 id="greylistlabel">Join a committee!</h4>
			<p id="greylisttext">Join a committee, contribute your talents and creativity to better your community.</p>
			<a href="committee.php" ><img src="images/linemeeting.jpg" height="80" width="180"/><a>
			<a href="committee.php" ><input class="greylistbtn" type="submit" value="Click here to join!"></a>			
		</div>
	</div>
	<div id="greyblocks">
		<div id="greylist">
			<h4 id="greylistlabel">Useful Links</h4>
			<ul>
				<li class="greylistlink"><a href="#">Recent Activity</a></li>
				<li class="greylistlink"><a href="#">Calendar</a></li>
				<li class="greylistlink"><a href="#">Board of Directors</a></li>
				<li></li>
			</ul>
		</div>
	</div>
	<div id="greyblocks">
		<div><a href="#"><img src="images/fakead.png" height="250" width="250"/></a></div>
	</div>
</div>
<?php
}
else
{
?>
<!-------------------------LOGIN-------------WELCOME--------------------->
<div id="homespacecontainer">
<h3 id="logo">mycommunityletter</h3>
<div id="toptheme">
	<p id="topthemetext">Love your community</p>
</div>
<div id="introdiv">
	<?php include(ABSPATH.'login.php'); ?>
	<div id="intro">
	<h2 id="introwelcomelabel">Welcome</h2>
	<p class="welcometext1">mycommunityletter is an interactive community newsletter with the goal of bringing communities
	 closer together by sharing and creating events in the community. Help keep everyone notified about 
	 what is going on around the community, give helpful tips and insights into maintaining homes. There is also a spot to give small 
	 businesses a change to advertise to their community. Out goal is bringing neighbors close together 
	 to turn community into family.</p>
	<p class="welcometext2">Take this opportunity to become involved!!!</p>
	</div>
</div>
<div id="introhelpdiv">
	<div id="acctcontainer">
		<p id="acctlabel">Forgot your password?<p>
		<p id="introlabel">No problem, click here.</p>
		<a href="register.php" ><input class="acctbtn" type="submit" value="Forgot password"></a>
	</div>
	<div id="acctcontainer">
			<p id="acctlabel">Need an account?<p>
			<p id="introlabel">You can sign up here.</p>
			<a href="register.php" ><input class="acctbtn" type="submit" value="Register"></a>
	</div>
	<div id="acctcontainer">
		<p id="acctlabel">Want to learn more?<p>
		<p id="introlabel">Click here to request the details.</p>
		<a href="register.php" ><input class="acctbtn" type="submit" value="Learn more"></a>
	</div>
</div>
<?php
}
?>
<!-----------------BOTTOM------------------->
</div>
<?php include(ABSPATH.'bottom.php');?>
</body>
</html>