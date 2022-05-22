<?php
session_start();
$un=$_SESSION['name'];

if(!$un){
  header("Location:login.php");
}

if(isset($_POST['btnbtnlogout'])){
  unset($_SESSION["name"]);
  header("Location:login.php");
  die;
}

if(isset($_POST['btnEditProfile'])){
  header("Location:editprofile.php");
  die;
}

// create a connection to mysql

$servername = "localhost";
$username = "root";
$password = "";
$conn='';
try {
  $conn = new PDO("mysql:host=$servername;dbname=mca2nd", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
}
$q="select * from student_course where user_id='".$un."'";
$s=$conn->prepare($q);
$s->execute();
$alreadySelectedCourses=$s->fetchAll(PDO::FETCH_ASSOC);
/*
echo(count($alreadySelectedCourses));
for($j=0;$j<count($alreadySelectedCourses);$j++)
{
   // echo($alreadySelectedCourses[$j]['course_code']);
}
*/
if(!empty($_POST))
{
    $q="delete from student_course where user_id='".$un."'";
    $sta=$conn->prepare($q);
       try{
       $sta->execute();
       }
   catch(PDOException $eee)
   {
   
   }
    if(!empty($_POST['course']))
    {
       
 $selectedCourses=$_POST['course'];
  
 for($i=0;$i<count($selectedCourses);$i++)
 {
    // echo($selectedCourses[$i]);
    $code=$selectedCourses[$i]; 
    $q="insert into student_course(course_code,user_id) values('".$code."','".$un."')";
    $sta=$conn->prepare($q);
    try{
    $sta->execute();
    }
catch(PDOException $eee)
{

}

 }
}
 header("Location:home.php");
 die;
}
else
//echo('First time');
{

}
$r='Hello';


$q="select * from course_details";
$s= $conn->prepare($q);
$s-> execute();

$tab=$s->fetchAll(PDO::FETCH_ASSOC); 

$r='<table class="table table-bordered ">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Cousre Code</th>
    <th scope="col">Cousre Name</th>
    <th scope="col">L</th>
    <th scope="col">T</th>
    <th scope="col">P</th>
    <th scope="col">Cr</th>
    <th scope="col">SELECT</th>
  </tr>
</thead>
<tbody>';
for($i=0;$i<count($tab);$i++) 
{
    $check=''; 
    $slno=$i+1;
    $code=$tab[$i]['course_code'];
    $cname=$tab[$i]['course_name'];
    $l=$tab[$i]['l'];
    $t=$tab[$i]['t'];
    $p=$tab[$i]['p'];
    $cr=$tab[$i]['cr'];

    for($j=0;$j<count($alreadySelectedCourses);$j++)
    {
        if($alreadySelectedCourses[$j]['course_code']==$code)
        {
            $check='checked';
            break;
        }
    }

    $r=$r. '<tr>
    <td scope="col">'.$slno.'</td>
    <td scope="col">'.$code.'</td>
    <td scope="col">'.$cname.'</td>
    <td scope="col">'.$l.'</td>
    <td scope="col">'.$t.'</td>
    <td scope="col">'.$p.'</td>
    <td scope="col">'.$cr.'</td>
    <td scope="col"><input class="form-check-input" type="checkbox" name="course[]" value="'.$code.'" '.$check.' </td>
  </tr>';
    
}
$r=$r.'<tr>
<td colspan="7"></td> 
<td colspan="8"><input class="btn btn-success" type="submit" name="okbutton"  value="OK"></td>     
</tr>';
$r=$r.  '</tbody>
    </table>';

?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="ourcss1.css" rel="stylesheet">
  <title>select course</title>
</head>

<body>
 
<div class="container">
    <div class="row">
        <div class="col makedark displaycentre">
            <h1><?php echo('welcome '.$un)?></h1>
        </div>
    </div>

    <div class="row">
      <div class="col">
      <form action="selectcourses.php" method="POST">
<?php echo $r?>
</form>
      </div>
    </div>
</div>
  
   
  


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>