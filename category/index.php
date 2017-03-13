<?php
    include '../connection/hadoopqaconnection.php';

//    $sql = "select * from " . $tblCategory . " where parent_id is NULL";
    $sql = "select * from " . $tblCategory;
    $res = mysql_query($sql);

    // Getting complete categories and storing it in an array
    while ($rowArray = mysql_fetch_array($res)) $arrCategory[ $rowArray['id'] ] = $rowArray['name'];

    // Resetting the row pointer
    mysql_data_seek($res, 0);

    // Check for category already exists, if so don't insert
    if( isset($_POST['name']) ) {

        if( isset($_POST['recordId']) ){

            $name = $_POST['name'];
            $catId = ($_POST['categoryId'] == 0)?NULL:$_POST['categoryId'];

            $sqlUpdate = "update " . $tblCategory . " set name='" . $name . "', parent_id=" . $catId . " where id = " . $_POST['recordId'];
            mysql_query( $sqlUpdate );

            header("location:.");
        } else {
            $name = $_POST['name'];
            $parent_id = ($_POST['categoryId'] == 0)?'NULL':$_POST['categoryId'];

            $sqlCheck = "select * from " . $tblCategory . " where name = '" . $name . "' and parent_id = " . $parent_id;

            if(mysql_num_rows($data) != 0) {
                $sqlInsert = "Insert into " . $tblCategory . "(`name`, `parent_id`, `isactive`) values ('" . $name . "'," . $parent_id . "," . 1 . ")";

                mysql_query($sqlInsert);
            } else {
                echo "Entered category is already exists";
            }
        }

    }

    // Check if record id is exists, if exists get data for editing
    if( isset($_POST['recordId']) ) {
        $sql .= " where id = " . $_POST['recordId'];

        /*echo '--->';
        echo $_POST['recordId'];
        echo '<---';*/

        $result = mysql_query( $sql );

        $dataRecord  = mysql_fetch_assoc($result);
    }

?>
<html>
    <head>
        <title>Category :: NPN Training</title>
    </head>
<body>
    <table border="1" width="90%">
        <tr>
            <td>
                <form action='.' method="POST">
                    <table border="1" width="100%">
                        <tr>
                            <td colspan="2"><h2 align="center">Category</h2></td>
                        </tr>
                        <tr>
                            <td>Parent Category</td>
                            <td>
                                <select name="categoryId" id="categoryId">
                                    <option value="0" <?=(isset($_POST['recordId']) && $dataRecord['parent_id'] == NULL)?'selected="selected"':''; ?>>Parent Category</option>
                                    <?php while ($row = mysql_fetch_array($res)): ?>
                                        <?php if( $row['parent_id'] == NULL ): ?>
                                            <option value="<?=$row['id']; ?>" <?=(isset($_POST['recordId']) && $dataRecord['parent_id'] == $row['id'])?' selected="selected"':''; ?>><?=$row['name']; ?></option>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Category Name</td>
                            <td><input type="text" name="name" id="name" value="<?=(isset($_POST['recordId']))?$dataRecord['name']:''; ?>" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" name="recordId" id="recordId" value="<?=(isset($_POST['recordId']))?$_POST['recordId']:''; ?>">
                                <input type="submit" value="<?=(isset($_POST['recordId']))?'Update Category':'Add Category'; ?>">
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
            <td>

                    <table border="1">
                        <tr>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Parent Category</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        <?php
                            // Resetting the row pointer
                            mysql_data_seek($res, 0);

                            while ($row = mysql_fetch_array($res)):
                        ?>
                        <tr>
                            <form action='.' method="POST">
                                <td><?=$row['id']; ?></td>
                                <td><?=$row['name']; ?></td>
                                <td><?=($row['parent_id'] == "")?"Parent Category":$arrCategory[ $row['parent_id'] ]; ?></td>
                                <td><?=($row['isactive'] == 1)?"Active":"Deactive"; ?></td>
                                <td>
                                    <input type="hidden" name="recordId" id="recordId" value="<?=$row['id']; ?>">
                                    <input type="submit" value="Edit">
                                </td>
                            </form>
                        </tr>
                        <?php endwhile; ?>
                    </table>

            </td>
        </tr>
    </table>
</body>
</html>