<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //include_once './ketnoicsdl.php';
        require_once './ketnoicsdl.php';

        $sql = "SELECT CategoryID,CategoryName,Description FROM categories";
        $result = mysqli_query($conn, $sql);

        ?>

        <table border="1">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>    
                        <tr>
                            <td><?= $row["CategoryID"] ?></td>
                            <td><?= $row["CategoryName"] ?></td>
                            <td><?= $row["Description"] ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "0 results";
                }
                mysqli_close($conn);
                ?>      
            </tbody>
        </table>

    </body>
</html>
