-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 14 Décembre 2016 à 14:28
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
(1, 'Direct Box', 7),
(2, 'Compresseur', 8),
(3, 'Préamplificateur', 9);

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
(9, 'asfasfsaf', 7),
(10, 'saf', 7),
(11, 'saf', 7),
(12, 'saf', 7),
(13, 'asfsafasfsa', 7),
(14, 'IN XLR trs niveau micro', 8),
(15, 'IN Jack niveau instrument', 8),
(16, 'OUT XLR trs niveau micro', 8),
(17, 'OUT Jack trs niveau ligne', 8),
(18, 'Alimentation via IEC 10A', 8),
(19, 'IN XLR trs niveau micro', 9),
(20, 'OUT XLR trs niveau micro ou ligne', 9),
(21, 'OUT Jack trs niveau ligne', 9),
(22, 'Alimentation IEC 10A', 9);

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
(12, 'sjffjsf', 7),
(13, 'sfafadfasf', 7),
(14, 'fasfsaf', 7),
(15, 'asfasfasfas', 7),
(16, 'Compresseur a lampe', 8),
(17, 'Gain d\'entrée', 8),
(18, 'Niveau de compression (seuil)', 8),
(19, 'Gain de sortie', 8),
(20, 'VU metre analogique', 8),
(21, 'Plage dynamique 110db', 8),
(22, 'Preamplificateur a lampe', 9),
(23, '70db de gain', 9),
(24, 'Commutateur d\'impédance', 9),
(25, 'Pad atténuateur de gain', 9),
(26, 'Gain d\'entrée et de sortie', 9);

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
(8, 'c2', 'img/products/c2.jpg', 7),
(9, 'C1 - analog syle compressor', 'img/products/ok3.jpg', 8),
(10, 'P2 - lamp preamplifier', 'img/products/ok5.jpg', 9);

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
(7, 'Test 3', 'Un produit', 'tralalal'),
(8, 'C1 - analog style compressor', 'Le c1 est un compresseur analogique chaud et coloré. Il apportera a vos prises une coté agréable et doux. Idéal sur des voix ou des instruments a corder. Avec son circuit d\'amplification a lampe faible bruit, le son reste fidéle et propre.', 'Ce compresseur utilise un capteur photosensible pour déclencher la compression. Les temps d\'attaque sont d\'environs 10ms, idéal pour les voix. Le temps de relâchement est a 200ms.\r\nLe circuit de sortie vous permet d\'abaisser le niveau jusqu\'à -40db, pour éviter la saturation sur vos convertisseur AD.\r\nCe qui vous permet de saturer le compresseur lui même sans que le signal de sortie soit trop élevé. Idéal pour obtenir des effets de pompage ou de distortion.'),
(9, 'P2 - lamp preamplifier', 'Le P2 est un préamplificateur a lampe compact. Il offre un gain de -40 jusqua +70db avec un niveau de brut très faible. Idéal pour des prises a faible niveau.\r\nSon circuit de préamplification a lampe offre un son chaleureux. La distortion harmonique offerte par les circuits et transparente.', 'Equipé de 2 lampes de préamplification, avec un commutateur de niveau d\'entrée de 20db ainsi qu\'un commutateur d\'impédance. Le réglage d\'impédance permet de vous adapter au maximum a votre matériel.\r\nLe gain de sortie vous permet d\'utiliser ce préamplificateur hors de sa plage dynamique pour obtenir des effets de distortion sans faire saturer vos appareils de compression.\r\nUne led de saturation a 10ms d\'integration vous indique si le signal d\'entrée est trop élevé.');

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
(14, 'Admin', '$2y$10$jGhF2vCFrWGTegmutC9pR.uaUli0Z4AOiujFyfDmnl9dBr84naqRy', '33b07856e08a3e09fab4d6a55ebb1eadf7ae1e5e144e7afebcfbae000b22c7c85e5560f89a2a0280b4');

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
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `connectors`
--
ALTER TABLE `connectors`
  MODIFY `id_connector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `features`
--
ALTER TABLE `features`
  MODIFY `id_feature` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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
