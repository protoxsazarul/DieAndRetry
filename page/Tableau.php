<?php
include "page/Data.php" ;?>

<script src="script_java.js"></script>
<!-- Modal du form d'ajout -->
<div class="modal fade" id="GameAdd" tabindex="-1" role="dialog" aria-labelledby="GameAddModal" aria-hidden="true">
    <form action="FormModif.php" method="POST" name="Add">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="GameAddModal">Ajouter un jeu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label for="atitle">Titre: </label>
                    <input type="text" name="aTitre" value="" required><br>
                    <label for="aPlatform">Platform:</label>
                    <select name="aPlatform" id="aListPlat" class="">
                        <?php 
                    for ($i=0; $i < sizeof($PlatList) ; $i++) :                      
                    ?>
                        <option value="<?=$PlatList[$i]["id"]?>"><?=$PlatList[$i]["name"]?>
                            <?php
                    endfor;
                    ?>
                    </select><br>
                    <label for="aDev">developpeurs:</label>
                    <select name="aDev" id="aListDev" class="">
                        <?php 
                    for ($i=0; $i < sizeof($DevList) ; $i++) :                      
                    ?>
                        <option value="<?=$DevList[$i]["id"]?>"><?=$DevList[$i]["name"]?>
                            <?php
                    endfor;
                    ?>
                    </select><br>
                    <label for="aPub">Editeur: </label>
                    <select name="aPub" id="aListPub" class="">
                        <?php 
                    for ($i=0; $i < sizeof($PubList) ; $i++) :                      
                    ?>
                        <option value="<?=$PubList[$i]["id"]?>"><?=$PubList[$i]["name"]?>
                            <?php
              
                    endfor;
                    ?>
                    </select><br>
                    <label for="adate">Date de sortie</label>
                    <input name="aDate" type="text" value="31-mois-année" require>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </div>

    </form>
</div>
<?php
?> 

<!-- Debut de la page  -->
<!-- triage  -->
<div id="formTab" class="container-fluid p-2">
    <div class="row p-1">
        <form action="" method='POST' class="col-12">
            <label for="ordres" class="col-sm-4 col-md-2">Trier par :</label>
            <select name="ordres" id="selecteur" class="col-sm-6 col-md-4">
                <?php 
        if(isset($_POST['ordres']) && !empty($_POST['ordres'])) :
        ?>
                <option value="<?=$_POST['ordres']?>"><?=$_POST['ordres']?></option>
                <?php 
        endif;
        ?>
                <option value="Titre">Titre</option>
                <option value="Platforms">Platforms</option>
                <option value="Developers">Developers</option>
                <option value="Publishers">Editeurs</option>
            </select>
            <button type="submit" value="Valider" class="btn btn-secondary btn-sm offset-sm-6 offset-md-1">Valider</button>

        </form>
        <!-- lf = looking for = recherche | Bare de recherche  -->
        <form action="" method='POST' class="col-sm-12">
            <label for="search" class="col-sm-4 col-md-2">Rechercher : </label>
            <input type="text" name="lf" id="lfbare" class="col-sm-6 col-md-4">
            <label for="Quoi" class="col-sm-2 col-md-1">dans</label>
            <select name="Quoi" id="selecteur" class="col-sm-4 col-md-3">
                <option value="title">Titre</option>
                <option value="platform.name">Platforms</option>
                <option value="developers.name">Developers</option>
                <option value="publishers.name">Editeur</option>
            </select>
            <button type="submit" value="Rechercher" class="btn btn-secondary btn-sm">Rechercher</button>
        </form>
    </div>
    <div class="row">
        <button type="button" class="btn btn-secondary btn-sm" value="AddGame" data-toggle="modal"
            data-target="#GameAdd">Ajouter un jeux
        </button>
    </div>
</div>

<?php
// verification et prise en compte des options de recherche et de tries pour l'affichage du tableau
if(isset($_POST['ordres'])){
$ordre=$ordre.$_POST['ordres'];
}else {
    $ordre=$ordre."titre";
};
if (!isset($_POST['lf']) && empty($_POST["lf"])){
$query = $bdd->query($queryTableau.$ordre.';');
}else{
    if($_POST['lf']== " " or ""){
        $query = $bdd->query($queryTableau.$ordre.';');   
    } else{
    $search ="where ".$_POST['Quoi']. " LIKE '".$_POST['lf']."%'";
    $query = $bdd->query($queryTableau.$search.$ordre.';');
}
};
// traitement du resulta de la requête
$gamesList=$query->fetchall(PDO::FETCH_ASSOC);
?>
<section class="container-fuild w-100 ">
    <table id="Tab" class="row">
        <thead id="tabhead" class="col-12">
            <td id="GHname" class="pad">Titre</td>
            <td id="GHplat"class="pad">Platform</td>
            <td id="GHpub"class="pad">Editeur</td>
            <td id="GHdev"class="pad">developer</td>
            <td id="GHconst"class="pad">Constructeur</td>
            <td id="GHdetail"class="pad">details</td>
        </thead>
    </table>

    <div id="scroll" class="">
        <table>
            <form action="" method="POST">
                <?php 
                foreach ($gamesList as $game) :
                    // var_dump($game);
            ?>
                <tr id="<?=$game['ID']?>">
                    <td id="Gname" class="col-sm-2 list"><?= $game['Titre']?></td>
                    <td id="Gplat" class="col-sm-2 list"><?= $game['Platforms'] ?></td>
                    <td id="Gpub" class="col-sm-2 list"><?=$game["Publishers"]?></td>
                    <td id="Gdev" class="col-sm-2 list"><?= $game['Developers'] ?></td>
                    <td id="Gconst" class="col-sm-2 list"><?=$game['Constructeur']?></td>
                    <td id="Gdetail" class="button list"> <button type="submit" name="One" value="<?=$game['ID']?>"
                            class="btn btn-sm btn-secondary"> modifier
                        </button></td>

                </tr>
                <?php
                endforeach;
            ?>
            </form>
        </table>
    </div>
    <?php
    // var_dump($queryAdd);
        // var_dump($_POST);
        // var_dump($_GET);
        ?>
</section>