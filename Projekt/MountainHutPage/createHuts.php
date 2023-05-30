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
    <link rel="stylesheet" href="style.css">
    <title>WildyBeskids</title>
</head>
<body>
    <nav id="navbar">   
        <a href="huts.php" >Go back</a>
        <a href="#forum" class="active">Forum</a>
    </nav>
    <div id="forumPost" style="position:relative;">
        <h1>Create a new post</h1><br><br>
        <form  method="post" enctype="multipart/form-data">
            <select id="selectHut" name="hutList" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                <option value="5">Szyndzielnia PTTK</option>
                <option value="7">Hala Miziowa PTTK</option>
                <option value="8">Przyslop PTTK</option>
                <option value="9">Rysianka PTTK</option>
                <option value="10">Krawców Wierch PTTK</option>
                <option value="11">Klimczok PTTK</option>
                <option value="12">Błatnia PTTK</option>
                <option value="13">Magurka PTTK</option>
                <option value="14">Markowe Szczawiny PTTK</option>   
                <option value="15">Skrzyczne PTTK</option>  
            </select>
            <textarea name="description" id="desc" cols="40" rows="20" ></textarea><br>
            <br><br> 
            <input type="file" name="image"><br><br><br>
            <input type="submit" value="Save" id="submit" name="subPost">
            
        </form>
    </div>
<?php
require_once "../loginPage/connection.php";
    if(isset($_POST['subPost'])){
        
        $description = htmlentities($_POST['description'], ENT_QUOTES);
        $allowtypes = array('jpg','png','jpeg');
        $targetDirectory = "../Images".DIRECTORY_SEPARATOR;
        $max_size = 5 * 1024 * 1024;
        $hutChoice = $_POST['hutList'];
        
        $user = $_SESSION['loggedUser'];
       
        
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
                    $imageQuery = "INSERT INTO hutPost(description,idImage
                    ,idUser,idHut,dateAdded) 
                    VALUES(:description,:idImage
                    ,:userId,:idHut,:dateAdded);";
                     $resultImage = $conn->prepare($imageQuery);
                    //  $resultImage->execute();
                    $resultImage->execute([
                    'description' => $description,
                    'idImage' => $imageRes,
                    'userId' => $userId,
                    'idHut' => $hutChoice,
                    'dateAdded' =>  $datetime    
                    ]);

                    
                    header("Location: huts.php?status=added");
                        
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
?>
</body>
</html>