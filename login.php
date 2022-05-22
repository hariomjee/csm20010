<?php
if (isset($_POST['newbtn'])) {
    header("Location:createuser.php");
    die;
}
$isfirsttime = 0;
//$allusers = array(array('abc', 'abc1'), array('pqr', 'pqr1'), array('iop', 'iop1'), array('ram', 'mar'));

$msg = " ";
if (empty($_POST)) {
    $msg = "first time";
    $isfirsttime = 1;
} else {
    $msg = "Re submittion";
    $isfirsttime = 0;
    $isfound = 0;

    $un = $_POST["t1"];
    $pw = $_POST["t2"];

    if ($un == "admin" and $pw == "admin") {
        session_start();
        $_SESSION['name'] = "admin";
        header("Location: gradeentryform.php");
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
        echo "Connection failed: " . $e->getMessage();
    }

    // create a statemant for the sql command u want to execute
    $q = "select * from user_details where user_name='" . $un . "' and password='" . $pw . "'";
    //echo($q);
    //die;
    $statement = $conn->prepare($q);

    //execute the command
    $statement->execute();
    if ($statement->rowCount() == 0) {
        $isfound = 0;
    } else {
        $isfound = 1;
    }
    /*
$rc=$statement -> rowCount();  // how many row are effected or returned

echo($rc);
$rows=$statement-> fetchAll(PDO::FETCH_ASSOC); // will return the result in a tabular format

for($i=0;$i<count($rows);$i++)
{
    echo($rows[$i]['name'].' ' .$rows[$i]['pwd']);
}
*/

    /*
    for($i=0;$i<count($allusers);$i++)
    {
        if($allusers[$i][0]== $un && $allusers[$i][$i]==$pw)
        {
            $isfound=1;
            break;
        }
    }
    if($i==count($allusers))
    {
        $isfound=0;
    }
*/
    if ($isfound == 1) {
        // $msg="Welcome ".$un;
        session_start();
        $_SESSION['name'] = $un;

        header("location:home.php");
        die;
    } else {
        $msg = "invalid un and pw";
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
    <title>login</title>
</head>

<body>
    <form method="POST" action="login.php">
        <!-- when ever we make a form in php the two method we must use . one is POST or GET and another is action="name of file"  it mean suppose we click on form then after pressing button it redirect to next page which has given into action -->
        <div class="container" style="padding-left:20%;padding-top: 10%;padding-right:20%;">
            <div class="row rowspace">
                <div class="col">
                    <h4 class="text-primary"> USER NAME:</h4>
                </div>
            </div>

            <div class="row rowspace">
                <div class="col">
                    <input class="fulltextbox" type="text" name="t1">
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
                    <input class="fulltextbox" type="password" name="t2" </div>
                </div>


                <div class="row rowspace">
                    <form method="POST" action="createuser.php">
                        <div class="col d-flex justify-content-between">
                            <input class="btn btn-info" type="submit" value="New User" name="newbtn">
                            <!--- submit button-->

                            <input class="btn btn-info" type="submit" value="Login" <!--- submit button-->
                        </div>
                    </form>
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