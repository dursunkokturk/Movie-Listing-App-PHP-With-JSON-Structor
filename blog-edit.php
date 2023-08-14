<?php
    require "libs/vars.php";
    require "libs/functions.php";  

    // Edit Islemi Icin Ilk Olarak Tum Filmlerin id Bilgilerine Bakiyoruz
    $id = $_GET["id"];

    // Edit Islemi Icin getBlogById Fonksiyonu Icinde id Parametresi Kullanilarak
    // Secilen Filmin id Bilgisi Uzerinden Filmi Seciyoruz
    $selectedMovie = getBlogById($id);

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $imageUrl = $_POST["imageUrl"];
        $url = $_POST["url"];

        // Update Islemi Yapilirken Ayni Zamanda Filmin Kimleri Gorme Yetkisini de Ayarliyoruz
        // Film Bilgileri Guncellenirken isActive Secilmis Ise true Degerini Verecek
        // Film Bilgileri Guncellenirken isActive Secilmemis Ise false Degerini Verecek
        $isActive = isset($_POST["isActive"]) ? true : false;

        editBlog($id,$title,$description,$imageUrl,$url,$isActive);

        $_SESSION['message'] = $title." isimli Film Güncellendi";
        $_SESSION['type'] = "success";

        header('Location: admin-blogs.php');
    }
?>

<?php include "views/_header.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">
           <div class="card">
                <div class="card-body">

                    <!-- Sayfa Yuklenmesi Icin POST Yada GET Yontemlerinden Hangisinin Kullanidigi Fark Etmeksizin -->
                    <!-- id Bilgisine Ulasagiz-->
                    <!-- Sayfa Acilirken id Bilgisini Daha Onceden Aldigi Icin Tekrardan id Bilgisine Gerek Yok -->
                    <!-- Guncelleme Islemi Bitiminde Tekrardan Ayni Sayfada Kalacagi Icin action Ozelligini Kullanmaya Gerek Yok -->
                    <form method="POST">

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $selectedMovie["title"]?>">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control"><?php echo $selectedMovie["description"]?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image-url" class="form-label">Image URL</label>
                            <input type="text" class="form-control" name="imageUrl" id="imageUrl" value="<?php echo $selectedMovie["image-url"]?>">
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">url</label>
                            <input type="text" class="form-control" name="url" id="url" value="<?php echo $selectedMovie["url"]?>">
                        </div>

                        <div class="form-check mb-3">
                            <label for="isActive" class="form-check-label">url</label>
                            <input type="checkbox" class="form-check-input" name="isActive" id="isActive" value="<?php if($selectedMovie["is-active"]) {echo "checked";}?>">
                        </div>

                        <input type="submit" value="Submit" class="btn btn-primary">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "views/_footer.php" ?>