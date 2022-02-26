-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 26, 2022 at 08:01 PM
-- Server version: 8.0.28
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpforhealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
                          `id` bigint UNSIGNED NOT NULL,
                          `blockable_id` int UNSIGNED DEFAULT NULL,
                          `blockable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `position` int UNSIGNED NOT NULL,
                          `content` json NOT NULL,
                          `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                          `child_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `parent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `blockable_id`, `blockable_type`, `position`, `content`, `type`, `child_key`, `parent_id`) VALUES
                                                                                                                           (14, 1, 'App\\Models\\Page', 1, '{\"paragraph\": {\"en\": \"<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\", \"ro\": \"<p>Sed ut <strong>perspiciatis</strong> unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\"}}', 'paragraph', NULL, NULL),
                                                                                                                           (16, 7, 'App\\Models\\Page', 1, '{\"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}, \"browsers\": {\"partners\": [1, 2, 3]}}', 'homepage-partners', NULL, NULL),
                                                                                                                           (18, 2, 'App\\Models\\Page', 1, '{\"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}, \"browsers\": {\"partners\": [1, 2, 3]}}', 'partners', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mediables`
--

CREATE TABLE `mediables` (
                             `id` bigint UNSIGNED NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             `mediable_id` bigint UNSIGNED DEFAULT NULL,
                             `mediable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `media_id` bigint UNSIGNED NOT NULL,
                             `crop_x` int DEFAULT NULL,
                             `crop_y` int DEFAULT NULL,
                             `crop_w` int DEFAULT NULL,
                             `crop_h` int DEFAULT NULL,
                             `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `crop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `lqip_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                             `ratio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `metadatas` json NOT NULL,
                             `locale` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mediables`
--

INSERT INTO `mediables` (`id`, `created_at`, `updated_at`, `deleted_at`, `mediable_id`, `mediable_type`, `media_id`, `crop_x`, `crop_y`, `crop_w`, `crop_h`, `role`, `crop`, `lqip_data`, `ratio`, `metadatas`, `locale`) VALUES
                                                                                                                                                                                                                              (2, '2020-09-03 09:38:46', '2020-09-03 09:38:46', NULL, 2, 'App\\Models\\Partner', 2, 0, 0, 0, 0, 'logo', 'desktop', NULL, 'desktop', '{\"video\": null, \"altText\": null, \"caption\": null}', 'ro'),
                                                                                                                                                                                                                              (3, '2020-09-03 09:39:07', '2020-09-03 09:39:07', NULL, 1, 'App\\Models\\Partner', 1, 0, 0, 0, 0, 'logo', 'desktop', NULL, 'desktop', '{\"video\": null, \"altText\": null, \"caption\": null}', 'ro'),
                                                                                                                                                                                                                              (4, '2020-09-03 09:40:09', '2020-09-03 09:40:09', NULL, 3, 'App\\Models\\Partner', 3, 0, 0, 0, 0, 'logo', 'desktop', NULL, 'desktop', '{\"video\": null, \"altText\": null, \"caption\": null}', 'ro');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
                          `id` bigint UNSIGNED NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          `deleted_at` timestamp NULL DEFAULT NULL,
                          `uuid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                          `alt_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                          `width` int UNSIGNED NOT NULL,
                          `height` int UNSIGNED NOT NULL,
                          `caption` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                          `filename` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `created_at`, `updated_at`, `deleted_at`, `uuid`, `alt_text`, `width`, `height`, `caption`, `filename`) VALUES
                                                                                                                                        (1, '2020-09-03 09:36:38', '2020-09-03 09:36:38', NULL, 'bd6648f4-6a46-4d3b-8993-ee359d26ce01/logo-mame-white.svg', 'Logo Mame White', 0, 0, NULL, 'logo-mame-white.svg'),
                                                                                                                                        (2, '2020-09-03 09:38:39', '2020-09-03 09:38:39', NULL, '630dd0bb-042a-4d08-8658-301e1e824393/logo-civiclabs-white.svg', 'Logo Civiclabs White', 0, 0, NULL, 'logo-civiclabs-white.svg'),
                                                                                                                                        (3, '2020-09-03 09:39:58', '2020-09-03 09:39:58', NULL, '54b13851-7f17-49e7-803d-c979597d45dd/logo-fvr-white.svg', 'Logo Fvr White', 0, 0, NULL, 'logo-fvr-white.svg');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
                         `id` bigint UNSIGNED NOT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `published` tinyint(1) NOT NULL DEFAULT '0',
                         `featured` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `deleted_at`, `created_at`, `updated_at`, `published`, `featured`) VALUES
                                                                                                  (1, NULL, '2020-09-02 14:59:20', '2020-09-03 09:08:37', 1, 0),
                                                                                                  (2, NULL, '2020-09-03 09:02:52', '2020-09-03 09:50:04', 1, 1),
                                                                                                  (3, NULL, '2020-09-03 09:03:13', '2020-09-03 09:03:13', 1, 0),
                                                                                                  (4, NULL, '2020-09-03 09:03:36', '2020-09-03 09:03:36', 1, 0),
                                                                                                  (5, NULL, '2020-09-03 09:03:52', '2020-09-03 09:03:52', 1, 0),
                                                                                                  (6, NULL, '2020-09-03 09:06:02', '2020-09-03 09:06:02', 1, 0),
                                                                                                  (7, NULL, '2020-09-03 09:25:09', '2020-09-03 09:40:40', 1, 0),
                                                                                                  (9, NULL, '2020-09-03 09:25:09', '2020-09-03 09:40:40', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `page_revisions`
--

CREATE TABLE `page_revisions` (
                                  `id` bigint UNSIGNED NOT NULL,
                                  `page_id` bigint UNSIGNED NOT NULL,
                                  `user_id` bigint UNSIGNED DEFAULT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  `payload` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_revisions`
--

INSERT INTO `page_revisions` (`id`, `page_id`, `user_id`, `created_at`, `updated_at`, `payload`) VALUES
                                                                                                     (1, 1, 1, '2020-09-02 14:59:20', '2020-09-02 14:59:20', '{\"slug\": {\"ro\": \"asd\"}, \"title\": {\"ro\": \"asd\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": false, \"shortlabel\": \"EN\"}]}'),
                                                                                                     (3, 1, 1, '2020-09-02 15:03:09', '2020-09-02 15:03:09', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"publish\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (4, 1, 1, '2020-09-02 15:03:23', '2020-09-02 15:03:23', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 1599058999025, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (5, 1, 1, '2020-09-02 15:03:37', '2020-09-02 15:03:37', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 1599058999025, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (6, 1, 1, '2020-09-02 15:04:44', '2020-09-02 15:04:44', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 2, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 1599059076901, \"type\": \"a17-block-homepage-partners\", \"blocks\": [], \"medias\": [], \"content\": [], \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"dada\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (7, 1, 1, '2020-09-02 15:06:06', '2020-09-02 15:06:06', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 2, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 1599059076901, \"type\": \"a17-block-homepage-partners\", \"blocks\": [], \"medias\": [], \"content\": [], \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"dada\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (8, 1, 1, '2020-09-02 15:06:54', '2020-09-02 15:06:54', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 2, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 1599059206797, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": \"hehe\"}, \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"dada\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (9, 1, 1, '2020-09-02 15:08:02', '2020-09-02 15:08:02', '{\"slug\": {\"en\": \"asd\", \"ro\": \"asd\"}, \"title\": {\"en\": null, \"ro\": \"asd\"}, \"blocks\": [{\"id\": 7, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 8, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": \"Parteneri\"}, \"browsers\": {\"partners\": [{\"id\": 1, \"name\": \"partenerul de incredere\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 0, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (10, 1, 1, '2020-09-03 09:01:17', '2020-09-03 09:01:17', '{\"slug\": {\"en\": \"about\", \"ro\": \"despre\"}, \"title\": {\"en\": \"About Help for Health\", \"ro\": \"Despre Help for Health\"}, \"blocks\": [{\"id\": 9, \"type\": \"a17-block-wysiwyg\", \"blocks\": [], \"medias\": [], \"content\": {\"html\": \"<p>SUCK IT</p>\"}, \"browsers\": []}, {\"id\": 10, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": \"Parteneri\"}, \"browsers\": {\"partners\": [{\"id\": 1, \"name\": \"partenerul de incredere\", \"thumbnail\": \"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (11, 1, 1, '2020-09-03 09:02:04', '2020-09-03 09:02:04', '{\"slug\": {\"en\": \"about\", \"ro\": \"despre\"}, \"title\": {\"en\": \"About Help for Health\", \"ro\": \"Despre Help for Health\"}, \"blocks\": [{\"id\": 1599123703777, \"type\": \"a17-block-paragraph\", \"blocks\": [], \"medias\": [], \"content\": {\"paragraph\": {\"en\": \"<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\"}}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (12, 2, 1, '2020-09-03 09:02:52', '2020-09-03 09:02:52', '{\"slug\": {\"en\": \"partners\", \"ro\": \"parteneri\"}, \"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
                                                                                                     (13, 3, 1, '2020-09-03 09:03:13', '2020-09-03 09:03:13', '{\"slug\": {\"en\": \"media\", \"ro\": \"media\"}, \"title\": {\"en\": \"Media\", \"ro\": \"Media\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
                                                                                                     (14, 4, 1, '2020-09-03 09:03:36', '2020-09-03 09:03:36', '{\"slug\": {\"en\": \"gdpr\", \"ro\": \"gdpr\"}, \"title\": {\"en\": \"GDPR\", \"ro\": \"GDPR\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
                                                                                                     (15, 5, 1, '2020-09-03 09:03:52', '2020-09-03 09:03:52', '{\"slug\": {\"en\": \"terms-and-conditions\", \"ro\": \"termeni-si-conditii\"}, \"title\": {\"en\": \"Terms and conditions\", \"ro\": \"Termeni și condiții\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
                                                                                                     (16, 6, 1, '2020-09-03 09:06:02', '2020-09-03 09:06:02', '{\"slug\": {\"en\": \"news\", \"ro\": \"stiri\"}, \"title\": {\"en\": \"News\", \"ro\": \"Știri\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
                                                                                                     (17, 1, 1, '2020-09-03 09:08:37', '2020-09-03 09:08:37', '{\"slug\": {\"en\": \"about\", \"ro\": \"despre\"}, \"title\": {\"en\": \"About Help for Health\", \"ro\": \"Despre Help for Health\"}, \"blocks\": [{\"id\": 13, \"type\": \"a17-block-paragraph\", \"blocks\": [], \"medias\": [], \"content\": {\"paragraph\": {\"en\": \"<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\", \"ro\": \"<p>Sed ut <strong>perspiciatis</strong> unde omnis iste natus error sit voluptatem <strong>accusantium</strong> doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\"}}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (18, 7, 1, '2020-09-03 09:25:09', '2020-09-03 09:25:09', '{\"slug\": {\"en\": \"homepage-helper\", \"ro\": \"homepage-helper\"}, \"title\": {\"en\": \"Homepage helper\", \"ro\": \"Homepage helper\"}, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": true, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": true, \"shortlabel\": \"EN\"}], \"published\": true}'),
                                                                                                     (19, 7, 1, '2020-09-03 09:31:04', '2020-09-03 09:31:04', '{\"slug\": {\"en\": \"homepage-helper\", \"ro\": \"homepage-helper\"}, \"title\": {\"en\": \"Homepage helper\", \"ro\": \"Homepage helper\"}, \"blocks\": [{\"id\": 1599125440779, \"type\": \"a17-block-homepage-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}}, \"browsers\": []}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (20, 7, 1, '2020-09-03 09:40:40', '2020-09-03 09:40:40', '{\"slug\": {\"en\": \"homepage-helper\", \"ro\": \"homepage-helper\"}, \"title\": {\"en\": \"Homepage helper\", \"ro\": \"Homepage helper\"}, \"blocks\": [{\"id\": 15, \"type\": \"a17-block-homepage-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}}, \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"Asociatia M.A.M.E.\", \"thumbnail\": \"http://localhost/storage/uploads/bd6648f4-6a46-4d3b-8993-ee359d26ce01/logo-mame-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}, {\"id\": 2, \"edit\": \"http://admin.helpforhealth.local/partners/2/edit\", \"name\": \"Civic Labs\", \"thumbnail\": \"http://localhost/storage/uploads/630dd0bb-042a-4d08-8658-301e1e824393/logo-civiclabs-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}, {\"id\": 3, \"edit\": \"http://admin.helpforhealth.local/partners/3/edit\", \"name\": \"Fundația Vodafone România\", \"thumbnail\": \"http://localhost/storage/uploads/54b13851-7f17-49e7-803d-c979597d45dd/logo-fvr-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": false, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (21, 2, 1, '2020-09-03 09:49:04', '2020-09-03 09:49:04', '{\"slug\": {\"en\": \"partners\", \"ro\": \"parteneri\"}, \"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}, \"blocks\": [{\"id\": 1599126498239, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": \"Partners\"}, \"browsers\": {\"partners\": [{\"id\": 1, \"edit\": \"http://admin.helpforhealth.local/partners/1/edit\", \"name\": \"Asociatia M.A.M.E.\", \"thumbnail\": \"http://localhost/storage/uploads/bd6648f4-6a46-4d3b-8993-ee359d26ce01/logo-mame-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}, {\"id\": 2, \"edit\": \"http://admin.helpforhealth.local/partners/2/edit\", \"name\": \"Civic Labs\", \"thumbnail\": \"http://localhost/storage/uploads/630dd0bb-042a-4d08-8658-301e1e824393/logo-civiclabs-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}, {\"id\": 3, \"edit\": \"http://admin.helpforhealth.local/partners/3/edit\", \"name\": \"Fundația Vodafone România\", \"thumbnail\": \"http://localhost/storage/uploads/54b13851-7f17-49e7-803d-c979597d45dd/logo-fvr-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}'),
                                                                                                     (22, 2, 1, '2020-09-03 09:50:04', '2020-09-03 09:50:04', '{\"slug\": {\"en\": \"partners\", \"ro\": \"parteneri\"}, \"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}, \"blocks\": [{\"id\": 17, \"type\": \"a17-block-partners\", \"blocks\": [], \"medias\": [], \"content\": {\"title\": {\"en\": \"Partners\", \"ro\": \"Parteneri\"}}, \"browsers\": {\"partners\": [{\"id\": 1, \"name\": \"Asociatia M.A.M.E.\", \"thumbnail\": \"http://localhost/storage/uploads/bd6648f4-6a46-4d3b-8993-ee359d26ce01/logo-mame-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}, {\"id\": 2, \"name\": \"Civic Labs\", \"thumbnail\": \"http://localhost/storage/uploads/630dd0bb-042a-4d08-8658-301e1e824393/logo-civiclabs-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}, {\"id\": 3, \"name\": \"Fundația Vodafone România\", \"thumbnail\": \"http://localhost/storage/uploads/54b13851-7f17-49e7-803d-c979597d45dd/logo-fvr-white.svg\", \"endpointType\": \"App\\\\Models\\\\Partner\"}]}}], \"medias\": [], \"public\": false, \"browsers\": [], \"featured\": true, \"languages\": [{\"label\": \"Romanian\", \"value\": \"ro\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"RO\"}, {\"label\": \"English\", \"value\": \"en\", \"disabled\": false, \"published\": 1, \"shortlabel\": \"EN\"}], \"parent_id\": 0, \"published\": true, \"repeaters\": [], \"cmsSaveType\": \"update\", \"publish_end_date\": null, \"publish_start_date\": null}');

-- --------------------------------------------------------

--
-- Table structure for table `related`
--

CREATE TABLE `related` (
                           `subject_id` int UNSIGNED DEFAULT NULL,
                           `subject_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `related_id` int UNSIGNED DEFAULT NULL,
                           `related_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `browser_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `position` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `related`
--

INSERT INTO `related` (`subject_id`, `subject_type`, `related_id`, `related_type`, `browser_name`, `position`) VALUES
                                                                                                                   (16, 'blocks', 1, 'App\\Models\\Partner', 'partners', 1),
                                                                                                                   (16, 'blocks', 2, 'App\\Models\\Partner', 'partners', 2),
                                                                                                                   (16, 'blocks', 3, 'App\\Models\\Partner', 'partners', 3),
                                                                                                                   (18, 'blocks', 1, 'App\\Models\\Partner', 'partners', 1),
                                                                                                                   (18, 'blocks', 2, 'App\\Models\\Partner', 'partners', 2),
                                                                                                                   (18, 'blocks', 3, 'App\\Models\\Partner', 'partners', 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
                            `id` bigint UNSIGNED NOT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `section` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `deleted_at`, `key`, `section`) VALUES
                                                                                              (1, '2020-09-03 10:03:16', '2020-09-03 10:03:16', NULL, 'homepage_message', 'home'),
                                                                                              (2, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'welcome_title', 'home'),
                                                                                              (3, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'welcome_body', 'home'),
                                                                                              (4, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_title', 'home'),
                                                                                              (5, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_1_title', 'home'),
                                                                                              (6, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_1_body', 'home'),
                                                                                              (7, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_2_title', 'home'),
                                                                                              (8, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_2_body', 'home'),
                                                                                              (9, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_3_title', 'home'),
                                                                                              (10, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_3_body', 'home'),
                                                                                              (11, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_4_title', 'home'),
                                                                                              (12, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'help_block_4_body', 'home'),
                                                                                              (13, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'about_title', 'home'),
                                                                                              (14, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'about_body', 'home'),
                                                                                              (16, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'ask_services_body', 'home'),
                                                                                              (17, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'become_host_title', 'home'),
                                                                                              (18, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'become_host_body', 'home'),
                                                                                              (19, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'footer_block_1_title', 'home'),
                                                                                              (20, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'footer_block_1_body', 'home'),
                                                                                              (21, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'footer_block_2_title', 'home'),
                                                                                              (22, '2020-09-09 19:27:31', '2020-09-09 19:27:31', NULL, 'footer_block_2_body', 'home'),
                                                                                              (23, '2020-09-09 19:35:56', '2020-09-09 19:35:56', NULL, 'ask_services_title', 'home'),
                                                                                              (24, '2020-09-10 11:22:35', '2020-09-10 11:22:35', NULL, 'contact_description', 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `setting_translations`
--

CREATE TABLE `setting_translations` (
                                        `id` bigint UNSIGNED NOT NULL,
                                        `setting_id` bigint UNSIGNED NOT NULL,
                                        `deleted_at` timestamp NULL DEFAULT NULL,
                                        `created_at` timestamp NULL DEFAULT NULL,
                                        `updated_at` timestamp NULL DEFAULT NULL,
                                        `locale` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                        `active` tinyint(1) NOT NULL,
                                        `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_translations`
--

INSERT INTO `setting_translations` (`id`, `setting_id`, `deleted_at`, `created_at`, `updated_at`, `locale`, `active`, `value`) VALUES
                                                                                                                                   (1, 1, NULL, '2020-09-03 10:03:16', '2020-09-03 10:03:36', 'ro', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.'),
                                                                                                                                   (3, 2, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Bine ai venit!'),
                                                                                                                                   (5, 3, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.</p>'),
                                                                                                                                   (7, 4, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Cu ce te putem ajuta'),
                                                                                                                                   (9, 5, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Consultanta in strangerea de fonduri'),
                                                                                                                                   (11, 6, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (13, 7, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Accesarea serviciilor medicale potrivite'),
                                                                                                                                   (15, 8, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (17, 9, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Solutionarea altor nevoi'),
                                                                                                                                   (19, 10, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (21, 11, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Sprijin pentru a găsi cazare'),
                                                                                                                                   (23, 12, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (25, 13, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Despre proiect'),
                                                                                                                                   (27, 14, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p>'),
                                                                                                                                   (31, 16, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (33, 17, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Devino gazda'),
                                                                                                                                   (35, 18, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (37, 19, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Footer block 1'),
                                                                                                                                   (39, 20, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (41, 21, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, 'Footer block 2'),
                                                                                                                                   (43, 22, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (45, 23, NULL, '2020-09-09 19:35:56', '2020-09-09 19:35:56', 'ro', 1, 'Solicita servicii'),
                                                                                                                                   (47, 24, NULL, '2020-09-10 11:22:35', '2020-09-10 11:24:33', 'ro', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac arcu in erat vestibulum mollis at id enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p><p><br></p>'),
                                                                                                                                   (50, 1, NULL, '2020-09-03 10:03:16', '2020-09-03 10:03:36', 'ua', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.'),
                                                                                                                                   (51, 2, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Bine ai venit!'),
                                                                                                                                   (52, 3, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.</p>'),
                                                                                                                                   (53, 4, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Cu ce te putem ajuta'),
                                                                                                                                   (54, 5, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Consultanta in strangerea de fonduri'),
                                                                                                                                   (55, 6, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (56, 7, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Accesarea serviciilor medicale potrivite'),
                                                                                                                                   (57, 8, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (58, 9, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Solutionarea altor nevoi'),
                                                                                                                                   (59, 10, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (60, 11, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Sprijin pentru a găsi cazare'),
                                                                                                                                   (61, 12, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (62, 13, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Despre proiect'),
                                                                                                                                   (63, 14, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p>'),
                                                                                                                                   (64, 16, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (65, 17, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Devino gazda'),
                                                                                                                                   (66, 18, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (67, 19, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Footer block 1'),
                                                                                                                                   (68, 20, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (69, 21, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, 'Footer block 2'),
                                                                                                                                   (70, 22, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (71, 23, NULL, '2020-09-09 19:35:56', '2020-09-09 19:35:56', 'ua', 1, 'Solicita servicii'),
                                                                                                                                   (72, 24, NULL, '2020-09-10 11:22:35', '2020-09-10 11:24:33', 'ua', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac arcu in erat vestibulum mollis at id enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p><p><br></p>'),
                                                                                                                                   (73, 1, NULL, '2020-09-03 10:03:16', '2020-09-03 10:03:36', 'ru', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.'),
                                                                                                                                   (74, 2, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Bleat'),
                                                                                                                                   (75, 3, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.</p>'),
                                                                                                                                   (76, 4, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Cu ce te putem ajuta'),
                                                                                                                                   (77, 5, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Consultanta in strangerea de fonduri'),
                                                                                                                                   (78, 6, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (79, 7, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Accesarea serviciilor medicale potrivite'),
                                                                                                                                   (80, 8, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (81, 9, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Solutionarea altor nevoi'),
                                                                                                                                   (82, 10, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (83, 11, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Sprijin pentru a găsi cazare'),
                                                                                                                                   (84, 12, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (85, 13, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Despre proiect'),
                                                                                                                                   (86, 14, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p>'),
                                                                                                                                   (87, 16, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (88, 17, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Devino gazda'),
                                                                                                                                   (89, 18, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (90, 19, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Footer block 1'),
                                                                                                                                   (91, 20, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (92, 21, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, 'Footer block 2'),
                                                                                                                                   (93, 22, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (94, 23, NULL, '2020-09-09 19:35:56', '2020-09-09 19:35:56', 'ru', 1, 'Solicita servicii'),
                                                                                                                                   (95, 24, NULL, '2020-09-10 11:22:35', '2020-09-10 11:24:33', 'ru', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac arcu in erat vestibulum mollis at id enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p><p><br></p>'),
                                                                                                                                   (96, 1, NULL, '2020-09-03 10:03:16', '2020-09-03 10:03:36', 'en', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.'),
                                                                                                                                   (97, 2, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Bine ai venit!'),
                                                                                                                                   (98, 3, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>1Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci. Ridiculus facilisis curabitur bibendum ultricies lacus, sollicitudin id massa augue. Consequat ullamcorper semper nisl tristique habitant eu et ac. Auctor magna tellus cursus viverra tortor. Porttitor consequat.</p>'),
                                                                                                                                   (99, 4, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Cu ce te putem ajuta'),
                                                                                                                                   (100, 5, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Consultanta in strangerea de fonduri'),
                                                                                                                                   (101, 6, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (102, 7, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Accesarea serviciilor medicale potrivite'),
                                                                                                                                   (103, 8, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (104, 9, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Solutionarea altor nevoi'),
                                                                                                                                   (105, 10, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (106, 11, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Sprijin pentru a găsi cazare'),
                                                                                                                                   (107, 12, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam.</p>'),
                                                                                                                                   (108, 13, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Despre proiect'),
                                                                                                                                   (109, 14, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nunc vitae egestas fames risus. Tempus arcu, quis nec commodo habitasse dignissim donec mi. Cras viverra bibendum in tincidunt id ornare. Mi tincidunt euismod id lorem dictum. Morbi sit diam accumsan et convallis ut tellus ipsum nam. Neque pellentesque et orci, scelerisque tristique vulputate. Viverra pellentesque id dolor turpis platea sed.</p>'),
                                                                                                                                   (110, 16, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (111, 17, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Devino gazda'),
                                                                                                                                   (112, 18, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (113, 19, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Footer block 1'),
                                                                                                                                   (114, 20, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (115, 21, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, 'Footer block 2'),
                                                                                                                                   (116, 22, NULL, '2020-09-09 19:27:31', '2020-09-09 19:35:56', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sed netus blandit mi non nunc. Ipsum aliquam fringilla sagittis, quis rutrum. Arcu imperdiet sem tellus accumsan urna orci.</p>'),
                                                                                                                                   (117, 23, NULL, '2020-09-09 19:35:56', '2020-09-09 19:35:56', 'en', 1, 'Solicita servicii'),
                                                                                                                                   (118, 24, NULL, '2020-09-10 11:22:35', '2020-09-10 11:24:33', 'en', 1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac arcu in erat vestibulum mollis at id enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p><p><br></p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
    ADD PRIMARY KEY (`id`),
    ADD KEY `blocks_blockable_type_blockable_id_index` (`blockable_type`,`blockable_id`);

--
-- Indexes for table `mediables`
--
ALTER TABLE `mediables`
    ADD PRIMARY KEY (`id`),
    ADD KEY `fk_mediables_media_id` (`media_id`),
    ADD KEY `mediables_mediable_type_mediable_id_index` (`mediable_type`,`mediable_id`),
    ADD KEY `mediables_locale_index` (`locale`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_revisions`
--
ALTER TABLE `page_revisions`
    ADD PRIMARY KEY (`id`),
    ADD KEY `page_revisions_page_id_foreign` (`page_id`),
    ADD KEY `page_revisions_user_id_foreign` (`user_id`);

--
-- Indexes for table `related`
--
ALTER TABLE `related`
    ADD UNIQUE KEY `related_unique` (`subject_id`,`subject_type`,`related_id`,`related_type`,`browser_name`),
    ADD KEY `related_browser_name_index` (`browser_name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`),
    ADD KEY `settings_key_index` (`key`),
    ADD KEY `settings_section_index` (`section`);

--
-- Indexes for table `setting_translations`
--
ALTER TABLE `setting_translations`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `setting_id_locale_unique` (`setting_id`,`locale`),
    ADD KEY `setting_translations_locale_index` (`locale`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mediables`
--
ALTER TABLE `mediables`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `page_revisions`
--
ALTER TABLE `page_revisions`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `setting_translations`
--
ALTER TABLE `setting_translations`
    MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mediables`
--
ALTER TABLE `mediables`
    ADD CONSTRAINT `fk_mediables_media_id` FOREIGN KEY (`media_id`) REFERENCES `medias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `page_revisions`
--
ALTER TABLE `page_revisions`
    ADD CONSTRAINT `page_revisions_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `page_revisions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `setting_translations`
--
ALTER TABLE `setting_translations`
    ADD CONSTRAINT `fk_setting_translations_setting_id` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
