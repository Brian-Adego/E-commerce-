<?php 
    $connect = mysqli_connect("localhost", "root", "", "alcool");
    if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
        echo "<pre>";
        print_r($_FILES["my_image"]);
        echo "</pre>";

        $img_name = $_FILES["my_image"]["name"];
        $img_size = $_FILES["my_image"]["size"];
        $tmp_name = $_FILES["my_image"]["tmp_name"];
        $error = $_FILES["my_image"]["error"];

        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        if ($error === 0) {
            if ($img_size > 12500000000) {
                $em = "Your life is tooo large";
                header("Location:./sell.php?error=$em");
            } else {
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
               $img_ex_lc = strtolower($img_ex);
               $allowed_exs = array('jpg', 'jpeg', 'png', 'ico', 'webp');

               if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = './IMAGES/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);


                    //insert into database
                    $sql = "INSERT INTO displaybuy(image, name, description, price) VALUES('$new_img_name', '$description', '$name', $price)";
                    mysqli_query($connect, $sql);
                    header("Location:./buy.php");
               } else {
                   $em = "You can't open files of this format";
                   header("Location:./sell.php?error=$em");
               }
            }

        } else {
            $em = "unknown error occured";
            header("Location: ./sell.php?error=$em");
        }
    } else {
        header("Location:./sell.php");
    }
?>