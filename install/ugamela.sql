-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Erstellungszeit: 25. Feb 2018 um 16:28
-- Server-Version: 10.2.12-MariaDB-10.2.12+maria~jessie
-- PHP-Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ugamela`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buildings`
--

CREATE TABLE `buildings` (
  `planetID` int(11) NOT NULL,
  `metal_mine` int(11) NOT NULL DEFAULT 0,
  `crystal_mine` int(11) NOT NULL DEFAULT 0,
  `deuterium_synthesizer` int(11) NOT NULL DEFAULT 0,
  `solar_plant` int(11) NOT NULL DEFAULT 0,
  `fusion_reactor` int(11) NOT NULL DEFAULT 0,
  `robotic_factory` int(11) NOT NULL DEFAULT 0,
  `nanite_factory` int(11) NOT NULL DEFAULT 0,
  `shipyard` int(11) NOT NULL DEFAULT 0,
  `metal_storage` int(11) NOT NULL DEFAULT 0,
  `crystal_storage` int(11) NOT NULL DEFAULT 0,
  `deuterium_storage` int(11) NOT NULL DEFAULT 0,
  `research_lab` int(11) NOT NULL DEFAULT 0,
  `terraformer` int(11) NOT NULL DEFAULT 0,
  `alliance_depot` int(11) NOT NULL DEFAULT 0,
  `missile_silo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `defenses`
--

CREATE TABLE `defenses` (
  `planetID` int(11) NOT NULL,
  `rocket_launcher` int(11) NOT NULL DEFAULT 0,
  `light_laser` int(11) NOT NULL DEFAULT 0,
  `heavy_laser` int(11) NOT NULL DEFAULT 0,
  `ion_cannon` int(11) NOT NULL DEFAULT 0,
  `gauss_cannon` int(11) NOT NULL DEFAULT 0,
  `plasma_turret` int(11) NOT NULL DEFAULT 0,
  `small_shield_dome` int(11) NOT NULL DEFAULT 0,
  `large_shield_dome` int(11) NOT NULL DEFAULT 0,
  `anti_ballistic_missile` int(11) NOT NULL DEFAULT 0,
  `interplanetary_missile` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `errors`
--

CREATE TABLE `errors` (
  `id` int(11) NOT NULL,
  `class` text NOT NULL,
  `method` text NOT NULL,
  `line` text NOT NULL,
  `exception` text NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fleet`
--

CREATE TABLE `fleet` (
  `planetID` int(11) NOT NULL,
  `small_cargo_ship` int(11) NOT NULL DEFAULT 0,
  `large_cargo_ship` int(11) NOT NULL DEFAULT 0,
  `light_fighter` int(11) NOT NULL DEFAULT 0,
  `heavy_fighter` int(11) NOT NULL DEFAULT 0,
  `cruiser` int(11) NOT NULL DEFAULT 0,
  `battleship` int(11) NOT NULL DEFAULT 0,
  `colony_ship` int(11) NOT NULL DEFAULT 0,
  `recycler` int(11) NOT NULL DEFAULT 0,
  `espionage_probe` int(11) NOT NULL DEFAULT 0,
  `bomber` int(11) NOT NULL DEFAULT 0,
  `solar_satellite` int(11) NOT NULL DEFAULT 0,
  `destroyer` int(11) NOT NULL DEFAULT 0,
  `battlecruiser` int(11) NOT NULL DEFAULT 0,
  `deathstar` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `flights`
--

CREATE TABLE `flights` (
  `flightID` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `mission` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `fleetlist` text NOT NULL,
  `start_id` int(11) NOT NULL,
  `start_type` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `end_id` int(11) NOT NULL,
  `end_type` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `loaded_metal` int(11) NOT NULL DEFAULT 0,
  `loaded_crystal` int(11) NOT NULL DEFAULT 0,
  `loaded_deuterium` int(11) NOT NULL DEFAULT 0,
  `returntime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `galaxy`
--

CREATE TABLE `galaxy` (
  `planetID` int(11) NOT NULL DEFAULT 0,
  `debris_metal` int(11) NOT NULL DEFAULT 0,
  `debris_crystal` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `sendtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` tinyint(1) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `planets`
--

CREATE TABLE `planets` (
  `planetID` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `galaxy` int(11) NOT NULL,
  `system` int(11) NOT NULL,
  `planet` int(11) NOT NULL,
  `last_update` int(11) DEFAULT NULL,
  `planet_type` int(1) NOT NULL,
  `image` char(32) NOT NULL,
  `diameter` int(11) NOT NULL,
  `fields_current` int(3) NOT NULL,
  `fields_max` int(3) NOT NULL,
  `temp_min` int(3) NOT NULL,
  `temp_max` int(3) NOT NULL,
  `metal` double(16,6) NOT NULL DEFAULT 500.000000,
  `crystal` double(16,6) NOT NULL DEFAULT 500.000000,
  `deuterium` double(16,6) NOT NULL DEFAULT 0.000000,
  `energy_used` int(11) NOT NULL DEFAULT 0,
  `energy_max` int(11) NOT NULL DEFAULT 0,
  `metal_mine_percent` int(3) NOT NULL DEFAULT 100,
  `crystal_mine_percent` int(3) NOT NULL DEFAULT 100,
  `deuterium_synthesizer_percent` int(3) NOT NULL DEFAULT 100,
  `solar_plant_percent` int(3) NOT NULL DEFAULT 100,
  `fusion_reactor_percent` int(3) NOT NULL DEFAULT 100,
  `solar_satellite_percent` int(3) NOT NULL DEFAULT 100,
  `b_building_id` int(3) DEFAULT NULL,
  `b_building_endtime` int(10) DEFAULT NULL,
  `b_tech_id` int(3) DEFAULT NULL,
  `b_tech_endtime` int(10) DEFAULT NULL,
  `b_hangar_id` text DEFAULT NULL,
  `b_hangar_start_time` int(11) NOT NULL,
  `b_hangar_plus` tinyint(1) NOT NULL DEFAULT 0,
  `destroyed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `techs`
--

CREATE TABLE `techs` (
  `userID` int(11) NOT NULL,
  `espionage_tech` tinyint(2) NOT NULL DEFAULT 0,
  `computer_tech` tinyint(2) NOT NULL DEFAULT 0,
  `weapon_tech` tinyint(2) NOT NULL DEFAULT 0,
  `armour_tech` tinyint(2) NOT NULL DEFAULT 0,
  `shielding_tech` tinyint(2) NOT NULL DEFAULT 0,
  `energy_tech` tinyint(2) NOT NULL DEFAULT 0,
  `hyperspace_tech` tinyint(2) NOT NULL DEFAULT 0,
  `combustion_drive_tech` tinyint(2) NOT NULL DEFAULT 0,
  `impulse_drive_tech` tinyint(2) NOT NULL DEFAULT 0,
  `hyperspace_drive_tech` tinyint(2) NOT NULL DEFAULT 0,
  `laser_tech` tinyint(2) NOT NULL DEFAULT 0,
  `ion_tech` tinyint(2) NOT NULL DEFAULT 0,
  `plasma_tech` tinyint(2) NOT NULL DEFAULT 0,
  `intergalactic_research_tech` tinyint(2) NOT NULL DEFAULT 0,
  `graviton_tech` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(64) NOT NULL,
  `onlinetime` varchar(10) NOT NULL,
  `currentplanet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `buildings`
--
ALTER TABLE `buildings`
  ADD UNIQUE KEY `planetid_UNIQUE` (`planetID`);

--
-- Indizes für die Tabelle `defenses`
--
ALTER TABLE `defenses`
  ADD UNIQUE KEY `planetid_UNIQUE` (`planetID`);

--
-- Indizes für die Tabelle `errors`
--
ALTER TABLE `errors`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `fleet`
--
ALTER TABLE `fleet`
  ADD UNIQUE KEY `planetid_UNIQUE` (`planetID`);

--
-- Indizes für die Tabelle `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flightID`),
  ADD KEY `fk_flight_ownerid` (`ownerID`);

--
-- Indizes für die Tabelle `galaxy`
--
ALTER TABLE `galaxy`
  ADD UNIQUE KEY `planetid_UNIQUE` (`planetID`);

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD UNIQUE KEY `messageID_UNIQUE` (`messageID`),
  ADD KEY `fk_messages_users1_idx` (`senderID`),
  ADD KEY `fk_messages_users2_idx` (`receiverID`);

--
-- Indizes für die Tabelle `planets`
--
ALTER TABLE `planets`
  ADD PRIMARY KEY (`planetID`),
  ADD KEY `fk_planet_ownerid` (`ownerID`);

--
-- Indizes für die Tabelle `techs`
--
ALTER TABLE `techs`
  ADD UNIQUE KEY `userid_UNIQUE` (`userID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `id_UNIQUE` (`userID`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `currentplanet_UNIQUE` (`currentplanet`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `errors`
--
ALTER TABLE `errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `flights`
--
ALTER TABLE `flights`
  MODIFY `flightID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `fk_building_planetid` FOREIGN KEY (`planetID`) REFERENCES `planets` (`planetID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `defenses`
--
ALTER TABLE `defenses`
  ADD CONSTRAINT `fk_defense_planetid` FOREIGN KEY (`planetID`) REFERENCES `planets` (`planetID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `fleet`
--
ALTER TABLE `fleet`
  ADD CONSTRAINT `fk_fleet_planetid` FOREIGN KEY (`planetID`) REFERENCES `planets` (`planetID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `fk_flight_ownerid` FOREIGN KEY (`ownerID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `galaxy`
--
ALTER TABLE `galaxy`
  ADD CONSTRAINT `fk_galaxy_planetid` FOREIGN KEY (`planetID`) REFERENCES `planets` (`planetID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users1` FOREIGN KEY (`senderID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_users2` FOREIGN KEY (`receiverID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `planets`
--
ALTER TABLE `planets`
  ADD CONSTRAINT `fk_planet_ownerid` FOREIGN KEY (`ownerID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `techs`
--
ALTER TABLE `techs`
  ADD CONSTRAINT `fk_research_userid` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
