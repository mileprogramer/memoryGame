-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 01:37 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memory_game`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_level` (IN `id_level` BIGINT UNSIGNED, IN `images` JSON, IN `replaced_images_ids` JSON, IN `time_to_solve` BIGINT, IN `unit` ENUM('minutes','seconds'))   BEGIN
    DECLARE num_images INT;
    DECLARE i INT DEFAULT 0;
    DECLARE image_path VARCHAR(255);
    DECLARE replaced_image_id BIGINT;

    SET num_images = JSON_LENGTH(images);

    -- Start transaction
    START TRANSACTION;

    -- Update time_to_solve and unit if provided
    IF time_to_solve IS NOT NULL THEN
        UPDATE `level`
        JOIN `time` ON level.id_time_to_solve = time.id_time_to_solve
        SET time.time_to_solve = time_to_solve
        WHERE level.id_level = id_level;
    END IF;

    IF unit IS NOT NULL THEN
        UPDATE `time`
        JOIN `level` ON level.id_time_to_solve = time.id_time_to_solve
        SET time.unit = unit
        WHERE `id_level` = id_level;
    END IF;

    -- Update images if provided
    IF images IS NOT NULL THEN
        WHILE i < num_images DO
            SET image_path = JSON_UNQUOTE(JSON_EXTRACT(images, CONCAT('$[', i, ']')));
            SET replaced_image_id = JSON_UNQUOTE(JSON_EXTRACT(replaced_images_ids, CONCAT('$[', i, ']')));

            UPDATE `images`
            SET `image_path` = image_path
            WHERE `id_image` = replaced_image_id;

            SET i = i + 1;
        END WHILE;
    END IF;

    -- Commit transaction
    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_level` (IN `num_rows` INT, IN `num_columns` INT, IN `images` JSON, IN `time_to_solve` BIGINT, IN `unit` ENUM('minutes','seconds'), IN `creator_username` VARCHAR(255))   BEGIN
    -- Declare variables
    DECLARE id_grid INT;
    DECLARE id_gallery INT;
    DECLARE id_time_to_solve INT;
    DECLARE id_user_creator INT;
    DECLARE i INT DEFAULT 0;
    DECLARE image_path VARCHAR(255);
    DECLARE num_images INT;

    -- Insert into `grid` table
    INSERT INTO `grid` (`num_rows`, `num_columns`) VALUES (num_rows, num_columns);
    SET id_grid = LAST_INSERT_ID();

    -- Insert into `gallery` table
    INSERT INTO `gallery` VALUES ();
    SET id_gallery = LAST_INSERT_ID();

    -- Insert into `time` table
    INSERT INTO `time` (`time_to_solve`, `unit`) VALUES (time_to_solve, unit);
    SET id_time_to_solve = LAST_INSERT_ID();

    -- Get user ID
    SELECT id_user INTO id_user_creator FROM `user` WHERE `username` = creator_username;

    
    -- Get the number of images from the JSON array
    SET num_images = JSON_LENGTH(images);

    -- Process JSON array of images
    WHILE i < num_images DO
        SET image_path = JSON_UNQUOTE(JSON_EXTRACT(images, CONCAT('$[', i, ']')));
        INSERT INTO `images` (`image_path`, `id_gallery`) VALUES (image_path, id_gallery);
        SET i = i + 1;
    END WHILE;

    
    -- Insert data into `level` table
    INSERT INTO `level` (`id_grid`, `id_time_to_solve`, `id_gallery`, `id_user`) 
    VALUES (id_grid, id_time_to_solve, id_gallery, id_user_creator);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_all_levels` ()   BEGIN

SELECT l.id_level, g.num_rows, g.num_columns, t.time_to_solve, t.unit, images.id_image ,images.image_path, gallery.card_size
    FROM level l
    INNER JOIN grid g ON l.id_grid = g.id_grid
    INNER JOIN images ON l.id_gallery = images.id_gallery
    INNER JOIN gallery ON l.id_gallery = gallery.id_gallery
    INNER JOIN time t ON l.id_time_to_solve = t.id_time_to_solve;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_by_id_level` (IN `searched_id_level` INT)   BEGIN
SELECT l.id_level, g.num_rows, g.num_columns, t.time_to_solve, t.unit, images.id_image ,images.image_path, gallery.card_size
    FROM level l
    INNER JOIN grid g ON l.id_grid = g.id_grid
    INNER JOIN images ON l.id_gallery = images.id_gallery
    INNER JOIN gallery ON l.id_gallery = gallery.id_gallery
    INNER JOIN time t ON l.id_time_to_solve = t.id_time_to_solve
	WHERE l.id_level = searched_id_level;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
