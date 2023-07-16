<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/admin.css">
    <title>Home</title>
</head>

<body>

    <div class="container-fluid">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12 px-4  AdminWorkOptions">
                            <div class="row gy-3">
                                <div class="col-6">
                                    <button onclick="student();" class="py-2 px-3 fw-bold my-auto w-100">Student</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="teacher();" class="py-2 px-3 fw-bold my-auto w-100">Teacher</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="academic();" class="py-2 px-3 fw-bold my-auto w-100">Academic</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="homepage.js"></script>
</body>

</html>