<?php
	$pdo = new PDO('sqlite:chinook.db');
	$sql = 'SELECT
			tracks.Name,
			albums.Title,
			artists.Name as Artist,
			tracks.Unitprice
		FROM tracks
		INNER JOIN albums
			ON tracks.AlbumId = albums.AlbumId
		INNER JOIN artists
			ON albums.ArtistId = artists.ArtistId
		INNER JOIN genres
			ON genres.GenreId = tracks.GenreId
	';

	if (isset($_GET['genre']) and !empty($_GET['genre'])) {
		$sql = $sql . ' WHERE genres.Name = ?';
	}

	$statement = $pdo->prepare($sql);
	if (isset($_GET['genre']) and !empty($_GET['genre'])) {
		$statement->bindParam(1, $_GET['genre']);
	}
	$statement->execute();
	$info = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Assignment 1</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
	<table class="table">
		<tr>
			<th>Track Name</th>
			<th>Album Title</th>
			<th>Artist Name</th>
			<th>Price</th>
		</tr>
		<?php foreach ($info as $row): ?>
		<tr>
			<td>
				<?php echo $row->Name; ?>
			</td>
			<td>
				<?php echo $row->Title; ?>
			</td>
			<td>
				<?php echo $row->Artist; ?>
			</td>
			<td>
				<?php echo $row->UnitPrice; ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php if (count($info) === 0): ?>
		<tr>
			<td colspan="4">
				No tracks found.
			</td>
		</tr>
		<?php endif;?>
	</table>
</body>
</html>