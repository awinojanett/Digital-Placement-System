<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Registration</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php
    include 'conn.php';
    ?>
<body>
  <div class="container"> 
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Contact Name</th>
      <th scope="col">Contact Number</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>

  <?php
    $raw = 0;

    $query = "SELECT * FROM tbl_highschool";
    $run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($run)){
      $raw++; 
    ?>


    <tr>
      <th scope="row"><?php echo $raw ?></th>
      <td><?php echo $row['school_name'] ?></td>
      <td><?php echo $row['category'] ?></td>
      <td><?php echo $row['location'] ?></td>
      <td><?php echo $row['contact_name'] ?></td>
      <td><?php echo $row['contact_no'] ?></td>
      <td style="background-color: <?php echo $row['status'] == 1 ? 'green' : ''; ?>; color: orange;">
    <?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?>
      </td> 
    </tr>
    <?php } ?>
  </tbody>
</table>


</div>
</body>
</html>