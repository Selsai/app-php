<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syntaxe PHP</title>
    <style>
        h2 {
            background-color: steelblue;
            color: white;
            padding: 20px;
        }

        .container {
            width: 1000px;
            border: 1px solid;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Syntaxe PHP</h2>
        <!-- Il est possible d'écrire de l'html dans un fichier.php
         En revanche l'inverse n'est pas possible ! -->

        <?php
        // Ouverture de la balise PHP

        // Ceci est un commentaire sur une ligne
        # Ceci est un commentaire sur une seule ligne
        /* 
            Commentaire
            Entre deux
            indicateurs
        */


        // Fermeture de la balise PHP

        // La doc officiel de PHP 
        // www.php.net 

        // Les bonnes pratiques et convention d'écriture PHP 

        // https://phptherightway.com 

        echo "<h2>01 - Instruction d'affichage</h2>";

        // echo est une instruction du langage permettant de générer un affichage 

        // ATTENTION chaque instruction doit se terminer par un ";" 

        echo "Bonjour";
        echo " à tous";
        echo "<br>";

        print "Nous sommes lundi<br>"; // Autre instruction permettant de générer un affichage similaire à echo
        // Nous utiliserons toujours echo pour une raison simple, echo est capable de gérer les deux types de concaténation 

        echo "<h2>02 - Variables : déclaration / affectation / type </h2>";
        // Une variable est un espace nommé permettant de conserver une valeur.
        // Une variable en PHP on la déclare avec le signe $ 
        // Caractères autorisés : a-z A-Z 0-9 _
        // PHP est sensible à la casse (une minuscule n'est pas équivalent à une majuscule)
        // Une variable ne peut pas commencer par un chiffre ! 

        $a = 123; // déclaration de la variable nommée "a" et affectation de la valeur 123 
        echo $a;
        // gettype() est une fonction prédéfinie permettant de nous renvoyer une chaine de caractère représentant le type d'une variable 
        echo gettype($a); // integer c'est un entier 
        echo "<br>";

        $a = 1.5; // On change la valeur de a ici, elle est écrasée par la nouvelle 
        echo $a;
        echo gettype($a); // double ou float = chiffre décimal 
        echo "<br>";

        $a = "une chaine";
        echo $a;
        echo gettype($a); // string = chaine de caractères
        echo "<br>";

        $b = true;
        echo $b;
        echo gettype($b); // boolean // vrai ou faux // 1 ou 0  
        echo "<br>";

        // Il reste deux autres types que nous verrons dans d'autres chapitres (array/object)

        echo "<h2>03 - Concaténation</h2>";
        // La concaténation consiste à assembler des chaines de caractères 
        // Caractère de concaténation c'est le "point" : .   ou bien la "virgule" : , 
        // Le caractère de concaténation peut toujours se traduire "suivi de"

        $x = "Bonjour";
        $y = "tout le monde";

        // Sans concaténation 
        echo $x;
        echo " ";
        echo $y;
        echo "<br>";

        // Avec concaténation 
        echo $x . " " . $y . "<br>";

        // Concaténation avec la virgule 
        echo $x, " ", $y, "<br>";

        // Concaténation lors de l'affectation 
        $prenom = "Pierre";
        $prenom = "Alexandre"; // Cela écrase la valeur précédente 
        echo $prenom . "<br>";

        // Pour rajouter sans écraser : 

        $prenom2 = "Pierre";
        $prenom2 = $prenom2 . "-Alexandre";
        echo $prenom2 . "<br>";

        // Raccourci 
        $prenom3 = "Pierre";
        $prenom3 .= "-Alexandre";

        echo $prenom3 . "<br>";

        echo "<h2>04 - Guillemets et apostrophes</h2>";

        $x = "Bonjour";
        $y = "tout le monde";

        // Dans les guillemets, une variable est reconnue et donc est interprétée 
        // Dans les apostrophes, une variable ne sera pas reconnue et interprétée comme un simple string 

        echo "$x $y <br>";
        echo '$x $y <br>';

        echo "<h2>05 - Constantes</h2>";
        // Une constante comme une variable permet de conserver une valeur
        // Cependant, comme son nom l'indique, cette valeur restera... constante
        // Elle ne pourra plus être modifiée, passé sa définition
        // Par convention d'écriture, une constante s'écrit en majuscule

        // On parle ici de constante globale 

        // déclaration et affectation : 
        // define(SON_NOM, sa_valeur);
        define("URL", "http://www.monsite.fr/");
        echo URL . "<br>";
        // Par exemple ici une constante qui défini la racine de mon site, pour travailler avec des URL absolues plus facilement 

        // define("URL", "coucou"); // Une fois une constante déclarée, je ne peux plus changer sa valeur 

        // Constantes magiques 
        // Déjà inscrites au langage 

        echo __FILE__ . "<br>";  // Le chemin absolu depuis le serveur vers ce fichier 
        echo __LINE__ . "<br>"; // le numéro de ligne
        echo __DIR__ . "<br>"; // le chemin vers le dossier contenant ce fichier 

        echo "<h2>Exercice variables</h2>";
        // Créer 3 variables et leur assigner très exactement les valeurs suivantes "bleu", "blanc", "rouge"
        // Ensuite, générer un affichage avec UN SEUL ECHO pour obtenir : 
        // bleu - blanc - rouge 
        // Plusieurs façons possibles, l'objectif étant de trouver la façon la plus courte 

        




        ?>


    </div>

</body>

</html>