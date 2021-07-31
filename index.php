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
<div class='info'>Description</div>
<div class='infoViewer' id="descDiv"></div>
<?php



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
            $tree .= '<li class="line" title=' . $cat['description'] . '>' . " - " . $cat['name'] . "  " . '<input class="button" type="button" value="+" id='. $cat['id'] .' name=' . $cat['id'] . '">';
            $tree .= build_tree($cats, $cat['id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
    } else {
        return false;
    }
    return $tree;
}


?>
    <script src="./js/index.js"></script>
</body>
</html>