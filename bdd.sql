CREATE TABLE produits (
    'id' int(8) NOT NULL,
    'nom' varchar (15) NOT NULL,
    'marque' varchar (15) NOT NULL,
    'reference' varchar (7) NOT NULL,
    'quantite' int (4) NOT NULL,
    PRIMARY KEY ('id'));

INSERT INTO `declinaisons`(`id`, `couleur`, `bonnet`, `taille`, `quantite`, `id_produit`) VALUES (11, 'noir', 'a', 80, 15, 3), (12, 'rouge', 'a', 85, 12, 3), (13, 'mauve', 'd', 110, 18, 3), (14, 'noir', 'b', 95, 12, 3), (15, 'rouge', 'c', 100, 6, 3), (16, 'jaune', 'a', 105, 14, 3), (17, 'bleu', 'e', 120, 7, 3);


INSERT INTO `declinaisons`(`id`, `couleur`, `bonnet`, `taille`, `quantite`, `id_produit`) VALUES(20, 'vert', 'b', 100, 7, 4), (21, 'rouge', 'a', 105, 2, 4), (22, 'rouge', 'e', 95, 16, 4);
