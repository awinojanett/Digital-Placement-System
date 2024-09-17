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
<?php
    include 'conn.php';
    ?>
<body>  
    
    <?php
    include 'conn.php'; // Connection to the database

    $school_nameErr = $locationErr = $contact_nameErr = $contact_noErr = "";
    $school_name = $location = $contact_name = $contact_no = "";

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form inputs
        $school_name = test_input($_POST['school_name']);
        $location = test_input($_POST['location']);
        $contact_name = test_input($_POST['contact_name']);
        $contact_no = test_input($_POST['contact_no']);

        $is_valid = true;
        
        // Form validation
        if (empty($school_name)) {
            $school_nameErr = "School name is required";
            $is_valid = false;
        } elseif (!preg_match("/^\d{8}\/\d{3}$/", $school_name)) {
            $school_name = "Invalid index number format";
            $is_valid = false;
        }

        if (empty($location)) {
            $locationErr = "Location is required";
            $is_valid = false;
        }

        if (empty($contact_name)) {
            $contact_nameErr = "Email is required";
            $is_valid = false;
        }

        if (empty($contact_no)) {
            $contact_noErr = "Phone number is required";
            $is_valid = false;
        } elseif (!preg_match("/^\d{10}$/", $contact_no)) {
            $contact_noErr = "Invalid phone number";
            $is_valid = false;
        }

        
    
        // Check if form is valid before processing
        if ($is_valid) {
            // Prepare and bind
            $query = "INSERT INTO tbl_highschool (school_name, location, contact_name, contact_no) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            // Bind form values to the query
            $stmt->bind_param("ssssssss", $school_name, $location, $contact_name, $contact_no);

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
        <div class="container">
            <div class="mb-3">
                <label for="index_number" class="form-label">School Name</label>
                <input type="text" name="index_number" class="form-control" id="index_number" autocomplete="off">
                <span class="error"><?php echo $school_nameErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control" id="location">
                <span class="error"><?php echo $locationErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" name="contact" class="form-control" id="contact">
                <span class="error"><?php echo $contact_nameErr; ?></span>
            </div>
            <div class="mb-3">
                <label for="phone_no" class="form-label">Contact Number</label>
                <input type="text" name="phone_no" class="form-control" id="phone_no">
                <span class="error"><?php echo $contact_noErr; ?></span>
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
