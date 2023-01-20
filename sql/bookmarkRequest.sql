-- CRUD Pour les bookmarks (liens)

-- Insérer un bookmark

INSERT INTO bookmarks (`url`, `title`, `description`,`creation_date`) 
VALUES ('https://www.google.fr/', 'google', 'moteur de recherche', '09/01/2023');

-- Récupérer les données de ma table Bookmarks via la table de jointure
        
SELECT 
bookmarks.`id`, 
bookmarks.`URL`, 
bookmarks.`Title`, 
bookmarks.`Description`, 
categories.name
FROM bookmarks 
JOIN bookmarks_categories ON bookmarks.`id` = bookmarks_categories.bookmark_id 
JOIN categories ON bookmarks_categories.categorie_id = categories.id;;


-- Insérer un bookmark 

INSERT INTO bookmarks (`URL`,`Title`, `Description`) 
 VALUES (?, ?, ?)

-- Récupérer la ligne du bookmark selectionné pour le modifier

SELECT `URL`, `Title`, `Description` FROM bookmarks WHERE `id` = $id

-- Modifier un bookmark

UPDATE bookmarks 
SET URL = :url, Title = :title, Description = :description WHERE id = :id;


-- Supprimer un bookmark

DELETE FROM bookmarks WHERE `id`=`$id`