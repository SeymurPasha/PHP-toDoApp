<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'todoapp') or die(mysqli_error($mysqli));

$name = '';
$update = false;


if(isset($_POST['save'])) {
    $name = $_POST['name'];
    
    $mysqli->query("INSERT INTO task (name) VALUES('$name')") or 
        die($mysqli->error);
    
        header("location:toDo.php");
    }


    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM task WHERE id=$id") or die($mysqli->error());
        header("location:toDo.php");
        }
  

        if(isset($_GET['complete'])) {
            $id = $_GET['complete'];
            $result = $mysqli->query("SELECT * FROM task WHERE id=$id") or die($mysqli->error());
            $row = $result->fetch_array();
            $complete = $row['complete'];
            $mysqli->query("UPDATE task SET complete = !($complete) WHERE id=$id") or die($mysqli->error);
            header("location:toDo.php");
        }

             
        if(isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $update = true;
            $result = $mysqli->query("SELECT * FROM task WHERE id=$id") or die($mysqli->error());
             $row = $result->fetch_array();
             $name = $row['name'];
            }

        if(isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $mysqli->query("UPDATE task SET name = '$name' WHERE id = $id") or die($mysqli->error);  
            header("location:toDo.php");
        }