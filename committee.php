<?php
require_once 'core/init.php';
define('ABSPATH',dirname(__FILE__).'/');
include(ABSPATH.'top.php');
include(ABSPATH.'includes.php');
?>
<title>join a committee</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Helping communities come together."> <meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="keyword" content="My community letter"> <meta http-equiv="content-type" content="text/html;charset=UTF-8">

<script type="text/javascript"></script>
</head>
<body>
<!--Content-->
<?php
if(Session::exists('committee'))
{// flashes at the very top of the page
	echo '<p>' . Session::flash('committee') . '</p>';
}
$user = new User();
if($user->isLoggedIn())
{
?>
<!---------------LOGGED IN---------------->
<?php include(ABSPATH.'includes/menus/navmenu.php'); ?>
<h4 id="darklabel">Committees</h4>
<div id="committeediv">
	<p class="ctext">Do you want to make a difference in your community? Join a committee to contribute
	your talents and creativity. Select one or more from the list below and we will connect you 
	with others who want to help.</p>
<div id="radioselectdiv">
	<form action="" method="">
		<div class="field">
			<input type="radio" name="architecturalcontrol" value="architecturalcontrol">
			<label class="btext" for="architecturalcontrol">Architectural Control</label>
			<p id="radiotext">Make sure the aesthetics of your community abide by the association standards. 
			We handle any request to alter and improve the guidelines.</p>	
		</div>	
		<div class="field" >
			<input type="radio" name="ptaandfurthereducation" value="ptaandfurthereducation">
			<label class="btext" for="ptaandfurthereducation">PTA and Further Education</label>
			<p id="radiotext">Join this committee comprised of PTA members and volunteers of surrounding 
				schools to help make our youth a priority by offer after school tutoring and other activities for children.</p>	
		</div>
		<div class="field">
			<input type="radio" name="communications" value="communications">
			<label class="btext" for="architecturalcontrol">Communications</label>
			<p id="radiotext">Join this committee to oversee communication distribution, work closely with the community by sharing 
			information through the newsletter, managing websites and other social media.</p>
		</div>
		<div class="field">
			<input type="radio" name="parksandcommonareas" value="parksandcommonareas">
			<label class="btext" for="parksandcommonareas">Parks and Common Areas</label>
			<p id="radiotext">Help oversee the public areas we all use for fun and relaxation, by making 
			sure maintenance is up-to-date and that it stays clean and safe.</p>
		</div>
		<div class="field">
			<input type="radio" name="recreation" value="recreation">
			<label class="btext" for="recreation">Recreation</label>
			<p id="radiotext">Do you enjoy planning events? Why not join a committee that organizes activities 
			in your community.</p>
		</div>
		<div class="field">
			<input type="radio" name="safetysecurityandtransportation" value="safetysecurityandtransportation">
			<label class="btext" for="safetysecurityandtransportation">Safety, Security and Transportation</label>
			<p id="radiotext">Be a part of the neighborhood watch, report suspicious activity and 
			keep updated lists of sex offenders in the surrounding areas.</p>
		</div>
		<div class="field">
			<input type="radio" name="welcoming" value="welcoming">
			<label class="btext" for="welcoming">Welcoming</label>
			<p id="radiotext">Do you enjoy meeting new people and making them feel at home? This is the 
			committee for you to welcome new residents.</p>
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Join">
		<input type="reset" value="Clear">
		<a href="index.php"><input type="button" value="Cancel" /></a>
	</form>
</div>
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