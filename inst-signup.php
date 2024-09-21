<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Create Account to Register</h1>
<?php
include 'conn.php'; // Connection to the database

$index_numberErr = $birth_dateErr = $emailErr = $phone_noErr = $gradesErr = $placed_instErr = $high_schoolErr = $kcse_yearErr = "";
$index_number = $birth_date = $email = $phone_no = $grades = $placed_inst = $high_school = $kcse_year = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $index_number = test_input($_POST['index_number']);
    $birth_date = test_input($_POST['birth_date']);
    $email = test_input($_POST['email']);
    $phone_no = test_input($_POST['phone_no']);
    $grades = test_input($_POST['grades']);
    $placed_inst = test_input($_POST['placed_inst']);
    $high_school = test_input($_POST['high_school']);
    $kcse_year = test_input($_POST['kcse_year']);

    $is_valid = true;

    // Form validation
    if (empty($index_number)) {
        $index_numberErr = "Index number is required";
        $is_valid = false;
    } elseif (!preg_match("/^\d{8}\/\d{3}$/", $index_number)) {
        $index_numberErr = "Invalid index number format";
        $is_valid = false;
    }

    if (empty($birth_date)) {
        $birth_dateErr = "Birth date is required";
        $is_valid = false;
    }

    if (empty($email)) {
        $emailErr = "Email is required";
        $is_valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $is_valid = false;
    } else {
        // Check if the email already exists in the database
        $email_query = "SELECT * FROM tbl_students WHERE email = ?";
        $email_stmt = $conn->prepare($email_query);
        $email_stmt->bind_param("s", $email);
        $email_stmt->execute();
        $result = $email_stmt->get_result();

        if ($result->num_rows > 0) {
            $emailErr = "This email is already registered";
            $is_valid = false;
        }
        $email_stmt->close();
    }

    if (empty($phone_no)) {
        $phone_noErr = "Phone number is required";
        $is_valid = false;
    } elseif (!preg_match("/^\d{10}$/", $phone_no)) {
        $phone_noErr = "Invalid phone number";
        $is_valid = false;
    }

    if (empty($grades)) {
        $gradesErr = "Grades are required";
        $is_valid = false;
    }

    if (empty($placed_inst)) {
        $placed_instErr = "Placed institution is required";
        $is_valid = false;
    }

    if (empty($high_school)) {
        $high_schoolErr = "High school is required";
        $is_valid = false;
    }

    if (empty($kcse_year)) {
        $kcse_yearErr = "KCSE year is required";
        $is_valid = false;
    } elseif (!preg_match("/^\d{4}$/", $kcse_year)) {
        $kcse_yearErr = "KCSE year must be exactly 4 digits and contain only numbers";
        $is_valid = false;
    }

    // Check if form is valid before processing
    if ($is_valid) {
        // Prepare and bind
        $query = "INSERT INTO tbl_students (index_number, birth_date, email, phone_no, grades, placed_inst, high_school, kcse_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Bind form values to the query
        $stmt->bind_param("ssssssss", $index_number, $birth_date, $email, $phone_no, $grades, $placed_inst, $high_school, $kcse_year);

        // Execute the query
        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>New record created successfully</div>";
            // Redirect after successful submission
            header('Location: index.php');
            exit(); // Ensure no further code execution
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="container mt-5">
            <div class="mb-3">
                <label for="index_number" class="form-label">Index Number</label>
                <input type="text" name="index_number" class="form-control" id="index_number" value="<?php echo htmlspecialchars($index_number); ?>" autocomplete="off">
                <span class="error"><?php echo $index_numberErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="birth_date" class="form-label">Birth Date</label>
                <input type="date" name="birth_date" class="form-control" id="birth_date" value="<?php echo htmlspecialchars($birth_date); ?>">
                <span class="error"><?php echo $birth_dateErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone Number</label>
                <input type="text" name="phone_no" class="form-control" id="phone_no" value="<?php echo htmlspecialchars($phone_no); ?>" maxlength="10">
                <span class="error"><?php echo $phone_noErr; ?></span>
            </div>
            <div class="mb-3">
    <label for="grades" class="form-label">Grade</label>
    
    <select name="grades" class="form-control" id="grades">
        <option value="">Select Grade</option> <!-- Default option -->
        <?php
        $query = "SELECT * FROM tbl_grade";
        $run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($run)){
        ?>
            <option value="<?php echo $row['points']; ?>"><?php echo $row['grade']; ?></option>
        <?php
        }
        ?>
    </select>
    
    <span class="error"><?php echo $gradesErr; ?></span>
</div>

            <div class="mb-3">
                <label for="placed_inst" class="form-label">Placed Institution</label>
                <select name="placed_inst" class="form-control" id="grades">
        <option value="">Select Institution</option> <!-- Default option -->
        <?php
        $query = "SELECT * FROM tbl_institution";
        $run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($run)){
        ?>
            <option value="<?php echo $row['inst_id']; ?>"><?php echo $row['inst_name']; ?></option>
        <?php
        }
        ?>
    </select>
                <span class="error"><?php echo $placed_instErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="high_school" class="form-label">High School</label>
                <select name="high_school" class="form-control" id="grades">
        <option value="">Select High School</option> <!-- Default option -->
        <?php
        $query = "SELECT * FROM tbl_highschool";
        $run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($run)){
        ?>
            <option value="<?php echo $row['school_id']; ?>"><?php echo $row['school_name']; ?></option>
        <?php
        }
        ?>
    </select>
                <span class="error"><?php echo $high_schoolErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="kcse_year" class="form-label">KCSE Year</label>
                <input type="number" name="kcse_year" class="form-control" id="kcse_year" value="<?php echo htmlspecialchars($kcse_year); ?>">
                <span class="error"><?php echo $kcse_yearErr; ?></span>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Keep me signed in</label>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</body>
</html>
