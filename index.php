<?php
$host_name = "localhost";
$database = "kithub";
$user_name = "root";
$password = "";

try
{
	$bdd = new PDO('mysql:host='.$host_name.';dbname='.$database.';charset=utf8', $user_name, $password);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$tools = $bdd->query('SELECT * FROM tool ORDER BY priority DESC');
$tools = $tools->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KitHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
</head>
<body>
    <header>
        <h1><a href="#">KitH<span class="animated">u</span>b</a></h1>
        <label for="searchbar"><i class="fas fa-search"></i></label>
        <input type="text" placeholder="Tu cherche un truc... ?" id="searchbar" name="searchbar" onkeyup="searchByTag()">
    </header>

    <div id="introduction">
        <img src="https://fakeimg.pl/250x250/">
    </div>

    <div id="container">
    <?php foreach ($tools as $tool) { 
        
        $links_url = explode("|",$tool['links_url']);
        $links_labels = explode("|",$tool['links_label']);
        $tags = explode("|",$tool['tags']);

        $modified_title = str_replace(" ", "", $tool['title']);
        $modified_title = str_replace(".", "", $modified_title);
        
        ?>


        <div class="case">
            <div class="case-img" style='background-image:url("img/icons/<?= $modified_title; ?>.png")'></div>
            <h2><?= ucfirst($tool['title']) ?></h2>
            <p><?= $tool['description'] ?></p>
            <ul class="link-list">
                <?php for ($i=0; $i < sizeof($links_url); $i++) { ?>
                <li><a target="_blank" href="<?= $links_url[$i] ?>"><?= $links_labels[$i] ?></a></li>
                <?php } ?>
            </ul>
            <ul class="tag-list">
                <?php foreach ($tags as $tag) { ?>
                    <li><?= ucfirst($tag) ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>
    </div>
    <footer>
        <div class="bg"></div>
        <p>Mise en kit par <a href="https://remi-rucojevic.com">Rémi<span>Rucojevic</span></a></p>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>