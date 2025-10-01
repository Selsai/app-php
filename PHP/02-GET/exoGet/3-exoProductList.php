<?php
session_start();

if (!isset($_SESSION['produits'])) {
    $_SESSION['produits'] = [
        1 => ["id"=>1, "nom"=>"Chaussures Sport", "desc"=>"Chaussures confortables pour courir", "categorie"=>"Chaussures", "image"=>"https://picsum.photos/400/300?random=1"],
        2 => ["id"=>2, "nom"=>"T-shirt Blanc", "desc"=>"T-shirt en coton bio", "categorie"=>"Vêtements", "image"=>"https://picsum.photos/400/300?random=2"],
        3 => ["id"=>3, "nom"=>"Sac à dos", "desc"=>"Sac à dos pratique pour voyages", "categorie"=>"Accessoires", "image"=>"https://picsum.photos/400/300?random=3"],
        4 => ["id"=>4, "nom"=>"Jeans Bleu", "desc"=>"Jean slim moderne", "categorie"=>"Vêtements", "image"=>"https://picsum.photos/400/300?random=4"],
        5 => ["id"=>5, "nom"=>"Casquette", "desc"=>"Casquette stylée", "categorie"=>"Accessoires", "image"=>"https://picsum.photos/400/300?random=5"]
    ];
}

$categories = array_unique(array_column($_SESSION['produits'], 'categorie'));
sort($categories);

$filtre = $_GET['categorie'] ?? 'Toutes';

$produitsFiltres = ($filtre === 'Toutes') ? $_SESSION['produits'] : array_filter($_SESSION['produits'], fn($p) => $p['categorie'] === $filtre);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Ma Boutique - Produits</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f9fafb;
        color: #444;
    }
    .navbar {
        background: linear-gradient(90deg, #4b6cb7 0%, #182848 100%);
        box-shadow: 0 4px 10px rgba(24, 40, 72,0.4);
    }
    .navbar-brand {
        font-weight: 700;
        font-size: 1.7rem;
        letter-spacing: 2px;
        color: #fff !important;
    }
    .nav-link {
        font-weight: 500;
        color: #cbd5e1 !important;
        transition: color 0.3s ease;
        letter-spacing: 0.5px;
    }
    .nav-link.active,
    .nav-link:hover {
        color: #e9ecef !important;
        text-shadow: 0 0 5px #4b6cb7;
    }
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(75, 108, 183, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 12px 40px rgba(75, 108, 183, 0.3);
        transform: translateY(-8px);
    }
    .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        height: 220px;
        object-fit: cover;
    }
    .card-title {
        font-weight: 700;
        color: #182848;
    }
    .card-text {
        font-weight: 300;
        font-size: 0.95rem;
        color: #666;
        min-height: 60px;
    }
    .badge {
        font-weight: 600;
        background-color: #4b6cb7;
        color: #f0f4f8;
        padding: 6px 12px;
        border-radius: 12px;
    }
    .btn-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(118, 75, 162, 0.6);
        transition: background 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(45deg, #764ba2, #667eea);
    }
    h1 {
        font-weight: 700;
        color: #182848;
        margin-bottom: 30px;
        letter-spacing: 1.5px;
    }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a href="3-exoProductList.php" class="navbar-brand">Ma Boutique</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="3-exoProductList.php" class="nav-link <?= $filtre === 'Toutes' ? 'active' : '' ?>">Toutes</a>
                </li>
                <?php foreach ($categories as $cat): ?>
                    <li class="nav-item">
                        <a href="3-exoProductList.php?categorie=<?= urlencode($cat) ?>" class="nav-link <?= $filtre === $cat ? 'active' : '' ?>"><?= htmlspecialchars($cat) ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1>Produits : <?= htmlspecialchars($filtre) ?></h1>
    <div class="row g-4">
        <?php if (empty($produitsFiltres)): ?>
            <p class="text-center text-muted fs-5 mt-5">Aucun produit trouvé dans cette catégorie.</p>
        <?php else: ?>
            <?php foreach ($produitsFiltres as $produit): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="card h-100">
                        <img src="<?= $produit['image'] ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" class="card-img-top" />
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($produit['nom']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($produit['desc']) ?></p>
                            <span class="badge mb-3"><?= htmlspecialchars($produit['categorie']) ?></span>
                            <a href="produit.php?id=<?= $produit['id'] ?>" class="btn btn-primary mt-auto">Voir le produit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
