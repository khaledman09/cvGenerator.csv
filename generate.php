<?php
/**
 * Created by PhpStorm.
 * User: USERA
 * Date: 20/08/2016
 * Time: 01:32
 */
include 'randomizer.php';

if(isset($_POST["cvsQuantity"])){
    $cvsQuantity = $_POST["cvsQuantity"];
    $fileName = "CSV\\" . $cvsQuantity . "_cv_" . time() . ".csv";
    create_file('CSV', $fileName);

    $fp = fopen($fileName, "w");
    for($index = 0; $index < $cvsQuantity; $index++){
        $personalData = generate_random_name();
        $csvArray[0] = $personalData["lastName"];                           // Nom
        $csvArray[1] = $personalData["firstName"];                          // Prenom
        $csvArray[2] = $personalData["gender"];                             // Sexe
        $csvArray[3] = rand(22, 50);                                        // Age
        $csvArray[4] = rand(1, 48);                                         // Wilaya
        $mobileOperator = rand(1, 4);                                       // Mobile
        if($mobileOperator == 1)
            $csvArray[5] = "0" . rand(770000000, 779999999);
        else if($mobileOperator == 2)
            $csvArray[5] = "0" . rand(550000000, 559999999);
        else if($mobileOperator == 3)
            $csvArray[5] = "0" . rand(660000000, 669999999);
        else if($mobileOperator == 4)
            $csvArray[5] = "0" . rand(20000000, 49999999);
        $csvArray[6] = generate_random_email($personalData["lastName"]);    // Email
        $csvArray[7] = rand(0, 1);                                          // Service National
        $niveau = generate_random_niveau_etudes();
        $csvArray[8] = $niveau["niveau"];                                   // Niveau d'étude
        $csvArray[9] = rand(1, 3);                                          // Niveau Pro
        $csvArray[10] = $niveau["specialite"];                                // Spécialité
        $csvArray[11] = rand(0, 1);                                         // Déplacement
        $csvArray[12] = rand(1, 90);                                        // Disponibilité
        $csvArray[13] = rand(1, 1000);                                      // Dernier Travail
        $csvArray[14] = rand(0, 1);                                         // PRecrut

        fputcsv($fp, $csvArray);
    }
    fclose($fp);




    echo "Les cvs sont generer avec succes";
    header("refresh:3, url=index.php");

} else {
    echo "Vous devez venir ici en saisissant la form dans la page d'accueil<br><br>Vous allez etre rediger vers cette page...<br>
Si ça prendre bcp de temps clickez sur le lien <a href='index.php'>Accueil</a> ";
    header("refresh:5,url=index.php");
}


function create_file($dir, $fileName){
    if(!is_dir($dir))
        mkdir($dir, 0700);
    $fp = fopen($fileName, 'w');
    fclose($fp);
}