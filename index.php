<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/style.css">
    <title>BOOKMARKS</title>
</head>
<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 d-flex justify-content-between">
                        <h2 class="">Ajoute tes Bookmarks préféré et range les par catégorie!</h2>
                        <a href="create.php" class="btn btn-success"><i class="bi bi-plus"></i> Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <?php

            //Connexion à la base de donnée.
            include 'connexionDb/database.php';

            //Récupérer les données de ma table Bookmarks
            $sql = "SELECT `id`, `URL`, `Title`, `Description` FROM bookmarks;";

            $stmt = $db->prepare($sql);
            
            $stmt->execute();
            
            // Creation du tableau d'affichage des données
            echo '<table class="table table-bordered">';
                echo '<thead>';
                    echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>URL</th>';
                        echo '<th>Title</th>';
                        echo '<th>Description</th>';
                        echo '<th>Categorie</th>';
                        echo '<th>Action</th>';
                    echo '</tr>';
                echo '</thead>';
            echo '<tbody>';

            // Boucle qui parcours les résultats et crée les lignes du tableau
            $result = $stmt->fetchAll();
            if (count($result) > 0) {
                foreach($result as $row) {
                    echo '<tr>';
                        echo '<td class="data_id">' . $row['id'] . '</td>';
                        echo '<td class="data_url">' . $row['URL'] . '</td>';
                        echo '<td class="data_title">' . $row['Title'] . '</td>';
                        echo '<td class="data">' . $row['Description'] . '</td>';
                        echo '<td class="data">' . $row['categorie_id'] . '</td>';
                        echo '<td class="data">';
                            echo '<a href="#" ><span class="bi bi-pencil"></span></a>';
                            echo '<a href="#" ><span class="bi bi-trash"></span></a>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">Aucune donnée trouvée</td></tr>';
            }
            ?>

        </div>

</body>
</html>