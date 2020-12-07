<?php
//session start
session_start();
if (!isset($_SESSION['adminid']))
{
    // not logged in
    $content = 'No access</br>';
}
else
{
    //get the parameter from the url
    $id = (int)$_GET['id'];

    //make connection
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if ($conn)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //proccess the form
            if ($_POST['title'] && $_POST['text'] && $_POST['author'])
            {
                //assign the fields to the variables
                $title = stripslashes($_POST['title']);
                $title = htmlspecialchars($title);
                $text = stripslashes($_POST['text']);
                $text = htmlspecialchars($text);
                $author = stripslashes($_POST['author']);
                $author = htmlspecialchars($author);
                try
                {
                    //update the database
                    $res = $conn->prepare("UPDATE blog SET title = ?, text = ?, author = ?
                                   WHERE blogid = ?");
                    $res->execute(array(
                        $title,
                        $text,
                        $author,
                        $id
                    ));
                    header("Location:show-blog.php?id=" . $id);
                }
                catch(Exception $e)
                {
                    //error
                    $content = '<p>Something went wrong !!</p>';
                }
            }
            else
            {
                //some fields not filled in
                $content = '<p>You need to filled all the fields in !!</p>';
            }
        }
        else
        {
            //sql command
            $sql = "SELECT * FROM blog WHERE blogid = " . $id;
            $res = $conn->query($sql);
            $aantal = $res->rowCount();
            if ($aantal == 0)
            {
                //error
                $content = '<p>Nothing was found !!</p>';
            }
            else
            {
                $row = $res->fetch();
                $title = htmlentities($row['title']);
                $text = htmlentities($row['text']);
                $author = htmlentities($row['author']);
                //create the content for the page
                $content = '
          <form method="post">
          <p>
          <label>Titel:</label> <br>
          <input type="text" name="title" size="50" value="' . $title . '"><br>
           <label>Author:</label> <br>
           <input type="text" name="author" size="50" value="' . $author . '"><br>
          <label>Blog text:</label><br>
          <textarea rows="10" cols="50" name="text">' . $text . '</textarea>
          <br><br><br><br>
          <input type="submit" value="Edit"></p>
          </form>';
            }
        }
    }
    else
    {
        $content = '<p>Can not connect to the database.</p>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit blog</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="edit-blog-box">
        <a href="blog.php">Back</a>
        <h2> Edit blog</h2>
        <?php
//show the page
echo $content; ?>
    </div>
</body>

</html>
