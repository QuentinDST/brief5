-- CRUD Pour l'utilisateur (User)

-- Insérer un utilisateur

INSERT INTO users (`name`, `color`) 
VALUES ('HTML', 'F0FF33', 'quentin.destrade@gmail.com', 'aloha');


-- Récupérer tous les utilisateurs, tri alphabetique sur le nom et prénom

SELECT 
`id`, 
`first_name`, 
`second_name`, 
`email` 
FROM `users` 
ORDER BY 
`first_name`, 
`second_name`, 
`email` 
ASC;


-- Recherche sur un utilisateur, tri alphabetique sur le nom et prénom

SELECT 
`id`, 
`first_name`, 
`second_name`, 
`email` 
FROM `users` 
WHERE `second_name` 
LIKE '%er%' 
ORDER BY 
`second_name`, 
`first_name`, 
`email` 
ASC;


-- Récupérer un seul utilisateur, par son id


SELECT 
`id`, 
`first_name`, 
`second_name`, 
`email` 
FROM `users` 
WHERE `id` = '@identifiantUser';


-- LIKE -- Récupérer les données des tables users et bookmarks et tous les liens liké par chaque utilisateur

SELECT 
l.`id_user`, 
l.`id_bookmark`, 
u.`first_name`, 
u.`second_name`, 
u.`email`, 
b.`id`,
b.`url`, 
b.`title`, 
b.`description` 
FROM likes as l 
INNER JOIN users AS u ON l.id_user = u.id 
INNER JOIN bookmarks AS b ON l.id_bookmark = b.id;

-- Modifier un utilisateur

UPDATE `users` 
SET 
`first_name` =  '$first_Name'
`second_name` = '$second_Name' 
`email` = '$email' 
WHERE `id` = '@identifiantUser';


-- Supprimer un utilisateur

DELETE FROM `users` 
WHERE `id` = '@identifiantUser';