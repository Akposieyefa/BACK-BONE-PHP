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
    <?php include_once( ROOT_PATH . '/layouts/inc/nav.inc.php');?>
    <main>
        <div class="container-fluid">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                            if (isset($_GET['del'])) {
                                $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['del']);
                                $delDetail = Contact::delContactById($id);
                                if ($delDetail){
                                    echo $delDetail;
                                }
                            }

                        ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                                $getContact = Contact::getAllContact();
                                $i = 0;
                                if (is_array($getContact) || is_object($getContact)) {
                                    foreach($getContact as $key => $value) {
                                        $id       = htmlentities($value["id"]);
                                        $name     = htmlentities($value["name"]);
                                        $email    = htmlentities($value["email"]);
                                        $subject  = htmlentities($value["subject"]);
                                        $i ++;
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $i;?> </td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $email;?></td>
                                        <td><?php echo $subject;?></td>
                                        <td>
                                            <span>
                                              <a class="btn btn-info btn-sm" href="complain-show.php?id=<?php echo  $id;?>"> <i class="fa fa-eye"></i></a>
                                            </span>
                                            <span>
                                              <a class="btn btn-primary btn-sm" href="complain-show.php?id=<?php echo  $id;?>"> <i class="fa fa-edit"></i></a>
                                            </span>
                                            <span>
                                              <a onclick="return confirm('Are you sure you want to delete this...?')" href="?del=<?php echo $id; ?>" class="btn btn-danger btn-sm"> <i  class="fa fa-trash"></i></a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                    <?php
                                }
                            } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>