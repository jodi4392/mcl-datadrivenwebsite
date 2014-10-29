<?php
class Redirect
{
	public static function to($location = null)
	{
		if($location)
		{
			if(is_numeric($location))
			{
				switch($location)
				{
					case 404:
						header('HTTP/1.0 404 Not Found');
						include 'includes/errors/404.php';
						exit();
					break;
					//we can add other error codes if we need to
					default:
					break;
				}
			}
			header('Location: ' . $location);
			exit();
		}
	}
}
?>