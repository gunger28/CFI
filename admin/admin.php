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
    <input style="background-color: rgb(255, 95, 95); width: 60px; height: 30px" type="button" id="exit" value="Exit" class="exit">
    <form action="" method="post" class="forma">
        <input id="id" name="id" placeholder="id"> </input>
        <input id="parent" name="parent" placeholder="parent"> </input>
        <input id="name" name="name" placeholder="name"> </input>
        <input id="description" name="description" placeholder="description"> </input>
        <button style="background-color: rgb(100, 187, 0);" type="submit" name="action" value="append"> append</button>
        <button style="background-color: rgb(161, 51, 0);" type="submit" name="action" value="delete"> delete</button>
        <button style="background-color: rgb(0, 85, 155);;" type="submit" name="action" value="edit"> edit</button>
    </form>
    <div class="centreMain">

        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST["action"] == "delete") {
                deleteObject($_POST["id"]);
            }

            if ($_POST["action"] == "append") {
                appendObject($_POST["parent"], $_POST["name"], $_POST["description"]);
            }

            if ($_POST["action"] == "edit") {
                editObject($_POST["id"], $_POST["parent"], $_POST["name"], $_POST["description"]);
            }
        }

        $query_prod = 'SELECT              
id,
parent,
name,
description
FROM objects';

        $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
        $result =  mysqli_query($con, $query_prod);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo "<div class=\"crosser\"> 
        <div class=\"infoTable\">
        <div class=\"id\">id-par</div> 
        <div class=\"name\">name / description</div>
        <div class=\"dbInfo\">Current DB</div>
        </div>
        ";
        foreach ($rows as $row) {
            echo

            "<div class=\"dataLine\"> <div class=\"dataID\">"
                . $row['id'] .
                "-" . $row['parent'] .
                " </div> " . $row['name'] .
                " / " . $row['description'] .
                "</div>";
        }
        echo "</div>";

        function treeDesider($objects)
        {
        }

        $tree = form_tree($rows);
        echo build_tree($tree, 0);

        function form_tree($dataDB)
        {
            if (!is_array($dataDB)) {
                return false;
            }
            $tree = array();
            foreach ($dataDB as $value) {
                $tree[$value['parent']][] = $value;
            }
            return $tree;
        }

        //$parent - айдишник родителя / корень считается 0 (БД)
        function build_tree($cats, $parent_id)
        {
            if (is_array($cats) && isset($cats[$parent_id])) {
                $tree = '<ul class="treePlane">';
                foreach ($cats[$parent_id] as $cat) {
                    $tree .= '<li class="line">';
                    $tree .= '<div class="allData"><div class="idBlock">' . $cat['id'] . '</div>';
                    $tree .= '<div class="infoBlock">' . $cat['name'] . ' (' . $cat['description'] . ')</div></div>';
                    $tree .= build_tree($cats, $cat['id']);
                    $tree .= '</li>';
                }
                $tree .= '</ul>';
            } else {
                return false;
            }
            return $tree;
        }

        function deleteObject($id)
        {
            $query_prod = 'delete from objects where id = ' . $id . '';
            $query_child = 'delete from objects where parent = ' . $id . '';
            $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
            $result =  mysqli_query($con, $query_prod);
            $result =  mysqli_query($con, $query_child);
        }

        function appendObject($parent, $name, $description)
        {
            $query_prod = "insert into objects(parent,name,description) values('$parent','$name','$description') ";
            $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
            $result =  mysqli_query($con, $query_prod);
        }

        function editObject($id, $parent, $name, $description)
        {
            $query_prod = "update objects set parent='$parent', name='$name', description='$description' where id = '$id' ";
            $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
            $result =  mysqli_query($con, $query_prod);
        }
        ?>

    </div>
    <script src="../js/admin.js"></script>
</body>

</html>