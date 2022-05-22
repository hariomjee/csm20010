<?php
if(isset($_POST['login'])){
    header("Location:login.php");
    die;
}
$msg='';
if(empty($_POST))
{
    $msg='First Load';
}
else
{
    $un=$_POST['username'];
    $pw=$_POST['pwd'];

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

$q="insert into user_details (user_name,password) values ('".$un."','".$pw."')";
  echo($q);  
  
  $statement=$conn->prepare($q);
  try{
  $statement->execute();
  $msg="Account created go to login page to LOGIN";
  }
  catch(PDOException $err)
  {
      $msg="Account already exits";
  }
}
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
    <title>Create User</title>
</head>

<body>
    <form method="POST" action="createuser.php">
        <!-- when ever we make a form in php the two method we must use . one is POST or GET and another is action="name of file"  it mean suppose we click on form then after pressing button it redirect to next page which has given into action -->
        <div class="container" style="padding-left:20%;padding-top: 10%;padding-right:20%;">
            <div class="row rowspace">
                <div class="col">
                    <h4 class="text-primary"> USER NAME:</h4>
                </div>
            </div>

            <div class="row rowspace">
                <div class="col">
                    <input class="fulltextbox" type="text" name="username">
                </div>
            </div>

            <div class="row rowspace">
                <div class="col">
                    <h4 class="text-primary">PASSWORD:</h4>
                    <!-- text-primary is already defined coloer in bootstrap. If you want to use more these type of color then just on google and search color bootstrap. you get many more color-->
                </div>
            </div>

            <div class="row rowspace">
                <div class="col ">
                    <input class="fulltextbox" type="text" name="pwd" </div>
                </div>

                <div class="row rowspace">
                    <div class="col  ">
                        <input class="btn btn-info" type="submit" value="Create Account"<!--- submit button-->

                        <!-- btn btn-info    this is another bootstrap readymade class . this is for color  button.-->
                    </div>
                    <div class="col rightcontant ">
                        <input class="btn btn-info" type="submit" value="Login" name="login"<!--- submit button-->
                    </div>
                </div>

                


                <div class="row rowspace">
                    <div class="col ">
                        <h2><?php echo ($msg) ?></h2>
                    </div>
                </div>
            </div>
    </form>



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