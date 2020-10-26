<?php
include ("path.php");
    include_once(ROOT_PATH . '/bootstrap/bootstrap.php');
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Contact</title>
		<link href="layouts/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="layouts/bootstrap/fonts/css/font-awesome.min.css" rel="stylesheet" />
	</head>
<body>
<br><br>
        <div id="layoutSidenav_content">
            <?php include_once('layouts/inc/nav.inc.php');?>
            <main>
                <div class="container-fluid">
                    <div class="card mb-4">
                        <div class="card-body col-md-8 offset-2">
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_submit'])) {
                                    $cnt = Contact::contactCreate($_POST);
                                }
                            ?>
                            <form action="" method="POST">
                                <?php
                                    if (isset($cnt)) {
                                        echo $cnt ;
                                    }
                                ?>
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control form-control-lg" id="name" placeholder="Enter Name" name="name"/>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="email" class="form-control form-control-lg" id="email" placeholder="Enter Email-Address" name="email"/>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subject">Subject</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-legal"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" id="subject" placeholder="Enter Subject Matter" name="subject" />
                                    </div>
                                </div>
                                <label for="haddress">Message</label>
                                <textarea class="form-control" rows="5"  name="message" placeholder="Enter Message" id="message" name="message" /></textarea>
                                <br/>
                                <button class="btn btn-lg btn-block btn-success" type="submit"  name="contact_submit">Send</button>
                            </form>

                        </div>
                    </div>
                </div>
            </main>
        </div>

		<script src="layouts/bootstrap/jquery.js" type="text/javascript"></script>
		<script src="layouts/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
		<script src="layouts/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
