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
    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
        <div class="container">
            <a class="navbar-brand" href="#">WELCOME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Togglenavigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="create.php">AJOUTER UN BOOKMARK</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Login
                </span>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row bookmark--title">
            <div class="col-md-12">
                <div class="mt-5 mb-3 d-flex justify-content-center index--title">
                    <h1>Ajoute tes bookmark favoris et range les par catégories</h1>
                </div>
            </div>
        </div>
        <div class="row bookmark--button">
            <div class="col-md-12">
                <div class="col-6 gy-5 mx-auto d-flex justify-content-between index--title">
                    <a href="create.php" class="btn btn-success btn-sm index--button"><i class="bi bi-plus"></i> Add New Bookmark</a>
                    <a href="createCategorie.php" class="btn btn-success btn-sm"><i class="bi bi-plus"></i> Add New Category</a>
                </div>
            </div>
        </div>

    <div class="container">
        <?php
        //Connexion à la base de donnée.
        include 'connexionDb/database.php';
        //Récupérer les données de ma table Bookmarks via la table de jointure
        $sql = "SELECT 
        bookmarks.`id`, 
        bookmarks.`URL`, 
        bookmarks.`Title`, 
        bookmarks.`Description`, 
        categories.name 

        FROM bookmarks 
        JOIN bookmarks_categories ON bookmarks.`id` = bookmarks_categories.bookmark_id 
        JOIN categories ON bookmarks_categories.categorie_id = categories.id;";
        $stmt = $db->prepare($sql);
        
        $stmt->execute();
        
        // Creation du tableau d'affichage des données
        echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>ID</th>';
                    echo '<th>URL</th>';
                    echo '<th>Title</th>';
                    echo '<th>Description</th>';
                    echo '<th>Categorie</th>';
                    echo '<th>Edition</th>';
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
                    echo '<td class="data">' . $row['name'] . '</td>';
                    echo '<td class="data">';
                    //Penser à récupérer l'id pour effectuer les requêtes Edit et Delete
                    echo '<a class="btn--edit" href="edit.php?id= '. $row['id'] .'"><span class="bi bi-pencil"></span></a>';
                        echo '<a class="btn--delete" href="delete.php?id='. $row['id'] .'" ><span class="bi bi-trash"></span></a>';
                    echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">Aucune donnée trouvée</td></tr>';
        }

        ?>
    </div>
</div>
</body>
</html>