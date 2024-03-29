--
-- Table: `apikey`
--
CREATE TABLE `apikey`
(
    `uuid`        varchar(255) NOT NULL PRIMARY KEY,
    `description` varchar(255) DEFAULT NULL,
    `created_at`  datetime     NOT NULL
);

--
-- Table: `content`
--
CREATE TABLE `content`
(
    `id`         int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title`      varchar(255) NOT NULL,
    `body`       longtext     NOT NULL,
    `image_path` varchar(255)          DEFAULT NULL,
    `deletable`  boolean      NOT NULL DEFAULT TRUE
);

--
-- Table: `role`
--
CREATE TABLE `role`
(
    `id`          int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`        varchar(255) NOT NULL,
    `description` varchar(255) NOT NULL
);

--
-- Table: `user`
--
CREATE TABLE `user`
(
    `id`           int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `role_id`      int(11)      NOT NULL,
    `name`         varchar(255) NOT NULL,
    `email`        varchar(255) NOT NULL,
    `passwordhash` varchar(255) NOT NULL,
    `created_at`   datetime     NOT NULL,
    CONSTRAINT FK_user_role FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `passwordreset`
--
CREATE TABLE `passwordreset`
(
    `uuid`       varchar(255) NOT NULL PRIMARY KEY,
    `user_id`    int(11)      NOT NULL,
    `expires_at` datetime     NOT NULL,
    CONSTRAINT FK_passwordreset_user FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `artist`
--
CREATE TABLE `artist`
(
    `id`          int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`        varchar(255) NOT NULL,
    `description` text         NOT NULL
);

--
-- Table: `location`
--
CREATE TABLE `location`
(
    `id`      int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name`    varchar(255) NOT NULL,
    `city`    varchar(255) NOT NULL,
    `address` varchar(255) NOT NULL,
    `stage`   varchar(255) NOT NULL,
    `seats`   int(11)      NOT NULL
);

--
-- Table: `event`
--
CREATE TABLE `event`
(
    `id`          int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title`       varchar(255) NOT NULL,
    `description` text         NOT NULL
);

--
-- Table: `program`
--
CREATE TABLE `program`
(
    `id`         int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `event_id`   int(11)      NOT NULL,
    `title`      varchar(255) NOT NULL,
    `price`      double       NOT NULL,
    `start_time` datetime     NOT NULL,
    `end_time`   datetime     NOT NULL,
    CONSTRAINT FK_program_event FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `programitem`
--
CREATE TABLE `programitem`
(
    `id`               int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `program_id`       int(11)      NOT NULL,
    `location_id`      int(11)      NOT NULL,
    `artist_id`        int(11)      NOT NULL,
    `special_guest_id` int(11)      NOT NULL,
    `title`            varchar(255) NOT NULL,
    `start_time`       datetime     NOT NULL,
    `end_time`         datetime     NOT NULL,
    `price`            double       NOT NULL,
    `seats_left`       int(11)      NOT NULL,
    `highlight`        boolean      NOT NULL DEFAULT FALSE,
    CONSTRAINT FK_item_program FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_item_location FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_item_artist FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_item_guest FOREIGN KEY (`special_guest_id`) REFERENCES `artist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `restaurant`
--
CREATE TABLE `restaurant`
(
    `id`            int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `location_id`   int(11)      NOT NULL,
    `name`          varchar(255) NOT NULL,
    `description`   text         NOT NULL,
    `stars`         int(11)      NOT NULL,
    `seats`         int(11)      NOT NULL,
    `price`         double       NOT NULL,
    `price_child`   double       NOT NULL,
    `accessibility` varchar(255) NOT NULL,
    `highlight`     boolean      NOT NULL DEFAULT FALSE,
    CONSTRAINT FK_restaurant_location FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `restauranttype`
--
CREATE TABLE `restauranttype`
(
    `id`           int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `cuisine_name` varchar(255) NOT NULL
);

--
-- Table: `restauranttypelink`
--
CREATE TABLE `restauranttypelink`
(
    `id`                 int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `restaurant_id`      int(11) NOT NULL,
    `restaurant_type_id` int(11) NOT NULL,
    CONSTRAINT FK_link_restaurant FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_link_type FOREIGN KEY (`restaurant_type_id`) REFERENCES `restauranttype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `session`
--
CREATE TABLE `session`
(
    `id`            int(11)  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `restaurant_id` int(11)  NOT NULL,
    `program_id`    int(11)  NOT NULL,
    `start_time`    datetime NOT NULL,
    `end_time`      datetime NOT NULL,
    `seats_left`    int(11)  NOT NULL,
    CONSTRAINT FK_session_restaurant FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_session_program FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `reservation`
--
CREATE TABLE `reservation`
(
    `id`         int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id`    int(11)      NOT NULL,
    `session_id` int(11)      NOT NULL,
    `remarks`    varchar(255) DEFAULT NULL,
    `status`     varchar(255) NOT NULL,
    CONSTRAINT FK_reservation_user FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK_reservation_session FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `orders`
--
CREATE TABLE `orders`
(
    `id`         int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id`    int(11)      NOT NULL,
    `share_uuid` varchar(255) NOT NULL,
    `status`     varchar(255) NOT NULL,
    `payed_at`   datetime     NOT NULL DEFAULT '0000-00-00 00:00:00',
    CONSTRAINT FK_orders_user FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `orderline`
--
CREATE TABLE `orderline`
(
    `id`       int(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `order_id` int(11)      NOT NULL,
    `table`    varchar(255) NOT NULL,
    `item_id`  int(11)      NOT NULL,
    `quantity` int(3)       NOT NULL,
    `child`    boolean      NOT NULL DEFAULT FALSE,
    CONSTRAINT FK_orderline_order FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- Table: `tickets`
--
CREATE TABLE `tickets`
(
    `uuid`         varchar(255) NOT NULL PRIMARY KEY,
    `orderline_id` int(11)      NOT NULL,
    `used`         boolean      NOT NULL DEFAULT FALSE,
    CONSTRAINT FK_ticket_orderline FOREIGN KEY (`orderline_id`) REFERENCES `orderline` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

--
-- INSERT Data In Tables`
--
INSERT INTO `apikey` (`uuid`, `description`, `created_at`)
VALUES ('cb4ecf3a-c8a6-11ed-afa1-0242ac120002', 'Inholland B.V.', '2023-03-22 11:43:11'),
       ('d7a1ddd6-c8a6-11ed-afa1-0242ac120002', 'Monsters Inc.', '2023-03-22 11:43:59');

INSERT INTO `content` (`id`, `title`, `body`, `image_path`, `deletable`)
VALUES (1, 'Home',
        '&#60;p&#62;this is an test for the homepage&#60;/p&#62;&#13;&#10;&#60;p&#62;&#38;nbsp;&#60;/p&#62;&#13;&#10;&#60;p&#62;it is working now!&#60;/p&#62;',
        '', 0),
       (2, 'Venues', 'We partnered with a lot of venues to give you the best experience at Haarlem Festival.', '', 0),
       (3, 'Jazz', 'We partnered with a lot of venues to give you the best experience at Haarlem Festival.', '', 0),
       (4, 'Dance', 'We partnered with a lot of venues to give you the best experience at Haarlem Festival.', '', 0),
       (5, 'Food', 'We partnered with a lot of venues to give you the best experience at Haarlem Festival.', '', 0),
       (6, 'Haarlem Information', 'Haarlem is a beautiful city with lots to see and discover.', '', 0),
       (7, 'Locations', 'Haarlem is a beautiful city with lots to see and discover.', '', 0),
       (8, 'Artist', 'Haarlem is a beautiful city with lots to see and discover.', '', 0);

INSERT INTO `role` (`id`, `name`, `description`)
VALUES (1, 'user', 'Simple user account'),
       (2, 'admin', 'Administrator account'),
       (3, 'super-admin', 'Super-administrator account');

INSERT INTO `user` (`id`, `role_id`, `name`, `email`, `passwordhash`, `created_at`)
VALUES (1, 1, 'gebruiker', 'gebruiker@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO',
        '2023-03-22 11:35:42'),
       (2, 2, 'admin', 'admin@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO',
        '2023-03-22 11:35:43'),
       (3, 3, 'super-admin', 'superadmin@email.com', '$2y$10$/LNXF0yNrbWuzNXXGU8uP.wpWnkTbqzHYx0Ex.Ks2t8p4tBDarnJO',
        '2023-03-22 11:35:44'),
       (4, 2, 'Cees Gribnau', 'ceesgribnau@hotmail.com', '$2y$10$QHE/S7Z7Hif70cccePiTbuiPUOsTzh7y9Ok57.oD3Z0XgvFo5/f5W',
        '2023-03-22 11:35:45');

INSERT INTO `passwordreset` (`uuid`, `user_id`, `expires_at`)
VALUES ('05b7e252-c8ba-11ed-afa1-0242ac120002', 1, '2023-03-22 14:01:17'),
       ('0d07ad6c-c8ba-11ed-afa1-0242ac120002', 2, '2023-03-23 15:01:28');

-- Insert into `artist` table
INSERT INTO `artist` (`id`, `name`, `description`)
VALUES (1, 'John Doe', 'John Doe the guitar player'),
       (2, 'Henry Benry', 'He loves cheese'),
       (3, 'Alice Smith', 'A talented singer'),
       (4, 'Bob Johnson', 'A renowned pianist'),
       (5, 'Emma Thompson', 'A skilled violinist');

-- Insert into `location` table
INSERT INTO `location` (`id`, `name`, `city`, `address`, `stage`, `seats`)
VALUES (1, 'De graanfabriek', 'Haarlem', 'laanlaan 538', 'test', 100),
       (2, 'De Molen', 'Haarlem', 'groenstraat 857738', 'test', 500),
       (3, 'De Roode Leeuw', 'Haarlem', 'damstraat 123', 'test', 200),
       (4, 'Het Gouden Kalf', 'Haarlem', 'maasstraat 456', 'test', 150),
       (5, 'De Pauw', 'Haarlem', 'grachtstraat 789', 'test', 50);

INSERT INTO `event` (`id`, `title`, `description`)
VALUES (1, 'Food', 'Taste the best food from Haarlem.'),
       (2, 'Dance', 'The finest dance music made for you.'),
       (3, 'Jazz', 'The finest jazz music made for you.');

-- Insert into `program` table
INSERT INTO `program` (`id`, `event_id`, `title`, `price`, `start_time`, `end_time`)
VALUES (1, 2, 'Friday', 200, '2023-05-24 14:02:41', '2023-03-24 23:59:59'),
       (2, 2, 'Saturday', 400, '2023-05-25 14:02:41', '2023-03-25 23:59:59'),
       (3, 1, 'Sunday', 150, '2023-05-26 14:02:41', '2023-03-26 23:59:59'),
       (4, 3, 'Monday', 100, '2023-05-27 14:02:41', '2023-03-27 23:59:59'),
       (5, 2, 'Tuesday', 300, '2023-05-28 14:02:41', '2023-03-28 23:59:59');

-- Insert into `programitem` table
INSERT INTO `programitem` (`id`, `program_id`, `location_id`, `artist_id`, `special_guest_id`, `title`, `start_time`,
                           `end_time`, `price`, `seats_left`, highlight)
VALUES (1, 1, 1, 1, 2, 'John Doe Live', '2023-03-24 14:03:10', '2023-05-24 22:03:10', 100, 50 , 1),
       (2, 2, 2, 1, 2, 'John Doe Live 2: Electric Boogaloo', '2023-05-25 14:04:31', '2023-03-25 12:04:31', 150, 50, 1),
       (3, 3, 3, 2, 1, 'Alice Smith Live', '2023-05-26 14:05:52', '2023-03-26 22:05:52', 200, 50, 1),
       (4, 4, 4, 3, 4, 'Bob Johnson Live', '2023-05-27 14:07:13', '2023-03-27 22:07:13', 250, 50, 1),
       (5, 5, 5, 4, 5, 'Emma Thompson Live', '2023-05-28 14:08:34', '2023-03-28 22:08:34', 300, 50, 1);

INSERT INTO `restaurant` (`id`, `location_id`, `name`, `description`, `stars`, `seats`, `price`, `price_child`,
                          `accessibility`, highlight)
VALUES (1, 1, 'Ratatouille', 'Ratatouille has a lot of food.', 5, 100, 20, 10, 'none', 1),
       (2, 2, 'McDonalds', 'McDonalds is known for their high culinary standards. ', 5, 500, 5000, 3000,
        'Wheelchair Accessible' , 1),
        (3, 3, 'Burger King', 'Burger King is known for their high culinary standards. ', 5, 500, 5000, 3000, 'none', 1),
        (4, 4, 'KFC', 'KFC is known for their high culinary standards. ', 5, 500, 5000, 3000, 'none', 1),
        (5, 5, 'Pizza Hut', 'Pizza Hut is known for their high culinary standards. ', 5, 500, 5000, 3000, 'none', 1);

INSERT INTO `restauranttype` (`id`, `cuisine_name`)
VALUES (1, 'French'),
       (2, 'Mexican'),
       (3, 'Argentinian'),
       (4, 'Dutch'),
       (5, 'Modern French'),
       (6, 'German'),
       (7, 'Chinese'),
       (8, 'Indonesian'),
       (9, 'Indian'),
       (10, 'American');

INSERT INTO `restauranttypelink` (`id`, `restaurant_id`, `restaurant_type_id`)
VALUES (1, 2, 10),
       (2, 1, 1),
       (3, 1, 5),
       (4, 3, 10),
       (5, 4, 10),
       (6, 5, 10);

INSERT INTO `session` (`id`, `restaurant_id`, `program_id`, `start_time`, `end_time`, `seats_left`)
VALUES (1, 1, 1, '2023-05-31 14:12:22', '2023-05-28 18:12:22', 10),
       (2, 2, 1, '2023-05-29 14:13:13', '2023-05-29 19:13:13', 50),
       (3, 3, 1, '2023-05-30 14:13:13', '2023-05-30 19:13:13', 50),
       (4, 4, 1, '2023-05-31 14:13:13', '2023-05-31 19:13:13', 50),
       (5, 5, 1, '2023-05-31 14:13:13', '2023-05-31 19:13:13', 50);

INSERT INTO `reservation` (`id`, `user_id`, `session_id`, `remarks`, `status`)
VALUES (1, 1, 1, 'none', 'active'),
       (2, 1, 2, 'Can we get a chair for my 3 year old', 'inactive'),
       (3, 1, 3, 'none', 'inactive'),
       (4, 1, 4, 'none', 'inactive'),
       (5, 1, 5, 'none', 'inactive');

INSERT INTO `orders` (`id`, `user_id`, `share_uuid`, `status`, `payed_at`)
VALUES (1, 1, '82336383-1950-47c2-874e-9a9191cf2e4d', 'open', NULL),
       (2, 1, 'a44aa6b2-c8b9-11ed-afa1-0242ac120002', 'paid', '2023-03-22 14:01:17');

INSERT INTO `orderline` (`id`, `order_id`, `table`, `item_id`, `quantity`, `child`)
VALUES (1, 1, 'reservation', 1, 3, 0),
       (2, 1, 'reservation', 2, 2, 1);
