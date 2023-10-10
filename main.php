<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main - L'Instant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur L'Instant</h1>
        <p>Partagez vos moments spéciaux avec vos proches.</p>
    </header>

    <?php

require './bdd.php';

if(isset($_FILES['file'])){
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $maxSize = 400000;

    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){

        $uniqueName = uniqid('', true);
        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
        $file = $uniqueName.".".$extension;
        //$file = 5f586bf96dcd38.73540086.jpg

        move_uploaded_file($tmpName, './upload/'.$file);

        $req = $db->prepare('INSERT INTO photo (name) VALUES (?)');
        $req->execute([$file]);

        echo "Image enregistrée";
    }
    else{
        echo "Une erreur est survenue";
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

    </head>
<body>
    <h2>Ajouter une image</h2>
    <form action="main.php" method="POST" enctype="multipart/form-data">
    
        <label for="file">Fichier</label>
        <input type="file" name="file">

        <button type="submit">Enregistrer</button>
    </form>
    <h2>Mes images</h2>
    <?php 
        $req = $db->query('SELECT name FROM photo');
        while($data = $req->fetch()){
            echo "<img src='./upload/".$data['name']."' width='300px' ><br>";
            echo "<a href='./upload/".$data['name']."' download>Télécharger</a><br>";
        }
    ?>
</body>
</html>
</body>
</html>
