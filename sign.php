<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            left:31%;
            top:20%;
            
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
        #cpassword
        {
            margin: 2% 1%;
            height:30px;
            padding-left: 20%;
            width:400px;
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
        $cpassword = $_POST["cpassword"];
        $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
        $res = mysqli_query($connection,$sql);
        $num = mysqli_num_rows($res);
        if($num>0)
        {
            echo '<div class="alertcontainerdan">
            <p>User Already Exist</p>
            <button>X</button></div>';
        }
        else if($username == '' || $password == '' || $cpassword == '')
        {
            echo '<div class="alertcontainerdan">
            <p>Please Fill all the entries</p>
            <button>X</button></div>';
        }
        else
        {
            if($password == $cpassword)
            {
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql1 = "INSERT INTO `user`(`username`,`password`) VALUES ('$username','$hash')";
                $res1 = mysqli_query($connection,$sql1);
                header("location:log.php");

            }
            else
            {
                echo '<div class="alertcontainerdan">
                <p>Password Do Not Match</p>
                <button>X</button></div>';
            }
        }
    }

    ?>
    

    <img src = "budget.jpg">
    
    <div class="container">
        <h1>Sign Up</h1>
    <form action = "sign.php" method = "POST">
    <div>
        <label for = "username"><strong>Username:</strong></label>
        <input type="text" id = "username" name="username" placeholder="Enter your username">
    </div>
    <div>
        <label for = "password"><strong>Password:</strong></label>
        <input type="password" id = "password" name="password" placeholder="Enter your password">
    </div>
    <div>
        <label for = "cpassword"><strong>Confirm Password:</strong></label>
        <input type="password" id = "cpassword" name="cpassword" placeholder="Re-Enter your password">
    </div>
    <div>
        <button>Sign Up</button>
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