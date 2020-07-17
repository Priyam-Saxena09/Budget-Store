<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUDGET</title>
    <link rel ="small icon" href = "rupee.jpg">
    <style>
        .container
        {
            height:260px;
            width: auto;
        }
        .container img
        {
            height:260px;
            width: 1800px;
            opacity:0.6;
        }
        .container h1
        {
            position: absolute;
            left:35%;
            top:1px;
            font-size: 25px;
        } 
        .container p
        {
            position: absolute;
            left:43%;
            top:10px;
            font-size: 40px;
        } 
        .incomecont
        {
            height:50px;
            width:410px;
            background-color:cyan;
            position: absolute;
            left:34%;
            top:110px;
        }
        .incomecont p
        {
            font-family: cursive;
            font-size: 20px;
            position: absolute;
            left:20px;
            top: -10px;
        }
        .incomecont b
        {
            font-family: cursive;
            font-size: 20px;
            position: absolute;
            left:320px;
            top: 7px;
        }
        .expensecont
        {
            height:50px;
            width:410px;
            background-color:indianred;
            position: absolute;
            left:34%;
            top:190px;
        }
        .expensecont p
        {
            font-family: cursive;
            font-size: 20px;
            position: absolute;
            left:20px;
            top: -10px;
            
        }
        .expensecont b
        {
            font-family: cursive;
            font-size: 20px;
            position: absolute;
            left:320px;
            top: 7px;
        }
        .container1
        {
            height:70px;
            width: auto;
            border:2px solid wheat;
            display: grid;
            grid-template-columns: repeat(4,auto);
            grid-gap: 20px;
            justify-content:center;
            align-content: center;
        }

        #option
        {
            height:50px;
            width:40px;
            
        }

        #description
        {
            height:40px;
            width:390px;
            margin-top: 2px;
        }
        #amount
        {
            height:35px;
            width:70px;
            margin-top: 4px;
        }
        th,td
        {
           padding:2px 290px;
           font-size: 25px;
           font-family: cursive;
           color:lime;
        }
        #inc 
        {
           display:inline-grid;
           grid-template-columns: repeat(3,60px);
           color:cyan;
           font-size: 30px;
           font-family: cursive;
           align-items: center;
           grid-column-gap: 120px;
           grid-row-gap: 1px;
           position: absolute;
           left:200px;
        }
        #inc button
        {
            border-radius: 60%;
            color:cyan;
           
        }
        #exp 
        {
           display:inline-grid;
           grid-template-columns: repeat(3,60px);
           color:magenta;
           font-size: 30px;
           font-family: cursive;
           align-items: center;
           grid-column-gap: 110px;
           grid-row-gap: 1px;
           position: absolute;
           left:880px;
        }   
        #exp button
        {
            border-radius: 60%;
            color:magenta;
            
        }
       
        .container button
        {
            position:absolute;
            right:1%;
            top:3%;
            height:5%;
            width:5%;
        }
       
    </style>
</head>
<body>
<?php include 'dbcon.php'; ?>
    <?php
    session_start();
    $id = $_GET['id'];
    if(isset($_SESSION["loggedin"])&& $_SESSION["loggedin"] == true)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
    
           $type = $_POST["option"];
           $desc = $_POST["description"];
           $amount = $_POST["amount"];
           if($desc!=''&& $amount!='')
           {
           if($type == "+")
           {
               $sql = "INSERT INTO `budget` (`budget_type`,`budget_description`,`budget_value`,`user_id`) VALUES ('INCOME','$desc','$amount','$id')";
               $res = mysqli_query($connection,$sql);
              
           }
           else if($type == "-")
           {
            $sql = "INSERT INTO `budget` (`budget_type`,`budget_description`,`budget_value`,`user_id`) VALUES ('EXPENSE','$desc','$amount','$id')";
            $res = mysqli_query($connection,$sql);
           }
        }
        }
        
    }
    ?>
    <?php
        if(isset($_GET["delete"]))
        {
            $id1 = $_GET["delete"];
            $sql = "DELETE FROM `budget` WHERE `bud_id` = '$id1' AND `user_id` = '$id'";
            $res1 = mysqli_query($connection,$sql);
        }
        
        ?>
        
    <div class="container" >
        <img src = "back.png">
        <a href = "Logout.php"><button>Log out</button></a>
        <h1>Available Budget of <b><?php echo $_SESSION["username"];?> </b></h1>
        <?php
        $incsum = 0;
        $sql2 = "SELECT * FROM `budget` WHERE `user_id` = '$id' AND `budget_type` = 'INCOME'";
        $res2 = mysqli_query($connection,$sql2);
        
        $num = mysqli_num_rows($res2);
        for($i=1;$i<=$num;$i++)
        {
            $row = mysqli_fetch_assoc($res2);
            $incsum = $incsum + $row['budget_value'];
        }
        $expsum = 0;

      $sql3 = "SELECT * FROM `budget` WHERE `user_id` = '$id' AND `budget_type` = 'EXPENSE'";
