<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once './ketnoicsdl.php';
        $sql = "Select RegionID,RegionDescription from region";
        $result = mysqli_query($conn, $sql);
        
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>RegionID</th>
                    <th>RegionDescription</th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>    
                        <tr>
                            <td><?= $row["RegionID"] ?></td>
                            <td><?= $row["RegionDescription"] ?></td>                            
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
