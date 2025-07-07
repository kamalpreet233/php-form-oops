<?php
require_once "form.php";
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
    <?php

    $obj = new \form\formdata();
    $id = $_GET['id'];
    $all_id=[];
    $i=0;
    $res = $obj->conn->query('select id from emptab;');
    while($row = mysqli_fetch_array($res)){
        $all_id[$i] = $row['id'];
        $i++;
    }
   ?>
   <?php
   if(in_array($id,$all_id)){
        
    $res = $obj->fetchdatasingle($id);
    $row = mysqli_fetch_array($res)
    ?>
    <div class="container-fluid">
        <div class="container py-5">
            <form class="row g-3" method="post" id="form">
                <div class="col-md-6">
                    <label for="fname" class="form-label">first name</label>
                    <input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname']; ?>" id="fname">
                </div>
                <div class="col-md-6">
                    <label for="lname" class="form-label">last name</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo $row['lastname']; ?>" id="lname">
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>" placeholder="Apartment, studio, or floor">
                </div>

                <div class="col-12">
                    <button type="submit" name='update' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">update</button>
                </div>
                <input type="hidden" id="id" value="<?php echo $row['id'] ?>">
            </form>
            <A href="view.php"> <button type="button" class="btn btn-success">view data</button></A>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pop Up</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modalbody">
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           
                        </div>
                    </div>
                </div>
            </div>

        </div>



        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
        <script>
            const fname = document.querySelector("#fname").value;
            const lname = document.querySelector("#lname").value;
            const email = document.querySelector("#email").value;
            const param1 = document.getElementById('id').value;
            form.onsubmit = async (e) => {

                if (fname == "" || lname == "") {
                    document.getElementById('modalbody').innerHTML = `Name can not empty`;
                    e.preventDefault()
                  
                } else if (email == "" || !email.includes('@') || !email.includes('.')) {
                    document.getElementById('modalbody').innerHTML = `Name can not empty`;
                    e.preventDefault()
                   
                } else {
                    e.preventDefault()
                    let response = await fetch(`form.php?id=${param1}&req=update`, {
                        method: 'POST',
                        body: new FormData(form)
                    });
                    let result = await response.text();

                    document.getElementById('modalbody').innerHTML = result;
                }
            }
        </script>
</body>

<?php
}
else{
    echo "unknown id";
}
?>
</html>