$res3 = mysqli_query($connection,$sql3);
$num1 = mysqli_num_rows($res3);
for($i=1;$i<=$num1;$i++)
{
    $row = mysqli_fetch_assoc($res3);
   
    $expsum = $expsum + $row['budget_value'];
    
}
$calc = $incsum-$expsum;
        
        echo '<p>'.$calc.'</p>';
        ?>
        <div class="incomecont">
            <p>Income</p>
            <?php

$incsum = 0;
$id = $_GET['id'];
$sql2 = "SELECT * FROM `budget` WHERE `user_id` = '$id' AND `budget_type` = 'INCOME'";
$res2 = mysqli_query($connection,$sql2);

$num = mysqli_num_rows($res2);
for($i=1;$i<=$num;$i++)
{
    $row = mysqli_fetch_assoc($res2);
    $incsum = $incsum + $row['budget_value'];
}
echo '<b>+'.$incsum.'</b>';
    

?>
            
        </div>
        <div class="expensecont">
            <p>Expenses</p>
<?php

$expsum = 0;
$id = $_GET['id'];
$sql2 = "SELECT * FROM `budget` WHERE `user_id` = '$id' AND `budget_type` = 'EXPENSE'";
$res2 = mysqli_query($connection,$sql2);
$num = mysqli_num_rows($res2);
for($i=1;$i<=$num;$i++)
{
    $row = mysqli_fetch_assoc($res2);
   
    $expsum = $expsum + $row['budget_value'];
    
}
echo '<b>-'.$expsum.'</b>';
    


?>
            
        </div>
    </div>
    <form action ="<?php $_SERVER["REQUEST_URI"];?>" method="POST" class="container1">
       <select name = "option" id = "option">
           <option value="+">+</option>
           <option value="-">-</option>
       </select>
       <input type = "text" id = "description" name="description" placeholder="Add the description">
       <input type = "number" id = "amount" name="amount" placeholder="Value">
       <button>Add</button> 
    </form>
    <center>
    <table>
        <thead>
            <tr>
                <th>Income</th>
                <th>Expense</th>
            </tr>
        </thead>
    </table>
</center>

   
    <div id="inc">
    <?php
$id = $_GET['id'];
$sql1 = "SELECT * FROM `budget` WHERE `user_id` = '$id'";
$res1 = mysqli_query($connection,$sql1);
while($row = mysqli_fetch_assoc($res1))
{
if($row["budget_type"] == "INCOME")
{
    echo 
          '<p>'.$row["budget_description"].'</p>
          <p>'.$row["budget_value"].'</p>
          <button id = "'.$row["bud_id"].'" class = "delete">X</button>';
}
}
    
 ?> 
    </div>
    <div id="exp">
    <?php

     
$id = $_GET['id'];
$sql1 = "SELECT * FROM `budget` WHERE `user_id` = '$id'";
$res1 = mysqli_query($connection,$sql1);
while($row = mysqli_fetch_assoc($res1))
{
if($row["budget_type"] == "EXPENSE")
{
    echo 
          '<p>'.$row["budget_description"].'</p>
          <p>'.$row["budget_value"].'</p>
          <button id = "'.$row["bud_id"].'" class = "delete">X</button>';
}
}
        ?> 
    </div>
   <?php 
echo '<script>

const but = document.querySelectorAll(".delete");
Array.from(but).forEach((e)=>{

e.addEventListener("click",(e1) => {
    var id = e1.target.id;
    var id1 = '.$_GET["id"].';
    if(confirm("Do you Want to delete this record?"))
    {
    window.location = `budgetstore.php?id=${id1}&delete=${id}`;
    }
});

});



</script>';
?>    
</body>
</html>