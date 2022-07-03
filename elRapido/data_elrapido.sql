-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 mai 2022 à 19:51
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `elrapido`
--

-- --------------------------------------------------------

--
-- Structure de la table `party`
--

CREATE TABLE `party` (
  `tokenParty` text DEFAULT NULL,
  `tokenPlayer1` text DEFAULT NULL,
  `PseudoPlayer1` text DEFAULT NULL,
  `timerPlayer1` int(11) NOT NULL DEFAULT 60,
  `rankPlayer1` int(11) DEFAULT NULL,
  `tokenPlayer2` text DEFAULT NULL,
  `PseudoPlayer2` text DEFAULT NULL,
  `timerPlayer2` int(11) NOT NULL DEFAULT 60,
  `nameParty` text DEFAULT NULL,
  `listeQuestion` text DEFAULT NULL,
  `readyPlayer1` text NOT NULL DEFAULT '0',
  `readyPlayer2` text NOT NULL DEFAULT '0',
  `switch` int(11) NOT NULL DEFAULT 1,
  `CurrentQuestion` text DEFAULT NULL,
  `CurrentAnswer1` text DEFAULT NULL,
  `CurrentAnswer2` text DEFAULT NULL,
  `CurrentAnswer3` text DEFAULT NULL,
  `CurrentAnswer4` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

CREATE TABLE `player` (
  `PlayerID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `totalParty` int(11) NOT NULL DEFAULT 0,
  `win` int(11) NOT NULL DEFAULT 0,
  `lose` int(11) NOT NULL DEFAULT 0,
  `ranked` int(11) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `token` text NOT NULL,
  `statut` text NOT NULL DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `player`
--

INSERT INTO `player` (`PlayerID`, `email`, `pseudo`, `password`, `totalParty`, `win`, `lose`, `ranked`, `admin`, `token`, `statut`) VALUES
(1, 'mahieuarnaud1909@hotmail.com', 'serenity1909', '$2y$12$yr5mP2WFVFxUX57taO9Ppu3hezAgGktogTqkWBd51SXazi5v8Azpe', 72, 34, 38, 34, 1, 'e6cf34a44327ecdc62009d0c439b972930bf65852c6710f5d522c5fac95fca008ddeab069d116a1de9f29dc32d4a6863d14ea7895e71a0b53f3767071ce85a29', 'online'),
(12, 'jujufrere96@hotmail.com', 'jujufrere96', '$2y$12$zq0ogE3Zg3PZgdCxAnGK1u.szwAiCkqwPZJ1kYuR9G6LvfRhU8cv2', 60, 21, 39, 21, 0, '761e8e739353e009b8016ae456e745e9af91653649aea2ad8eb17540b6c10582fe320fd521cac0a7f5584ae6ba9f8a07fe543cb22368fc6aaa2de6983a1ad44f', 'online'),
(16, 'fred-frere@hotmail.com', 'fredos', '$2y$12$46fL1q6TPg95nqujyOtLZOPKcBnhRveVfD/LSSCEK8L0zqyBV4k2G', 10, 5, 5, 5, 0, '3363ca925ad44ea4fd6773d13a58b3b1afa095337a047cdd8f5d5a2ed3d13ad44573a3b8de2d498b86c5724c63f884c26bddc452a235a326cdbd4859c880128b', 'offline'),
(19, 'cowez-clement@hotmail.com', 'shadowstorm', '$2y$12$cZd/KQ5nGlS.SlgGvr5KgezpxYbSKaFciYhS8xfB2vQHBpabhhvLC', 20, 8, 12, 8, 0, '2a1861eeaf25000bf7ee82dfc7d4f71222ecd9faa4e2ea307bdcc46162f1d7c58f1a3b6a2719af96d7173e940270d8673ca2cd1cd290f5e0fa060513dd1489c5', 'offline'),
(20, 'lucascow@hotmail.com', 'LucasCow', '$2y$12$BaWjOyMR19/egrUispWs3.UJee24sJDeBT35DpW816x9ouZEMeAie', 18, 17, 1, 17, 0, '878b3fce1e400b626c97b3a757b844f8b4069825f7472fb80cdcdf22e1874f9afbff9774a50a3a1b3c7f7457c9e99084d4acce2f8f165859a3f3e9bb2aa1174f', 'offline');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `questionID` int(11) NOT NULL,
  `question` text NOT NULL,
  `reponseVrai` text NOT NULL,
  `reponseFaux1` text NOT NULL,
  `reponseFaux2` text NOT NULL,
  `reponseFaux3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`questionID`, `question`, `reponseVrai`, `reponseFaux1`, `reponseFaux2`, `reponseFaux3`) VALUES
(1, 'Où se situe la Statue de la Liberté ?\r\n', 'New York', 'Los Angeles', 'Las vegas', 'Paris'),
(2, 'Quelle est la capitale du Royaume-Uni ?\r\n', 'Londres', 'Berlin', 'Dublin', 'Royaume-Uni'),
(3, ' Dans quelle discipline la Tchèque Borbora Spotakova est-elle une reine ?', 'javelot', 'lancer du disque', 'heptathlon', 'saut en hauteur'),
(4, 'Combien de cases blanches y-a-t-il sur un échiquier ?', '32', '30', '34', '36'),
(5, 'Quel nom porte la barque vénitienne mue par un seul aviron à l arrière', 'La gondole', 'La barge', 'La chaloupe', 'Le chaland'),
(6, ' Quel pays est situé littéralement entre le Turkménistan et le Kazakhstan?', 'Ouzbékistan', 'Kirghiztan', 'Tadjikistan', ' Afghanistan'),
(7, 'Dans quel pays se trouve le désert de Gobi?', 'Mongolie', 'Algérie', 'Mauritanie', 'Russie'),
(8, ' Quel est le second pays le plus peuplé au monde?', ' Inde', 'Chine', 'Russie', 'Canada'),
(9, 'Comment l aéroport de Bruxelles s appelle-t-il?', 'Zaventem', 'Sud', 'Bierset', 'Deurne'),
(10, 'Quelle est la capital de Samoa?', 'Apia', 'Funafuti', 'Tarawai', 'Nukualofa'),
(11, 'Quel roi autorisa Parmentier à planter des pommes de terre à Neuilly?', 'Louis XVI', 'Louis XIV', 'Louis XV', 'Louis XVIII'),
(12, ' Quelle est l hormone dite de la virilité ?', 'testostérone', 'ocytocine', 'oestrogène', 'thyroxine'),
(13, 'Quelle planète dont Io et Callisto sont des satellites fait quelque onze fois la taille de la terre ?', 'Jupiter', 'Vénus', 'Mars', 'Mercure'),
(14, 'Quel est le cube de 2 ?', '8', '6', '16', '10'),
(15, 'Quel tour moyen de femme répondait en 2014 au chiffre 79,9 cm ?', 'Tour de taille', 'Tour de poitrine', 'Tour de hanche', 'Tour de bassin'),
(16, ' Quel monstre était prisonnier d un célèbre Labyrinthe construit pas Dédale ?', 'Minotaure', 'Licorne', 'Centaure', 'Hydre'),
(17, 'Qui est l aîné des Titans ?', 'Océan', 'Hypérion', 'Japet', 'Cronos'),
(18, ' Quel est le plus grand pays du monde du point de vue de sa superficie ?', 'Russie', 'Chine', 'Canada', 'Inde'),
(19, 'A qui doit-on la classification périodique des éléments chimiques ?', 'Dimitri Mendéleïev', 'Sergueï Prokofiev', 'Nikita Khrouchtchev', 'Vassili Alexeiev'),
(20, 'Avec quel titre le groupe Abba a-t-il remporté en 1974 le concours Eurovision ?', 'Waterloo', 'Austerlitz', 'Wagnam', 'Stalingrad'),
(21, ' Quel pays a accueilli le Mondial en 1994 ?', 'Etats-Unis', 'France', 'Italie', 'Mexique'),
(22, 'Par quel moyen Gertrude Ederlé traversa-t-elle la Manche en 1926 ?', 'A la nage', 'En avion', 'A la rame', 'En pédalo'),
(23, ' Dans quelle discipline les Français Sow, Vastine et Djekhir ont-ils remporté des médailles aux JO de Pékin ?', 'boxe', 'judo', 'aviron', 'escrime'),
(24, 'Laquelle de ces plantes renferme un liquide irritant pour la peau ?', 'l ortie', 'Le trèfle', 'La luzerne', 'La jonquille'),
(25, 'Le pékinois est une espèce de ...', 'Chien', 'Chat', 'Chameau', 'Cheval'),
(26, 'Lorsqu on fête son installation dans un nouvel appartement, on dit qu on \"pend...', 'La crémaillère', 'La crémière', 'La soupière', 'La cuillère'),
(27, 'En musique, l appareil servant à marquer la mesure est un ...', 'Métronome', 'Batteur', 'Métreur', 'Bécarre'),
(28, 'On dit de quelqu un qui est de mauvais humeur \"qu il s est levé...', 'Du pied gauche', 'A l est', 'Comme un seul homme', 'Avec les poules'),
(29, 'Quel était le prénom du peintre Picasso ?', 'Pablo', 'Paolo', 'Pedro', 'Giacomo'),
(30, 'Quel est l autre nom du melon d eau', 'la pastèque', 'l orange', 'la figue de Barbarie', 'Le citron vert'),
(31, 'Quand il est en colère, Hulk devient...', 'Vert', 'Noir', 'Bleu', 'Rouge'),
(32, 'La murène est un...', 'Poisson', 'Insecte', 'Félin', 'Oiseau'),
(33, 'Quelle ville française est souvent associée à un savon ?', 'Marseille', 'Arles', 'Nîmes', 'Avignon'),
(34, 'Quel est l ingrédient de base de la paella ?', 'Le riz', 'Les pâtes', 'Le chou', 'Les haricots'),
(35, 'Les célèbres Schtroumfs sont des ...', 'Lutins', 'Géants', 'Dieux', 'Gargouilles'),
(36, 'Quelqu un qui vit en ville est un ...', 'Citadin', 'Citoyen', 'Villageois', 'Vilebrequin'),
(37, 'Dans l Antiquité, quelle ville était célèbre pour son phare ?', 'Alexandrie', 'Rome', 'Athènes', 'Sparte'),
(38, 'Lorsque le petit pantin Pinocchio ment...', 'Son nez s allonge', 'Sa bouche se ferme', 'Sa main grandit', 'Son pied rétrécit'),
(39, 'Baloo est un ours sympathique que l on rencontre dans...', 'Le Livre de la jungle', 'Tarzan', 'Robins des Bois', 'Robinson Crusoé'),
(40, 'La  choucroute est une spécialité...', 'Alsacienne', 'Bretonne', 'Provençale', 'Basque');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `player`
--
ALTER TABLE `player`
  MODIFY `PlayerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
