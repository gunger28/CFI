<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../Style/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="button" id="exit" value="Exit">
<form action="" method="post">
    <input id="id" name="id"  placeholder="id"> </input>
    <input id="parent" name="parent" placeholder="parent"> </input>
    <input id="name" name="name"  placeholder="name"> </input>
    <input id="description" name="description"  placeholder="description"> </input>
<button  type="submit" name="action" value="delete"> delete</button>
<button  type="submit" name="action" value="append"> append</button>
<button  type="submit" name="action" value="edit"> edit</button>
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
     print_r($_POST);
print_r($_POST["id"]);
print_r($_POST["action"]);
print_r($_POST["idEdit"]);
    if ($_POST["action"] == "delete")
    {
        deleteObject($_POST["id"]);
    }

    if ($_POST["action"] == "append")
    {
      appendObject($_POST["parent"],$_POST["name"],$_POST["description"]);
    }

    if ($_POST["action"] == "edit")
    {
       editObject($_POST["id"],$_POST["parent"],$_POST["name"],$_POST["description"]);
    }
} 

// echo "<form class=\"form\" id=\"form\"";
$query_prod = 'SELECT              
id,
parent,
name,
description
FROM 
objects';

$con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
       
        $result =  mysqli_query($con, $query_prod);
       
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo "<div class=\"crosser\">" ;
        foreach ($rows as $row) { 
            echo

                "<div>" 
                . $row['id'] .
                "-" . $row['parent'] .
                " " . $row['name'] .
                " " . $row['description'] .
                "</div>";
               
        }
        echo "</div>" ;

        function treeDesider($objects){


        }

        $tree = form_tree($rows);
        echo build_tree($tree, 0);  
        
        function form_tree($mess)
{
    if (!is_array($mess)) {
        return false;
    }
    $tree = array();
    foreach ($mess as $value) {
        $tree[$value['parent']][] = $value;
    }
    return $tree;
}

//$parent - айдишник родителя / корень считается 0 (БД)
function build_tree($cats, $parent_id)
{
    if (is_array($cats) && isset($cats[$parent_id])) {
        $tree = '<ul>';
        foreach ($cats[$parent_id] as $cat) {
            $tree .= '<li class="line"> ' . $cat['id'] . " << " . $cat['description'] . ">>" . '<input class="button" type="button" value="edit" id='. $cat['id'] .' name=' . $cat['id'] . '">';
            $tree .= build_tree($cats, $cat['id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
    } else {
        return false;
    }
    return $tree;
}


function deleteObject($id){
    $query_prod = 'delete from objects where id = '. $id .'';
    $query_child = 'delete from objects where parent = '. $id .'';

    $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
       
        $result =  mysqli_query($con, $query_prod);
        $result =  mysqli_query($con, $query_child);

echo "deleted";
}
// appendObject(7,'lol','kek');

function appendObject($parent,$name,$description){
    $query_prod = "insert into objects(parent,name,description) values('$parent','$name','$description') ";

    $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
       
        $result =  mysqli_query($con, $query_prod);
        // header("refresh");
// echo "appended";
}

function editObject($id,$parent,$name,$description){
    $query_prod = "update objects set parent='$parent', name='$name', description='$description' where id = '$id' ";

    $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
       
        $result =  mysqli_query($con, $query_prod);
        // header("refresh");
// echo "appended";
}




?>
<!-- </form> -->
<script src="../js/admin.js"></script>
</body>
</html>