<?php
require_once 'core/init.php';

$user = new User();
if(!$user->isLoggedIn())
{
	Redirect::to('index.php');
}
if($user->hasPermission('Admin'))
{
	if(isset($_FILES['file']))
	{
		$file = $_FILES['file'];
		//file properties
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];
		//file extension and make it lower case
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));
		//allows specific extensions
		$allowed = array('txt', 'jpg', 'gif', 'jpeg', 'png');
		if(in_array($file_ext, $allowed))
		{
			echo 'upload';
			if($file_error === 0)
			{
				if($file_size <= 20097152)
				{
					// give the file it's a unique number behind it
					$file_name_new = $file_name . '_' . uniqid('',true) . '.' .$file_ext;
					$file_destination = 'includes/forms/testupload/' . $file_name_new;
					if(move_uploaded_file($file_tmp, $file_destination))
					{
						echo $file_destination;
						echo '<br />Your file has been uploaded.<br/>';
					}
				}
			}
		}		
		else
		{
			echo 'There was an error.';
		}
	}
?>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<div class="field">
			<div class="field">
				<input type="file" name="file">
				<input type="submit" value="Upload">
			</div>
			<a href="index.php"><input type="button" value="Cancel" /></a>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		</div>
	</form>
<?php
}
else
{
	Session::flash('home','You do not have permission to view that page.');
	Redirect::to('index.php');
}
?>
