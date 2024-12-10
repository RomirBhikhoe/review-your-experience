-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 okt 2024 om 13:54
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mellespellen`
--
CREATE DATABASE IF NOT EXISTS `mellespellen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mellespellen`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `consoles`
--

CREATE TABLE `consoles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `consoles`
--

INSERT INTO `consoles` (`id`, `name`) VALUES
(1, 'PlayStation'),
(2, 'XBOX'),
(3, 'Nintendo Switch');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `console_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `games`
--

INSERT INTO `games` (`id`, `name`, `image`, `description`, `price`, `console_id`) VALUES
(1, 'Doom Eternal\r\n', 'doometernal.png', 'Het helleleger is de aarde binnengevallen. Word de Slayer in een epische campagne voor één speler, waarin je demonen afslacht in verschillende dimensies om de uiteindelijke vernietiging van de mensheid te stoppen. De enige die ze vrezen... ben jij.', 30, 1),
(2, 'Red Dead Redemption II', 'reddead2.png', 'Red Dead Redemption 2 is de bejubelde, epische open wereld van Rockstar Games. Het is de best beoordeelde game van deze generatie consoles die nu is verbeterd voor PC met nieuwe content voor de Story Mode, nog mooiere graphics en meer.', 50, 1),
(3, 'Call of Duty Black Ops 6', 'blackops6.png', 'Call of Duty®: Black Ops 6 is typische Black Ops in een filmische singleplayer campagne, een Multiplayer-ervaring die de beste in zijn klasse is en bevat de epische terugkeer van Round-Based Zombies.', 70, 1),
(4, 'Bloodborne', 'bloodborne.png', 'Jaag je nachtmerries na Een eenzame reiziger. Een vervloekte stad. Een dodelijk mysterie dat alles verslindt wat ermee in aanraking komt. Overwin je angsten in de vervallen stad Yharnam, een doodse plek die ten onder ging aan een vreselijke, alles verterende ziekte. Sluip door de donkere schaduwen, vecht voor je leven met steek- en vuurwapens en ontdek geheimen die je bloed doen stollen... maar die misschien ook je redding zijn.', 30, 1),
(5, 'Marvel\'s Spider-Man 2', 'spiderman2.png', 'De Spider-mannen Peter Parker en Miles Morales staan voor de ultieme uitdaging als ze niet alleen de stad, maar ook elkaar en hun naasten moeten redden van de monsterlijke Venom en de nieuwe symbiootdreiging.', 70, 1),
(6, 'Elden Ring', 'eldenring.png', 'EEN NIEUW WONDERBAARLIJK AVONTUUR STAAT JE TE WACHTEN. Verrijs, Bezoedelden, en laat je leiden door genade om de kracht van de Elden Ring te gebruiken en een Elden Lord in The Lands Between te worden.', 60, 1),
(7, 'EA Sports FC 25', 'fc25.png', 'EA SPORTS FC™ 25 geeft je meer manieren om voor de club te winnen. Werk samen met vrienden in je favoriete speltypen met het nieuwe 5-tegen-5 Rush en leid je club naar de overwinning nu FC IQ je meer tactische controle dan ooit tevoren geeft.', 80, 2),
(8, 'Hogwarts Legacy', 'hogwarts.png', 'Hogwarts Legacy is een meeslepende actie-RPG in een open wereld. Nu ben jij het middelpunt van de actie en beleef je je eigen avontuur in de tovenaarswereld.', 70, 2),
(9, 'Warhammer 40K: Space Marine', 'warhammer.png', 'Embody the superhuman skill and brutality of a Space Marine. Unleash deadly abilities and devastating weaponry to obliterate the relentless Tyranid swarms. Defend the Imperium in spectacular third-person action in solo or multiplayer modes.', 70, 2),
(10, 'Forza Horizon 5', 'forza.png', 'Verken de levendige landschappen van Mexico in een open wereld met grenzeloze, leuke actie in \'s werelds beste auto\'s. Beleef een spannend achtervolgingsspel met onze nieuwe 5v1-multiplayerervaring: Hide & Seek.', 50, 2),
(11, 'Halo Infinite', 'halo.png', 'Halo Infinite bevat de meest uitgebreide Halo-campagne ooit, vol actie en avontuur, dat zich afspeelt in de uitgestrekte omgeving van de oude ringwereld Zeta Halo. Verken de enorme gebieden van Zeta Halo, met waanzinnige hoogtes en mysterieuze dieptes onder de ring. Red UNSC-mariniers om versterkingen te krijgen voor de strijd tegen een afschrikwekkende vijand: de Banished.', 40, 2),
(12, 'S.T.A.L.K.E.R. 2: Heart of Chernobyl', 'stalker.png', 'Discover the vast Chornobyl Exclusion Zone full of dangerous enemies, deadly anomalies and powerful artifacts. Unveil your own epic story as you make your way to the Heart of Chornobyl. Make your choices wisely, as they will determine your fate in the end.', 70, 2),
(13, 'The Legend of Zelda Breath of the Wild', 'botw.png', 'Na honderd jaar slapen wordt Link wakker in een wereld die hij zich niet kan herinneren. Ontdek een uitgestrekt en gevaarlijk land en help Link zijn herinneringen terug te krijgen in dit veelgeprezen avontuur.', 60, 3),
(14, 'Super Mario Odyssey', 'marioodyssey.png', 'Maak samen met Mario een avontuurlijke wereldreis in 3D en gebruik zijn nieuwe moves om prinses Peach te redden en Bowsers trouwplannen en dwarsbomen!', 40, 3),
(15, 'Super Smash Bros. Ultimate', 'smash.png', 'Legendarische gamewerelden en beroemde vechters komen samen in de ultieme showdown: Super Smash Bros. Ultimate voor de Nintendo Switch', 40, 3),
(16, 'Mario Kart 8 Deluxe', 'mariokart.png', 'Dankzij de Nintendo Switch kunnen fans de ultieme versie van Mario Kart 8 altijd en overal spelen. Er is zelfs een lokale, draadloze multiplayerstand voor maximaal acht spelers!', 60, 3),
(17, 'Fire Emblem Three Houses', 'fireemblem.png', 'Jij speelt een belangrijke rol in een continent waar elk moment een grote oorlog kan losbarsten in Fire Emblem: Three Houses voor de Nintendo Swtich.', 30, 3),
(18, 'Splatoon 3', 'splatoon.png', 'Vorm een team en schiet je met inkt een weg naar de overwinning in Splatoon 3!', 40, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `text` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `review`
--

INSERT INTO `review` (`id`, `titel`, `score`, `text`, `username`, `game_id`, `user_id`, `time`) VALUES
(1, 'Je voelt echt als Spider-Man', 4, 'In het 3de spel in de Marvel\'s Spider-Man serie, kan je als beide Spider-Mannen spelen terwijl je het moet opnemen tegen Venom.', '', 5, 0, '2024-10-16 11:37:37'),
(2, 'heel moeilijk', 3, 'wowie', '', 4, 0, '2024-10-16 11:37:37'),
(3, 'super leuk leuk', 5, 'mario is zo cool zuig me lul xoxo', '', 14, 0, '2024-10-16 11:37:37'),
(4, 'kkr spel', 1, 'ik haat dit stomme stom spel', '', 14, 0, '2024-10-16 11:37:37'),
(8, 'Mario ik hou van je', 0, 'super super super leuke omg ', '', 14, 0, '2024-10-16 11:37:37'),
(20, 'a', 7, 'dwa', '', 14, 0, '2024-10-16 11:37:37'),
(21, 'nee', 6, 'nee', '', 2, 0, '2024-10-16 11:41:55'),
(22, 'wit spul uit gaten schieten', 9, 'aaa', '', 2, 0, '2024-10-16 11:43:12'),
(23, 'bope', 8, 'schrik', '', 1, 0, '2024-10-16 11:45:51'),
(24, '', 110, '', '', 1, 0, '2024-10-16 11:56:51'),
(25, 'krijk kanker', 9, 'nee', '', 14, 0, '2024-10-16 12:47:40'),
(26, 'Ik hou zo erg van dit sple', 10, 'ik heb geen mening', '', 17, 0, '2024-10-16 12:53:28');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profile_picture`) VALUES
(1, 'TestUser', 'password', 'profielfoto.png'),
(5, 'TestUser', 'da', 'aap.png'),
(6, 'TestUser', 'a', 'aap.png'),
(7, 'TestUser', 'nee', 'aap.png'),
(8, 'TestUser', 'a', 'Kies een profielfoto uit'),
(9, 'TestUser', 'nee', 'aap.png');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `console_id` (`console_id`);

--
-- Indexen voor tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `consoles`
--
ALTER TABLE `consoles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15417;

--
-- AUTO_INCREMENT voor een tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`console_id`) REFERENCES `consoles` (`id`);

--
-- Beperkingen voor tabel `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
