<?php
/*
    EXERCICE GET : 
        Créer un tableau de gestion des utilisateurs back office 

        Etapes : 
            1 - Lancer l'instruction session_start(), cela vous donne accès à une superglobale nommée $_SESSION (c'est un array) qui peut stocker les données de votre choix et les transporter tout au long de la navigation 
            2 - Dans cette superglobale, à un indice [users], insérer des données fictives d'utilisateurs, par exemple, id, prenom, nom, email (cet array va représenter le retour d'une requête de selection en base de données)
            3 - Créer une base de page html pour créer un tableau html représentant les utilisateurs présents dans votre array session
            4 - Rajouter une colonne "actions" dans laquelle vous insérerez des boutons de votre choix pour les actions "Voir" "Modifier" "Supprimer"
            5 - Créer une communication de votre choix par GET via ces boutons pour amener sur une ou plusieurs autres pages pour chaque bouton
            6 - Une fois l'exercice terminé, lancer l'instruction session_destroy();
*/

session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ["id" => 1, "prenom" => "Alice", "nom" => "Dupont", "email" => "alice.dupont@example.com"],
        ["id" => 2, "prenom" => "Bruno", "nom" => "Martin", "email" => "bruno.martin@example.com"],
        ["id" => 3, "prenom" => "Chloé", "nom" => "Durand", "email" => "chloe.durand@example.com"],
    ];
}

