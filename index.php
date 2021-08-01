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
    <div class="centreMain">

        <?php
        $query_prod = 'SELECT              
id,
parent,
name,
description
FROM objects';

        $con =  mysqli_connect("localhost", "a316809_1", "mayakavangard", "cfi");
        $result =  mysqli_query($con, $query_prod);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

        function build_tree($cats, $parent_id)
        {
            if (is_array($cats) && isset($cats[$parent_id])) {
                $tree = '<ul>';
                foreach ($cats[$parent_id] as $cat) {
                    $tree .= '<li class="line">';
                    $tree .= '<div class="allData"><div class="idBlock">' . " - " . '</div>';
                    $tree .= '<span class="infoBlock" title="' . $cat['description'] . '">' . $cat['name'] . '</span></div>';
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

    </div>
    <script src="./js/index.js"></script>
</body>

</html>