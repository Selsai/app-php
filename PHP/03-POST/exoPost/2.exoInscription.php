<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

$pseudo = $email = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = trim($_POST['pseudo'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $password = $_POST['password'] ?? "";
    $confirm = $_POST['confirm'] ?? "";

    // Vérifications
    if (strlen($pseudo) < 3) {
        $errors[] = "Le pseudo doit contenir au moins 3 caractères.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Le format de l'email est invalide.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
    }

    if ($password !== $confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    foreach ($_SESSION['users'] as $user) {
        if ($user['pseudo'] === $pseudo) {
            $errors[] = "Ce pseudo est déjà pris.";
            break;
        }
    }

    // Pas d'erreurs → Enregistrement
    if (empty($errors)) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // Par défaut, avatar vide et date d'inscription enregistrée
        $_SESSION['users'][] = [
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $hashPassword,
            'avatar' => null,
            'registered_at' => time()
        ];

        $_SESSION['registered_at'] = time();

        $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        $pseudo = $email = "";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Inscription Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animations */
        @keyframes fadeSlideIn {
            0% {opacity: 0; transform: translateY(15px);}
            100% {opacity: 1; transform: translateY(0);}
        }
        @keyframes pulseText {
            0%, 100% {opacity: 1;}
            50% {opacity: 0.7;}
        }
        .fade-slide-in {
            animation: fadeSlideIn 0.8s ease forwards;
        }
        .pulse-text {
            animation: pulseText 2s ease infinite;
        }
        input:focus {
            box-shadow: 0 0 12px rgba(219, 39, 119, 0.7);
            transition: box-shadow 0.3s ease;
        }
        button:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(219, 39, 119, 0.5);
            transition: all 0.3s ease;
        }
        a:hover {
            text-decoration: underline;
            color: #9333ea;
            transition: color 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-tr from-purple-300 via-pink-300 to-yellow-200 min-h-screen flex items-center justify-center p-6">

<div class="bg-white bg-opacity-80 backdrop-blur-md rounded-3xl shadow-2xl max-w-md w-full p-10 fade-slide-in">
    <h2 class="text-4xl font-extrabold text-purple-700 mb-6 text-center tracking-wide pulse-text">Inscription Utilisateur</h2>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 shadow-inner transition-opacity duration-500 ease-in-out">
            <ul class="list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center shadow-inner transition-opacity duration-500 ease-in-out">
            <?= $success ?>
        </p>
        <div class="text-center">
            <a href="3.exoConnexion.php" class="text-purple-700 font-bold hover:underline">Aller à la connexion</a>
        </div>
    <?php endif; ?>

    <form method="POST" action="" class="space-y-6">
        <div>
            <label for="pseudo" class="block text-purple-700 font-semibold mb-2">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($pseudo) ?>"
                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-300 transition duration-300"
                   required />
        </div>

        <div>
            <label for="email" class="block text-purple-700 font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>"
                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-300 transition duration-300"
                   required />
        </div>

        <div>
            <label for="password" class="block text-purple-700 font-semibold mb-2">Mot de passe</label>
            <input type="password" id="password" name="password"
                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-300 transition duration-300"
                   required />
        </div>

        <div>
            <label for="confirm" class="block text-purple-700 font-semibold mb-2">Confirmer mot de passe</label>
            <input type="password" id="confirm" name="confirm"
                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-xl focus:outline-none focus:ring-4 focus:ring-pink-300 transition duration-300"
                   required />
        </div>

        <button type="submit"
                class="w-full bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-500 text-white font-bold py-3 rounded-full shadow-lg">
            S'inscrire
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="3.exoConnexion.php" class="text-purple-700 font-bold hover:underline">Déjà inscrit ? Connexion</a>
    </div>
</div>

</body>
</html>
