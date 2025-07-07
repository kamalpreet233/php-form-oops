<?php
require "form.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>first name</th>
                        <th>last name</th>
                        <th>email</th>
                        <th> action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $obj = new \form\formdata();
                    $res=$obj->fetchdata();
                    while($row=mysqli_fetch_array($res)){
                    ?>
                    <tr>
                        <td><?php echo $row['id']?></td>

                        <td><?php echo $row['firstname']?></td>
                        <td><?php echo $row['lastname']?></td>
                        <td><?php echo $row['email']?></td>
                        <td>
                            <a href="dlt.php?id=<?php echo $row['id'];?>"> delete records</a>
                        
                            <a href="edit.php?id=<?php echo $row['id'];?>"> update records</a>
                        </td>

                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <A href="index.php"> <button type="button" class="btn btn-danger">insert data</button></A>
        </div>

    </div>
</body>
</html>