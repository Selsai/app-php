<?php
session_start();

$id = $_GET['id'] ?? null;
if (!$id || !isset($_SESSION['produits'][$id])) {
    header('Location: 3-exoProductList.php');
    exit;
}

$produit = $_SESSION['produits'][$id];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <title><?= htmlspecialchars($produit['nom']) ?> - Ma Boutique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fafb;
            color: #444;
        }

        .navbar {
            background: linear-gradient(90deg, #4b6cb7 0%, #182848 100%);
            box-shadow: 0 4px 10px rgba(24, 40, 72, 0.4);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.7rem;
            letter-spacing: 2px;
            color: white !important;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(75, 108, 183, 0.15);
        }

        .img-product {
            border-radius: 15px 0 0 15px;
            width: 100%;
            max-height: 400px;
            object-fit: cover;
        }

        .card-title {
            font-weight: 700;
            font-size: 2rem;
            color: #182848;
        }

        .card-text {
            font-weight: 300;
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 25px;
        }

        .badge {
            font-weight: 600;
            background-color: #4b6cb7;
            color: #f0f4f8;
            padding: 8px 18px;
            border-radius: 12px;
            font-size: 1rem;
        }

        .btn-secondary {
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #364fc7;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a href="3-exoProductList.php" class="navbar-brand">Ma Boutique</a>
    </div>
</nav>

<div class="container py-5">
    <a href="3-exoProductList.php" class="btn btn-secondary mb-4">&laquo; Retour à la boutique</a>
    <div class="card shadow-sm">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>"
                     class="img-product"/>
            </div>
            <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                <h2 class="card-title"><?= htmlspecialchars($produit['nom']) ?></h2>
                <p class="card-text"><?= htmlspecialchars($produit['desc']) ?></p>
                <span class="badge"><?= htmlspecialchars($produit['categorie']) ?></span>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
