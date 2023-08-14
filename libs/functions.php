<?php

    function getData(){

        // fopen Fonksiyonu Icinde Bilgilerin Yer Aldigi Database Dosyasini
        // Okuma Modunda Aciyoruz
        $myfile = fopen("db.json","r");

        // Dosyanin Kapasitesine Bakiyoruz
        $size = filesize("db.json");

        // Okuma Islemi Yapilacak Dosya Icindeki Verileri 
        // Array Tipine Ceviriyoruz
        $result = json_decode(fread($myfile,$size),true);
        fclose($myfile);

        // Array Tipine Cevirilmis Datalari Gereken Yerlerde Kullanmak Icin
        // return Ile Donduruyoruz
        return $result;
    }


    function createUser(string $name,string $username,string $password,string $email){

        // db.json Dosyasindaki Tum Bilgileri
        // getData Fonksiyonu Ile Aliyoruz Ve 
        // Kullanici Kaydi Yapilmasi Icin
        // db Degiskenine Atama Yapiyoruz
        $db = getData();

        // db Degiskeni Uzerinden 
        // db.json Dosyasindaki users Array Yapisinda Bulunan
        // JSON Yapisina Ulasiyoruz
        // JSON Yapisi Formatinda 
        // Yeni Kullaniciya Ait Bilgileri Form Uzerinden Alip
        // db.json Dosyasina Kaydedecegimizi Belirtiyoruz
        array_push($db["users"],array(
            // Yeni Kullanici Kaydetme Isleminde id Bilgisinin Otomatik Olarak Artmasi Icin
            // Toplam user Sayisina Bakiyoruz ve +1 Diyerek 
            // Bir Sonraki Kullanici Bilgisinin id Bilgisinin Otomatik Olarak Artmasini Sagliyoruz
            "id" => count($db["users"])+1,
            "name" => $name,
            "username" => $username,
            "password" => $password,
            "email" => $email
        ));

        // fopen Fonksiyonu Icinde db.json Dosyasini
        // Yazma Modunda Aciyoruz
        $myfile = fopen("db.json","w");

        // json_encode Fonksiyonu Ile 
        // Kullanicidan Form Uzerinden Alinan Bilgiyi
        // String Yapisina Ceviriyoruz
        fwrite($myfile,json_encode($db,JSON_PRETTY_PRINT));
        fclose($myfile);
    }

    // getUser Fonksiyonu Ile db.json Dosyasindaki username Bilgilerini Aliyoruz
    function getUser(string $username){

        // getUser Fonksiyonu Ile db.json Dosyasindaki
        // db.json Dosyasindaki users Bilgilerini Aliyoruz
        $users = getData()["users"];

        // users Degiskenine Atanan Degerleri 
        // user Degiskeni Uzerinden Tek Tek Geziyoruz
        foreach($users as $user){

            // Kullanici Tarafindan Girilen username Bilgisi Ile 
            // db.json Dosyasi Icindeki username Bilgisi Eslesir Ise
            if($user["username"] == $username){

                // Eslesen Bilgiyi Donduruyoruz
                return $user;
            }
        }

        // Eslesen Kayit Yok Ise Bos Deger Donduruyoruz
        return null;
    }

    function createBlog(string $title, string $description, string $imageUrl,string $url, int $comments=0,int $likes=0) {
        
        // db.json Dosyasindaki Tum Bilgileri
        // getData Fonksiyonu Ile Aliyoruz Ve 
        // Kullanici Kaydi Yapilmasi Icin
        // db Degiskenine Atama Yapiyoruz
        $db = getData();

        // db Degiskeni Uzerinden 
        // db.json Dosyasindaki users Array Yapisinda Bulunan
        // JSON Yapisina Ulasiyoruz
        // JSON Yapisi Formatinda 
        // Yeni Filme Ait Bilgileri Form Uzerinden Alip
        // db.json Dosyasina Kaydedecegimizi Belirtiyoruz
        array_push($db["movies"],array(
            // Yeni Film Kaydetme Isleminde id Bilgisinin Otomatik Olarak Artmasi Icin
            // Toplam film Sayisina Bakiyoruz ve +1 Diyerek 
            // Bir Sonraki Film Bilgisinin id Bilgisinin Otomatik Olarak Artmasini Sagliyoruz
            "id" => count($db["movies"])+1,
            "title" => $title,
            "description" => $description,
            "image-url" => $imageUrl,
            "url" => $url,
            "comments" => $comments,
            "likes" => $likes,
            "is-active"=> false
        ));

        // fopen Fonksiyonu Icinde db.json Dosyasini
        // Yazma Modunda Aciyoruz
        $myfile = fopen("db.json","w");

        // json_encode Fonksiyonu Ile 
        // Kullanicidan Form Uzerinden Alinan Bilgiyi
        // String Yapisina Ceviriyoruz
        fwrite($myfile,json_encode($db,JSON_PRETTY_PRINT));
        fclose($myfile);
    }

    // Filmin Yanindaki Edit Butonuna Tiklandiginda
    function getBlogById(int $movieId){
        
        // Filmin Id Bilgisi Uzerinden Filmin db.json Dosyasindaki
        // movie array ine Ulasiyoruz
        $movies = getData()["movies"];

        // Edit Butonuna Tiklandiginda 
        // Buton Uzerinden Gelen id Bilgisine Gore 
        // Filmler Icinde Tarama Yapilacak
        foreach($movies as $movie){
        
            // Edit Butonuna Tiklandiginda Yer Alan id Bilgisi Ile
            // db.json Dosyasi Icindeki movie Array Arasinda
            if($movie["id"] == $movieId){

                // id Bilgileri Arasinda Eslesme Oldugunda 
                // Filmin Bilgilerini Donduruyoruz
                return $movie;
            }
        }

        return null;
    }

    function editBlog(int $id,string $title, string $description, string $imageUrl,string $url, bool $isActive){
        
        // db.json Dosyasindaki Tum Bilgileri
        // getData Fonksiyonu Ile Aliyoruz Ve 
        // Edit Yapilmasi Icin
        // db Degiskenine Atama Yapiyoruz
        $db = getData();

        // Edit Islemi Icin Secilen Filmin Bilgilerine Ulasmak Icin Tarama Yapiyoruz
        // Edit Isleminin Sistem Tarafindan Olusturulan Kopyasi Uzerinde Yapilacak Degisiklik 
        // db.json Dosyasinda Gorunmez
        // Edit Isleminin db.json Dosyasinda Gorunmesi Icin 
        // Degiskenin Basina & Operatorunu Eklemek Gerekiyor.
        foreach($db["movies"] as &$movie){
            
            // id Bilgisi Uzerindn Edit Islemi Icin Tiklanilan Filmin Bilgilerini Karsilastiriyoruz 
            if($movie["id"] == $id){

                // Tiklanilan Filmin id Bilgisi Ile 
                // db.json Dosyasindaki id Bilgisi Eslesir Ise
                // Filmin Bilgileri Gelecek
                $movie["title"] = $title;
                $movie["description"] = $description;
                $movie["image-url"] = $imageUrl;
                $movie["url"] = $url;
                $movie["is-active"] = $isActive;


                // fopen Fonksiyonu Icinde db.json Dosyasini
                // Yazma Modunda Aciyoruz
                $myfile = fopen("db.json","w");

                // json_encode Fonksiyonu Ile 
                // Kullanicidan Form Uzerinden Alinan Bilgiyi
                // String Yapisina Ceviriyoruz
                fwrite($myfile,json_encode($db,JSON_PRETTY_PRINT));
                fclose($myfile);

                // Edit Islemi Bittiginde Donguyu Durduruyoruz
                break;
            }
        }
    }

    // Delete Butonuna Tiklama Isleminden Sonra id Bilgisini Aliyoruz
    function deleteBlog($id){

        // db.json Dosyasindaki Tum Bilgileri
        // getData Fonksiyonu Ile Aliyoruz Ve 
        // Delete Yapilmasi Icin
        // db Degiskenine Atama Yapiyoruz
        $db = getData();

        // Alinan id Bilgisine movie Icinde key ve value Degerlerini Tarama Yapiyor 
        foreach($db["movies"] as $key => $movie){
            
            // Alinan id Bilgisine Gore Eslesen id Buldugunda
            if($movie["id"] == $id){

                // Silme Isleminde Fonksiyon Icinde 
                // Ilk Parametre Olarak Silme Isleminin Uygulanacagi Array Degeri
                // Ikinci Parametre movie nin Icindeki Silinecek Olan Degeri Aliyoruz
                // Ucuncu Parametre Silinecek Degerin Kac Tane Oldugunu Belirtiyoruz
                array_splice($db["movies"],$key,1);
            }
        }

        // fopen Fonksiyonu Icinde db.json Dosyasini
                // Yazma Modunda Aciyoruz
                $myfile = fopen("db.json","w");

                // json_encode Fonksiyonu Ile 
                // Kullanicidan Form Uzerinden Alinan Bilgiyi
                // String Yapisina Ceviriyoruz
                fwrite($myfile,json_encode($db,JSON_PRETTY_PRINT));
                fclose($myfile);
    }

    function kisaAciklama($aciklama, $limit) {
        if (strlen($aciklama) > $limit) {
            echo substr($aciklama,0,$limit)."...";
        } else {
            echo $aciklama;
        };
    }

?>