$selectedUser = null;
$editUser = null;
$message = '';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'supprimer') {
        foreach ($_SESSION['users'] as $key => $user) {
            if ($user['id'] === $id) {
                unset($_SESSION['users'][$key]);
                $_SESSION['users'] = array_values($_SESSION['users']);
                $message = "Utilisateur supprimé avec succès.";
                header("Location: ".$_SERVER['PHP_SELF']); 
                exit;
            }
        }
    }
    elseif ($action === 'voir' || $action === 'modifier') {
        foreach ($_SESSION['users'] as $user) {
            if ($user['id'] === $id) {
                if ($action === 'voir') $selectedUser = $user;
                else $editUser = $user;
                break;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['prenom'], $_POST['nom'], $_POST['email'])) {
    $id = intval($_POST['id']);
    foreach ($_SESSION['users'] as &$user) {
        if ($user['id'] === $id) {
            $user['prenom'] = htmlspecialchars(trim($_POST['prenom']));
            $user['nom'] = htmlspecialchars(trim($_POST['nom']));
            $user['email'] = htmlspecialchars(trim($_POST['email']));
            $message = "Utilisateur modifié avec succès.";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>✨ Gestion Utilisateurs - Back Office Floral ✨</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        /* Reset */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0; padding: 30px 15px;
            background: linear-gradient(135deg, #fbc7c7, #fddb92);
            font-family: 'Montserrat', sans-serif;
            color: #4a2c3a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            -webkit-font-smoothing: antialiased;
        }

        h1 {
            font-weight: 700;
            font-size: 3.2rem;
            margin-bottom: 22px;
            text-shadow: 1px 1px 6px #e97c8e;
            letter-spacing: 2px;
        }

        .container {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            border-radius: 24px;
            box-shadow: 0 8px 38px rgba(255, 105, 135, 0.25);
            width: 100%;
            max-width: 1080px;
            padding: 36px 45px;
            user-select: none;
        }

table {
    width: 100%;
    border-collapse: collapse; /* fusion des bordures */
    font-size: 1.05rem;
    margin-bottom: 40px;
    background: white;
}

thead th {
    font-weight: 700;
    font-size: 1.15rem;
    color: #fff;
    background: #d84e66;
    padding: 12px 18px;
    border: 1px solid #a93a4b; /* lignes verticales et horizontales */
    border-radius: 0; /* suppression arrondi */
}

tbody tr {
    transition: background 0.25s ease;
}

tbody tr:hover {
    background: #fde8ec; /* survol simple */
}

td {
    font-weight: 500;
    color: #532b3d;
    padding: 12px 6px;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #fbc7c7;
}

.actions {
    display: flex;
    justify-content: center;
    gap: 10px;
}


        .btn {
            background: #d84e66;
            color: #fbe7ec;
            font-weight: 700;
            border: none;
            border-radius: 30px;
            padding: 10px 24px;
            cursor: pointer;
            box-shadow: 0 6px 14px #d84e66cc;
            transition: background 0.35s ease, box-shadow 0.4s ease;
            user-select: none;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn:hover, .btn:focus {
            background: #eb6e85;
            box-shadow: 0 10px 22px #eb6e85cc;
            outline: none;
        }

        .btn.supprimer {
            background: #a02c3e;
        }

        .btn.supprimer:hover {
            background: #d6304a;
            box-shadow: 0 10px 22px #d6304acc;
        }

        .btn.modifier {
            background: #eb8a48;
        }

        .btn.modifier:hover {
            background: #f2a75f;
            box-shadow: 0 10px 22px #f2a75fcc;
        }

        .message {
            color: #b32c4a;
            font-weight: 700;
            font-size: 1.15rem;
            text-align: center;
            margin-bottom: 28px;
            user-select: text;
        }

        form {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 24px;
            padding: 32px 40px;
            max-width: 460px;
            margin: 0 auto 0;
            box-shadow: 0 8px 38px rgba(208, 89, 114, 0.22);
            user-select: text;
        }

        form h2 {
            color: #c63951;
            font-weight: 700;
            margin-bottom: 28px;
            font-size: 1.95rem;
            text-align: center;
            letter-spacing: 1.2px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 16px 20px;
            margin-bottom: 22px;
            border-radius: 20px;
            border: 2px solid #eac7d1;
            font-size: 1.05rem;
            font-weight: 600;
            color: #532b3d;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #d84e66;
            background-color: #fff0f4;
            box-shadow: 0 0 10px #d84e66bb;
        }

        button[type="submit"] {
            background: #d84e66;
            color: #fbe7ec;
            font-size: 1.4rem;
            font-weight: 700;
            border-radius: 36px;
            padding: 16px 0;
            width: 100%;
            cursor: pointer;
            box-shadow: 0 6px 20px #d84e66cc;
            border: none;
            transition: background 0.3s ease, box-shadow 0.4s ease;
            user-select: none;
        }

        button[type="submit"]:hover,
        button[type="submit"]:focus {
            background: #eb6e85;
            box-shadow: 0 12px 28px #eb6e85cc;
            outline: none;
        }

        /* Sections détail et édition utilisateur */
        .detail-box {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 10px 44px rgba(216, 74, 102, 0.3);
            max-width: 430px;
            border-radius: 24px;
            padding: 30px 35px;
            margin: 0 auto 32px auto;
            text-align: center;
            color: #532b3d;
            user-select: text;
        }

        .detail-box h2 {
            color: #c63951;
            margin-bottom: 22px;
            font-size: 1.85rem;
            font-weight: 700;
            letter-spacing: 1.1px;
        }

        .detail-box p {
            font-size: 1.15rem;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .back-link {
            display: inline-block;
            margin-top: 18px;
            font-weight: 600;
            color: #c63951;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .back-link:hover, .back-link:focus {
            color: #eb6e85;
            outline: none;
        }

        /* Responsive */
        @media (max-width: 800px) {
            .container {
                padding: 25px 20px;
            }
            table {
                font-size: 0.95rem;
            }
            body {
                padding: 25px 12px;
            }
            h1 {
                font-size: 2.6rem;
            }
            form {
                max-width: 95%;
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <h1>🌺 Gestion Utilisateurs</h1>
    <div class="container">
        <?php if ($message): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>

        <?php if ($selectedUser): ?>
            <section class="detail-box" role="region" aria-label="Détails utilisateur">
                <h2>Détails utilisateur</h2>
                <p><strong>ID :</strong> <?= $selectedUser['id'] ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($selectedUser['prenom']) ?></p>
                <p><strong>Nom :</strong> <?= htmlspecialchars($selectedUser['nom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($selectedUser['email']) ?></p>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="back-link" aria-label="Retour à la liste des utilisateurs">← Retour à la liste</a>
            </section>
        <?php elseif ($editUser): ?>
            <form method="POST" novalidate aria-label="Formulaire de modification utilisateur">
                <h2>✏️ Modifier l'utilisateur</h2>
                <input type="hidden" name="id" value="<?= $editUser['id'] ?>" />
                <input type="text" name="prenom" value="<?= htmlspecialchars($editUser['prenom']) ?>" placeholder="Prénom" required autocomplete="off" />
                <input type="text" name="nom" value="<?= htmlspecialchars($editUser['nom']) ?>" placeholder="Nom" required autocomplete="off" />
                <input type="email" name="email" value="<?= htmlspecialchars($editUser['email']) ?>" placeholder="Email" required autocomplete="off" />
                <button type="submit">Sauvegarder</button>
                <p style="text-align:center; margin-top: 18px;">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="back-link" aria-label="Annuler la modification">← Annuler</a>
                </p>
            </form>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['users'] as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['prenom']) ?></td>
                            <td><?= htmlspecialchars($user['nom']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td class="actions">
                                <a href="?action=voir&id=<?= $user['id'] ?>" class="btn voir" aria-label="Voir utilisateur <?= htmlspecialchars($user['prenom'].' '.$user['nom']) ?>">👁 Voir</a>
                                <a href="?action=modifier&id=<?= $user['id'] ?>" class="btn modifier" aria-label="Modifier utilisateur <?= htmlspecialchars($user['prenom'].' '.$user['nom']) ?>">✏️ Modifier</a>
                                <a href="?action=supprimer&id=<?= $user['id'] ?>" class="btn supprimer" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');" aria-label="Supprimer utilisateur <?= htmlspecialchars($user['prenom'].' '.$user['nom']) ?>">❌ Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <form method="POST" novalidate aria-label="Formulaire ajout utilisateur">
                <h2>➕ Ajouter un utilisateur</h2>
                <input type="text" name="prenom" placeholder="Prénom" required autocomplete="off" />
                <input type="text" name="nom" placeholder="Nom" required autocomplete="off" />
                <input type="email" name="email" placeholder="Email" required autocomplete="off" />
                <button type="submit">Ajouter</button>
            </form>
        <?php endif; ?>
    </div>

    <?php
    ?>
</body>
</html>
