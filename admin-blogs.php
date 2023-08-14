<?php

    require "libs/vars.php";
    require "libs/functions.php";  

?>

<?php include "views/_header.php" ?>
<?php include "views/_message.php" ?>
<?php include "views/_navbar.php" ?>

<div class="container my-3">
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Title</th>
                        <th>URL</th>
                        <th style="width: 30px;">Likes</th>
                        <th style="width: 30px;">Comments</th>
                        <th style="width: 100px;">is Active</th>
                        <th style="width: 150px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- getData Fonksiyonu Ile db.jdon Dosyasi Icindeki Array Tipinde Bulunan JSON Yapisi Icinden -->
                    <!-- movie Key Degerinin Altindaki Value Degerlerini Aliyoruz -->
                    <?php foreach(getData()["movies"] as $movie):?>
                        <tr>
                            <td>
                                <img src="img/<?php echo $movie["image-url"]?>" alt="" class="img-fluid">
                            </td>
                            <td>
                                <?php echo $movie["title"]?>
                            </td>
                            <td>
                                <?php echo $movie["url"]?>
                            </td>
                            <td>
                                <?php echo $movie["likes"]?>
                            </td>
                            <td>
                                <?php echo $movie["comments"]?>
                            </td>
                            <td>
                                <!-- Filmin Gosterilmesine Izin Veriliyorsa -->
                                <?php if($movie["is-active"]): ?>
                                    <!-- Filmin Yanin Onay Isareti Olacak -->
                                    <i class="fas fa-check"></i>
                                <?php else: ?>
                                    <!-- Filmin Gosterilmesine Izin Verilmiyorsa -->
                                    <!-- Filmin Yanin Carpi Isareti Olacak -->
                                    <i class="fas fa-times"></i>
                                <?php endif;?>
                            </td>
                            <td>
                                <!-- Yaninda Yer Aldigi Filmin id Numarasini Otomatik Olarak Aliyor Ve
                                    Bu id Numarasina Gore Islemin Yapilacagi Sayfaya Yonlendirme Yapiyoruz -->
                                <a class="btn btn-primary btn-sm" href="blog-edit.php?id=<?php echo $movie["id"]?>">Edit</a>
                                <a class="btn btn-danger btn-sm" href="blog-delete.php?id=<?php echo $movie["id"]?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "views/_footer.php" ?>