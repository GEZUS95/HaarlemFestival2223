-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 15, 2023 at 11:56 AM
-- Server version: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
                          `id` int(11) NOT NULL,
                          `name` varchar(255) NOT NULL,
                          `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
                         `id` int(11) NOT NULL,
                         `session_id` int(11) NOT NULL,
                         `title` varchar(255) NOT NULL,
                         `total_price_event` varchar(255) NOT NULL,
                         `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) NOT NULL,
                            `city` varchar(255) NOT NULL,
                            `address` varchar(255) NOT NULL,
                            `stage` varchar(255) NOT NULL,
                            `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
                             `uuid` varchar(255) NOT NULL,
                             `order_id` int(11) NOT NULL,
                             `event_id` int(11) NOT NULL,
                             `program_id` int(11) NOT NULL,
                             `programitem_id` int(11) NOT NULL,
                             `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
                          `id` int(11) NOT NULL,
                          `user_id` int(11) NOT NULL,
                          `share_uuid` varchar(255) NOT NULL,
                          `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
                           `id` int(11) NOT NULL,
                           `event_id` int(11) NOT NULL,
                           `title` varchar(255) NOT NULL,
                           `total_price_program` double NOT NULL,
                           `start_time` datetime NOT NULL,
                           `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programitem`
--

CREATE TABLE `programitem` (
                               `id` int(11) NOT NULL,
                               `program_id` int(11) NOT NULL,
                               `location_id` int(11) NOT NULL,
                               `artist_id` int(11) NOT NULL,
                               `special_guest_id` int(11) DEFAULT NULL,
                               `start_time` datetime NOT NULL,
                               `end_time` datetime NOT NULL,
                               `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
                              `id` int(11) NOT NULL,
                              `location_id` int(11) NOT NULL,
                              `name` varchar(255) NOT NULL,
                              `description` text NOT NULL,
                              `stars` int(11) NOT NULL,
                              `seats` int(11) NOT NULL,
                              `price` double NOT NULL,
                              `price_child` double NOT NULL,
                              `session_time` datetime NOT NULL,
                              `accesibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restauranttype`
--

CREATE TABLE `restauranttype` (
                                  `id` int(11) NOT NULL,
                                  `cuisine_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restauranttypelink`
--

CREATE TABLE `restauranttypelink` (
                                      `id` int(11) NOT NULL,
                                      `restaurant_id` int(11) NOT NULL,
                                      `restaurant_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
                        `id` int(11) NOT NULL,
                        `name` varchar(255) NOT NULL,
                        `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
                           `id` int(11) NOT NULL,
                           `restaurant_id` int(11) NOT NULL,
                           `start_time` datetime NOT NULL,
                           `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL,
                        `role_id` int(11) NOT NULL,
                        `name` varchar(255) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `passwordhash` varchar(255) NOT NULL,
                        `created_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apikeys`
--

CREATE TABLE apikey (
                        `uuid` varchar(255) NOT NULL,
                        `description` varchar(255),
                        `created_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
                                 `uuid` varchar(255) NOT NULL,
                                 `user_id` int(11) NOT NULL,
                                 `expires_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `content`
--

create table content (
    `id`         int auto_increment primary key,
    `title`      varchar(255) not null,
    `body`       longtext     not null,
    `image_path` varchar(255) null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
    ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
    ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
    ADD PRIMARY KEY (`id`);


--
-- Indexes for table `programitem`
--
ALTER TABLE `programitem`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restauranttype`
--
ALTER TABLE `restauranttype`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restauranttypelink`
--
ALTER TABLE `restauranttypelink`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apikeys`
--
ALTER TABLE apikey
    ADD PRIMARY KEY (`uuid`);

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programitem`
--
ALTER TABLE `programitem`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restauranttype`
--
ALTER TABLE `restauranttype`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restauranttypelink`
--
ALTER TABLE `restauranttypelink`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- Foreign Keys
-- event table
ALTER TABLE event ADD FOREIGN KEY (session_id) REFERENCES programitem (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- orderline table
ALTER TABLE orderline ADD FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE orderline ADD FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE orderline ADD FOREIGN KEY (programitem_id) REFERENCES programitem (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE orderline ADD FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE orderline ADD FOREIGN KEY (session_id) REFERENCES programitem (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- orders table
ALTER TABLE orders ADD FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- program table
ALTER TABLE program ADD FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- programitem table
ALTER TABLE programitem ADD FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE programitem ADD FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE programitem ADD FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE programitem ADD FOREIGN KEY (special_guest_id) REFERENCES artist (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- restaurant table
ALTER TABLE restaurant ADD FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- restauranttypelink table
ALTER TABLE restauranttypelink ADD FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE restauranttypelink ADD FOREIGN KEY (restaurant_type_id) REFERENCES restauranttype (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- user table
ALTER TABLE user ADD FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE ON UPDATE CASCADE;

-- passwordreset table
ALTER TABLE passwordreset ADD FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- insert data

-- user roles
INSERT INTO role VALUES (1, 'user', 'Simple user account');
INSERT INTO role VALUES (2, 'admin', 'Administrator account');
INSERT INTO role VALUES (3, 'super-admin', 'Super-administrator account');

-- users
INSERT INTO user VALUES (1, 1, 'gebruiker', 'gebruiker@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO', NOW());
INSERT INTO user VALUES (2, 2, 'admin', 'admin@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO', NOW());
INSERT INTO user VALUES (3, 3, 'super-admin', 'superadmin@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO', NOW());