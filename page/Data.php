<?php 
$user = "GamesAdmin";
$pass = "A1z2e3r4";
$ordre = ' order by ';
$bdd = new PDO('mysql:host=localhost;port=3306;dbname=videogames', $user,$pass);
// requete pour le tableau
$queryTableau= 'SELECT  videogames.id as "ID", Title as "Titre" , developers.name as "Developers" , platform.name as "Platforms", publishers.id as "Publishers", publishers.name as "Publishers" , constructor.name as "Constructeur"
FROM videogames.videogames
inner join publishers on publishers.id = videogames.idPublisher
inner join platform on platform.id = videogames.idplatform
inner join developers on developers.id = videogames.idDeveloper
inner join constructor on constructor.id = platform.idConstructor ';
// requete pour la recupérer les info du jeu select
$queryModal ='SELECT  videogames.id as "ID", Title as "Titre" , developers.name as "Developers",developers.id as"DevId" , platform.name as "Platforms" ,platform.id as"PlatId" , publishers.id as "PubId" , publishers.name as "Publishers", constructor.name as "Constructeur",constructor.id as"ConstId" 
FROM videogames.videogames
inner join publishers on publishers.id = videogames.idPublisher
inner join platform on platform.id = videogames.idplatform
inner join developers on developers.id = videogames.idDeveloper
inner join constructor on constructor.id = platform.idConstructor 
where videogames.id = ';
$queryAdd='INSERT INTO videogames (title,ReleaseDate,idPlatform,idPublisher,IdDeveloper) Values ("';
// requete de modification 
$queryModification='UPDATE videogames.videogames set Title = "';
$modif= "";
// chargement des listes a factorisé plus tard  
$queryDevList='SELECT name,id from videogames.developers';
$DevCall=$bdd->query($queryDevList);
$DevList=$DevCall->fetchall(PDO::FETCH_ASSOC);

$queryPlatList='SELECT name, id from videogames.platform';
$PlatCall=$bdd->query($queryPlatList);
$PlatList=$PlatCall->fetchall(PDO::FETCH_ASSOC);

$queryPubList='SELECT name, id from videogames.publishers';
$PubCall=$bdd->query($queryPubList);
$PubList=$PubCall->fetchall(PDO::FETCH_ASSOC);
?>