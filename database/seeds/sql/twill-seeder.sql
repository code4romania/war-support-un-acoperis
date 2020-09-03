-- -------------------------------------------------------------
-- TablePlus 3.8.0(336)
--
-- https://tableplus.com/
--
-- Database: helpforhealth
-- Generation Time: 2020-09-03 12:11:52.8010
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blockable_id` int unsigned DEFAULT NULL,
  `blockable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int unsigned NOT NULL,
  `content` json NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocks_blockable_type_blockable_id_index` (`blockable_type`,`blockable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `mediables`;
CREATE TABLE `mediables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `mediable_id` bigint unsigned DEFAULT NULL,
  `mediable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` bigint unsigned NOT NULL,
  `crop_x` int DEFAULT NULL,
  `crop_y` int DEFAULT NULL,
  `crop_w` int DEFAULT NULL,
  `crop_h` int DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lqip_data` text COLLATE utf8mb4_unicode_ci,
  `ratio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadatas` json NOT NULL,
  `locale` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  KEY `fk_mediables_media_id` (`media_id`),
  KEY `mediables_mediable_type_mediable_id_index` (`mediable_type`,`mediable_id`),
  KEY `mediables_locale_index` (`locale`),
  CONSTRAINT `fk_mediables_media_id` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `medias`;
CREATE TABLE `medias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `uuid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` text COLLATE utf8mb4_unicode_ci,
  `width` int unsigned NOT NULL,
  `height` int unsigned NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `filename` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `page_revisions`;
CREATE TABLE `page_revisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payload` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_revisions_page_id_foreign` (`page_id`),
  KEY `page_revisions_user_id_foreign` (`user_id`),
  CONSTRAINT `page_revisions_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `page_revisions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `page_slugs`;
CREATE TABLE `page_slugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_page_slugs_page_id` (`page_id`),
  KEY `page_slugs_locale_index` (`locale`),
  CONSTRAINT `fk_page_slugs_page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `page_translations`;
CREATE TABLE `page_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_id_locale_unique` (`page_id`,`locale`),
  KEY `page_translations_locale_index` (`locale`),
  CONSTRAINT `fk_page_translations_page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `setting_translations`;
