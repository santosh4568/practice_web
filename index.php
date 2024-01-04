<?php
$conn = mysqli_connect("localhost", "root", "", "alumni_website");
if ($conn) {
    echo '';
} else {
    echo "Error";
}
?>
<html>

<head>
    <title>Alumni website</title>
</head>

<style>
    body {
        background-image: url("https://www.vignanlara.org/images/main-slider/lara5.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }

    .myDiv {
        border: 5px outset black;
        background-color: black;
        text-align: center;
    }

    h4 {
        width: 100%;
        text-align: center;
        border-bottom: 1px solid #000;
        line-height: 0.1em;
        margin: 10px 0 20px;
    }

    h4 span {
        background: #fff;
        padding: 0 10px;
    }

    .button1 {
        color: black;
        float: right;
    }

    .button1:hover {
        background-color: #000000;
        color: white;
    }
</style>

<body>
    <center>
        <div class="myDiv">
            <h1 style="color:white;font-family:Goudy Stout;">Alumni Website</h1><br>
        </div>
        <hr>
        <marquee>
            <h2 style="color:#b71c1c;">Welcome to the Alumni website of vignan university</h2>
        </marquee>
        <hr>
        <form action="/Sai/index.php" method="POST" id="Form">
        <table style="width:50%">
            <tr colspan="2">
                <td>
                    <h2 style="font-family:elephant;font-size:30px;">Login</h2>
                </td>
            <tr>
            <tr>
                <td>
                    <p style="font-family:Candara;font-size:30px;">User name:</p>
                </td>
                <td><input type="text" name="user" /></td><br>
            </tr>
            <tr>
                <td>
                    <p style="font-family:Candara;font-size:30px;">Password:</p>
                </td>
                <td><input type="password" name="password" /></td><br>
            </tr>
        </table>
        <button name="login" method="POST">Submit</button>
        <button onclick="reset()">Reset</button>
        <?php 
        if(isset($_POST['login']))
        {
            $usr=$_POST['user'];
            $password=$_POST['password'];
            $query=mysqli_query($conn,"SELECT * FROM `login` WHERE `user` LIKE '$usr'");
        if(mysqli_num_rows($query)>0){
            $row=mysqli_fetch_assoc($query);
            if($password==$row['pass'])
            {
                echo '<script>
                alert("Successfully login in");
                </script>';
            }
            else{
                echo '<script>
                alert("Wrong Password !!");
                </script>';
            }
        }
        else{
            echo '<script>
            alert("User is not registered !! You should registered first");
            </script>';
        }
        }
        ?>
</form>
        <form action="/Sai/index.php" method="POST" id="myForm">
        <table style="width:50%">
            <tr>
                <td style="font-size:30px;text-align:center;" colspan="2">
                    <h4><span>Or <br> Register</span></h4>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-family:Candara;font-size:30px;">User name: </p>
                </td>
                <td><input type="text" name="username" /></td><br>
            </tr>
            <tr>
                <td>
                    <p style="font-family:Candara;font-size:30px;">Contact number: </p>
                </td>
                <td><input type="text" name="contactnumber" /></td><br>
            </tr>
            <tr>
                <td>
                    <p style="font-family:Candara;font-size:30px;">Create Password:</p>
                </td>
                <td><input type="password" name="createpassword" /></td><br>
            </tr>
            <tr>
                <td>
                    <p style="font-family:Candara;font-size:30px;">Confirm Password:</p>
                </td>
                <td><input type="password" name="confirmpassword" /></td><br>
            </tr>
        </table>
        <button name="registration" method="POST">Submit</button>
        <button onclick="reset()">Reset</button>
        <?php
        if (isset($_POST['registration'])) {
            $user = $_POST['username'];
            $ph = $_POST['contactnumber'];
            $pass = $_POST['createpassword'];
            $con_pass = $_POST['confirmpassword'];
            $duplicate = mysqli_query($conn, "SELECT * FROM `login` WHERE `user` LIKE '$user'");
            if (mysqli_fetch_assoc($duplicate) > 0) {
                echo '<script>
                        alert("User Name already existed !!");
                        </script>';
            } else {
                if ($pass == $con_pass) {
                    $query = "INSERT INTO `login` (`user`, `phone`, `pass`) VALUES ('$user', '$ph', '$pass')";
                    $res = mysqli_query($conn, $query);
                    if ($res) {
                        echo '<script>
                            alert("You have successfully registered !!");
                        </script>';
                    }
                } else {
                    echo '<script>
                            alert("Password does not matched");
                        </script>';
                }
            }
        }
        ?>
        </form>
    </center>
    <script>
        document.getElementById("myForm").reset();
    </script>
    <script>
        document.getElementById("Form").reset();
    </script>
    <footer>
    <hr>
    <span>&copy;Vignan University</span>
    <hr>
    </footer>
</body>

</html>