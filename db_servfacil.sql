CREATE DATABASE IF NOT EXISTS `db_servfacil` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_servfacil`;

CREATE TABLE IF NOT EXISTS `cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `entry_value` decimal(15,4) DEFAULT NULL,
  `input_value` decimal(15,4) DEFAULT NULL,
  `output_value` decimal(15,4) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `payment_date` date NOT NULL,
  `document` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_cash` (`client_id`),
  CONSTRAINT `fk_client_cash` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `cfop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cfop_group` varchar(100) DEFAULT NULL,
  `cfop` varchar(6) NOT NULL,
  `cfop_description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=591 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `inserted_at` datetime NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `born_at` date DEFAULT NULL,
  `age` smallint(6) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `nat_registration` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=722 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ctt_type` char(1) NOT NULL,
  `contact` varchar(70) NOT NULL,
  `person_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_person` (`person_id`),
  CONSTRAINT `fk_person` FOREIGN KEY (`person_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `csosn_cst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csosn_cst_code` varchar(6) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` varchar(125) NOT NULL,
  `created_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `original_value` decimal(15,4) NOT NULL,
  `payment_value` decimal(15,4) NOT NULL,
  `addition_value` decimal(15,4) DEFAULT NULL,
  `discount_value` decimal(15,4) DEFAULT NULL,
  `payment_type` varchar(20) NOT NULL,
  `paid_amount` decimal(15,4) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_payments` (`client_id`),
  CONSTRAINT `fk_client_payments` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) NOT NULL,
  `product_application` enum('Mercadoria para revenda','Serviços','Material de uso e consumo') NOT NULL DEFAULT 'Mercadoria para revenda',
  `gtin_barcode` varchar(15) DEFAULT NULL,
  `ncm` varchar(10) DEFAULT NULL,
  `cest` varchar(10) DEFAULT NULL,
  `quantity` double(10,4) NOT NULL DEFAULT 0.0000,
  `cost_price` double(15,4) NOT NULL DEFAULT 0.0000,
  `sell_price` double(15,4) NOT NULL DEFAULT 0.0000,
  `profit_percentual` double(15,4) NOT NULL DEFAULT 0.0000,
  `cfop` varchar(6) DEFAULT NULL,
  `csosn_cst` varchar(6) DEFAULT NULL,
  `origin` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3058 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `receivements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `original_value` decimal(15,4) NOT NULL,
  `payment_value` decimal(15,4) NOT NULL,
  `addition_value` decimal(15,4) DEFAULT NULL,
  `discount_value` decimal(15,4) DEFAULT NULL,
  `receivement_type` varchar(20) NOT NULL,
  `paid_amount` decimal(15,4) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_receivements` (`client_id`) USING BTREE,
  CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `service_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `items_value` decimal(15,4) DEFAULT NULL,
  `services_value` decimal(15,4) DEFAULT NULL,
  `total_value` decimal(15,4) DEFAULT NULL,
  `object_id` int(11) NOT NULL,
  `object_name` varchar(125) NOT NULL,
  `observation` blob DEFAULT NULL,
  `service_report` blob DEFAULT NULL,
  `solicitation` blob DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `forecast_date` date DEFAULT NULL,
  `situation_id` int(11) NOT NULL,
  `situation_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_service_order` (`client_id`),
  KEY `fk_object_service_order` (`object_id`),
  KEY `fk_situation_service_order` (`situation_id`),
  CONSTRAINT `fk_client_service_order` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `fk_object_service_order` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`),
  CONSTRAINT `fk_situation_service_order` FOREIGN KEY (`situation_id`) REFERENCES `situation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `service_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_application` varchar(100) DEFAULT NULL,
  `unitary_value` decimal(15,4) DEFAULT NULL,
  `total_value` decimal(15,4) DEFAULT NULL,
  `quantity` decimal(15,4) DEFAULT NULL,
  `discount` decimal(15,4) DEFAULT NULL,
  `addition` decimal(15,4) DEFAULT NULL,
  `confirmal_status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_person` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_so_items` (`user_id`),
  KEY `fk_product_so_items` (`product_id`),
  CONSTRAINT `fk_product_so_items` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_user_so_items` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `situation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `situation` varchar(50) NOT NULL,
  `color` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `person_name` varchar(100) DEFAULT NULL,
  `age` smallint(6) DEFAULT NULL,
  `function` varchar(50) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;