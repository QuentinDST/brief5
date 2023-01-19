<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
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
                    <a href="create-deleteCategorie.php" class="btn btn-success btn-sm"><i class="bi bi-plus"></i> Add / Edit New Category</a>
                </div>
            </div>
        </div>

    <div class="container">
        <?php
        //Connexion à la base de donnée.
        include 'connexionDb/database.php';
        //Récupérer les données de ma table Bookmarks via la table de jointure en utilisant 
        // GROUPCONCAT et GROUPBY pour eviter les lignes en doublon, et concaténer le nom des catégorie
        $getBookmarks = "SELECT 
        bookmarks.`id`, 
        bookmarks.`URL`, 
        bookmarks.`Title`, 
        bookmarks.`Description`, 
        GROUP_CONCAT(categories.name) as categories_string 
        FROM bookmarks 
        LEFT OUTER JOIN bookmarks_categories ON bookmarks.`id` = bookmarks_categories.bookmark_id 
        LEFT OUTER JOIN categories ON bookmarks_categories.categorie_id = categories.id
        GROUP BY bookmarks.`id`";
        $result = $db->prepare($getBookmarks);
        
        $result->execute();
        
        // Creation du tableau d'affichage des données
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-striped data-toggle="table" data-pagination="true" table-bordered>';
            echo '<thead>';
                echo '<tr>';
                    echo '<th data-sortable="true" data-field="ID">ID</th>';
                    echo '<th>URL</th>';
                    echo '<th>Title</th>';
                    echo '<th>Description</th>';
                    echo '<th>Categorie</th>';
                    echo '<th>Edition</th>';
                echo '</tr>';
            echo '</thead>';
        echo '<tbody>';
        echo '</div>';
        // Boucle qui parcours les résultats et crée les lignes du tableau
    
        $bookmarks = $result->fetchAll();
        if (count($bookmarks) > 0) {
            foreach($bookmarks as $row) {
                echo '<tr>';
                    echo '<td class="data_id">' . $row['id'] . '</td>';
                    echo '<td class="data_url"><a href="' . $row['URL'] . '" target="_blank">' . $row['URL'] . '</a></td>';
                    echo '<td class="data_title">' . $row['Title'] . '</td>';
                    echo '<td class="data">' . $row['Description'] . '</td>';
                    // afficher les catégories en utilisant la fonction explode() pour séparer les catégories 
                    // qui sont stockées dans une chaine de caractères (séparées par des virgules) en un tableau
                    echo '<td class="data">';$categories = explode(",", $row['categories_string']);
                        foreach($categories as $categorie) {
                            echo $categorie . "<br>";
                        }
                    echo '</td>';
                    echo '<td class="data">';
                    //Penser à récupérer l'id pour effectuer les requêtes Edit et Delete
                    echo '<a class="btn--edit" href="edit.php?id= '. $row['id'] .'"><span class="bi bi-pencil"></span></a>';
                    echo '<a class="btn--delete" href="delete.php?id='. $row['id'] .'" ><span class="bi bi-trash"></span></a>';
                    ?> 

                    <!-- <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="deletebookmark" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deletebookmark">Confirmer la suppression</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Êtes-vous sûr de vouloir supprimer ce bookmark? Cette action est définitive.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-success" data-dismiss="modal">Annuler</button>
                              <a href="" type="submit" name="delete-bookmark" class="btn btn-danger">Supprimer</a>
                            </div>
                          </div>
                        </div>
                    </div> -->

                    <?php
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