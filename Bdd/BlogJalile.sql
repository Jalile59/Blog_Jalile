-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Lun 26 Février 2018 à 12:18
-- Version du serveur :  5.5.57-MariaDB
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `BlogJalile`
--

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `idArticle` int(11) NOT NULL,
  `NameArticle` varchar(45) DEFAULT NULL,
  `CreateDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Categorie` varchar(45) DEFAULT NULL,
  `Dirphoto` varchar(45) DEFAULT NULL,
  `dateModificationArticle` date DEFAULT NULL,
  `user_iduser` int(11) NOT NULL DEFAULT '0',
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Article`
--

INSERT INTO `Article` (`idArticle`, `NameArticle`, `CreateDate`, `Categorie`, `Dirphoto`, `dateModificationArticle`, `user_iduser`, `Content`) VALUES
(190, 'Xiaomi Mi Robot Vacuum', '2018-02-22 18:41:16', 'Technologie', './public/img/0abfd4f1337816ca2fb8a5f8cc6a9898', '2018-02-22', 1, '     Même si certains ne rêvent que de smartphones (voir notre sélection des meilleurs smartphones en promotion), d\'autres préfèrent pouvoir se reposer et se dispenser de la corvée du ménage tout en suivant depuis leur smartphone justement leur robot effectuer à leur place ces tâches ménagères en aspirant la poussière voir en passant la serpillière !\r\n\r\nXiaomi propose ainsi deux robots dits de première et de seconde génération (le second étant proposé sous la marque Roborock mais il s\'agit bien de Xiaomi derrière, l\'application smartphone étant d\'ailleurs la même). Le premier passe l\'aspirateur, alors que le second permet en plus de passer la serpillière !\r\n\r\nLe Xiaomi Mi Robot Vacuum est un robot aspirateur qui dispose de 12 capteurs dont un capteur laser pour scanner l\'environnement immédiat à 360° à raison de 1800 fois par seconde. Cela permet d\'obtenir une cartographie précise de l\'intérieur d\'un foyer. Trois processeurs sont dédiés au suivi des mouvements en temps réel, et un algorithme de localisation et cartographie simultanées permettent de calculer le parcours le plus efficace pour un nettoyage. L\'application Mi Home sur smarphone permet de diriger le robot (Wifi ou en mode mobile) : vous pourrez suivre ses mouvements, stopper son nettoyage, changer sa puissance de fonctionnement, suivre le niveau de sa batterie, recevoir des alertes en cas de problèmes (roues bloquées, robot coincé,...) ou encore pour indiquer qu\'il retourne se recharger à son dock ou que le ménage est terminé. Tout est en anglais mais parfaitement compréhensible et l\'application, pour l\'avoir testée, est vraiment très ergonomique et simple d\'utilisation. Et si vous ne préférez pas utiliser l\'application, un simple bouton sur le robot permet de lancer la phase de ménage, le robot se chargeant de tout tout seul, la seule intervention humaine consistant en fait à vider le bac contenant la poussière !\r\n\r\nSa batterie de 5200mAh permet une autonomie de 2,5 heures de nettoyage, ensuite il revient se charger automatiquement à sa base. Il dispose d\'un pouvoir d\'aspiration de jusqu\'à 1800 Pa. '),
(191, 'Whirlpool ', '2018-02-22 18:32:16', NULL, './public/img/44d38c92764bf0ea5848d488fa4d1c00', NULL, 1, ' L\'année dernière, Whirlpool souffrait d\'un déficit d\'image en annonçant sa volonté de délocaliser la fabrication de sèche-linge de son site d\'Amiens vers la Pologne dès juin 2018. Cette intention a déclenché un mouvement de grève en avril, qui a duré plusieurs longues semaines. Aujourd\'hui, le géant américain accuse un nouveau coup dur en rappelant pas moins de 310 000 bouilloires électriques vendues dans le monde sous la filiale KitchenAid. C\'est la référence 5KEK1722 (à vos factures !), produite entre janvier et 2013 et juin 2017, qui est à renvoyer à la firme américaine. \r\n\r\nDans son communiqué, le géant mentionne un \"risque de blessure\" dû à un défaut de fabrication. Celui-ci réside dans la poignée de l\'appareil qui, vraisemblablement, pourrait se séparer de la cuve de la bouilloire ; de quoi multiplier les risques de brûlures pour l\'utilisateur. Ce sont les \"retours récents des utilisateurs\" ainsi qu\'un contrôle interne de qualité qui a permis à Whirlpool d\'inviter les propriétaires dudit modèle \"à ne plus utiliser\" sa bouilloire. Et de préciser qu\'il s\'engage à \"rembourser toutes les bouilloires concernées\" par ce phénomène.\r\n\r\nIl semblerait que seule une fourchette de production soit concernée. Aussi, c\'est la raison pour laquelle le constructeur invite ses utilisateurs à se rapprocher du service client ou bien à se rendre sur le site www.repair.whirlpool.com pour voir s\'ils sont bien concernés. Rappelons enfin que sur les 310 000 bouilloires vendues, plus de 16 700 ont été vendues en France et le groupe a précisé qu\'il s\'employait d\'ores et déjà à apporter \"des modifications sur le site de fabrication — en Chine — afin que le défaut de conception n\'apparaisse plus\". '),
(194, 'test', '2018-02-25 09:25:01', 'Programmation', './public/img/1cf5adb5d57c02a5177ad8fc5a11ab58', NULL, 1, ' [color=#000000]ferferfer[b]freferf[size=200]ferfrefer[font=Tahoma]ferferfer[/font][font=Trebuchet MS]freferf[/font][/size][/b][/color]');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE `Commentaire` (
  `idCommentaire` int(11) NOT NULL,
  `ContentCommentaire` varchar(45) NOT NULL,
  `CreateDate` varchar(55) DEFAULT NULL,
  `user_iduser` int(11) NOT NULL,
  `Article_idArticle` int(11) NOT NULL,
  `Valide` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Commentaire`
--

INSERT INTO `Commentaire` (`idCommentaire`, `ContentCommentaire`, `CreateDate`, `user_iduser`, `Article_idArticle`, `Valide`) VALUES
(1, 'ouhnouihn', '0000-00-00', 1, 190, NULL),
(2, 'ouhnouihn', '0000-00-00', 1, 190, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `NameUser` varchar(45) NOT NULL,
  `SurenameUser` varchar(45) NOT NULL,
  `Pseudo` varchar(45) NOT NULL,
  `EmailUser` varchar(45) NOT NULL,
  `MdpUser` varchar(45) NOT NULL,
  `PhotoUser` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`iduser`, `NameUser`, `SurenameUser`, `Pseudo`, `EmailUser`, `MdpUser`, `PhotoUser`) VALUES
(0, 'DJELLOULI', 'JALILE', 'Djal', 'jal.djellouli@gmail.com', '123', NULL),
(1, 'Admin', '', '', '', '', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`idArticle`,`user_iduser`),
  ADD KEY `fk_Article_user1_idx` (`user_iduser`);

--
-- Index pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD PRIMARY KEY (`idCommentaire`,`user_iduser`,`Article_idArticle`),
  ADD KEY `fk_Commentaire_user1_idx` (`user_iduser`),
  ADD KEY `fk_Commentaire_Article1_idx` (`Article_idArticle`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `fk_Article_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD CONSTRAINT `fk_Commentaire_Article1` FOREIGN KEY (`Article_idArticle`) REFERENCES `Article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Commentaire_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
