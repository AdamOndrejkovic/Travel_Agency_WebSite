<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Travelers</title>
    <link rel="stylesheet" href="css/home.css">
    <meta name="viewport" content="width=device-width">
    <!-- Including extern file jquery/ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Top content changer -->
    <script>
        $(function() {
            $("#tabs a").click(function() {
                var page = this.hash.substr(1);
                $.get(page + ".php", function(gotHtml) {
                    $("#top-content").html(gotHtml)
                });
                return false;
            });
        });

    </script>
    <!-- Trips content changer -->
    <script>
        $(function() {
            $("#trips-tabs a").click(function() {
                var page = this.hash.substr(1);
                $.get(page + ".php", function(gotHtml) {
                    $("#trips-content").html(gotHtml)
                });
                return false;
            });
        });

    </script>
    <!-- Navbar visibility changer -->
    <script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "-100px";
            }
            prevScrollpos = currentScrollPos;
        }

    </script>
</head>

<body>
    <!-- Responsive menu -->
    <div class="header">
        <div class="navbar" id="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="">
            </div>
            <a class="btn">
                <span></span>
                <span></span>
                <span></span>
            </a>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="about-us.php">About</a>
                <a href="trips.php">Trips</a>
                <a href="blog.php">Blog</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </div>
    <!-- Connection file for whole project -->
    <?php
         $conn = false;
         $file='./connection.php';
         if(file_exists($file)) {include($file);}
         ?>
