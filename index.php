<?php
include 'db.php';

// Insert Record
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $sql = "INSERT INTO students (name, email, mobile, department) 
            VALUES ('$name', '$email', '$mobile', '$department')";

    mysqli_query($conn, $sql);
    header("Location: index.php");
}

// Delete Record
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header("Location: index.php");
}

// Update Record
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $department = $_POST['department'];

    $update = "UPDATE students 
               SET name='$name', email='$email', mobile='$mobile', department='$department'
               WHERE id=$id";

    mysqli_query($conn, $update);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD Application</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            min-height: 100vh;
            padding: 30px;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .form-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }

        .form-box h2 {
            margin-bottom: 20px;
            color: #444;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .btn {
            background: #4CAF50;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
        }

        table th {
            background: #4CAF50;
            color: white;
            padding: 12px;
        }

        table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background: #f2f2f2;
        }

        .edit-btn {
            background: #2196F3;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .delete-btn {
            background: #f44336;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .edit-btn:hover {
            background: #1976D2;
        }

        .delete-btn:hover {
            background: #d32f2f;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .update-form {
            background: #fff3cd;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
            border: 1px solid #ffeeba;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student Management System</h1>

    <!-- Insert Form -->
    <div class="form-box">
        <h2>Add Student Details</h2>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" pattern="[0-9]{10}" required>
            </div>

            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" required>
            </div>

            <button type="submit" name="submit" class="btn">Add Student</button>
        </form>
    </div>

    <!-- Update Form -->
    <?php
    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="update-form">
        <h2>Update Student Details</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>

            <div class="form-group">
                <label>Mobile</label>
                <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" required>
            </div>

            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" value="<?php echo $row['department']; ?>" required>
            </div>

            <button type="submit" name="update" class="btn">Update Student</button>
        </form>
    </div>
    <?php } ?>

    <!-- Student Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM students");

        while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td>
                <div class="action-buttons">
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                    <a href="index.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>