<?php
  session_start();
 
  if(!isset($_SESSION['username']))
  {
      $_SESSION['msg']="You must login to enter";
 header('location: login.php');
  }
  if(isset($_GET['logout']))
  {
 session_destroy();
 unset($_SESSION['username']);
 header("location: admin.php");
  }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/cdf270f348.js" crossorigin="anonymous"></script>
    <title>Admin | Section-B</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            margin: 0;
            padding: 0;
            background: url(background.jpg);
            /* background-position: center; */
            background-size: cover;
            font-family: sans-serif;
        }
        .login-form{
            width:250px;
            height: 300px;
            background-color: black;
            top: 50%;
            left: 50%;
            position: absolute;
            transform:translate(-50% ,-50%) ;
            box-sizing: border-box;
            border-radius: 10px;
        }
        .admin{
            height: 100px;
            width: 100px;
            border-radius: 50%;
            margin: -50px 0 0 5px;
    
        }
        .form{
            color: white;
        }
        h1{
            color: white;
            text-align: center;
            font-size: 22px;
            margin-bottom:30px ;
        }
        form p{
            margin: 0;
            padding: 0;
            font-weight: bold;
            color: white;
            margin:0 0 0 12px;
        }
        form input{
            width: 90%;
            margin:0 0 5px 12px;
            /* text-align: center; */
        }
        .login-form input[type="txt"], input[type="password"]{
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color: white;
        }
        .btn{
            width: 90%;
            margin:10px 0 10px 10px;
            font-size:18px;
            border: none;
            height: 35px;
            background: purple;
            color: white;
            border-radius: 20px;
            cursor: pointer;
        }
        .btn:hover{
            background: rgb(167, 11, 167);
        }
        form a{
            color: white;
            margin:15px 20px;
            text-decoration: none;
        }
        form a:hover{
            color: gray;
        }
select {
background-repeat:no-repeat;
background-position:300px;
width:200px;
padding:12px;
margin-top:8px;
font-family:Cursive;
line-height:1;
border-radius:5px;
background-color:#000000;
color:#ff0;
font-size:20px;
-webkit-appearance:none;
outline:none
}
select:hover {
color:#00ff7f
}
    </style>
</head>
<body align="center">
<h1>
			
		       <?php  if (isset($_SESSION['username'])) : ?>
				Hello, <?php echo $_SESSION['username']; ?>
				<?php endif ?>
		</h1>
    <header class="header">
        <a href="index.php"><img class="logo" src="logo.jpg" alt="logo"></a>
    </header>
    <div class="login-form">
        <img src="admin.jpg" class="admin">
      <form action="allocate.php" method="post">
&nbsp&nbsp
<select name="year">
<option value="choose a year:">Choose year</option>
  <option value="2">2nd year</option>
  <option value="3">3rd year</option>
<option value="2&3">2nd & 3rd year</option>
</select><br><br><br><br><br><br><br>
 <button class="btn" name="set">Submit</button> <br><br><br><br>
 <a href="adminaction.php?logout='1'" style="color: red; font-size:40px">logout</a>
        </form>
    </div>

		
</body>
</html>

