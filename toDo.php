<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php require_once 'process.php'; ?>
<?php

$mysqli = new mysqli('localhost', 'root', '', 'todoapp') or die(mysqli_error($mysqli));
$result  = $mysqli->query("SELECT * FROM task") or die($mysqli->error);

?>
<div class = "d-flex align-items-center justify-content-between flex-column" style = "height:100vh">
<h1>To Do List</h1>
<div class = "d-flex  align-items-center justify-content-center" style = "width:75%;">
<form class = "d-flex  align-items-center justify-content-center" action = "process.php" method = "POST" style = "width:75%">
<input type="hidden" name = "id" value = "<?php echo $id; ?>">
<input class = "w-50" type="text" name = "name" value = "<?php echo $name ?>">
<?php 
if ($update == true):
?>
<button class=" w-25 btn btn-warning" name = "update">Update</button>
<?php else : ?>
    <button class="w-25 btn btn-warning" name = "save">Add</button>
<?php endif; ?>
</form>
</div>
<div class = "w-50">
<?php
while ($row = $result->fetch_assoc()): ?>
<div class = "d-flex align-items-center justify-content-between">
<h5
<?php if ($row['complete'] == 1): ?>
style = "text-decoration:line-through;width:30%"
<?php else : ?>
    style = "width:30%;"
<?php endif; ?>
>
<?php echo $row['name']; ?>
</h5>
<h6><?php echo $row['date']; ?></h6>
<div>
<a href="process.php?complete=<?php echo $row['id']; ?>" class="btn btn-success">Complete</a>
<a href="toDo.php?edit=<?php echo $row['id']; ?>" class = "btn btn-info">Edit</a>
<a href="process.php?delete=<?php echo $row['id']; ?>" class = "btn btn-danger">Delete</a>
</div>

</div>
<?php endwhile; ?>

</div>
</div>
</body>
</html>