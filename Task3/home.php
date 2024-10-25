<?php
session_start();
include 'connect.php';


if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $query = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email'");
    $row=mysqli_fetch_array($query);
}
else{
    echo "You are not logged in.";
    include("index.php");
    exit();
}
          
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>

    <div class="container hcontainer" style="justify-content:center">
        <h1 style="text-align:center;padding:30px 0">Simply User Login</h1>
        <div class="details" style="padding:10px;display:grid;justify-content:center" >
            <h2>Welcome  <?php
                echo $row['name'];
            ?>
            </h2>
            <br>
            <h2>
                Email : <?php
                        echo $row['email'];
                        ?>
            </h2>
        </div>
        <button type="submit" name="logout" id="logout" style="margin-left:40%">Log Out</button>
    </div>
<?php
session_destroy();
?>
    <script >
        const logutBtn = document.getElementById('logout');
        logutBtn,addEventListener('click',() =>{
        window.location.href="logout.php";
        });
    </script>
</body>

</html>

