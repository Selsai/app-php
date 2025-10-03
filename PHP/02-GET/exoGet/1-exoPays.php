<?php
/*
    EXERCICE :
    La base de la manipulation de GET

    Étapes :
        - Créer 4 liens indiquant 4 pays différents
        - Chaque lien transmet une valeur GET sur la même page
        - En fonction de la valeur transmise, afficher un message adapté avec traduction
*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Choisissez votre pays</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />

<style>
  body, html {
    height: 100%;
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(120deg, #6a11cb 0%, #2575fc 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }
  .glass-card {
    background: rgba(255, 255, 255, 0.18);
    backdrop-filter: blur(18px);
    border-radius: 24px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.25);
    padding: 3.5rem 2.5rem;
    max-width: 700px;
    width: 100%;
    text-align: center;
    color: white;
  }
  h1 {
    font-weight: 700;
    font-size: 2.8rem;
    margin-bottom: 2rem;
    letter-spacing: 1.3px;
  }
  .btn-custom {
    border-radius: 50px;
    border: 2px solid white;
    padding: 0.9rem 0;
    font-weight: 600;
    font-size: 1.2rem;
    color: white;
    transition: all 0.35s ease;
    box-shadow: 0 6px 14px rgba(255,255,255,0.25);
    user-select: none;
    flex: 1 1 140px;
    max-width: 190px;
    display: flex;
    justify-content: center;
    align-items: center;
    white-space: nowrap;
  }
  .btn-custom:hover, .btn-custom:focus {
    color: #6a11cb;
    background: white;
    border-color: white;
    box-shadow: 0 10px 25px rgba(255,255,255,0.7);
    transform: translateY(-5px);
    text-decoration: none;
  }
  .message {
    margin-top: 2rem;
    font-weight: 700;
    font-size: 1.4rem;
    padding: 1.2rem 2rem;
    border-radius: 50px;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 30px rgba(255,255,255,0.3);
    display: inline-block;
    animation: fadeInUp 0.8s ease forwards;
    opacity: 0;
    line-height: 1.4;
    min-width: 350px;
    max-width: 450px;
    text-align: center;
  }
  .message div {
    font-weight: 700;
    font-size: 1.4rem;
  }
  .message div:last-child {
    font-weight: 400;
    font-size: 1.2rem;
    margin-top: 0.35rem;
  }
  
  .alert-primary {background: #4e73df; color: white;}
  .alert-danger {background: #e84949; color: white;}
  .alert-success {background: #4bbf73; color: white;}
  .alert-warning {background: #f0ad4e; color: #3e3e00;}
  .alert-info {background: #17a2b8; color: white;}
  .alert-secondary {background: rgba(200,200,200,0.3); color: #222;}

  @keyframes fadeInUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
    from {
      opacity: 0;
      transform: translateY(15px);
    }
  }

  /* Container des boutons en flex, 3 par ligne */
  .btn-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 18px 22px;
  }
</style>
</head>
<body>

<div class="glass-card">
  <h1>Choisissez votre pays</h1>

  <div class="btn-container">
    <a href="?pays=France" class="btn btn-custom">France 🇫🇷</a>
    <a href="?pays=Espagne" class="btn btn-custom">Espagne 🇪🇸</a>
    <a href="?pays=Italie" class="btn btn-custom">Italie 🇮🇹</a>
    <a href="?pays=Tunisie" class="btn btn-custom">Tunisie 🇹🇳</a>
    <a href="?pays=Allemagne" class="btn btn-custom">Allemagne 🇩🇪</a>
    <a href="?pays=Turquie" class="btn btn-custom">Turquie 🇹🇷</a>
  </div>

  <?php
  if (isset($_GET['pays'])) {
    $pays = $_GET['pays'];
    $messages = [
      'France' => [
        'msg_fr' => '🇫🇷 Vous êtes français !',
        'msg_lang' => '🇫🇷 You are French!',
        'class' => 'alert-primary',
      ],
      'Espagne' => [
        'msg_fr' => '🇪🇸 Vous êtes espagnol !',
        'msg_lang' => '🇪🇸 ¡Usted es español!',
        'class' => 'alert-danger',
      ],
      'Italie' => [
        'msg_fr' => '🇮🇹 Vous êtes italien !',
        'msg_lang' => '🇮🇹 Sei italiano!',
        'class' => 'alert-success',
      ],
      'Tunisie' => [
        'msg_fr' => '🇹🇳 Vous êtes tunisien !',
        'msg_lang' => '🇹🇳 إنت تونسي!',
        'class' => 'alert-warning',
      ],
      'Allemagne' => [
        'msg_fr' => '🇩🇪 Vous êtes allemand !',
        'msg_lang' => '🇩🇪 Sie sind Deutscher!',
        'class' => 'alert-info',
      ],
      'Turquie' => [
        'msg_fr' => '🇹🇷 Vous êtes turc !',
        'msg_lang' => '🇹🇷 Sen Türk\'sün!',
        'class' => 'alert-secondary',
      ],
    ];

    if (array_key_exists($pays, $messages)) {
      $alertClass = $messages[$pays]['class'];
      $msgFr = $messages[$pays]['msg_fr'];
      $msgLang = $messages[$pays]['msg_lang'];
      echo "<div class='message $alertClass'>";
      echo "<div>$msgFr</div>";
      echo "<div>$msgLang</div>";
      echo "</div>";
    } else {
      echo "<div class='message alert-secondary'>Pays non reconnu.</div>";
    }
  }
  ?>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php session_destroy(); ?>