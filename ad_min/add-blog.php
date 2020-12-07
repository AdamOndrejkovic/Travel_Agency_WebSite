<?php
//session start
session_start();
$err = '';
if (isset($_SESSION['adminid']))
{
    $content = '<a href="blog.php">Back</a>
         <h2>Add a blog</h2>';
    //check the request method
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //proccess the form
        if ($_POST['title'] && $_POST['text'] && $_POST['author'])
        {

            //proccess and save the name
            $uploadname = $_FILES['userfile']['name'];
            if ($uploadname != '')
            { // check the format
                if (($_FILES["userfile"]["type"] == "image/pjpeg") || ($_FILES["userfile"]["type"] == "image/jpeg"))
                {
                    $conn = false;
                    $file = '../connection.php';
                    if (file_exists($file))
                    {
                        include ($file);
                    }
                    if ($conn)
                    {
                        //assign the data to the variables
                        $title = stripslashes($_POST['title']);
                        $title = htmlspecialchars($title);
                        $text = stripslashes($_POST['text']);
                        $text = htmlspecialchars($text);
                        $author = stripslashes($_POST['author']);
                        $author = htmlspecialchars($author);

                        try
                        {
                            //try and insert
                            $res = $conn->prepare("INSERT INTO blog ( author, date, title, text)
                                      VALUES ( ?, NOW(), ?, ?)");
                            $res->execute(array(
                                $author,
                                $title,
                                $text
                            ));
                            $last_id = $conn->lastInsertId();
                            //save the photo
                            $uploadname = $last_id . '.JPG';
                            if (is_uploaded_file($_FILES['userfile']['tmp_name']))
                            {
                                move_uploaded_file($_FILES['userfile']['tmp_name'], "../img/blog/$uploadname");
                                //if all is checked and proccessed redirect
                                $err = "OK";
                                header("Location:blog.php");
                            }
                            else
                            {
                                //Photo couldn't be saved
                                $err .= '<p>The picture could not be saved.</p>';
                            }
                        }
                        catch(Exception $e)
                        {
                            //error message
                            $err .= '<p>Something went wrong. The text was not saved.</p>';
                        }
                    }
                    else
                    {
                        $err .= '<p>Something went wrong.</p>';
                    }
                }
                else
                { //wrong data type
                    $err = '<p>Wrong type of picture!';
                    $err .= '<br />You can upload only jpeg!</p>';
                }
            }
        }
        else
        { //some field left empty
            $err = '<p>You have to fill all the fields in.</p>';
        }
    }
    else
    {
    }
    //create the form
    $content .= $err . '<form method="post" enctype="multipart/form-data">
          <p>
          <label>Title:</label> <input type="text" name="title" size="30" /><br />
          <label>Foto:</label> <input type="file" name="userfile" size="40" /><br />
          <label>Author:</label> <input type="text" name="author" size="30" /><br />
          <label>Text:</label> <br /><textarea rows="10" cols="50" name="text"></textarea>
          <br /><br /> <br /><br />
          <input type="submit" value="Add" /></p>
          </form>';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="iso-8859-1">
    <title>Add blog</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <div id="add-blog-box">
        <?php
    //show the page
    echo $content; ?>
    </div>
</body>

</html>
<?php
}
else
{
    echo '<p>No access</p>';
}
?>
