<?php
    session_start();
    
    //membuat koneksi ke database
    $conn = mysqli_connect("localhost","root","","stokbarang");

    //menambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang  = $_POST['namabarang'];
    $Deskripsi  = $_POST['deskripsi'];
    $stok      = $_POST['stok'];
    
//soal gambar
$allowed_extansion = array('png','jpg');
$nama = $_FILES['file']['name'];//ngambil gambar
$dot = explode('.',$nama);
$ekstensi = strtolower(end($dot));//mengembil exstensinya
$ukuran = $_FILES['file']['size'];//ngambil file sizenya
$file_tmp = $_FILES['file']['tmp_name'];//ngambil lokasi file

//penamaan file -> enkripsi
$image = md5(uniqid($nama,true). time()).'.'.$ekstensi;//menggabungkan nama file yang di enkripsi dgn ektesinya

//validasi udah atau belum
$cek = mysqli_query($conn,"select * from stok where namabarang='$namabarang'");
$hitung = mysqli_num_rows($cek);

if($hitung<1){
    //jika belum ada
  
    //proses upload gambar
    if(in_array($ekstensi,$allowed_extansion) === true){

        //validasi ukuran file
        if($ukuran < 15000000){
            move_uploaded_file($file_tmp,'images/'.$image);

                $addtotable = mysqli_query($conn,"insert into stok(namabarang, deskripsi, stok, image)values('$namabarang','$Deskripsi','$stok','$image')");
                if($addtotable){
                    echo 'berhasil';
                    header('location:index.php');
            
                }else{
                    echo'gagal';
                    header('location:index.php');
                }
        }else
        //kalau filenya lebih dari 1.5mb
        echo'
        <script>
            alert("Ukuran file terlalu besar!");
            window.location.href="index.php";
            </script>
            ';
    }else{
        //kalau filenya tidak png/jpg
        echo'
        <script>
            alert("File harus Png atau Jpg");
            window.location.href="index.php";
            </script>
            ';
    }
    
    }else{
        //jika sudah ada
        echo'
        <script>
            alert("Nama barang sudah terdaftar");
            window.location.href="index.php";
            </script>
            ';
    }
};
  
 


    //menambah barang masuk
    if (isset($_POST['barangmasuk'])) {
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];
        

        $cekstoksekarang = mysqli_query($conn,"select * from stok where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstoksekarang);

        $stoksekarang = $ambildatanya['stok'];
        $tambahkanstoksekarangdenganquantity = $stoksekarang+$qty;

        $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima','$qty')");
        $updatestokmasuk = mysqli_query($conn, "update stok set stok='$tambahkanstoksekarangdenganquantity' where idbarang='$barangnya'");
        if ($addtomasuk&&$updatestokmasuk) {
            header('location:masuk.php');
        }else{
            echo 'gagal';
            header('location:masuk.php');
        }
    };


    //menambah barang keluar
    if (isset($_POST['barangkeluar'])) {
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];
        

        $cekstoksekarang = mysqli_query($conn,"select * from stok where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstoksekarang);

        $stoksekarang = $ambildatanya['stok'];

        if($stoksekarang >= $qty){
            //kalau barangnya cukup
        $tambahkanstoksekarangdenganquantity = $stoksekarang-$qty;

        $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
        $updatestokmasuk = mysqli_query($conn, "update stok set stok='$tambahkanstoksekarangdenganquantity' where idbarang='$barangnya'");
        if ($addtokeluar&&$updatestokmasuk) {
            header('location:keluar.php');
        }else{
            echo 'gagal';
            header('location:keluar.php');
        }
    }else{
        //kalau barangnya ga cukup
        echo'
        <script>
            alert("Stock saat ini tidak mencukupi");
            window.location.href="keluar.php";
        </script>
        ';
    }
}


    //update info barang
    if (isset($_POST['updatebarang'])) {
        $idb = $_POST['idb'];
        $namabarang = $_POST['namabarang'];
        $deskripsi = $_POST['deskripsi'];

        //soal gambar
            $allowed_extansion = array('png','jpg');
            $nama = $_FILES['file']['name'];//ngambil gambar
            $dot = explode('.',$nama);
            $ekstensi = strtolower(end($dot));//mengembil exstensinya
            $ukuran = $_FILES['file']['size'];//ngambil file sizenya
            $file_tmp = $_FILES['file']['tmp_name'];//ngambil lokasi file

            //penamaan file -> enkripsi
            $image = md5(uniqid($nama,true). time()).'.'.$ekstensi;//menggabungkan nama file yang di enkripsi dgn ektesinya
        
            if($ukuran==0){
                //jika tidak ingin upload
                $update = mysqli_query($conn, "update stok set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang = '$idb'");
                    if($update){
                        header('location:index.php');
                    }else{
                        echo 'gagal';
                        header('location:index.php');
                    }
            }else{
                //jika ingin upload
                move_uploaded_file($file_tmp,'images/'.$image);
                $update = mysqli_query($conn, "update stok set namabarang='$namabarang', deskripsi='$deskripsi', image='$image' where idbarang = '$idb'");
                    if ($update) {
                        header('location:index.php');
                    }else{
                        echo 'gagal';
                        header('location:index.php');
                    }
            }
        }
    

    //menghapus barang dari stok
    if(isset($_POST['hapusbarang'])){
        $idb = $_POST['idb'];//idbarang

        $gambar = mysqli_query($conn,"select * from stok where idbarang='$idb'");
        $get = mysqli_fetch_array($gambar);
        $img = 'images/'.get['$image'];
        unlink($img);

        $hapus = mysqli_query($conn,"delete from stok where idbarang='$idb'");
        if ($hapus) {
            header('location:index.php');
        }else{
            echo 'gagal';
            header('location:index.php');
        }
    };

    //megubah data barang masuk
    if(isset($_POST['updatebarangmasuk'])){
        $idb = $_POST['idb'];
        $idm = $_POST['idm'];
        $namabarang = $_POST['namabarang'];
        $deskripsi = $_POST['keterangan'];
        $qty = $_POST['qty'];

        $lihatstok = mysqli_query($conn,"select * from stok where idbarang='$idb'");
        $stoknya = mysqli_fetch_array($lihatstok);
        $stokskrg = $stoknya['stok'];

        $qtyskrg = mysqli_query($conn,"select * from masuk where idmasuk='$idm'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya['qty'];

        if($qty > $qtyskrg){
            $selisih = $qty - $qtyskrg;
            $kurangin = $stokskrg + $selisih;
            $kurangistoknya = mysqli_query($conn,"update stok set stok='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn,"update masuk set qty='$qty',keterangan ='$deskripsi' where idmasuk ='$idm'");
            if($kurangistoknya&&$updatenya){
                header('location:masuk.php');
            }else{
                echo'gagal';
                header('location:masuk.php');
            }
            
        }else{
            $selisih = $qtyskrg-$qty;
            $kurangin = $stokskrg - $selisih;
            $kurangistoknya = mysqli_query($conn,"update stok set stok='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn,"update masuk set qty='$qty',keterangan ='$deskripsi' where idmasuk ='$idm'");
            if($kurangstoknya&&$updatenya){
                header('location:masuk.php');
            }else{
                echo'gagal';
                header('location:masuk.php');
            }
        }
    }


//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastok = mysqli_query($conn,"select * from stok where idbarang ='$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stok'];

    $selisih = $stok - $qty;

    $update = mysqli_query($conn,"update stok set stok ='$selisih'where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");


    if($update&&$hapusdata){
        header('location:masuk.php');
    }else{
        header('location:masuk.php');
    }
}




//mengubah data barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idk'];
    $namabarang = $_POST['namabarang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstok = mysqli_query($conn,"select * from stok where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stok'];

    $qtyskrg = mysqli_query($conn,"select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty > $qtyskrg){
        $selisih = $qty - $qtyskrg;
        $kurangin = $stokskrg - $selisih;
        $kurangistoknya = mysqli_query($conn,"update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set qty='$qty',penerima ='$penerima' where idkeluar ='$idk'");
        if($kurangistoknya&&$updatenya){
            header('location:keluar.php');
        }else{
            echo'gagal';
            header('location:keluar.php');
        }
        
    }else{
        $selisih = $qtyskrg-$qty;
        $kurangin = $stokskrg + $selisih;
        $kurangistoknya = mysqli_query($conn,"update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set qty='$qty',penerima ='$penerima' where idkeluar ='$idk'");
        if($kurangstoknya&&$updatenya){
            header('location:keluar.php');
        }else{
            echo'gagal';
            header('location:keluar.php');
        }
    }
}


//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
$idb = $_POST['idb'];
$qty = $_POST['kty'];
$idk = $_POST['idk'];

$getdatastok = mysqli_query($conn,"select * from stok where idbarang ='$idb'");
$data = mysqli_fetch_array($getdatastok);
$stok = $data['stok'];

$selisih = $stok + $qty;

$update = mysqli_query($conn,"update stok set stok ='$selisih'where idbarang='$idb'");
$hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");


if($update&&$hapusdata){
    header('location:keluar.php');
}else{
    header('location:keluar.php');
}
}

//menambah admin baru
if(isset($_POST['addadmin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $querryinsert = mysqli_query($conn,"insert into login (email,password) values('$email','$password')");
    
    if($querryinsert){
        header('location:admin.php');
    }else{
        header('location:admin.php');
    }
}


//edit data admin

if(isset($_POST['updateadmin'])){
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $idnya = $_POST['id'];

    $queryupdate = mysqli_query($conn,"update login set email='$emailbaru', password='$passwordbaru'where iduser='$idnya'");
    if($queryupdate){
        header('location:admin.php');
    }else{
        header('location:admin.php');
    }
    
}

//hapus admin
if(isset($_POST['hapusadmin'])){
    $id = $_POST['id'];

    $querrydelete = mysqli_query($conn,"delete from login where iduser='$id'");
    if($querrydelete){
        header('location:admin.php');
    }else{
        header('location:admin.php');
    }
}
?>
