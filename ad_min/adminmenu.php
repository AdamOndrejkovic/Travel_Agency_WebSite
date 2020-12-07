<?php
session_start();
//logged in as an admin
if(isset($_SESSION['adminid']))
{
//timeout for the admin session
$file='./timeout.php';
if(file_exists($file)) {include($file);}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>TravelesAdmin
    </title>
    <link rel="stylesheet" type="text/css" href="admin.css" />
</head>

<body>
    <div id="menu-box">
        <div id="menu">
            <!-- Admin menu --->
            <h1>Travelers
                <br>
                <span> Admin
                </span>
            </h1>
            <ul>
                <li>
                    <a href="adminmenu.php">Main Menu
                    </a>
                </li>
                <li>
                    <a href="trips-overview.php" target="iframe">Trips
                    </a>
                </li>
                <li>
                    <a href="trips-pricing.php" target="iframe">Trips Pricing
                    </a>
                </li>
                <li>
                    <a href="trips-top.php" target="iframe">Trips Rating
                    </a>
                </li>
                <li>
                    <a href="client.php" target="iframe">Client
                    </a>
                </li>
                <li>
                    <a href="blog.php" target="iframe">Blog
                    </a>
                </li>
                <li>
                    <a href="forum.php" target="iframe">Forum
                    </a>
                </li>
                <li>
                    <a href="newsletter.php" target="iframe">Newsletter
                    </a>
                </li>
                <li>
                    <a href="support.php" target="iframe">Support
                    </a>
                </li>
                <li>
                    <a href="../index.php" target="_blank">Home
                    </a>
                </li>
                <li>
                    <a href="logout.php">Log off
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="iframe-box">
        <iframe src="" frameborder="0" name="iframe" id="iframe-window">
        </iframe>
    </div>
</body>

</html>
<?php
}
else
{
//no access to the admin or timeout
echo "Access denied!!! </br>";
}
?>
