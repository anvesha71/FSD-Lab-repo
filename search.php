<?php include 'db.php'; ?>

<form method="post">
Search Name: <input type="text" name="name">
<input type="submit" value="Search">
</form>

<?php
if(isset($_POST['name'])){
$name = $_POST['name'];

$result = mysqli_query($conn, "SELECT * FROM students WHERE name LIKE '%$name%'");

while($row = mysqli_fetch_assoc($result)){
echo $row['name']." - ".$row['email']." - ".$row['course']."<br>";
}
}
?>