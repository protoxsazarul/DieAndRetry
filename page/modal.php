<?php
include"Data.php";
$queryModalCall=$bdd->query($queryModal.$_POST["One"]);
$jeu= $queryModalCall->fetch(PDO::FETCH_OBJ);
// var_dump($jeu);
// var_dump($DevList);

?>
<div id="modal-bg" class="">
    <div id="modal-corps" class="offset-5 container-fuild">
        <h2 class="text-center">Modification</h2>
        <form action="" method="POST" class="" name="modifi">
            <div class="form-modal">
                <!-- <label for="id">ID du jeu</label>
                <input type="int" name="mID" value> -->
                <label for="name">Nom du jeu :</label>
                <input type="text" name="mTitre" value="<?=$jeu->Titre?>" required>
            </div>
            <!-- Selecteur pour les Platforms -->
            <div class="form-modal">
                <label for="mplatform">Platforms</label>
                <select name="mPlatform" id="ListPlat" class="">
                    <option value="<?=$jeu->PlatId?>"><?=$jeu->Platforms?></option>
                    <?php 
                    for ($i=0; $i < sizeof($PlatList) ; $i++) :                      
                    ?>
                    <option value="<?=$PlatList[$i]["id"]?>"><?=$PlatList[$i]["name"]?>
                        <?php
                    endfor;
                    ?>
                </select>

            </div>
            <!-- Selecteur pour les Développeurs -->
            <div class="form-modal">
                <label for="mDev">developpeurs</label>
                <select name="mDev" id="ListDev" class="">
                    <option value="<?=$jeu->DevId?>"><?=$jeu->Developers?></option>
                    <?php 
                    for ($i=0; $i < sizeof($DevList) ; $i++) :                      
                    ?>
                    <option value="<?=$DevList[$i]["id"]?>"><?=$DevList[$i]["name"]?>
                        <?php

                    endfor;
                    ?>
                </select>
            </div>
            <!-- Selecteur pour les constructeur -->
            <div class="form-modal">
                <label for="mPub">Editeur </label>
                <select name="mPub" id="ListPub" class="">
                    <option value="<?=$jeu->PubId?>"><?=$jeu->Publishers?></option>
                    <?php 
                    for ($i=0; $i < sizeof($PubList) ; $i++) :                      
                    ?>
                    <option value="<?=$PubList[$i]["id"]?>"><?=$PubList[$i]["name"]?>
                        <?php
              
                    endfor;
                    ?>
                </select>
            </div>
            <div class="form-modal">
                <button type="submit" class="btn btn-sm btn-primary" value="test-vald">Valider</button>
                <button type="button" class="btn btn-sm btn-danger">Supprimer</button>

            </div>
        </form>
        <?php

        // var_dump($_POST);
        ?>
    </div>

</div>
<?php
    if(isset($_POST["mPlatform"])){
            $queryModification=$queryModification.$_POST["mTitre"].'", idPlatform = "'.$_POST["mPlatform"].'",idPublisher ="'.$_POST["mPub"].'", idDeveloper = "'.$_POST["mDev"].'" where id ='.$jeu->ID;
            $modif=$bdd->prepare($queryModification);
            $modif->execute();

    };
?>