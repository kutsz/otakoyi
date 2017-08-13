

<!DOCTYPE html>
<html>
<head>
	<title>Cabinet</title>
	<link href="" rel="stylesheet" type="text/css">

</head>
<body>
	<h2>Cabinet</h2>

	    <form action="" method="post">
			<input type="text" name="name" placeholder="search" /><br><br>
            <input type="submit" name="submitSearch"  value="submit" /><br>
		</form>


		<input type="checkbox" name="Arr[]"/><br>

<?php if (isset($users) && is_array($users)): ?>
	<?php foreach ($users as $user): ?>

		<p>
			<input type='radio' name='id' value="<?php echo $categoryItem['id']; ?>">
			<?php echo $categoryItem['title']; ?>
		</p>

	<?php endforeach;?>


	<p>
		<input type="submit" name="submitDelete" value="Delete">
		<br><br>
		<input type="submit" name="submitEdit" value="Edit">
	</p>
<?php endif;?>
</form><br>

</body>
</html>

