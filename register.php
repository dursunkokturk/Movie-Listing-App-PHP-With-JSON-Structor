<?php

    require "libs/vars.php";
    require "libs/functions.php";  

    // Register Butonuna Tiklandiginda
    // Form Uzerinde Girilen Bilgileri Aliyoruz
    if (isset($_POST["register"])) {
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        // Form Uzerinde Tum Alanlar Doldurulmadan Register Islemine Izin Vermiyoruz
        if(empty($name) or empty($username) or empty($password) or empty($email)){
            echo "<div class='alert alert-danger mb-0 text-center'>Tüm Alanları Doldurunuz</div>";
            return;
        }

        // Kullanicidan Gelen Username Bilgisini Aliyoruz
        $user = getUser($username);

        // Kullanicidan Gelen username Bilgisi Ile 
        // db.json Dosyasindaki username Bilgisi
        // Ayni Ise Uyari Mesaji Veriyoruz
        if(!is_null($user)){
            echo "<div class='alert alert-danger mb-0 text-center'>Username Daha Önce Alınmış</div>";
            return;
        }

        // Hic Bir Sorun Yoksa 
        // Kullanicidan Gelen Bilgileri
        // createUser Fonksiyonu Icinde Parametre Olarak 
        createUser($name,$username,$password,$email);
        
        // db.json Dosyasina Kaydediyoruz
        header('Location: index.php');
    }

?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="register.php" method="POST">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">username</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail Address</label>
                            <input type="password" class="form-control" name="email" id="email">
                        </div>

                        <input type="submit" name="register" value="Submit" class="btn btn-primary">
                    
                    </form>
                </div>
            </div>
        </div>    
    </div>
</div>

<?php include "views/_footer.php" ?>