CREATE TABLE `setting_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_id_locale_unique` (`setting_id`,`locale`),
  KEY `setting_translations_locale_index` (`locale`),
  CONSTRAINT `fk_setting_translations_setting_id` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_key_index` (`key`),
  KEY `settings_section_index` (`section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blocks` (`id`, `blockable_id`, `blockable_type`, `position`, `content`, `type`, `child_key`, `parent_id`) VALUES
('14', '1', 'App\\Models\\Page', '1', '{\"paragraph\": {\"en\": \"<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\", \"ro\": \"<p>Sed ut <strong>perspiciatis</strong> unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\"}}', 'paragraph', NULL, NULL);

INSERT INTO `page_revisions` (`id`, `page_id`, `user_id`, `created_at`, `updated_at`, `payload`) VALUES
('1', '1', '1', '2020-09-02 14:59:20', '2020-09-02 14:59:20', '{\"slug\": {\"ro\": \"asd\"}, \"title\": {\"ro\": \"asd\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": false, \"shortlabel\": \"EN\"}]}'),
('3', '1', '1', '2020-09-02 15:03:09', '2020-09-02 15:03:09', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"publish\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('4', '1', '1', '2020-09-02 15:03:23', '2020-09-02 15:03:23', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 1599058999025, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('5', '1', '1', '2020-09-02 15:03:37', '2020-09-02 15:03:37', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 1599058999025, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('6', '1', '1', '2020-09-02 15:04:44', '2020-09-02 15:04:44', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 2, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 1599059076901, \"type\": \"a17-block-homepage-partners\", \"blocks\": [], \"medias\": [], \"content\": [], \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"dada\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('7', '1', '1', '2020-09-02 15:06:06', '2020-09-02 15:06:06', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 2, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 1599059076901, \"type\": \"a17-block-homepage-partners\", \"blocks\": [], \"medias\": [], \"content\": [], \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"dada\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('8', '1', '1', '2020-09-02 15:06:54', '2020-09-02 15:06:54', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 2, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 1599059206797, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": \"hehe\"}, \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"dada\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('9', '1', '1', '2020-09-02 15:08:02', '2020-09-02 15:08:02', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 7, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 8, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": \"Parteneri\"}, \"browsers\": {\"partners\": [{\"id\": 1, \"name\": \"partenerul de incredere\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('10', '1', '1', '2020-09-03 09:01:17', '2020-09-03 09:01:17', '{\"slug\": {\"en\": \"about\", \"ro\": \"despre\"}, \"title\": {\"en\": \"About Help for Health\", \"ro\": \"Despre Help for Health\"}, \"blocks\": [{\"id\": 9, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 10, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": \"Parteneri\"}, \"browsers\": {\"partners\": [{\"id\": 1, \"name\": \"partenerul de incredere\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('11', '1', '1', '2020-09-03 09:02:04', '2020-09-03 09:02:04', '{\"slug\": {\"en\": \"about\", \"ro\": \"despre\"}, \"title\": {\"en\": \"About Help for Health\", \"ro\": \"Despre Help for Health\"}, \"blocks\": [{\"id\": 1599123703777, \"type\": \"a17-block-paragraph\", \"blocks\": [], \"medias\": [], \"content\": {\"paragraph\": {\"en\": \"<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\"}}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
('12', '2', '1', '2020-09-03 09:02:52', '2020-09-03 09:02:52', '{\"slug\": {\"en\": \"partners\", \"ro\": \"parteneri\"}, \"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
('13', '3', '1', '2020-09-03 09:03:13', '2020-09-03 09:03:13', '{\"slug\": {\"en\": \"media\", \"ro\": \"media\"}, \"title\": {\"en\": \"Media\", \"ro\": \"Media\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
('14', '4', '1', '2020-09-03 09:03:36', '2020-09-03 09:03:36', '{\"slug\": {\"en\": \"gdpr\", \"ro\": \"gdpr\"}, \"title\": {\"en\": \"GDPR\", \"ro\": \"GDPR\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
('15', '5', '1', '2020-09-03 09:03:52', '2020-09-03 09:03:52', '{\"slug\": {\"en\": \"terms-and-conditions\", \"ro\": \"termeni-si-conditii\"}, \"title\": {\"en\": \"Terms and conditions\", \"ro\": \"Termeni și condiții\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
('16', '6', '1', '2020-09-03 09:06:02', '2020-09-03 09:06:02', '{\"slug\": {\"en\": \"news\", \"ro\": \"stiri\"}, \"title\": {\"en\": \"News\", \"ro\": \"Știri\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
('17', '1', '1', '2020-09-03 09:08:37', '2020-09-03 09:08:37', '{\"slug\": {\"en\": \"about\", \"ro\": \"despre\"}, \"title\": {\"en\": \"About Help for Health\", \"ro\": \"Despre Help for Health\"}, \"blocks\": [{\"id\": 13, \"type\": \"a17-block-paragraph\", \"blocks\": [], \"medias\": [], \"content\": {\"paragraph\": {\"en\": \"<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\", \"ro\": \"<p>Sed ut <strong>perspiciatis</strong> unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\"}}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}');

INSERT INTO `page_slugs` (`id`, `page_id`, `deleted_at`, `created_at`, `updated_at`, `slug`, `locale`, `active`) VALUES
('1', '1', NULL, NULL, NULL, 'asd', 'ro', '0'),
('2', '1', NULL, NULL, NULL, 'asd', 'en', '0'),
('3', '1', NULL, NULL, NULL, 'about-help-for-health', 'en', '0'),
('4', '1', NULL, NULL, NULL, 'despre-help-for-health', 'ro', '0'),
('5', '1', NULL, NULL, NULL, 'despre', 'ro', '1'),
('6', '1', NULL, NULL, NULL, 'about', 'en', '1'),
('7', '2', NULL, NULL, NULL, 'parteneri', 'ro', '1'),
('8', '2', NULL, NULL, NULL, 'partners', 'en', '1'),
('9', '3', NULL, NULL, NULL, 'media', 'ro', '1'),
('10', '3', NULL, NULL, NULL, 'media', 'en', '1'),
('11', '4', NULL, NULL, NULL, 'gdpr', 'ro', '1'),
('12', '4', NULL, NULL, NULL, 'gdpr', 'en', '1'),
('13', '5', NULL, NULL, NULL, 'termeni-si-conditii', 'ro', '1'),
('14', '5', NULL, NULL, NULL, 'terms-and-conditions', 'en', '1'),
('15', '6', NULL, NULL, NULL, 'stiri', 'ro', '1'),
('16', '6', NULL, NULL, NULL, 'news', 'en', '1');

INSERT INTO `page_translations` (`id`, `page_id`, `deleted_at`, `created_at`, `updated_at`, `locale`, `active`, `title`) VALUES
('1', '1', NULL, '2020-09-02 14:59:20', '2020-09-03 09:08:37', 'ro', '1', 'Despre Help for Health'),
('2', '1', NULL, '2020-09-02 14:59:20', '2020-09-03 09:08:37', 'en', '1', 'About Help for Health'),
('3', '2', NULL, '2020-09-03 09:02:52', '2020-09-03 09:02:52', 'ro', '1', 'Parteneri'),
('4', '2', NULL, '2020-09-03 09:02:52', '2020-09-03 09:02:52', 'en', '1', 'Partners'),
('5', '3', NULL, '2020-09-03 09:03:13', '2020-09-03 09:03:13', 'ro', '1', 'Media'),
('6', '3', NULL, '2020-09-03 09:03:13', '2020-09-03 09:03:13', 'en', '1', 'Media'),
('7', '4', NULL, '2020-09-03 09:03:36', '2020-09-03 09:03:36', 'ro', '1', 'GDPR'),
('8', '4', NULL, '2020-09-03 09:03:36', '2020-09-03 09:03:36', 'en', '1', 'GDPR'),
('9', '5', NULL, '2020-09-03 09:03:52', '2020-09-03 09:03:52', 'ro', '1', 'Termeni și condiții'),
('10', '5', NULL, '2020-09-03 09:03:52', '2020-09-03 09:03:52', 'en', '1', 'Terms and conditions'),
('11', '6', NULL, '2020-09-03 09:06:02', '2020-09-03 09:06:02', 'ro', '1', 'Știri'),
('12', '6', NULL, '2020-09-03 09:06:02', '2020-09-03 09:06:02', 'en', '1', 'News');

INSERT INTO `pages` (`id`, `deleted_at`, `created_at`, `updated_at`, `published`, `featured`) VALUES
('1', NULL, '2020-09-02 14:59:20', '2020-09-03 09:08:37', '1', '0'),
('2', NULL, '2020-09-03 09:02:52', '2020-09-03 09:02:52', '1', '0'),
('3', NULL, '2020-09-03 09:03:13', '2020-09-03 09:03:13', '1', '0'),
('4', NULL, '2020-09-03 09:03:36', '2020-09-03 09:03:36', '1', '0'),
('5', NULL, '2020-09-03 09:03:52', '2020-09-03 09:03:52', '1', '0'),
('6', NULL, '2020-09-03 09:06:02', '2020-09-03 09:06:02', '1', '0');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;