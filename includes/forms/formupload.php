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