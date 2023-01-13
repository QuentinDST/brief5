-- Ajouter valeur à table de liaison

INSERT INTO `bookmarks_categories` (`bookmark_id`, `categorie_id`) VALUES ('1', '4');

-- Récupérer le nom de la categorie depuis la table categorie

SELECT bookmarks.`id`, bookmarks.`URL`, bookmarks.`Title`, bookmarks.`Description`, categories.`name` 
FROM bookmarks 
JOIN bookmarks_categories ON bookmarks.`id` = bookmarks_categories.`bookmark_id` 
JOIN categories ON categories.`id` = bookmarks_categories.`categorie_id`;