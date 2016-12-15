-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Ven 16 Décembre 2016 à 00:11
-- Version du serveur :  5.6.28
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `thinkanalog`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorys`
--

CREATE TABLE `categorys` (
  `id_category` int(11) NOT NULL,
  `category` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `idx_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categorys`
--

INSERT INTO `categorys` (`id_category`, `category`, `idx_product`) VALUES
(7, 'Compresseur', 13),
(8, 'Préamplificateur', 14),
(9, 'Direct Box', 15),
(10, 'Préamplificateur', 16),
(11, 'Autre', 17);

-- --------------------------------------------------------

--
-- Structure de la table `connectors`
--

CREATE TABLE `connectors` (
  `id_connector` int(11) NOT NULL,
  `connector` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idx_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `connectors`
--

INSERT INTO `connectors` (`id_connector`, `connector`, `idx_product`) VALUES
(38, 'IN XLR trs niveau micro', 13),
(39, 'IN Jack niveau instrument', 13),
(40, 'OUT XLR trs niveau micro', 13),
(41, 'OUT Jack trs niveau ligne', 13),
(42, 'Alimentation via IEC 10A', 13),
(43, 'IN XLR trs niveau micro', 14),
(44, 'OUT XLR trs niveau micro ou ligne', 14),
(45, 'OUT Jack trs niveau ligne', 14),
(46, 'Alimentation IEC 10A', 14),
(47, 'IN Jack instrument', 15),
(48, 'DIRECT OUT jack Instrument', 15),
(49, 'OUT XLR trs niveau micro', 15),
(50, 'INPUT Jack niveau instrument', 16),
(51, 'INPUT XLR trs niveau micro', 16),
(52, 'OUTPUT XLR trs niveau micro', 16),
(53, 'OUTPUT Jack trs niveau ligne', 16),
(54, '4 INPUT XLR trs niveau ligne', 17),
(55, '4 INPUT Jack trs niveau ligne', 17),
(56, '2 OUT XLR trs niveau ligne', 17);

-- --------------------------------------------------------

--
-- Structure de la table `features`
--

CREATE TABLE `features` (
  `id_feature` int(11) NOT NULL,
  `feature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idx_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `features`
--

