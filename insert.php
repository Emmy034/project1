<?php
include("connect.php");

if (isset($_POST['insert'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $department = $_POST['depart'];
    $level_of_education = $_POST['LOD'];
    $salary = $_POST['salari'];

    // File upload
    $target_dir = "uploads/";
    $imageName = basename($_FILES["profile"]["name"]);
    $target_file = $target_dir . time() . "_" . $imageName;
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    if (isset($_FILES["profile"]["tmp_name"]) && getimagesize($_FILES["profile"]["tmp_name"]) !== false) {
        move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file);
    } else {
        $target_file = ""; // fallback in case no image uploaded
    }

    $insert = mysqli_query($con, "INSERT INTO friends (firstname, lastname, department, level_of_education, salary, profile_pic) 
                VALUES('$firstname','$lastname','$department','$level_of_education','$salary', '$target_file')");

    if ($insert) {
        echo "<script>alert('Welcome $lastname'); location.replace('select.php');</script>";
    } else {
        echo "<script>alert('Try again buddy');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Register Teacher</title>
  <style>
    :root {
      --bg: #121212;
      --card: #1e1e1e;
      --text: #ffffff;
      --input-bg: #2a2a2a;
      --border: #444;
      --placeholder: #aaa;
      --btn-bg: green;
      --btn-hover: darkgreen;
    }

    body {
      background-color: var(--bg);
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      color: var(--text);
    }

    fieldset {
      background-color: var(--card);
      padding: 30px;
      border-radius: 12px;
      border: none;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
      width: 100%;
      max-width: 500px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #00ffcc;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid var(--border);
      border-radius: 8px;
      background-color: var(--input-bg);
      color: var(--text);
    }

    ::placeholder {
      color: var(--placeholder);
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: var(--btn-bg);
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: var(--btn-hover);
      width: 50%;
      margin-left: 25%;
      transition: 1s;
     
    }
    #btn{
      width: 5pc;
      margin-left: 2%;
    }
  </style>
</head>
<body>
  <a href="select.php"><button id="btn">home</button></a>
  <fieldset>
    <form action="" method="post" enctype="multipart/form-data">
      <h1>Register</h1>
      <input type="file" name="profile" class="profile" accept="image/*">

      <input type="text" name="fname" placeholder="Enter your firstname" required>
      <input type="text" name="lname" placeholder="Enter your lastname" required>
      <input type="text" name="depart" placeholder="Enter your department" required>
      <input type="text" name="LOD" placeholder="Enter your level of education" required>
      <input type="number" name="salari" placeholder="Salary" required>
      <button name="insert">submit</button>
    </form>
  </fieldset>
</body>
</html>
