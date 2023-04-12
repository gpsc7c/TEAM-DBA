<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/registyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="./js/registration.js"></script>-->
    <style>
        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }
        input:required:invalid {
            background-color: lightyellow;
        }
        select:required:invalid {
            background-color: lightyellow;
        }
    </style>
</head>
<body>
<?php
include 'inputvalidation.php';
?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="container wrapper">
            <div class="wrapper">
                <div id="menubar">
                    <header>
                        <nav>
                            <img src="./img/774FNS.JPG" alt="Logo" style="left: 0; float:left; width: 100px; overflow: auto">
                            <ul>
                                <button><li class="menuitem"><a href="index.php">Home</a></li></button>
                                <button><li class="menuitem"><a href="registration.php">Registration</a></li></button>
                                <button><li class="menuitem"><a href="animations.php">Animations</a></li></button>
                            </ul>
                        </nav>
                    </header>
                </div>
            </div>
        </div>
    </div>
</nav>

<!--onsubmit="return mySubmitFunction(event)"-->

<div class="col-sm-9">
    <div id="main">
        <h1>Thank you for subscribing!</h1>
    </div>
</div>



<div class="container wrapper">
    <div class="wrapper">
        <div id="footer">
            <nav>
                <ul>
                </ul>
            </nav>
        </div>
    </div>
</div>


</body>
</html>