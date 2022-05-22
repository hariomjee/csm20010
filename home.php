<?php

session_start();
$un = $_SESSION['name'];
if (!$un) {
  header("Location:login.php");
}
if (isset($_POST['btnbtnlogout'])) {
  unset($_SESSION["name"]);
  header("Location:login.php");
  die;
}

if (isset($_POST['btnEditProfile'])) {
  header("Location:editprofile.php");
  die;
}

// create a connection to mysql

$servername = "localhost";
$username = "root";
$password = "";
$conn = '';
try {
  $conn = new PDO("mysql:host=$servername;dbname=mca2nd", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch (PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
}

$q = "select * from student_course where user_id='" . $un . "'";
$statement = $conn->prepare($q);
$statement->execute();

$r = '<table class="table table-bordered ">
<thead>
  <tr>
  <th scope="col">#</th>
  <th scope="col">Cousre Code</th>
  <th scope="col">Cousre Name</th>
  <th scope="col">L</th>
  <th scope="col">T</th>
  <th scope="col">P</th>
  <th scope="col">Cr</th>
  </tr>
</thead>
<tbody>';

if ($statement->rowCount() == 0) {

  $r = $r . '<tr>
      <td></td>
      <td>No course taken</td>     
    </tr>';
} else {
  $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

  for ($i = 0; $i < count($rows); $i++) {
    $ccode = $rows[$i]['course_code'];
    $q = "select * from course_details where course_code='" . $ccode . "'";
    $s = $conn->prepare($q);
    $s->execute();
    $details = $s->fetchAll(PDO::FETCH_ASSOC);

    $cname = $details[0]['course_name'];
    $l = $details[0]['l'];
    $t = $details[0]['t'];
    $p = $details[0]['p'];
    $cr = $details[0]['cr'];

    $r = $r . '<tr>
          <td>' . ($i + 1) . '</td> 
          <td>' . $ccode . '</td>
          <td>' . $cname . '</td>
          <td>' . $l . '</td>
          <td>' . $t . '</td>
          <td>' . $p . '</td>
          <td>' . $cr . '</td> 
        </tr>';
  }
}

$r = $r . '<tr>
<td colspan="6"></td>
<td><input class="btn btn-info" type="submit" value="EDIT"></td>     
</tr>';
$r = $r .  '</tbody>
    </table>';

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="ourcss1.css" rel="stylesheet">
  <title>Home</title>
</head>

<body>

  <div class="container">
    <div class="row">
    <form action="home.php" method="POST">
      <div class="col d-flex justify-content-between bg-info" style="padding: 2%;">
        <h1 class="text white"><?php echo ('welcome '.$un) ?> </h1>
        <input class="btn btn-link text-white" type="submit" value="EDIT PROFILE" name="btnEditProfile">
        <input class="btn btn-danger" type="submit" value="LOGOUT" name="btnbtnlogout">
      </div>
</form>

    </div>

    <div class="row">
      <div class="col">
        <form action="selectcourses.php" method="POST">
          <?php echo $r ?>
        </form>
      </div>
    </div>
  </div>





  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>