INSERT INTO `features` (`id_feature`, `feature`, `idx_product`) VALUES
(38, 'Compresseur a lampe', 13),
(39, 'Gain d\'entrée', 13),
(40, 'Niveau de compression (seuil)', 13),
(41, 'Gain de sortie', 13),
(42, 'VU metre analogique', 13),
(43, 'Plage dynamique 110db', 13),
(44, 'Preamplificateur a lampe', 14),
(45, '70db de gain', 14),
(46, 'Commutateur d\'impédance', 14),
(47, 'Pad atténuateur de gain', 14),
(48, 'Gain d\'entrée et de sortie', 14),
(49, '2x pad atténuateur 20db', 15),
(50, 'Passif', 15),
(51, 'entrée niveau ligne', 15),
(52, 'sortie directe', 15),
(53, 'sortie symetrique', 15),
(54, '2 circuits TUBE et FET', 16),
(55, 'Pad atténuateur 20db', 16),
(56, 'Phantom +48v', 16),
(57, 'Potentiometre de gain', 16),
(58, '4 canaux', 17),
(59, 'reglage du niveau par canal', 17),
(60, 'reglage panoramique par canal', 17),
(61, 'mute par canal', 17),
(62, 'volume independant gauche droite', 17),
(63, 'VU metre sur les sorties', 17);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idx_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id_image`, `title`, `src`, `idx_product`) VALUES
(14, 'C1 face avant', 'img/products/product13.jpg', 13),
(15, 'P2 face avant', 'img/products/product14.jpg', 14),
(16, 'DI vue dessus et coté', 'img/products/product15.jpg', 15),
(17, 'P3 vue de face', 'img/products/product16.jpg', 16),
(18, 'S4 vue 3D face de biais', 'img/products/product17.jpg', 17);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `header` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id_product`, `name`, `header`, `description`) VALUES
(13, 'C1 - analog style compressor', 'Le C1 est un compresseur analogique chaud et coloré. Il apportera a vos prises une coté agréable et doux. Idéal sur des voix ou des instruments a corder. Avec son circuit d\'amplification a lampe faible bruit, le son reste fidele et propre.', 'Ce compresseur utilise un capteur photosensible pour déclencher la compression. Les temps d\'attaque sont d\'environs 10ms, idéal pour les voix. Le temps de relâchement est a 200ms. Le circuit de sortie vous permet d\'abaisser le niveau jusqu\'à -40db, pour éviter la saturation sur vos convertisseur AD. Ce qui vous permet de saturer le compresseur lui même sans que le signal de sortie soit trop élevé. Idéal pour obtenir des effets de pompage ou de distortion.'),
(14, 'P2 - lamp preamplifier', 'Le P2 est un préamplificateur a lampe compact. Il offre un gain de -40 jusqua +70db avec un niveau de brut très faible. Idéal pour des prises a faible niveau. Son circuit de préamplification a lampe offre un son chaleureux. La distortion harmonique offerte par les circuits et transparente.', 'Equipé de 2 lampes de préamplification, avec un commutateur de niveau d\'entrée de 20db ainsi qu\'un commutateur d\'impédance. Le réglage d\'impédance permet de vous adapter au maximum a votre matériel. Le gain de sortie vous permet d\'utiliser ce préamplificateur hors de sa plage dynamique pour obtenir des effets de distortion sans faire saturer vos appareils de compression. Une led de saturation a 10ms d\'integration vous indique si le signal d\'entrée est trop élevé.'),
(15, 'DI - passive direct box', 'Cette Boite de direct est le compagnon idéal pour symétriser vos signal sur scène. Robuste, ça construction dans un block d\'aluminium brut, offre la robustesse nécessaire pour survivre dans n\'importe que scène de concert. Ces circuits de symétrisation son d\'une qualité irréprochable.', 'Conçu pour la scene, cette boite direct mono vous permet de sysmétriser des signaux niveau instrument asymétriques vers du niveau micro symétrique. Cette DI est passive, aucun besoin d\'alimentation phantom ou piles pour son fonctionnement. Deux boutons d\'atténuation sont disponibles pour les sources a fort signal, afin d\'éviter la saturation des circuits. Une sortie direct asymétrique vous permet d\'utiliser la DI entre deux appareils niveau instrument, par exemple pour récupérer le signal entre une guitare et son amplificateur.'),
(16, 'P3 - dual preamplifier', 'Le P3 est un préamplificateur un peu particulier, en effet, vous allez pouvoir switcher entre 2 circuits de préamplification. Le premier a tube, passe par deux lampes de préamplification. Le second a transistor. Ce paramètre vous permet de passer d\'un son chaud et fourni a un son précis et fidèle a la volée en fonction de vos besoins.', 'Le P3 embarque 2 circuits de préamplification totalement différents. Un premier basé sur 2 lampes de préamplification offre un gain de -10 à +60 db. Il offre un son chaud et une distortion harmonique discrete. Le second circuit a transistor lui et bien plus précis, la distortion est quasi inéxistante, et le gain va de -20 a +70db.\r\nAvec ces 2 circuits ce préamplificateur s\'adapte au différentes situation et prises de son. Le bouton poussoir vous permet de rapidement changer de circuit pour tester/écouter les différences et faire votre choix.\r\nUn pad atténuateur de 20db est présent ainsi qu\'une alimentation phantom +48v'),
(17, 'S4 - quad channel summing module', 'La sommation analogique de signaux est a la mode. Elle offre le son légendaire d\'une sommation analogique, une largeur et une profondeur encore inégalée dans les systèmes numériques.\r\nLe S4 est un petit sommateur 4 canaux, destiné principalement aux chaines de mastering ou petits appoints sur de plus gros systèmes.', 'Quad channel, chaque canaux possèdent un réglage du niveau, de la panoramique, et une poussoir de mute. Les sorties Left et Right possèdent un potentiomètre de volume indépendant.\r\nLes circuits de chaque canaux sont parfaitement idépendant, les canaux de sorties résultent des niveaux et panoramiques appliquées.\r\n2 Vu metres vous permettent de monitorer les niveaux de signal aux sorties.\r\nLe circuit de sommation est a transistor.');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `remember_token`) VALUES
(14, 'Admin', '$2y$10$jGhF2vCFrWGTegmutC9pR.uaUli0Z4AOiujFyfDmnl9dBr84naqRy', ''),
(15, 'bnicoud', '$2y$10$pkjEN9Pd0Bek479Qypap.uUs1fNElxQ7RKDoMzihUHtSFwAv3hJwu', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `idx_product` (`idx_product`);

--
-- Index pour la table `connectors`
--
ALTER TABLE `connectors`
  ADD PRIMARY KEY (`id_connector`),
  ADD KEY `idx_product` (`idx_product`);

--
-- Index pour la table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id_feature`),
  ADD KEY `idx_product` (`idx_product`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `idx_product` (`idx_product`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `connectors`
--
ALTER TABLE `connectors`
  MODIFY `id_connector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `features`
--
ALTER TABLE `features`
  MODIFY `id_feature` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categorys`
--
ALTER TABLE `categorys`
  ADD CONSTRAINT `categorys_ibfk_1` FOREIGN KEY (`idx_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `connectors`
--
ALTER TABLE `connectors`
  ADD CONSTRAINT `connectors_ibfk_1` FOREIGN KEY (`idx_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`idx_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`idx_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
