-- CRUD Pour les bookmarks (liens)

-- Insérer un bookmark

INSERT INTO bookmarks (`url`, `title`, `description`,`creation_date`) 
VALUES ('https://www.google.fr/', 'google', 'moteur de recherche', '09/01/2023');


-- Récupérer tous mes liens triés par titre (création Alias et jointure entre table bookmarks et users)

SELECT 
b.`id`, 
b.`url`, 
b.`title`,
b.`description`, 
u.`id`, 
u.`email` 
FROM bookmarks AS b 
INNER JOIN users AS u ON 
u.`id` = b.`id`
ORDER BY b.title 
DESC;

-- Récupérer le nombre de liens par utilisateur
-- Nombre de lien pour l'utilisateur, prenom, nom, mail

SELECT 
u.`first_name`, 
u.`second_name`, 
u.`email`, 
COUNT(b.id) 
FROM bookmarks AS b 
INNER JOIN users AS u ON u.`id` = b.`id` 
GROUP BY u.id 
HAVING COUNT(b.id) > 3;

--Récupérer les liens des catégories depuis bookmark_categories

SELECT 
bookmarks_categories.`id_categorie`, 
bookmarks_categories.`id_bookmark`, 
bookmarks.`url`, 
bookmarks.`title`, 
bookmarks.`description` 
FROM bookmarks_categories 
INNER JOIN bookmarks 
ON bookmarks_categories.`id_bookmark` = bookmarks.`id`;

-- Modifier un bookmark

UPDATE `bookmarks` 
SET 
`url` =  '$bookmark_Url'
`title` = '$bookmark_Title' 
`description` = '$bookmark_description' 
`creation_date` = '$creation_Date'
WHERE `id` = '@identifiantUser';

-- Supprimer un utilisateur

DELETE FROM `bookmarks` 
WHERE `id` = '@identifiantUser';