<?php
//create_cat.php
include 'connect.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //the form hasn't been posted yet, display it
    echo '<form method='post' action=''>
        Category name: <input type='text' name='cat_name' />
        Category description: <textarea name='cat_description' /></textarea>
        <input type='submit' value='Add category' />
     </form>';
}
else
{
    //the form has been posted, so save it
    $sql = ìINSERT INTO categories(cat_name, cat_description)
       VALUES('' . mysql_real_escape_string($_POST['cat_name']) . ì',
             '' . mysql_real_escape_string($_POST['cat_description']) . ì')';
    $result = mysql_query($sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error' . mysql_error();
    }
    else
    {
        echo 'New category successfully added.';
    }
}
?>