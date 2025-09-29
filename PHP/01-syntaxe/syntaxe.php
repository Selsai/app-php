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

        $a = "bleu";
        $b = "blanc";
        $c = "rouge";

        echo $a . " - " . $b . " - " . $c . "<br>";
        // On profite au max de notre syntaxe avec les guillemets interprétant les variables 
        echo "$a - $b - $c <br>";

        echo "<h2>Opérateurs arithmétiques</h2>";

        $a = 10;
        $b = 5;

        // Addition :
        echo $a + $b . "<br>";
        // Soustraction :
        echo $a - $b . "<br>";
        // Multiplication :
        echo $a * $b . "<br>";
        // Division :
        echo $a / $b . "<br>";
        // Puissance :
        echo $a ** $b . "<br>";
        // Modulo :
        echo $a % $b . "<br>";

        $a += $b; // équivaut à écrire $a = $a + $b
        $a -= $b;
        $a *= $b;
        $a /= $b;
        $a **= $b;
        $a %= $b;

        echo "<h2>06 - Conditions & opérateurs de comparaison</h2>";

        // if / elseif / else 
        $x = 10;
        $y = 5;
        $z = 2;

        if ($x > $y) { // Si la valeur de x est strictement supérieure à la valeur de y 
            echo "Vrai, la valeur de x est bien strictement supérieure à la valeur de y<br>";
        } else {
            echo "Faux, la valeur de x n'est pas strictement supérieure à la valeur de y<br>";
        }

        // Plusieurs conditions obligatoires : AND => && 
        if ($x > $y && $y > $z) {
            echo "Ok pour les deux conditions<br>";
        } else {
            echo "L'une ou l'autre ou les deux conditions sont fausses<br>";
        }

        // L'une ou l'autre d'un ensemble de conditions : OR => ||
        if ($x > $y || $y < $z) {
            echo "Ok pour au moins une condition<br>";
        } else {
            echo "Toutes les conditions sont fausses<br>";
        }

        // Seulement l'une ou l'autre des conditions, si les deux sont vérifiées, c'est refusé ! 
        if ($x > $y xor $y < $z) {
            echo "Ok une seule et unique condition est bonne ! <br>";
        } else {
            echo "Toutes les conditions sont fausses ou toutes les conditions sont vraies<br>";
        }

        // if elseif else 
        $x = 8;
        $y = 5;
        $z = 2;

        if ($x == 8) { // Si x est égal à 8
            echo "Réponse A<br>";
        } elseif ($x != 10) { // Si x est différent de 10 
            echo "Réponse B<br>";
        } elseif ($y == $z) { // Si y est égal à z
            echo "Réponse C<br>";
        } else { // Sinon
            echo "Réponse D<br>";
        }

        // Attention, lors de tests de conditions dans un bloc à plusieurs if, elseif, on sortira du bloc dès la première condition rencontrée
        // C'est à dire que si les valeurs correspondent aux conditions de la réponse A et aussi de la réponse B, alors je sortirai de toute façon à la réponse A, sans aller tester la réponse B 

        // Comparaison stricte 
        $a = 1;
        $b = "1";

        // Comparaison des valeurs uniquement 
        if ($a == $b) {
            echo "Oui ces deux variables sont identiques EN VALEUR<br>";
        } else {
            echo "Non ces deux variables sont différentes EN VALEUR<br>";
        }

        if ($a === $b) {
            echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        } else {
            echo "Non ces deux variables sont différentes en valeur ET/OU en type<br>";
        }

        /* 
            Opérateurs de comparaison
            --------------------------------------
            =                               affectation (ce n'est pas un opérateur de comparaison, c'est une affectation)
            ==                              est égal à 
            !=                              est différent de 
            ===                             est strictement égal à (valeur et type)
            !==                             est strictement différent de (valeur et/ou type différent)
            >                               strictement supérieur à 
            >=                              supérieur ou égal 
            <                               strictement inférieur à 
            <=                              inférieur ou égal 
        */

        // Autres possibilités de syntaxe pour les if 

        if ($a === $b) {
            echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        } // Si on ne veut pas gérer le else, il est possible de l'omettre 

        if ($a === $b) echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        else echo "Non ces deux variables sont différentes en valeur ET/OU en type<br>";
        // On peut ne pas mettre les accolades, par contre l'instruction sera limitée à une seule ligne de code après la condition

        if ($a === $b) :
            echo "Oui ces deux variables sont identiques en valeur ET en type<br>";
        else :
            echo "Non ces deux variables sont différentes en valeur ET/OU en type<br>";
        endif;
        // Ici syntaxe où les accolades sont remplacées par des ":" et un "endif" en fin de bloc
        // On utilisera surtout cette syntaxe lorsque l'on ouvre PHP dans de gros blocs HTML pour améliorer la lisibilité et compréhension du code 
        // Il est plus clair de voir un endif; au milieu du html plutôt que de voir une simple accolade fermante 

        // Ecriture ternaire, pour nos if les plus courts ! 

        // action (condition) ? .......... if......... : .............else............
        echo ($a === $b) ? "Oui les deux var sont identiques<br>" : "Non, les deux var sont différentes<br>";
        // On utilisera le if ternaire lorsque l'action du if et du else est la même ! Souvent un echo ou une affectation dans une variable, dont la valeur sera différente en fonction de la condition du if ! 
        // Pas de elseif possible pour l'écriture ternaire 

        


        ?>


    </div>

</body>

</html>