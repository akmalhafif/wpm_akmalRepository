<?php
    require 'function.php';
    require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kelola Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">akmalhafif_</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        
                        <div class="nav">
                          
                        <a class="nav-link" href="index.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
</svg>&nbsp;
                                Stok Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
</svg>&nbsp;
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
</svg>&nbsp;
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="admin.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>&nbsp;
                                Kelola Admin
                            </a>
                            <a class="nav-link" href="logout.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
</svg> &nbsp;                              
                                Logout
                            </a>
                        </div>

                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        akmalhafif_
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Kelola Admin</h1>                  
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Admin </button>
                            
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Email Admin</th>
                                                <th>Aksi</th>

                                            </tr>
                                        </thead>
                                        
                                        <tbody>


                                            <?php

                                            $ambilsemuadataadmin = mysqli_query($conn, "select * from login");
                                            $i = 1;
                                            while($data=mysqli_fetch_array($ambilsemuadataadmin)){
                                                $em = $data['email'];
                                                $iduser = $data['iduser'];
                                                $pw = $data['password'];

                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$em;?></td>
                                                
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$iduser;?>">Edit</button>
                                                
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$iduser;?>">Deleted</button>
                                                </td>
                                            </tr>

                                            <!-- edit Modal -->
                                            <div class="modal fade" id="edit<?=$iduser;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                
                                                    <!-- Modal body -->
                                                    <form method = "post">
                                                        <div class="modal-body">
                                                        <input type="email" name="emailadmin" value="<?=$em;?>" class="form-control"placeholder="Email" required>
                                                        <br>
                                                        <input type="password" name="passwordbaru" class="form-control"value="<?=$pw;?>"placeholder="Password">
                                                        <br>
                                                        <input type="hidden" name="id" value="<?=$iduser;?>">
                                                        <button type="submit" class="btn btn-primary" name="updateadmin">Submit</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>

                                            <!-- delete Modal -->
                                            <div class="modal fade" id="delete<?=$iduser;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang?</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                
                                                    <!-- Modal body -->
                                                    <form method = "post">
                                                        <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <?=$em;?>?
                                                        <input type="hidden" name="id" value="<?=$iduser;?>">

                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                                </div>
                                            </div>
                                            
                                            <?php
                                            
                                            };
                                            

                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy;akmalhafif_</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
            <!-- Modal body -->
            <form method = "post">
                <div class="modal-body">
                <input type="email" name="email" placeholder="Email" class="form-control" required>
                <br>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
                <br>
               
                <button type="submit" class="btn btn-primary" name="addadmin">submit</button>
                </div>
            </form>
            
            </div>
        </div>
    </div>
</html>
