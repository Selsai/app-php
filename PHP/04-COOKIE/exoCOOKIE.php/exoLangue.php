<?php
$langues = [
    'fr' => 'Français',
    'en' => 'English',
    'es' => 'Español',
    'ar' => 'العربية'
];

if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $langues)) {
    $langue = $_GET['lang'];
    setcookie('lang', $langue, time() + 3600 * 24 * 30, '/');
} elseif (isset($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], $langues)) {
    $langue = $_COOKIE['lang'];
} else {
    $langueNavigator = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $langue = array_key_exists($langueNavigator, $langues) ? $langueNavigator : 'en';
}

$phrases = [
    'fr' => "Bonjour ! La langue sélectionnée est le français.",
    'en' => "Hello! The selected language is English.",
    'es' => "¡Hola! El idioma seleccionado es español.",
    'ar' => "مرحبا! تم اختيار اللغة العربية."
];
?>
<!DOCTYPE html>
<html lang="<?php echo $langue; ?>">
<head>
<meta charset="UTF-8">
<title>Choix de langue avec Cookie</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  @keyframes blob {
      0%,100% { transform: scale(1) translateY(0);}
      50% { transform: scale(1.15) translateY(30px);}
  }
  .blob { animation: blob 7s infinite alternate; }
  @keyframes shine {
      to { background-position: 200%;}
  }
  .btn-animated {
      position: relative; overflow: hidden;
  }
  .btn-animated:after {
      content:'';
      position:absolute; left:-80%; top:0; width:220%; height:100%;
      background:linear-gradient(60deg,transparent 35%,rgba(255,255,255,.4) 50%,transparent 65%);
      opacity:.7; background-size:200% 100%; transition:background-position .7s;
  }
  .btn-animated:hover:after { animation: shine .9s linear 1; }
</style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-pink-100 via-purple-100 to-indigo-200">

<!-- Blobs animés -->
<div class="absolute top-8 left-8 w-80 h-80 bg-pink-400 rounded-full filter blur-3xl opacity-40 blob"></div>
<div class="absolute bottom-10 right-10 w-72 h-72 bg-violet-400 rounded-full filter blur-2xl opacity-35 blob"></div>
<div class="absolute top-1/3 right-1/4 w-56 h-56 bg-fuchsia-300 rounded-full filter blur-2xl opacity-30 blob"></div>

<!-- Carte centrale -->
<div class="relative z-10 px-10 py-12 card-glass rounded-3xl shadow-2xl max-w-lg w-full bg-white/25 backdrop-blur-2xl border border-white/30 flex flex-col items-center">
  <h1 class="text-3xl font-black bg-gradient-to-r from-pink-500 via-violet-600 to-indigo-900 bg-clip-text text-transparent animate-pulse mb-4 text-center">
    <?php echo $phrases[$langue]; ?>
  </h1>
  <p class="mb-6 text-lg text-gray-700 font-medium">Choisissez votre langue :</p>
  <div class="flex gap-4 mb-7 flex-wrap justify-center">
  <?php foreach ($langues as $code => $nom) : ?>
    <a href="?lang=<?php echo $code; ?>"
      class="btn-animated px-6 py-2 rounded-full font-semibold shadow text-white border border-white/10 text-lg transition-transform
        <?php echo $code === $langue ? 'bg-gradient-to-br from-violet-700 via-pink-500 to-fuchsia-500 scale-110 pointer-events-none' : 'bg-gradient-to-tr from-pink-400 to-purple-400 hover:from-purple-400 hover:to-pink-500 hover:scale-110'; ?>">
      <?php echo $nom; ?>
    </a>
  <?php endforeach; ?>
  </div>
  <p class="text-sm text-gray-500 italic">Rafraîchissez la page pour tester la mémorisation.</p>
</div>
</body>
</html>
