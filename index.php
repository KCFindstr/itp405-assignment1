<?php
	$pdo = new PDO('sqlite:chinook.db');
	$sql = 'SELECT * FROM Genres';

	$statement = $pdo->prepare($sql);
	$statement->execute();
	
	$genres = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Assignment </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Genre</th>
		</tr>
		<?php foreach ($genres as $genre): ?>
		<tr>
			<td>
				<?php echo $genre->GenreId; ?>
			</td>
			<td>
				<a href="tracks.php?genre=<?php echo urlencode($genre->Name); ?>">
					<?php echo $genre->Name; ?>
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>