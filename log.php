<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel ="small icon" href = "rupee.jpg">
    <style>
        img
        {
            height:90%;
            width:90%;
            position:absolute;
            top:8%;
            left:7%;
            opacity:0.8;

        }
        .container
        {
            position: absolute;
            left:33%;
            top:23%;
            
        }
        #username
        {
            margin: 2% 1%;
            height:30px;
            padding-left: 20%;
            padding-right: 20%;
            width:270px;
        }
        #password
        {
            margin: 2% 1%;
            height:30px;
            padding-left: 20%;
            padding-right: 20%;
            width:270px;
        }
        strong
        {
            font-size: 25px;
            font-family: cursive;
        }
        button
        {
            background-color:aqua;
            height: 35px;
            width:80px;
        }
        h1
        {
            font-size: 40px;
        }
        p
        {
            font-family: cursive;
        }
        .alertcontainerdan
        {
            background-color:red;
            position:absolute;
            top:1%;
            width:100%;
            height:8%;
            text-align:center;
        }
        .alertcontainerdan button
        {
            position:absolute;
            top:22%;
            right:1%;
            width:30px;
            height:30px;
            background-color:white;
        }
        
    </style>
</head>
<body>
<?php include 'dbcon.php'; ?>
    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
        $res = mysqli_query($connection,$sql);
        $num = mysqli_num_rows($res);
        if($num == 1)
        {
            while($row = mysqli_fetch_assoc($res))
            {
                if(password_verify($password,$row["password"]))
                {
                    $id = $row["user_id"];
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;
                    header("location:budgetstore.php?id=$id");
                }
                else
                {
                    echo '<div class="alertcontainerdan">
                    <p>Wrong Password</p>
                    <button>X</button></div>';
                }
            }
        }
        else
        {
            echo '<div class="alertcontainerdan">
                    <p>Error!Invalid Credentials</p>
                    <button>X</button></div>';
        }
    }
    






    ?>
<img src = "word-cloud-budget-related-items-35774612.png">

    <div class="container">
        <h1>Log in</h1>
    <form action="log.php" method = "POST">
    <div>
        <label for = "username"><strong>Username:</strong></label>
        <input type="text" id = "username" name="username" placeholder="Enter your username">
    </div>
    <div>
        <label for = "password"><strong>Password:</strong></label>
        <input type="password" id = "password" name="password" placeholder="Enter your password">
    </div>
    <div>
        <button>Log in</button>
    </div>
    <div>
        <p>Don't have an account?Then <a href = "sign.php">Sign up</a></p>
    </div>
    </form>
    </div>
    <script>

        const but = document.querySelector(".alertcontainerdan button");
        but.addEventListener("click",() => {
            document.querySelector(".alertcontainerdan").style.display = "none";
        });
        
    </script>
</body>
</html>