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
        <div class="container py-5">
            <form class="row g-3" id="form" method="post">
                <div class="col-md-6">
                    <label for="fname" class="form-label">first name</label>
                    <input type="text" name="firstname" class="form-control" id="fname">
                </div>
                <div class="col-md-6">
                    <label for="lname" class="form-label">last name</label>
                    <input type="text" name="lastname" class="form-control" id="lname">
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">email</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>

                <div class="col-12 my-3">
                    <button type="submit" name='submit' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Submit</button>

                </div>
            </form>
            <A href="view.php" class="my-3"> <button type="button" class="btn btn-success">view data</button></A>
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
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
        <script>
            form.onsubmit = async (e) => {
                const fname = document.querySelector("#fname").value;
                const lname = document.querySelector("#lname").value;
                const email = document.querySelector("#email").value;
                if (fname == "" || lname == "") {
                    document.getElementById('modalbody').innerHTML = `Name can not empty`;
                    e.preventDefault()

                } else if (email == "" || !email.includes('@') || !email.includes('.')) {
                    document.getElementById('modalbody').innerHTML = `Please enter a valid email`;
                    e.preventDefault()
                } else {

                    e.preventDefault()
                    let response = await fetch("form.php?req=insert", {
                        method: 'POST',
                        body: new FormData(form)
                    });
                    let result = await response.text();
    
                    document.getElementById('modalbody').innerHTML = result;

                }
            }
        </script>

</body>

</html>