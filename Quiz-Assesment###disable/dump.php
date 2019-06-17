<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="icon" href="images/logo.png" type="image/png" sizes="64x64">
</head>
<body class="wrapper">
    <div >
        <header>
            <div class="container">
                <a href="index.html" class="logo"><img src="images/logo.png" alt="" /></a>
            </div>
        </header>
        <div class="container">
            <div class="form-wrp">
                <div class='row'>
                    <div class='col-md-4'></div>
                    <div class='col-md-4'>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <a data-toggle="" data-target="" aria-expanded="" aria-controls="">
                                    <h4 class="heading" style='padding:0px;text-align:center'> Dump Download </h4>
                                </a>
                            </h5>
                            </div>
                            <div class="card-body">
                                <form action="./dump_function.php" method="post">
                                    <div class="form-group">
                                        <label for="from_date">From Date:</label>
                                        <input type="date" class="form-control" id="from_date" name="from_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="to_date">To Date:</label>
                                        <input type="date" class="form-control" id="to_date" name="to_date">
                                    </div>
                                    <center><button type="submit" name='download' class="btn btn-success">Download</button></center>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-4'></div>
                </div>
            </div>
         </div>
    </div>

    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/jquery-3.2.1.slim.min.js"></script> -->
    <script type="text/javascript">
    
    </script>
</body>
</html>