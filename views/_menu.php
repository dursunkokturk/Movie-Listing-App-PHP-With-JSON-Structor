<ul class="list-group">

    <!--getData Fonksiyonu Uzerinden db.json Dosyasi Icindeki Datalardan
        categories Array Icindeki Datalara Ulasiyoruz-->
    <?php foreach(getData()["categories"] as $kategori): ?>

        <!--movies Kismi Filme Tiklandiktan Sonra Gorunecek Olan Kisim-->
        <!--kategoriler Degiskeni Uzerinden id Bilgisini Alarak Kategorinin Sirasina Ulasiyoruz-->
        <a href='<?php echo "movies/".$kategori["id"]?>' class="list-group-item list-group-item-action">
            <!--kategoriler Degiskeni Uzerinden id Bilgisine Gore Name Degerine Ulasiyoruz-->
            <?php echo $kategori["name"] ?>
        </a>
    <?php endforeach; ?>                   
</ul>