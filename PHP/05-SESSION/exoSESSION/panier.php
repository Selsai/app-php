<?php
session_start();

$products = [
    1 => ["id" => 1, "name" => "Bouquet de Roses", "price" => 25, "image" => "img/img-rose.jpeg"],
    2 => ["id" => 2, "name" => "Tulipes en Pot", "price" => 15, "image" => "img/img-tulipe.jpg"],
    3 => ["id" => 3, "name" => "Pivoine Élégante", "price" => 35, "image" => "img/img-pivoine.jpg"],
    4 => ["id" => 4, "name" => "Renoncule Fraîche", "price" => 20, "image" => "img/img-renoncule.jpg"],
];

if (isset($_POST['update'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        $qty = (int)$qty;
        if ($qty > 0) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: panier.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    unset($_SESSION['cart'][$id]);
    header("Location: panier.php");
    exit;
}

if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: panier.php");
    exit;
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Panier – Boutique Fleurie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-yellow-50 via-pink-50 to-purple-100 min-h-screen font-sans antialiased">

  <!-- Header -->
  <header class="p-6 bg-white/80 backdrop-blur flex justify-between items-center shadow-md sticky top-0 z-10 transition-all duration-500">
    <div class="flex items-center gap-3">
      <span class="text-3xl animate-spin-slow">🌸</span>
      <span class="font-extrabold text-2xl tracking-wide text-pink-700">Boutique Fleurie</span>
    </div>
    <nav>
      <a href="exoPanier.php" class="px-5 py-3 rounded-xl bg-pink-600 hover:bg-pink-700 text-white font-semibold shadow-lg transition-all scale-100 hover:scale-105">
        ← Retour à la boutique
      </a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto pt-10 px-3">
    <h1 class="text-3xl font-bold text-pink-600 text-center mb-8 animate-fadeInDown">🛒 Votre panier</h1>
    <?php if(!empty($_SESSION['cart'])): ?>
      <form method="post" autocomplete="off" class="animate-fadeInUp shadow-xl rounded-2xl bg-white/90 p-6 overflow-x-auto">
        <table class="w-full border-collapse text-center text-pink-800">
          <thead class="bg-pink-300 text-white">
            <tr>
              <th class="p-4 rounded-tl-xl">Produit</th>
              <th class="p-4">Image</th>
              <th class="p-4">Prix</th>
              <th class="p-4">Quantité</th>
              <th class="p-4">Total</th>
              <th class="p-4 rounded-tr-xl">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION['cart'] as $id => $item):
              $subtotal = $item['price'] * $item['quantity'];
              $total += $subtotal;
            ?>
            <tr class="border-b border-pink-100 hover:bg-pink-50 transition group">
              <td class="p-4 font-semibold text-left"><?= htmlspecialchars($item['name']); ?></td>
              <td class="p-4">
                <img src="<?= $item['image']; ?>" alt="<?= htmlspecialchars($item['name']); ?>" class="h-20 w-20 mx-auto rounded-lg object-cover shadow">
              </td>
              <td class="p-4 font-medium"><?= $item['price']; ?> €</td>
              <td class="p-4">
                <select name="quantities[<?= $id ?>]" class="w-20 px-2 py-1 rounded-md border border-pink-300 bg-pink-50 text-pink-700">
                  <?php for ($i=1; $i<=20; $i++): ?>
                    <option value="<?= $i ?>" <?= $item['quantity'] == $i ? 'selected' : ''; ?>><?= $i ?></option>
                  <?php endfor; ?>
                </select>
              </td>
              <td class="p-4 font-bold"><?= $subtotal; ?> €</td>
              <td class="p-4">
                <a href="?delete=<?= $id ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-xl shadow transition remove-btn" title="Retirer"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="mt-8 flex justify-between items-center">
          <p class="font-bold text-2xl text-pink-700">Total : <?= $total; ?> €</p>
          <div>
            <button type="submit" name="update" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl text-white font-semibold shadow-lg transition-all duration-300 mr-3">Mettre à jour</button>
            <a href="?clear=1" class="bg-gray-400 hover:bg-gray-500 px-6 py-3 rounded-xl text-white font-semibold shadow-lg transition">Vider le panier</a>
          </div>
        </div>
      </form>
      <!-- Suggestions produit en bas du panier -->
      <div class="mt-10 mb-8">
        <h2 class="font-bold text-lg text-pink-700 mb-4">🌷 Suggestions pour compléter votre panier</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <?php foreach ($products as $pid => $prod): 
            if (!isset($_SESSION['cart'][$pid])): ?>
              <div class="bg-white rounded-xl shadow hover:scale-105 overflow-hidden transition">
                <img src="<?= $prod['image'] ?>" class="h-32 w-full object-cover" alt="<?= htmlspecialchars($prod['name']); ?>"/>
                <div class="p-3 flex flex-col gap-2">
                  <h3 class="font-bold text-pink-700"><?= $prod['name']; ?></h3>
                  <span class="text-pink-500"><?= $prod['price']; ?> €</span>
                  <a href="exoPanier.php?add=<?= $prod['id']; ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded font-semibold shadow transition">Ajouter</a>
                </div>
              </div>
            <?php endif;
          endforeach; ?>
        </div>
      </div>
    <?php else: ?>
      <p class="text-center text-xl text-pink-700 mt-20 font-semibold flex flex-col gap-2 animate-fadeIn">
        Votre panier est vide... <span class="text-3xl">🥀</span>
      </p>
    <?php endif; ?>
  </main>

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
    @keyframes heartPulse { 0%{ transform:scale(1);} 70%{ transform:scale(1.23);} 100%{transform:scale(1);} }
    .animate-fadeInUp { animation: fadeInUp .7s both;}
    .animate-fadeInDown { animation: fadeInDown 1s both;}
    .animate-heartPulse { display:inline-block; animation: heartPulse 1.1s infinite;}
    @keyframes spinSlow { 0%{transform:rotate(0);} 100%{transform:rotate(360deg);} }
    .animate-spin-slow { animation: spinSlow 12s linear infinite;}
    .remove-btn:hover { transform: scale(1.20); transition: transform .2s;}
  </style>
</body>
</html>
