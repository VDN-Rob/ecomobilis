# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.44)
# Database: ecomobilis
# Generation Time: 2025-06-05 13:43:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table api_keys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_keys`;

CREATE TABLE `api_keys` (
                            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                            `key` varchar(255) NOT NULL DEFAULT '',
                            `name` varchar(255) DEFAULT NULL,
                            `user_id` int(11) DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table blog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
                        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                        `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `user_id` int(11) DEFAULT NULL,
                        `is_live` tinyint(1) DEFAULT '0',
                        `intro` mediumtext COLLATE utf8mb4_unicode_ci,
                        `body` longtext COLLATE utf8mb4_unicode_ci,
                        `date_posted` date DEFAULT NULL,
                        `topic` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table carpool_car_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_car_types`;

CREATE TABLE `carpool_car_types` (
                                     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                     `type` varchar(255) DEFAULT NULL,
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table carpool_cars
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_cars`;

CREATE TABLE `carpool_cars` (
                                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                `car_type_id` int(11) DEFAULT NULL,
                                `brand` varchar(255) DEFAULT NULL,
                                `description` varchar(255) DEFAULT NULL,
                                `default_luggage_id` int(255) DEFAULT NULL,
                                `default_seats_available` int(11) DEFAULT NULL,
                                `is_smoking_allowed` tinyint(1) DEFAULT '0',
                                `is_isofix_present` tinyint(11) DEFAULT '0',
                                `price_per_km_per_seat` decimal(10,2) DEFAULT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table carpool_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_groups`;

CREATE TABLE `carpool_groups` (
                                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                  `title` varchar(255) DEFAULT NULL,
                                  `location_street_coordinates_id` int(11) DEFAULT NULL,
                                  `rides_are_private` tinyint(4) DEFAULT '0',
                                  `does_need_authentication` tinyint(4) DEFAULT '0',
                                  `token` varchar(255) DEFAULT NULL,
                                  `user_id` int(11) DEFAULT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table carpool_luggages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_luggages`;

CREATE TABLE `carpool_luggages` (
                                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table carpool_messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_messages`;

CREATE TABLE `carpool_messages` (
                                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                    `message` mediumtext COLLATE utf8mb4_bin,
                                    `user_id` int(11) DEFAULT NULL,
                                    `conversation_partner_user_id` int(11) DEFAULT NULL,
                                    `car_ride_id` int(11) DEFAULT NULL,
                                    `is_request_for_reservation` tinyint(4) DEFAULT '0',
                                    `is_confirmation_for_reservation` tinyint(4) DEFAULT '0',
                                    `is_rejected_for_reservation` tinyint(4) DEFAULT '0',
                                    `is_ride_cancelled_for_reservation` tinyint(4) DEFAULT '0',
                                    `is_read` tinyint(4) DEFAULT '0',
                                    `is_sent` tinyint(4) DEFAULT '0',
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;



# Dump of table carpool_rides
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_rides`;

CREATE TABLE `carpool_rides` (
                                 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                 `travel_start_datetime` datetime DEFAULT NULL,
                                 `from_street_coordinates_id` int(11) DEFAULT NULL,
                                 `to_street_coordinates_id` int(11) DEFAULT NULL,
                                 `luggage_id` int(11) DEFAULT NULL,
                                 `seats_available` int(11) DEFAULT NULL,
                                 `remark` varchar(255) DEFAULT NULL,
                                 `price_per_seat` decimal(10,2) DEFAULT NULL,
                                 `user_id` int(11) DEFAULT NULL,
                                 `group_id` int(11) DEFAULT NULL,
                                 `is_private` tinyint(1) DEFAULT '0',
                                 `is_cancelled` tinyint(1) DEFAULT '0',
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table carpool_rides_requests
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_rides_requests`;

CREATE TABLE `carpool_rides_requests` (
                                          `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                          `travel_start_datetime` datetime DEFAULT NULL,
                                          `from_street_coordinates_id` int(11) DEFAULT NULL,
                                          `to_street_coordinates_id` int(11) DEFAULT NULL,
                                          `seats_needed` int(11) DEFAULT NULL,
                                          `remark` varchar(255) DEFAULT NULL,
                                          `user_id` int(11) DEFAULT NULL,
                                          `is_accepted` tinyint(4) DEFAULT '0',
                                          `is_rejected` tinyint(4) DEFAULT '0',
                                          `token` varchar(25) DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table carpool_rides_reservations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_rides_reservations`;

CREATE TABLE `carpool_rides_reservations` (
                                              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                              `ride_id` int(11) DEFAULT NULL,
                                              `passenger_user_id` int(11) DEFAULT NULL,
                                              `amount` int(11) DEFAULT NULL,
                                              `is_accepted` tinyint(4) DEFAULT '0',
                                              `is_rejected` tinyint(4) DEFAULT '0',
                                              `created_at` timestamp NULL DEFAULT NULL,
                                              `updated_at` timestamp NULL DEFAULT NULL,
                                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table carpool_street_coordinates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `carpool_street_coordinates`;

CREATE TABLE `carpool_street_coordinates` (
                                              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                              `street` varchar(255) DEFAULT NULL,
                                              `zip_code` varchar(255) DEFAULT NULL,
                                              `city` varchar(255) DEFAULT NULL,
                                              `country` varchar(25) DEFAULT NULL,
                                              `external_api_id` varchar(15) DEFAULT NULL,
                                              `external_api_source` varchar(25) DEFAULT NULL,
                                              `osm_id` varchar(15) DEFAULT NULL,
                                              `osm_way` varchar(11) DEFAULT NULL,
                                              `lat` decimal(10,2) DEFAULT NULL,
                                              `lng` decimal(10,2) DEFAULT NULL,
                                              `created_at` timestamp NULL DEFAULT NULL,
                                              `updated_at` timestamp NULL DEFAULT NULL,
                                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
                               `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                               `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table faq
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faq`;

CREATE TABLE `faq` (
                       `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                       `category` varchar(255) DEFAULT NULL,
                       `question` varchar(255) DEFAULT NULL,
                       `answer` mediumtext,
                       `created_at` timestamp NULL DEFAULT NULL,
                       `updated_at` timestamp NULL DEFAULT NULL,
                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
                        `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                        `queue` varchar(191) NOT NULL,
                        `payload` longtext NOT NULL,
                        `attempts` tinyint(3) unsigned NOT NULL,
                        `reserved_at` int(10) unsigned DEFAULT NULL,
                        `available_at` int(10) unsigned NOT NULL,
                        `created_at` int(10) unsigned NOT NULL,
                        PRIMARY KEY (`id`),
                        KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
                         `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                         `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `is_live` tinyint(1) DEFAULT '0',
                         `is_show_in_top_nav` tinyint(1) DEFAULT '0',
                         `is_show_in_footer_nav` tinyint(1) DEFAULT '0',
                         `intro` mediumtext COLLATE utf8mb4_unicode_ci,
                         `body` longtext COLLATE utf8mb4_unicode_ci,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
                                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL,
                                         PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens_rm
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens_rm`;

CREATE TABLE `personal_access_tokens_rm` (
                                             `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                             `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                             `tokenable_id` bigint(20) unsigned NOT NULL,
                                             `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                             `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                             `abilities` text COLLATE utf8mb4_unicode_ci,
                                             `last_used_at` timestamp NULL DEFAULT NULL,
                                             `expires_at` timestamp NULL DEFAULT NULL,
                                             `created_at` timestamp NULL DEFAULT NULL,
                                             `updated_at` timestamp NULL DEFAULT NULL,
                                             PRIMARY KEY (`id`),
                                             UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                                             KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
                            `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `user_id` int(10) unsigned DEFAULT NULL,
                            `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `user_agent` text COLLATE utf8mb4_unicode_ci,
                            `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
                            `last_activity` int(11) NOT NULL,
                            UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `gender` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `birth_date` date DEFAULT NULL,
                         `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `permission_level` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `street_coordinates_id` int(11) DEFAULT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `car_id` int(11) DEFAULT NULL,
                         `is_admin` tinyint(4) NOT NULL DEFAULT '0',
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `carpool_car_types` (
                                     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                     `type` varchar(255) DEFAULT NULL,
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `carpool_luggages` (
                                    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
