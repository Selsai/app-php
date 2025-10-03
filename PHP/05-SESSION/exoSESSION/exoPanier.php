<?php
session_start();

$products = [
    1 => ["id" => 1, "name" => "Bouquet de Roses", "price" => 25, "image" => "img/img-rose.jpeg"],
    2 => ["id" => 2, "name" => "Tulipes en Pot", "price" => 15, "image" => "img/img-tulipe.jpg"],
    3 => ["id" => 3, "name" => "Pivoine Élégante", "price" => 35, "image" => "img/img-pivoine.jpg"],
    4 => ["id" => 4, "name" => "Renoncule Fraîche", "price" => 20, "image" => "img/img-renoncule.jpg"],
];

// Ajout au panier avec quantité (dropdown)
if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    $qty = (isset($_GET['quantity']) && (int)$_GET['quantity'] > 0) ? (int)$_GET['quantity'] : 1;
    if (isset($products[$id])) {
        $product = $products[$id];
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                "id" => $product['id'],
                "name" => $product['name'],
                "price" => $product['price'],
                "quantity" => $qty,
                "image" => $product['image']
            ];
        } else {
            $_SESSION['cart'][$id]['quantity'] += $qty;
        }
        $_SESSION['last_added'] = $product['name'];
    }
    header("Location: exoPanier.php?added=1");
    exit;
}
$notif = isset($_GET['added']) && isset($_SESSION['last_added']) ? $_SESSION['last_added'] : '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Boutique Fleurie – Accueil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-tr from-pink-50 via-yellow-100 to-green-50 min-h-screen font-sans antialiased relative">

  <!-- notification / loader -->
  <?php if($notif): ?>
    <script>
      window.onload = function() {
        Swal.fire({
          toast: true,
          icon: 'success',
          title: "<?= $notif ?> ajouté au panier !",
          position: 'top-end',
          showConfirmButton: false,
          timer: 1800,
          timerProgressBar: true
        });
      }
    </script>
  <?php endif; ?>

  <!-- HEADER NAV -->
  <header class="p-6 bg-white/80 backdrop-blur flex justify-between items-center shadow-md sticky top-0 z-10 transition-all duration-500">
    <div class="flex items-center gap-3">
      <span class="text-3xl animate-spin-slow">🌸</span>
      <span class="font-extrabold text-2xl tracking-wide text-pink-700">Boutique Fleurie</span>
    </div>
    <nav>
      <a href="panier.php" class="relative px-5 py-3 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold shadow-lg transition-all duration-300 scale-100 hover:scale-105">
          🛒
          <span class="absolute top-0 right-1 bg-green-500 text-white rounded-full px-2 py-0 text-xs font-bold animate-pulse">
              <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
          </span>
          Voir le panier
      </a>
    </nav>
  </header>

  <!-- PRODUIT GALLERY -->
  <main class="max-w-7xl mx-auto py-10 px-3">
    <h1 class="text-4xl text-center font-bold text-pink-600 drop-shadow mb-10 tracking-wider animate-fadeInDown">Découvrez nos plus belles fleurs</h1>
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 mb-16">
      <?php foreach ($products as $p): ?>
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300 group hover:bg-pink-50 relative animate-fadeInUp">
        <img src="<?= $p['image']; ?>" alt="<?= htmlspecialchars($p['name']); ?>" class="h-56 w-full object-cover group-hover:brightness-90 transition rounded-t-2xl"/>
        <div class="p-6 flex flex-col gap-1">
          <h3 class="font-bold text-xl text-pink-700 group-hover:text-pink-800 transition flex items-center">
            <?= $p['name']; ?>
            <button title="Ajouter en favori" class="ml-2 text-red-400 text-lg group-hover:text-red-500 transition-all hover:scale-125 focus:outline-none">
              <i class="fa-regular fa-heart"></i>
            </button>
          </h3>
          <span class="text-pink-500 font-semibold text-lg"><?= $p['price']; ?> €</span>
          <form method="get" class="flex items-center gap-2 mt-4">
            <input type="hidden" name="add" value="<?= $p['id']; ?>"/>
            <select name="quantity" class="rounded-lg border border-pink-200 bg-pink-50 px-2 py-1 text-pink-700">
              <?php for($i=1;$i<=20;$i++): ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php endfor; ?>
            </select>
            <button 
             class="bg-green-500 hover:bg-green-600 text-white text-center py-2 px-3 rounded-xl font-semibold shadow-md transition-all duration-200 animate-pulse hover:animate-none hover:scale-105 flex-1"
             type="submit">
              <i class="fa fa-cart-plus mr-1"></i> Ajouter au panier
            </button>
          </form>
        </div>
        <span title="Original" class="absolute left-2 top-2 bg-yellow-400 text-white text-xs px-3 py-1 rounded-xl shadow hover:bg-yellow-500 transition font-bold">BestSeller</span>
      </div>
      <?php endforeach; ?>
    </section>

    <!-- Filtres et suggestions (peuvent être retirés si jugés inutiles) -->

    <!-- A propos / FAQ -->
    <section id="about" class="bg-white/80 rounded-xl shadow-lg p-8 max-w-3xl mx-auto text-center mb-16 flex flex-col gap-4 animate-fadeInUp">
      <h2 class="text-2xl font-bold text-pink-700 mb-2">À propos de Boutique Fleurie</h2>
      <p class="text-gray-700 text-lg">Depuis 2020, nous sélectionnons les meilleures variétés de fleurs : tulipes, pivoines, roses et renoncules. Local, de saison, et des conseils sur l’entretien par mail !</p>
      <div class="flex justify-center gap-3 mt-3">
        <a href="mailto:contact@boutiquefleurie.fr" class="inline-block bg-pink-100 text-pink-700 px-6 py-2 rounded-full shadow hover:bg-pink-200 transition">
          Nous contacter
        </a>
        <a href="https://instagram.com/" target="_blank" class="inline-block bg-pink-50 text-pink-600 px-6 py-2 rounded-full shadow hover:bg-pink-100 transition">
          <i class="fa-brands fa-instagram mr-1"></i> Instagram
        </a>
      </div>
      <details class="mt-5 text-gray-600 text-sm">
        <summary class="cursor-pointer text-pink-600">FAQ - Questions fréquentes</summary>
        <ul class="mt-3 text-left list-disc pl-5">
          <li>Livraison en express dans toute la France</li>
          <li>Conseils d'entretien gratuits après commande</li>
          <li>Fleurs fraîches garanties chaque semaine</li>
        </ul>
      </details>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="bg-gradient-to-br from-pink-100 via-white to-pink-50 py-8 text-center text-gray-500 font-light shadow-inner">
    <div class="mb-2 flex justify-center gap-6">
      <a href="https://instagram.com/" class="hover:text-pink-700 transition">Instagram</a>
      <a href="mailto:contact@boutiquefleurie.fr" class="hover:text-pink-700 transition">Contact</a>
    </div>
    &copy; 2025 Boutique Fleurie &middot; Design réalisé avec <span class="animate-heartPulse">💗</span> by Selsa
  </footer>
  <style>
    @keyframes fadeInUp { from{opacity:0;transform:translateY(30px);} to{opacity:1;transform:translateY(0);} }
    @keyframes fadeInDown { from{opacity:0;transform:translateY(-30px);} to{opacity:1;transform:translateY(0);} }
    .animate-fadeInUp { animation: fadeInUp .9s both;}
    .animate-fadeInDown { animation: fadeInDown 1s both;}
    @keyframes heartPulse { 0%{ transform:scale(1);} 70%{ transform:scale(1.23);} 100%{transform:scale(1);} }
    .animate-heartPulse { display:inline-block; animation: heartPulse 1.1s infinite; }
    @keyframes spinSlow { 0%{transform:rotate(0);} 100%{transform:rotate(360deg);} }
    .animate-spin-slow { animation: spinSlow 12s linear infinite;}
  </style>
</body>
</html>
