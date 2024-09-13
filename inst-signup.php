
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel = "stylesheet" href = "style.css">
</head>

<?php
    include 'conn.php'; // Connection to the database
?>

<?php
// $username = '';
// $password = '';
// $institution = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $index_number = $_POST['index_number'];
    $birth_date= $_POST['birth_date'];
    $email = $_POST['email'];
    $phone_no= $_POST['phone_no'];
    $grades= $_POST['grades'];
    $placed_inst = $_POST['placed_inst'];
    $high_school = $_POST['high_school'];
    $kcse_year = $_POST['kcse_year'];

    // Prepare and bind
    $query = ("INSERT INTO tbl_students (index_number, birth_date, email, phone_no, grades, placed_inst, high_school, kcse_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt = $conn->prepare($query);
    
    // Bind form values to the query
    $stmt->bind_param("ssssssss", $index_number, $birth_date, $email, $phone_no, $grades, $placed_inst, $high_school, $kcse_year);

    // Execute the query
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<body>
  <h1>Create Account to Register</h1>
  <a href="index.php">Home</a>
<form action="" method="post">
<div class="container">
  <div class="mb-3">
  <label for="ExampleInputUsername" class="form-label">Index Number</label>
  <input type="text" name="index_number"class="form-control" id="ExampleInputUsername" autocomplete = "off">
</div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Birth Date</label>
    <input type="date" name="birth_date"class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
  <label for="ExampleInputInstitution" class="form-label">Email</label>
  <input type="email" name="email"class="form-control" id="ExampleInputInstitution">
</div>
  <div class="mb-3">
  <label for="ExampleInputInstitution" class="form-label">Phone number</label>
  <input type="text" name="phone_no" required maxlength ="10" class="form-control" id="ExampleInputInstitution">
</div>
<div class="mb-3">
  <label for="ExampleInputInstitution" class="form-label">Grade</label>
<select name="grades" class="form-control">
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
</select>
  <!-- <input type="text" name="grades" id="ExampleInputInstitution"> -->
</div>
<div class="mb-3">
  <label for="ExampleInputInstitution" class="form-label">Placed Institution</label>
  <select name="placed_inst" class="form-control">
  <option value="12">Egerton University</option>
  <option value="11">Kibabii University</option>
  <option value="10">Kisumu National Polytechnic</option>
  <option value="13">University of Nairobi</option>
</select>
  <!-- <input type="text" name="placed_inst"class="form-control" id="ExampleInputInstitution"> -->
</div>
<div class="mb-3">
  <label for="ExampleInputInstitution" class="form-label">High School</label>
  <select name="high_school" class="form-control">
  <option value="12">A</option>
  <option value="11">A-</option>
  <option value="10">B+</option>
  <option value="9">B</option>
  <option value="8">B-</option>
  <option value="7">C+</option>
  <option value="6">C</option>
  <option value="5">C-</option>
  <option value="4">D+</option>
</select>
  <!-- <input type="text" name="high_school"class="form-control" id="ExampleInputInstitution"> -->
</div>
<div class="mb-3">
  <label for="ExampleInputInstitution" class="form-label">KCSE Year</label>
  <input type="number" name="kcse_year"class="form-control" id="ExampleInputInstitution">
</div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Keep me signed in</label>
  </div>
  <button type="register" class="btn btn-primary">Register</button>
</form>
</div>
</body>
</html>