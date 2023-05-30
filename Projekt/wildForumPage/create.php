<?php
session_start();
require_once "../loginPage/connection.php";
$userId =0;
if(!isset($_SESSION['loggedUser'])){
        header('Location: ../loginPage/welcomePage.php');
}
else{
    $userId = $_SESSION['loggedId'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../WebIcon/icons8-snow-capped-mountain-emoji-32.png">
    <link rel="stylesheet" href="forum.css">
    <title>WildyBeskids</title>
</head>
<body>
    <nav id="navbar">   
        <a href="forum.php" >Go back</a>
        <a href="#forum" class="active">Forum</a>
    </nav>
    <div id="forumPost">
        <h1>Create a new post</h1><br><br>
        <form  method="post" enctype="multipart/form-data">
            <input type="text" placeholder="latitude" name="latitude" class="coords" >
            <input type="text" placeholder="longitude" name="longitude" class="coords"><br>
            <textarea name="description" id="desc" cols="40" rows="20" ></textarea><br>
            <input type="checkbox" name="water" checked>
            <label for="water">Water</label>
            <input type="checkbox" name="stars">
            <label for="stars">Stars</label><br><br>
            <input type="file" name="image"><br><br><br>
            <input type="submit" value="Save" id="submit" name="subPost">
            
        </form>
    </div>
<?php
require_once "../loginPage/connection.php";
    if(isset($_POST['subPost'])){
        $latitude = htmlentities($_POST['latitude'], ENT_QUOTES);
        $longitude = htmlentities($_POST['longitude'], ENT_QUOTES);
        $description = htmlentities($_POST['description'], ENT_QUOTES);
        $allowtypes = array('jpg','png','jpeg');
        $targetDirectory = "../Images".DIRECTORY_SEPARATOR;
        $max_size = 5 * 1024 * 1024;
        
        if(preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/',$latitude) == 1 && preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/',$longitude) == 1){
             
        
        $user = $_SESSION['loggedUser'];
       
        if(isset($_POST['water']))
            $water = true;
        if(isset($_POST['stars'])) 
            $stars = true;  
        if(strlen($description)>800){
            echo "<script type='text/javascript'>alert('Too long description');</script>";
        }
            
        

       $imgName = $_FILES['image']['name'];
       $imgSize = $_FILES['image']['size'];
       $imgTmpName = $_FILES['image']['tmp_name'];
       $imgError = $_FILES['image']['error'];
       $allowtypes = array('jpg','png','jpeg');
       $fileExt = explode('.',$imgName);
        $imgExtension = strtolower(end($fileExt));

       if($imgError === 0){
            if($imgSize > 5242880){
                echo "<script type='text/javascript'>alert('File too big');</script>";
            }
            else{
                if(in_array($imgExtension, $allowtypes)){
                    $finalImgName = uniqid("IMG-",true).'.'.$imgExtension;
                    $uploadPath = 'Images/'.$finalImgName;
                    move_uploaded_file($imgTmpName,$uploadPath);
                    $water = (isset($_POST['water'])) ? 1 : 0;
                    $stars = (isset($_POST['stars'])) ? 1 : 0;
                    

                    //-----------------------------------//
                    $insertImageQuery = "INSERT INTO image(filename,idUser) VALUES(:filename,:idUser)";
                    $insertImageResult = $conn->prepare($insertImageQuery);
                    $insertImageResult->execute([
                        'filename' => $finalImgName,
                        'idUser' => $userId
                    ]);
                    //---------------------------------------//
                    $selectImageQuery = "SELECT idImage FROM image WHERE filename = :filename";
                    $resultImageQuery = $conn->prepare($selectImageQuery);
                    $resultImageQuery->execute([
                        'filename' => $finalImgName
                    ]);
                    $imageRes = $resultImageQuery->fetchColumn();
                    $_SESSION['image'] = $imageRes;
                    
                    //--------------------------------------//
                   $datetime = date_create()->format('Y-m-d H:i:s');
                    $imageQuery = "INSERT INTO post(latitude,longitude,stars,water,description,idImage
                    ,idUser,idCategory,idHut,dateAdded) 
                    VALUES(:latitude,:longitude,:stars,:water,:description,:idImage
                    ,:userId,:idCategory,:idHut,:dateAdded);";
                     $resultImage = $conn->prepare($imageQuery);
                    //  $resultImage->execute();
                    $resultImage->execute([
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'stars' => $stars,
                    'water' => $water,
                    'description' => $description,
                    'idImage' => $imageRes,
                    'userId' => $userId,
                    'idCategory' => 1,
                    'idHut' => null,
                    'dateAdded' =>  $datetime    
                    ]);

                    
                    header("Location: forum.php?status=added");
                        
                }else{
                    echo "<script type='text/javascript'>alert('Not allowed extension');</script>";
                    exit();
                }
            }
       }
       else{
        echo "<script type='text/javascript'>alert('Problem with image');</script>";
        exit();
       }

    }
    else{
        echo "<script type='text/javascript'>alert('Wrong coordinations');</script>";
                 exit();
    }
}
?>
</body>
</html>