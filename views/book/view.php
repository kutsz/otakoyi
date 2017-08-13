<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>book of complaints</title>
    <link href="/template/css/style.css" rel="stylesheet">

</head>
<body>



	<table>

		<tr>
			<th>
				<center> <?php echo 'name'; ?></center>
			</th>
			<th>
				<center> <?php echo 'email'; ?></center>
			</th>
			<th>
				<center> <?php echo 'date'; ?></center>
			</th>
			<th>
				<center> <?php echo 'ip'; ?></center>
			</th>
			<th>
				<center> <?php echo 'browser'; ?></center>
			</th>
			<th>
				<center> <?php echo 'text'; ?></center>
			</th>
		</tr>

		<?php foreach ($users as $user): ?>
			<tr>
				<td> <?php echo $user['name']; ?></td>
				<td> <?php echo $user['email']; ?></td>
				<td> <?php echo $user['dateComment']; ?></td>
				<td> <?php echo $user['ip']; ?></td>
				<td> <?php echo $user['browser']; ?></td>
				<td> <?php echo $user['textComment']; ?></td>
			</tr>
		<?php endforeach;?>

	</table> <br>

	<?php //var_dump($users)?>

	<!-- Постраничная навигация -->
	<?php echo $pagination->get(); ?><br><br>


	<a href="/book">Book of complaints</a><br>


</body>

</html>
<!-- required -->

