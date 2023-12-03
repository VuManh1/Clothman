-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: clothman_db_local
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(450) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES ('9ab62419-d227-4f0c-b168-3b6666e5d3f7','Quần áo thu đông','images/banner_images/hsdcQvJlFJFfe1S4Kc7Y2pcsyhw5F2aK6WTVxTzX.jpg','http://127.0.0.1:8000/category/ao-dai-tay',1,'2023-11-27 00:40:04','2023-11-27 00:56:10'),('9ab6247d-6cae-462d-af6a-65df25f98ca2','End Season','images/banner_images/C6lxe2ryMw9IwEEbn3yYeFMDFCygdToOlKG512Q9.jpg',NULL,1,'2023-11-27 00:41:09','2023-11-27 01:00:14'),('9ab6aae5-f5cc-4788-8c16-118e75cb4e11','test','images/banner_images/b4xaZvsL12PQQ1xI17AY8MUue5mGkojbzJzpQbIF.jpg',NULL,0,'2023-11-27 06:57:00','2023-11-27 06:57:00');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_variant_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `carts_product_id_product_variant_id_user_id_unique` (`product_id`,`product_variant_id`,`user_id`),
  KEY `carts_product_variant_id_foreign` (`product_variant_id`),
  KEY `carts_user_id_foreign` (`user_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `carts_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`),
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `banner_url` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_in_home` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES ('9a8a8dd1-a793-43fc-ab88-62701390763f',NULL,'Áo','ao',NULL,'images/category_banners/UKsDbnxqhZw17duQuPiVjYxdeBd0QQoEJwgzaxlh.webp',0,'2023-11-05 08:39:14','2023-11-10 04:46:34',NULL),('9a8a8f8b-58a7-40e0-95ba-e3dbfcf7d6de','9a8a8dd1-a793-43fc-ab88-62701390763f','Áo Dài Tay','ao-dai-tay',NULL,'images/category_banners/4CqzXZrwtCw42QeT50MippA7ca4SKsxPC4Jf6pY5.webp',0,'2023-11-05 08:44:04','2023-11-13 05:43:35',NULL),('9a944910-a9e6-454a-8949-cefc4710e075',NULL,'Quần','quan',NULL,'images/category_banners/bfqRYNPyGzjbgyi2wrSnrqHEIhf7q5h6kVbZxfc0.webp',0,'2023-11-10 04:45:17','2023-11-10 04:45:17',NULL),('9a944a13-b916-40d8-aea2-983c688cf02f','9a944910-a9e6-454a-8949-cefc4710e075','Quần Jeans','quan-jeans',NULL,'images/category_banners/uSuSIbavygZInO48dYh7ND1tvV3Wrh09lISPMk6w.png',1,'2023-11-10 04:48:06','2023-11-13 05:44:00',NULL),('9a944ac9-ebc8-4470-8003-01bf53f337d0','9a8a8dd1-a793-43fc-ab88-62701390763f','Áo sơ mi','ao-so-mi',NULL,'images/category_banners/WceRJWTbvyp7LzQOR9FomqPNXq9UbGp0yZAco692.png',0,'2023-11-10 04:50:05','2023-11-10 04:50:05',NULL),('9a945038-5701-4273-9af9-6dd74e5efbdf',NULL,'Phụ kiện','phu-kien',NULL,'images/category_banners/drMwYKmCFdcyjQ1Pa402cnUDeGi5VATMFnnn8R0Z.jpg',0,'2023-11-10 05:05:17','2023-11-10 05:05:17',NULL),('9a9450bc-cd47-4cc8-a33d-e6b7b10287f2','9a945038-5701-4273-9af9-6dd74e5efbdf','Tất Vớ Nam','tat-vo-nam',NULL,'images/category_banners/rUcsCuTmTQROc5FeawxwGZoknhnP9aJM7PtSrosR.jpg',0,'2023-11-10 05:06:43','2023-12-01 07:57:53',NULL),('9a960860-f995-4be2-bf22-9f731d10bb75','9a8a8dd1-a793-43fc-ab88-62701390763f','Áo polo','ao-polo',NULL,'images/category_banners/1zCRF9GZvBcgOHMYKabsnUTEPKRa4R5f9ZPwLTOl.webp',1,'2023-11-11 01:36:03','2023-11-11 01:36:03',NULL),('9a984c41-1578-4808-824c-98fa36901d85','9a944910-a9e6-454a-8949-cefc4710e075','Quần thể thao','quan-the-thao',NULL,'images/category_banners/3um4S1f7XEeCw63mAesITClji64QhjTtcrLMMdjY.jpg',0,'2023-11-12 04:37:31','2023-11-12 04:44:56',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colors` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hex_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `colors_name_unique` (`name`),
  UNIQUE KEY `colors_hex_code_unique` (`hex_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES ('9a91b459-9359-4f30-b257-7dd50fbedd4e','Đen','#121212','2023-11-08 21:57:47','2023-11-09 07:22:47',NULL),('9a9393a3-a838-41f8-83c5-02035f12af02','Đỏ','#FF0000','2023-11-09 20:17:58','2023-11-09 20:17:58',NULL),('9a9393c9-f2e9-4b91-9d27-695d5bfd6205','Xanh lá','#008000','2023-11-09 20:18:23','2023-11-09 20:18:23',NULL),('9a9393e9-0d42-450c-b9a9-64cde99d83c9','Vàng','#FFFF00','2023-11-09 20:18:43','2023-11-09 20:18:43',NULL),('9a941ca8-c4c1-40b8-a868-bb502e3958c4','Trắng','#FFFFFF','2023-11-10 02:41:06','2023-11-10 02:41:06',NULL),('9a9456a1-0bf9-4203-b29a-0abad0c051f3','Xám','#808080','2023-11-10 05:23:12','2023-11-10 05:23:12',NULL),('9a960472-9ed8-46ce-8000-9eaa4ae4f660','Xanh đậm','#1b2838','2023-11-11 01:25:05','2023-11-11 01:25:05',NULL),('9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','Xanh nhạt','#748796','2023-11-11 01:26:00','2023-11-11 01:26:00',NULL),('9a985137-1440-47b1-9c9d-a0e0eaf986c5','Xanh navy','#4d6bb7','2023-11-12 04:51:22','2023-11-12 04:51:22',NULL);
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(450) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_product_id_foreign` (`product_id`),
  KEY `images_color_id_foreign` (`color_id`),
  CONSTRAINT `images_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES ('9a944d5d-1a99-4337-a537-c1d205567167','9a944d5c-c37a-4520-8048-d8d49b054e83','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a944d5c-c37a-4520-8048-d8d49b054e83/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/J9vZWW06oww47UGUcpGT5zrFEEoljbDlJVs4hT5Q.jpg'),('9a944d5d-1efe-46da-9fc4-6fda0da95b7e','9a944d5c-c37a-4520-8048-d8d49b054e83','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a944d5c-c37a-4520-8048-d8d49b054e83/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/zXef3a5urmFHcODtv9xKRx6Hrj7UQ1QmIjQksFu0.jpg'),('9a944d5d-21ce-4fb9-aa02-a4b24aaf9476','9a944d5c-c37a-4520-8048-d8d49b054e83','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a944d5c-c37a-4520-8048-d8d49b054e83/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/q6wLun0mcVF7xHpGSlComGunJVEpE2jxXo6EcRvt.jpg'),('9a944ec4-3403-4933-a034-f34c24038c82','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a944ec4-27ff-4c99-8b20-1d116a9f73e6/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/pxVfYpzoTtePycsDf1hl6QvidauSaaVZ3Me340FM.jpg'),('9a944ec4-3633-4b3a-aa81-8cf039a39156','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a944ec4-27ff-4c99-8b20-1d116a9f73e6/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/QE0R681uzykTEsj4y7DsXQYLs2MMVdzzxxT9Fyia.jpg'),('9a944ec4-392a-401f-89f7-cfc1dce681b0','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a944ec4-27ff-4c99-8b20-1d116a9f73e6/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/z2U7foA4Kw9Zuen2AxziGoZjAvrUs7a6S0GOA6O5.jpg'),('9a944ec4-41fe-43e8-83cb-a25858abb0dc','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a944ec4-27ff-4c99-8b20-1d116a9f73e6/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/VpBtzBmM1U0e86mV4uKRo3AbQ3BrkcvzK2y52Ebc.webp'),('9a944ec4-444a-4ba3-b137-bae1e551da48','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a944ec4-27ff-4c99-8b20-1d116a9f73e6/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/WTM95Tztdxt5yDUAj4Ot7PjqGnkuZDtOz1jFPxrY.webp'),('9a944ec4-469a-487d-b7bd-b456c4967a84','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a944ec4-27ff-4c99-8b20-1d116a9f73e6/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/CyUeXv8sdSDXGMBCR46z5aokK1ZlVxya0jaZ1B8A.webp'),('9a944fa7-030b-4e45-9e46-5c1b22648771','9a944fa6-ef36-4f08-912d-260f66ed3e8c','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a944fa6-ef36-4f08-912d-260f66ed3e8c/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/6K0C3qLvs42S7cnOyA92JdYxPgzJpKDoDrM7HxUx.webp'),('9a944fa7-0809-44eb-b197-b80b50545789','9a944fa6-ef36-4f08-912d-260f66ed3e8c','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a944fa6-ef36-4f08-912d-260f66ed3e8c/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/ZSjI7PUinQlvOvhciV2SfWeCjBdKDg7KiEkVRprj.webp'),('9a944fa7-0c16-4d49-9520-4daa1a8db54f','9a944fa6-ef36-4f08-912d-260f66ed3e8c','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a944fa6-ef36-4f08-912d-260f66ed3e8c/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/PjS6DnOxF4SULsRuG0ZDRBzYQam1EAkjBS1xOCDd.webp'),('9a945732-9e9b-488e-9758-7368b99f4628','9a945732-93c9-4fb8-b13e-3b2d32793b0c','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a945732-93c9-4fb8-b13e-3b2d32793b0c/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/2Prt0bFsAw5fDx1ptbYQOs7YzWGsxh5rxXGOPCP6.jpg'),('9a945732-a2b3-4262-9f94-2fbc0bb3e390','9a945732-93c9-4fb8-b13e-3b2d32793b0c','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a945732-93c9-4fb8-b13e-3b2d32793b0c/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/8G725dAMGaMhkGmgu1qulM7fvyVQZMM9gHhoDyml.jpg'),('9a945732-a588-46bf-911a-232532c9b941','9a945732-93c9-4fb8-b13e-3b2d32793b0c','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a945732-93c9-4fb8-b13e-3b2d32793b0c/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/nRf5CRwNFq1H8A0SYjp01eRvECijVujJZyieSiwM.jpg'),('9a9609d4-5c41-4c8d-8652-142909ffc9f2','9a9609d4-4b88-4b87-a101-d6aef2297094','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9609d4-4b88-4b87-a101-d6aef2297094/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/WoNFsJX769xeG2DHCcD4GNKETKaPkqAva2c6WNE9.jpg'),('9a9609d4-60c1-4c2d-aea0-29cd45834097','9a9609d4-4b88-4b87-a101-d6aef2297094','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9609d4-4b88-4b87-a101-d6aef2297094/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/4p8tTen2V0JFZhK5nHdEwyzAyqRN7AxlnJyM3j1D.jpg'),('9a9609d4-643f-479e-a9dc-f716138b078b','9a9609d4-4b88-4b87-a101-d6aef2297094','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9609d4-4b88-4b87-a101-d6aef2297094/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/2uDpKB2GtKrY3Y2A5FB6NK0d7ed0l4hS7wpy0cie.jpg'),('9a962c88-aa8a-4946-bbc3-fd2abd59e89e','9a962c88-9d21-422a-966d-43df894fdb1d','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a962c88-9d21-422a-966d-43df894fdb1d/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/Oio3iz5tUhh6ey0Dqf9lfyOTjvvtlel3omFnKl6s.jpg'),('9a962c88-b8cb-405f-a797-bfd8bda9add8','9a962c88-9d21-422a-966d-43df894fdb1d','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a962c88-9d21-422a-966d-43df894fdb1d/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/IEOiBdKT1F0vm5w8O1UhLG7yoNvKDyZ4NM1uHNL3.jpg'),('9a962c88-bb5e-4e69-bac4-89e905d3013e','9a962c88-9d21-422a-966d-43df894fdb1d','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a962c88-9d21-422a-966d-43df894fdb1d/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/4OT81MhLzMTcrtHWC4Yy9sFS6CwkA8zjfKuZ4pIi.jpg'),('9a962c88-be4e-4863-8604-8968264b634f','9a962c88-9d21-422a-966d-43df894fdb1d','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a962c88-9d21-422a-966d-43df894fdb1d/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/GE9XWyTPcHdvyJbNIYKvyei7tYd8FDQ1789dNf3l.jpg'),('9a962c88-c0e1-4dc8-8a6f-23f984b1da41','9a962c88-9d21-422a-966d-43df894fdb1d','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a962c88-9d21-422a-966d-43df894fdb1d/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/FoDtUoBRK1Hst0HbPJSxz3uwx6Tp5xiGyZCQx7vV.jpg'),('9a962c88-c3fd-4401-8c53-6c5e1d81b937','9a962c88-9d21-422a-966d-43df894fdb1d','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a962c88-9d21-422a-966d-43df894fdb1d/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/6VD0hRC3zK0HqvM77Ca3icvfeP9TwIXl9jqdCJ3A.webp'),('9a9850a6-3072-4d20-9ada-422574d17afd','9a9850a6-2792-4238-a419-1a43da8d2677','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9850a6-2792-4238-a419-1a43da8d2677/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/Xhgfx241xJ8V7Pl5JLwrxLM8L7IhfDZddT293uT1.jpg'),('9a9850a6-329c-44d7-bc91-91f89a52be07','9a9850a6-2792-4238-a419-1a43da8d2677','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9850a6-2792-4238-a419-1a43da8d2677/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/THZ4G31VbI0izPzVOlQG27nrTSzCNOt7kxXOpj2l.jpg'),('9a9850a6-4425-42f0-a575-906d64ad4abf','9a9850a6-2792-4238-a419-1a43da8d2677','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9850a6-2792-4238-a419-1a43da8d2677/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/3LeBpgKstWRbbD8CD3O95uqxI8iSC582gEk6CvWM.jpg'),('9a9850a6-4887-4718-8754-ab706e7bdda4','9a9850a6-2792-4238-a419-1a43da8d2677','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a9850a6-2792-4238-a419-1a43da8d2677/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/RdNSsntTom7s8kndUHycGjr8Rfv2XHYaQV1KDaO8.jpg'),('9a9850a6-4d60-4f39-bd93-45213147cc5f','9a9850a6-2792-4238-a419-1a43da8d2677','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a9850a6-2792-4238-a419-1a43da8d2677/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/Qp9PYzsv3NrTn92iBbuoLgSYO6ebIo5SNAF4N34o.jpg'),('9a9850a6-5020-42db-b80d-2d3438ee2826','9a9850a6-2792-4238-a419-1a43da8d2677','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a9850a6-2792-4238-a419-1a43da8d2677/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/1LinjYknhkMVCovuTVB743VLcUiQlvvxv0WZjlqJ.jpg'),('9a985211-02b7-439d-9b57-41467319b22b','9a985210-fdd1-48e5-bcd5-883b39663621','9a985137-1440-47b1-9c9d-a0e0eaf986c5','images/product_images/9a985210-fdd1-48e5-bcd5-883b39663621/color-9a985137-1440-47b1-9c9d-a0e0eaf986c5/ZKZcEmMrjT8P3aEwIoUPMw817D2uIvaNM2sYSfQl.webp'),('9a985211-0485-417f-a7cd-8a21cc8d0e4f','9a985210-fdd1-48e5-bcd5-883b39663621','9a985137-1440-47b1-9c9d-a0e0eaf986c5','images/product_images/9a985210-fdd1-48e5-bcd5-883b39663621/color-9a985137-1440-47b1-9c9d-a0e0eaf986c5/OjlgZfLvOBsqVuqN5hVE04DNQECqhJEDVKxXyYLx.webp'),('9a985211-0610-4caf-b4a4-7e14253b2f4a','9a985210-fdd1-48e5-bcd5-883b39663621','9a985137-1440-47b1-9c9d-a0e0eaf986c5','images/product_images/9a985210-fdd1-48e5-bcd5-883b39663621/color-9a985137-1440-47b1-9c9d-a0e0eaf986c5/2ZRfIwJyH3LF7ValnfjRvsDlZRslNLZbc02IL0G2.webp'),('9a98536e-a330-429f-b787-f9130b95e8b0','9a98536e-9810-4701-82a0-8e123d9cdd21','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a98536e-9810-4701-82a0-8e123d9cdd21/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/RhjTetD0lidhyPadeMxUpXaoFh07pV9KOtqAVQEQ.jpg'),('9a98536e-a4b0-4694-b207-d888e0a79257','9a98536e-9810-4701-82a0-8e123d9cdd21','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a98536e-9810-4701-82a0-8e123d9cdd21/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/LTzxhPlOJoeygW0m5bxUajBzUbK34tApbqfXRCUK.jpg'),('9a98536e-a6f6-4c7c-9c7e-f186cf49b30c','9a98536e-9810-4701-82a0-8e123d9cdd21','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a98536e-9810-4701-82a0-8e123d9cdd21/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/NOLz4p4erSkcYc20CkrwZdXXAbxlu0q4q3sQ1Lqs.jpg'),('9a98536e-a86f-4606-ba5d-78fb3d74369a','9a98536e-9810-4701-82a0-8e123d9cdd21','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a98536e-9810-4701-82a0-8e123d9cdd21/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/SDQrQmdF8snrvBhidROSVaOiyEQ4OFjGxnxkb5Ix.jpg'),('9a98536e-ab0b-4fdb-852c-19b402c5177d','9a98536e-9810-4701-82a0-8e123d9cdd21','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a98536e-9810-4701-82a0-8e123d9cdd21/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/rb5nSFK9leZMw1XjgwiA4ztViQ15RYiEx3EZM0RD.jpg'),('9a98536e-ac99-4a60-b4b5-3d6cb042ba44','9a98536e-9810-4701-82a0-8e123d9cdd21','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a98536e-9810-4701-82a0-8e123d9cdd21/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/kC9rCCZDZ11rVsihaRnYPUThkt9AFKFZUVlPVAMJ.jpg'),('9a98560b-a5bf-4e6c-85bb-ac9d0bf19b43','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a98560b-9f1c-4856-912a-6ac9b1bbb496/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/pBMTtWxtcUpVXd4R1bPM7i44dXSCGDMzI768OLD3.jpg'),('9a98560b-a74f-429f-94ee-5f33365f5f67','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a98560b-9f1c-4856-912a-6ac9b1bbb496/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/ztkk0XZwmz48ZFdovZTzTNJ2G3fPLv2UU9HOMhK7.jpg'),('9a98560b-a8b5-4e99-9046-4ec7a193c704','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9a98560b-9f1c-4856-912a-6ac9b1bbb496/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/7Lmp61MChZP8Pfs1h6kuEljys08KZoI85m7qFsN0.jpg'),('9a98560b-ab2a-41e7-a829-9ba2bb971766','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a985137-1440-47b1-9c9d-a0e0eaf986c5','images/product_images/9a98560b-9f1c-4856-912a-6ac9b1bbb496/color-9a985137-1440-47b1-9c9d-a0e0eaf986c5/yahRP57IQosd1pIHrrusxdKDtyPIgFPDhFmzABqq.webp'),('9a98560b-ace2-47e0-bec7-56a36dc55f33','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a985137-1440-47b1-9c9d-a0e0eaf986c5','images/product_images/9a98560b-9f1c-4856-912a-6ac9b1bbb496/color-9a985137-1440-47b1-9c9d-a0e0eaf986c5/HlScvqxgJQD7ZmlRjqV6tLyd4eAfxsIQpvUTpj4t.webp'),('9a98560b-bbf7-467d-946f-89b4fa059aed','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a985137-1440-47b1-9c9d-a0e0eaf986c5','images/product_images/9a98560b-9f1c-4856-912a-6ac9b1bbb496/color-9a985137-1440-47b1-9c9d-a0e0eaf986c5/LTApxV0yClFVdoRjZbG1IxYxw28ARvGAgi9X7bJ4.webp'),('9a985722-7fe6-46d2-bc03-6a059768f06c','9a985722-79aa-4675-ad14-791f7ea663e5','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a985722-79aa-4675-ad14-791f7ea663e5/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/jF9sm4ghgE3g57PeZ6nZpnu7ZZTECtunVqfhRt6c.webp'),('9a985722-81dc-4f66-b575-80242f9051e4','9a985722-79aa-4675-ad14-791f7ea663e5','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a985722-79aa-4675-ad14-791f7ea663e5/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/A4Xaqs7oYjFEJMWXI5qpEmNFrUz0bp0mDL9j2izx.webp'),('9a985722-834e-4025-af25-047747a4a739','9a985722-79aa-4675-ad14-791f7ea663e5','9a9456a1-0bf9-4203-b29a-0abad0c051f3','images/product_images/9a985722-79aa-4675-ad14-791f7ea663e5/color-9a9456a1-0bf9-4203-b29a-0abad0c051f3/pdAbYt10K4bBg9jnGPGCGiksTlEFkDzQfYJu1oJg.webp'),('9a985722-84e0-440b-a414-91f7e939b000','9a985722-79aa-4675-ad14-791f7ea663e5','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a985722-79aa-4675-ad14-791f7ea663e5/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/cFJm7VaFmSn87Mn8o0AhQyQWdiMPH3QMSHQctG0S.jpg'),('9a985722-8686-4e43-a63a-46afe05ac392','9a985722-79aa-4675-ad14-791f7ea663e5','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a985722-79aa-4675-ad14-791f7ea663e5/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/gFWYB7BX0MsOLyPyyZEbaWMh6u4Xhw25V1Kt0aLA.jpg'),('9a985722-8898-4614-a93e-b7da190e43b8','9a985722-79aa-4675-ad14-791f7ea663e5','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a985722-79aa-4675-ad14-791f7ea663e5/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/kHn5uhpXNgqBY2hMtU4vGRlfveJ307t852ZEvCBH.jpg'),('9a9e5e41-08f9-4132-a4d6-3c5e3475007a','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/PBqueypjs86f1oFNvx0DpoCfcwJMhVoDSzbjFz9y.jpg'),('9a9e5e41-0ecc-4d91-a550-450f60e50c20','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/KDuk8bdts8WbR9IGIWYaPnxKMtEvPfbEMOWQZxuF.jpg'),('9a9e5e41-1523-4e80-8306-e2592bf5b386','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/udo71QyIf0Ofg01bvR9vO7zUonh9uiOg9V99eCj1.jpg'),('9a9e5e41-1ad3-46c3-ac01-041176475059','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/Ez2ZgrSytoGEbQkfla03ZyfeKsUqXOsjCCsWQdQV.webp'),('9a9e5e41-1ef2-45b2-8448-4d2fa820d33f','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/DFyc3tPJnXBtPCMPEkPTkv28RB6T2jLlAYguwmXv.jpg'),('9a9e5e41-2205-4c09-8012-fd659e036a2f','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/3sRsx2xj3bI0Acip42g1OggeAkRbm74fxOsZGnn5.jpg'),('9a9e6231-6fc5-457a-82f1-e9744645aea2','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e6231-6929-423f-92b9-8cf2f16eb363/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/jwgo9FebHMIJWCjKLP1mBPCjM273rLqPhMO2Mqe5.jpg'),('9a9e6231-7183-45c4-a93b-6b7b71fb0ced','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e6231-6929-423f-92b9-8cf2f16eb363/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/nrMSFkpIkKh13mE9O2j7WtVrsEfMbd4TQ3WlBBlx.jpg'),('9a9e6231-7331-4ce8-adc6-6abd038fc020','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e6231-6929-423f-92b9-8cf2f16eb363/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/EoTT8c5NqFaH4byWjTK5lRGgjbeqpjeqG9lNVjat.jpg'),('9a9e6231-74ba-4820-88c5-dd23eacf090c','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a9e6231-6929-423f-92b9-8cf2f16eb363/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/fRgBjhl6klZRmtZWq9Z53B3F0jw1vjXenre1pdnR.jpg'),('9a9e6231-76de-4b23-846f-402bbd76aa17','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a9e6231-6929-423f-92b9-8cf2f16eb363/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/Vj8S8sTKfsBuEg23jXNooMjpISvHSWq3WuzsI26C.jpg'),('9a9e6231-85ae-40c7-b5a0-c96655e71e46','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a9e6231-6929-423f-92b9-8cf2f16eb363/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/INMlbYukEGdTAVTrQboNAvtE0E38XXjS5k708tE5.jpg'),('9a9e6785-d51a-4887-89fa-25a8a19f3866','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a9e6785-ca70-4bb7-bc2e-f873a6bcae51/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/5nnJ23V54ZeFxR7su8C0pQK8r42zpL0vbvsmrQfi.jpg'),('9a9e6785-d73a-4bbb-9c3c-988b4f7263c9','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a9e6785-ca70-4bb7-bc2e-f873a6bcae51/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/asXWfCA6bcrJpuzUq8sUst10JwlkOzAi707FpjfI.jpg'),('9a9e6785-d977-4904-ae05-5852f8b49f11','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','images/product_images/9a9e6785-ca70-4bb7-bc2e-f873a6bcae51/color-9a9604c8-2c2b-4304-aadc-12bb7d85f9e3/CPXoDjxpqXV9k3C9mP7DkZO7XanJLi3KQ5MoKr9l.jpg'),('9a9e6785-db85-4f44-a23a-7a0a53e99bec','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e6785-ca70-4bb7-bc2e-f873a6bcae51/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/vGpBhOcPWyHkCgPlU9QKJT1813Qt5xd9jy1K5kYh.jpg'),('9a9e6785-ddbb-4153-92ae-1a3159b23fd4','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e6785-ca70-4bb7-bc2e-f873a6bcae51/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/0debBRBaW9J2aJkcGqkzIz8Pa6BO9DEsBCCHHnBA.jpg'),('9a9e6785-e016-4fdd-9114-d47d6b99d643','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a960472-9ed8-46ce-8000-9eaa4ae4f660','images/product_images/9a9e6785-ca70-4bb7-bc2e-f873a6bcae51/color-9a960472-9ed8-46ce-8000-9eaa4ae4f660/d69Z7f5LjWM6qqS0WjfsaEdTU2zJwhZeTbN8FkTE.jpg'),('9aaffeba-edf8-4b0c-9708-8d72c3100b31','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a9393a3-a838-41f8-83c5-02035f12af02','images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/color-9a9393a3-a838-41f8-83c5-02035f12af02/MlMb6b89eQ5icqUSspEsxFT3Y6pM5ZIPryoqlamI.jpg'),('9aaffeba-f0a0-441b-bb4a-90e96ab94337','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a9393a3-a838-41f8-83c5-02035f12af02','images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/color-9a9393a3-a838-41f8-83c5-02035f12af02/z0fMqkmzUKtOacS89EhXWcdEKv0XCj2WpCRCG5Vn.jpg'),('9ab00298-a6a1-44b0-87e3-7d4aea55c914','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/9CSjMarTBVnj5rwUq9IbcdpWPtZcQklZeqMloXeo.png'),('9ab00298-a84b-4cb3-85d6-bf3f76c53464','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a941ca8-c4c1-40b8-a868-bb502e3958c4','images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/color-9a941ca8-c4c1-40b8-a868-bb502e3958c4/wlrecBFGv2O1Pcpa9h17oW4BRheLznslmvdIWaEU.png'),('9ab0a6b7-4e4b-4f36-8791-3ea9f5d617b7','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/IQkQ8zrEFL20ixYlYLyTef0Rac50lnBVFCaQSIgm.png'),('9ab0a6b7-54ab-4d24-92ff-7166fe13e150','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a91b459-9359-4f30-b257-7dd50fbedd4e','images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/color-9a91b459-9359-4f30-b257-7dd50fbedd4e/79eMtROh4MwYGvtn1CBElwoLL76h7j9OaeiuwNlR.png');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (13,'2014_10_12_000000_create_users_table',1),(14,'2014_10_12_100000_create_password_resets_table',1),(15,'2019_08_19_000000_create_failed_jobs_table',1),(16,'2019_12_14_000001_create_personal_access_tokens_table',1),(17,'2023_11_01_024947_create_categories_table',1),(18,'2023_11_01_030603_create_products_table',1),(19,'2023_11_01_031848_create_solds_table',1),(20,'2023_11_01_032933_create_colors_table',1),(21,'2023_11_01_033916_create_images_table',1),(22,'2023_11_01_034518_create_product_variants_table',1),(23,'2023_11_01_050519_create_payments_table',1),(24,'2023_11_01_052045_create_orders_table',1),(25,'2023_11_01_055036_create_order_items_table',1),(26,'2023_11_01_055614_create_banners_table',1),(27,'2023_11_01_055914_create_carts_table',1),(28,'2023_11_01_071136_add_parent_id_to_categories_table',1),(29,'2023_11_11_032259_change_product_variants_table_size_column',2),(30,'2023_11_11_033208_change_product_variants_table_add_unique',3),(31,'2023_11_11_033647_change_carts_table_add_unique',3),(32,'2023_11_11_033836_change_order_items_table_add_unique',3),(33,'2023_11_11_034455_change_product_variants_table_size_column_not_null',4),(34,'2023_11_16_042629_add_timestamps_to_carts_table',5),(35,'2023_11_18_115616_add_selling_price_to_products_table',6),(36,'2023_11_22_041317_alter_table_payments_nullable_transactionid_and_payerid',7),(37,'2023_11_23_113534_create_user_logins_table',8),(38,'2023_11_25_115651_create_sales_table',9),(41,'2023_11_26_070630_alter_sales_table_add_index_to_date_column',10),(42,'2023_11_26_112920_create_jobs_table',11),(43,'2023_11_27_041733_alter_payments_table_change_payment_method_column_type',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_variant_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `price` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_items_product_id_product_variant_id_order_id_unique` (`product_id`,`product_variant_id`,`order_id`),
  KEY `order_items_product_variant_id_foreign` (`product_variant_id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES ('9aabe1f1-2fe5-4327-9c56-5e1588473560','9a985722-79aa-4675-ad14-791f7ea663e5','9a985722-7e33-46eb-84f1-57c1b14f84c8','9aabe1f1-2eb0-4eda-b201-06df518f23ce',2,558400),('9aabf147-e922-47b9-9204-062b5125d345','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9e6231-6c1e-4048-8762-52d598173a27','9aabf147-e753-4040-8dce-14d2264ec8d6',1,399330),('9ab9f881-8bca-470c-a860-ef4adf0dce95','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9e6231-6c1e-4048-8762-52d598173a27','9ab9f881-89df-401e-8002-f20228fc8a05',1,399330),('9ab9f881-903e-46e1-a11f-8fab47d9312c','9a985722-79aa-4675-ad14-791f7ea663e5','9a985722-7e33-46eb-84f1-57c1b14f84c8','9ab9f881-89df-401e-8002-f20228fc8a05',1,279200),('9aba1cf2-603c-4e5c-99ec-a9a8d6ed686b','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a9e5e41-022d-4c31-b205-6350abb9eb2a','9aba1cf2-5e1a-49c3-b757-f2cd25e1d373',1,490000),('9abc2bf1-802d-422c-84c0-930ae8645386','9a945732-93c9-4fb8-b13e-3b2d32793b0c','9a945732-9a62-460c-a42c-91fa128b2fee','9abc2bf1-7d72-4000-9b7c-1f1acc8ad69e',2,278000),('9abc312d-54bc-444a-a107-e3fc7f6b432a','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a9e5e41-03f1-42d6-b067-465457f7cf7b','9abc312d-5403-4d0d-ae60-d55f6fd90d7f',1,490000),('9abc312d-5561-476d-9574-b5527a3d53a6','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a9e6785-d301-42d7-95eb-a6bba8b6bc97','9abc312d-5403-4d0d-ae60-d55f6fd90d7f',1,527120),('9abc343a-e6db-4771-9b23-2379629e3def','9a945732-93c9-4fb8-b13e-3b2d32793b0c','9a945732-9a62-460c-a42c-91fa128b2fee','9abc343a-e500-4e9f-b663-234642f10a72',1,139000),('9abc4c61-d3bb-4a78-8b77-e030effc9916','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a98560b-a2f4-46dd-b018-5b395e7541d1','9abc4c61-d1c9-462c-9243-46c080fde972',1,279300),('9abc4e85-f490-4585-b50d-ac8199533c68','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a9e6785-d26c-4595-965a-6b2625c30145','9abc4e85-f378-4869-92dd-bc00d63f87c0',1,527120),('9abc4fd9-e327-44eb-965f-c03f3b97b90f','9a945732-93c9-4fb8-b13e-3b2d32793b0c','9a945732-9a62-460c-a42c-91fa128b2fee','9abc4fd9-e175-4374-a737-0cc0150fbef0',1,139000);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('PENDING','PROCESSING','SHIPPING','CANCELED','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int NOT NULL,
  `cancel_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_code_unique` (`code`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_payment_id_foreign` (`payment_id`),
  CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES ('9aabe1f1-2eb0-4eda-b201-06df518f23ce','9a849a2d-b0d9-4bb9-8807-1bb49cbaed69','9aabe1f1-280a-4e1b-86c2-9420c25f318b','CTL-OD1700630207Sryf','CANCELED','Vu Strong','vubamanh05@gmail.com','0868154161','Nguyen Lan Ha Noi',558400,'thich ay',NULL,'2023-11-21 22:16:47','2023-11-21 22:53:06',NULL),('9aabf147-e753-4040-8dce-14d2264ec8d6','9a849a2d-b0d9-4bb9-8807-1bb49cbaed69','9aabf147-dedb-4f5e-86cc-3af45beec00a','CTL-OD1700632781d14J','COMPLETED','Vu Strong','vubamanh05@gmail.com','0868154161','Nguyen Lan Ha Noi',399330,NULL,NULL,'2023-11-21 22:59:41','2023-11-26 04:38:07',NULL),('9ab9f881-89df-401e-8002-f20228fc8a05',NULL,'9ab9f880-74d7-405a-9f16-86158de1dba6','CTL-OD1701235288dHEQ','COMPLETED','Vu Manh','vubamanh05@gmail.com','0868154166','ha noi',678530,NULL,'test','2023-11-28 22:21:28','2023-11-28 22:24:00',NULL),('9aba1cf2-5e1a-49c3-b757-f2cd25e1d373','9a849a2d-b0d9-4bb9-8807-1bb49cbaed69','9aba1cf2-47b1-40c9-8cfe-492357ccda32','CTL-OD1701241402NZ0K','COMPLETED','Vu Strong','vubamanh05@gmail.com','0868154161','Nguyen Lan Ha Noi',490000,NULL,NULL,'2023-11-29 00:03:22','2023-11-29 00:03:22',NULL),('9abc2bf1-7d72-4000-9b7c-1f1acc8ad69e','9a849a2d-b0d9-4bb9-8807-1bb49cbaed69','9abc2bf1-6551-4927-b0c2-c1562ca47fb3','CTL-OD1701329817DNbj','CANCELED','Vu Strong','vubamanh05@gmail.com','0868154161','Nguyen Lan Ha Noi',278000,'Hết tiền rùi :<',NULL,'2023-11-30 00:36:57','2023-11-30 00:40:45',NULL),('9abc312d-5403-4d0d-ae60-d55f6fd90d7f','9a849a2d-b0d9-4bb9-8807-1bb49cbaed69','9abc312d-4f16-4733-9070-cbb3f143f8ba','CTL-OD1701330695uGme','CANCELED','Vu Strong','vubamanh05@gmail.com','0868154161','Nguyen Lan Ha Noi',1017120,NULL,NULL,'2023-11-30 00:51:35','2023-11-30 01:12:57',NULL),('9abc343a-e500-4e9f-b663-234642f10a72','9a849a2d-b0d9-4bb9-8807-1bb49cbaed69','9abc343a-deb1-4f53-aede-4535a0c007da','CTL-OD1701331208T82A','CANCELED','Vu Strong','vubamanh05@gmail.com','0868154161','Nguyen Lan Ha Noi',139000,NULL,NULL,'2023-11-30 01:00:08','2023-11-30 01:05:04',NULL),('9abc4c61-d1c9-462c-9243-46c080fde972','9abc4b28-9148-45e2-8e88-c47c6e6f9ef9','9abc4c61-c240-4ae8-a293-74a9559ec061','CTL-OD1701335260AjeM','COMPLETED','strongtify','strongtify@gmail.com','0868154161','Ha Noi',279300,NULL,NULL,'2023-11-30 02:07:40','2023-11-30 02:11:17',NULL),('9abc4e85-f378-4869-92dd-bc00d63f87c0','9abc4b28-9148-45e2-8e88-c47c6e6f9ef9','9abc4e85-ef28-4ba3-a923-f3f9fc3b37b2','CTL-OD1701335619NvNV','CANCELED','strongtify','strongtify@gmail.com','0868154161','Viet Nam',527120,NULL,NULL,'2023-11-30 02:13:39','2023-11-30 02:16:30',NULL),('9abc4fd9-e175-4374-a737-0cc0150fbef0','9abc4b28-9148-45e2-8e88-c47c6e6f9ef9','9abc4fd9-de7b-4f8e-a8b5-084e230bf2d7','CTL-OD1701335842zJH3','COMPLETED','strongtify','strongtify@gmail.com','0868154161','Ha Noi',139000,NULL,NULL,'2023-11-30 02:17:22','2023-11-30 02:21:04',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int NOT NULL,
  `payment_method` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COD',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES ('9aabe1f1-280a-4e1b-86c2-9420c25f318b',558400,'COD',NULL,NULL,'vnd','COMPLETED','2023-11-21 22:16:47','2023-11-21 22:16:47',NULL),('9aabf147-dedb-4f5e-86cc-3af45beec00a',399330,'COD',NULL,NULL,'vnd','COMPLETED','2023-11-21 22:59:41','2023-11-21 22:59:41',NULL),('9ab9f880-74d7-405a-9f16-86158de1dba6',678530,'COD',NULL,NULL,'vnd','COMPLETED','2023-11-28 22:21:28','2023-11-28 22:21:28',NULL),('9aba1cf2-47b1-40c9-8cfe-492357ccda32',490000,'paypal',NULL,NULL,'vnd','COMPLETED','2023-11-29 00:03:22','2023-11-29 00:03:22',NULL),('9abc2bf1-6551-4927-b0c2-c1562ca47fb3',278000,'COD',NULL,NULL,'vnd','UNPAID','2023-11-30 00:36:57','2023-11-30 00:36:57',NULL),('9abc312d-4f16-4733-9070-cbb3f143f8ba',42,'paypal','7EH395999G293040W','TS2BVKFH9AWHE','usd','COMPLETED','2023-11-30 00:51:35','2023-11-30 00:52:44',NULL),('9abc343a-deb1-4f53-aede-4535a0c007da',6,'paypal',NULL,NULL,'usd','UNPAID','2023-11-30 01:00:08','2023-11-30 01:00:08',NULL),('9abc4c61-c240-4ae8-a293-74a9559ec061',279300,'COD',NULL,NULL,'vnd','COMPLETED','2023-11-30 02:07:40','2023-11-30 02:11:17',NULL),('9abc4e85-ef28-4ba3-a923-f3f9fc3b37b2',22,'paypal','4XR41561F3095153B','TS2BVKFH9AWHE','usd','COMPLETED','2023-11-30 02:13:39','2023-11-30 02:14:56',NULL),('9abc4fd9-de7b-4f8e-a8b5-084e230bf2d7',6,'paypal','7B564359GN000390R','TS2BVKFH9AWHE','usd','COMPLETED','2023-11-30 02:17:22','2023-11-30 02:19:13',NULL);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variants` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NONE',
  `quantity` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_variants_product_id_color_id_size_unique` (`product_id`,`color_id`,`size`),
  KEY `product_variants_color_id_foreign` (`color_id`),
  CONSTRAINT `product_variants_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES ('9a944d5d-0602-484c-8396-6ef195f4aa70','9a944d5c-c37a-4520-8048-d8d49b054e83','9a941ca8-c4c1-40b8-a868-bb502e3958c4','S',100),('9a944d5d-12ae-48f9-be90-3c7491085d9f','9a944d5c-c37a-4520-8048-d8d49b054e83','9a941ca8-c4c1-40b8-a868-bb502e3958c4','M',100),('9a944d5d-151b-40cd-be5f-e7a56df2555e','9a944d5c-c37a-4520-8048-d8d49b054e83','9a941ca8-c4c1-40b8-a868-bb502e3958c4','L',99),('9a944d5d-173d-4cec-be87-ad5d47230775','9a944d5c-c37a-4520-8048-d8d49b054e83','9a941ca8-c4c1-40b8-a868-bb502e3958c4','XL',100),('9a944ec4-2c93-45b1-b184-483e093a0163','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a941ca8-c4c1-40b8-a868-bb502e3958c4','S',100),('9a944ec4-2e7f-482e-88fe-862dfaf8cdf2','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a941ca8-c4c1-40b8-a868-bb502e3958c4','M',0),('9a944ec4-2fd2-46bf-bd5b-255029899efa','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a941ca8-c4c1-40b8-a868-bb502e3958c4','L',100),('9a944ec4-3186-4202-bad8-a69efa19a2ac','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a941ca8-c4c1-40b8-a868-bb502e3958c4','XL',100),('9a944ec4-3a8a-4555-8b9b-2f1bca186edb','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a91b459-9359-4f30-b257-7dd50fbedd4e','S',0),('9a944ec4-3be4-4852-a7f2-00fa60ff24fa','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a91b459-9359-4f30-b257-7dd50fbedd4e','M',100),('9a944ec4-3d34-41f0-a368-f132e479c533','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a91b459-9359-4f30-b257-7dd50fbedd4e','L',100),('9a944ec4-3ec6-41b1-b6fa-1b631ad33cd8','9a944ec4-27ff-4c99-8b20-1d116a9f73e6','9a91b459-9359-4f30-b257-7dd50fbedd4e','XL',100),('9a944fa6-f558-43f8-8f02-6e87acd0d478','9a944fa6-ef36-4f08-912d-260f66ed3e8c','9a91b459-9359-4f30-b257-7dd50fbedd4e','M',50),('9a944fa6-f752-4fa4-b507-e4e0bfb6030f','9a944fa6-ef36-4f08-912d-260f66ed3e8c','9a91b459-9359-4f30-b257-7dd50fbedd4e','L',50),('9a944fa6-f97a-4f02-94c3-c943a99d05c0','9a944fa6-ef36-4f08-912d-260f66ed3e8c','9a91b459-9359-4f30-b257-7dd50fbedd4e','XL',50),('9a945732-9a62-460c-a42c-91fa128b2fee','9a945732-93c9-4fb8-b13e-3b2d32793b0c','9a9456a1-0bf9-4203-b29a-0abad0c051f3','NONE',149),('9a9609d4-5281-4f6e-8db9-8c2757524e49','9a9609d4-4b88-4b87-a101-d6aef2297094','9a91b459-9359-4f30-b257-7dd50fbedd4e','S',100),('9a9609d4-5535-48c0-8a32-875da512dd9e','9a9609d4-4b88-4b87-a101-d6aef2297094','9a91b459-9359-4f30-b257-7dd50fbedd4e','M',100),('9a9609d4-56f2-43a7-8264-043948f3dae8','9a9609d4-4b88-4b87-a101-d6aef2297094','9a91b459-9359-4f30-b257-7dd50fbedd4e','L',100),('9a9609d4-58e3-4557-80db-b2e823c6592a','9a9609d4-4b88-4b87-a101-d6aef2297094','9a91b459-9359-4f30-b257-7dd50fbedd4e','XL',100),('9a962c88-a3aa-4ebb-8333-9da84110a99c','9a962c88-9d21-422a-966d-43df894fdb1d','9a960472-9ed8-46ce-8000-9eaa4ae4f660','29',100),('9a962c88-a4c0-42f8-afa8-d2429b37b44c','9a962c88-9d21-422a-966d-43df894fdb1d','9a960472-9ed8-46ce-8000-9eaa4ae4f660','30',100),('9a962c88-a570-4095-8ca7-26c34198005d','9a962c88-9d21-422a-966d-43df894fdb1d','9a960472-9ed8-46ce-8000-9eaa4ae4f660','31',100),('9a962c88-a63f-4abe-b7d4-4a16cd0ab69e','9a962c88-9d21-422a-966d-43df894fdb1d','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','29',100),('9a962c88-a714-463a-841b-e4b47aa21d97','9a962c88-9d21-422a-966d-43df894fdb1d','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','30',100),('9a962c88-a7fc-439b-b457-e39b8ebf02a3','9a962c88-9d21-422a-966d-43df894fdb1d','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','31',100),('9a9850a6-2c7c-4df0-a508-5ba537b85109','9a9850a6-2792-4238-a419-1a43da8d2677','9a91b459-9359-4f30-b257-7dd50fbedd4e','M',100),('9a9850a6-2d73-4e6d-ae06-0cd601722874','9a9850a6-2792-4238-a419-1a43da8d2677','9a91b459-9359-4f30-b257-7dd50fbedd4e','L',100),('9a9850a6-2df6-4232-9d5c-5e4ff8f93464','9a9850a6-2792-4238-a419-1a43da8d2677','9a91b459-9359-4f30-b257-7dd50fbedd4e','XL',100),('9a9850a6-2e5e-41b2-a8fa-69b46255f54b','9a9850a6-2792-4238-a419-1a43da8d2677','9a9456a1-0bf9-4203-b29a-0abad0c051f3','M',100),('9a9850a6-2ec0-431f-91a7-af8c4c1540e3','9a9850a6-2792-4238-a419-1a43da8d2677','9a9456a1-0bf9-4203-b29a-0abad0c051f3','L',100),('9a9850a6-2f24-4f4f-946b-f09045792854','9a9850a6-2792-4238-a419-1a43da8d2677','9a9456a1-0bf9-4203-b29a-0abad0c051f3','XL',100),('9a985211-00f2-4003-830f-e75f92263a13','9a985210-fdd1-48e5-bcd5-883b39663621','9a985137-1440-47b1-9c9d-a0e0eaf986c5','S',50),('9a98536e-9b23-433e-9ac5-52938239f2be','9a98536e-9810-4701-82a0-8e123d9cdd21','9a91b459-9359-4f30-b257-7dd50fbedd4e','S',0),('9a98536e-9bae-451f-ab3e-ecd73e0e990d','9a98536e-9810-4701-82a0-8e123d9cdd21','9a91b459-9359-4f30-b257-7dd50fbedd4e','M',10),('9a98536e-9c25-4a6a-97c3-ef646593a0fe','9a98536e-9810-4701-82a0-8e123d9cdd21','9a91b459-9359-4f30-b257-7dd50fbedd4e','L',1),('9a98536e-9c8b-40c8-a6e5-f7d5d742b007','9a98536e-9810-4701-82a0-8e123d9cdd21','9a941ca8-c4c1-40b8-a868-bb502e3958c4','S',10),('9a98536e-9ced-4ae6-8af7-b30df97bd674','9a98536e-9810-4701-82a0-8e123d9cdd21','9a941ca8-c4c1-40b8-a868-bb502e3958c4','M',0),('9a98536e-9d54-43d7-81ea-bd0e6c530fea','9a98536e-9810-4701-82a0-8e123d9cdd21','9a941ca8-c4c1-40b8-a868-bb502e3958c4','L',20),('9a98560b-a217-45c5-9107-b2d154fab1a3','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a941ca8-c4c1-40b8-a868-bb502e3958c4','S',50),('9a98560b-a299-4492-8b8a-d016e76ea13e','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a941ca8-c4c1-40b8-a868-bb502e3958c4','M',50),('9a98560b-a2f4-46dd-b018-5b395e7541d1','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a941ca8-c4c1-40b8-a868-bb502e3958c4','L',49),('9a98560b-a38c-4d6e-b2fa-3f5553a36e67','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a985137-1440-47b1-9c9d-a0e0eaf986c5','S',50),('9a98560b-a41e-4f23-9e7b-80a3357dff24','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a985137-1440-47b1-9c9d-a0e0eaf986c5','M',50),('9a98560b-a47f-4f0e-ad92-5adffe26bed6','9a98560b-9f1c-4856-912a-6ac9b1bbb496','9a985137-1440-47b1-9c9d-a0e0eaf986c5','L',50),('9a985722-7cac-463c-8959-84773908e06a','9a985722-79aa-4675-ad14-791f7ea663e5','9a9456a1-0bf9-4203-b29a-0abad0c051f3','S',0),('9a985722-7d2b-4931-835f-d56ce7a9a666','9a985722-79aa-4675-ad14-791f7ea663e5','9a9456a1-0bf9-4203-b29a-0abad0c051f3','M',0),('9a985722-7d85-46de-b3cf-3c3a9a155b71','9a985722-79aa-4675-ad14-791f7ea663e5','9a9456a1-0bf9-4203-b29a-0abad0c051f3','L',20),('9a985722-7dd8-42b7-877e-1bf180074ee0','9a985722-79aa-4675-ad14-791f7ea663e5','9a91b459-9359-4f30-b257-7dd50fbedd4e','S',20),('9a985722-7e33-46eb-84f1-57c1b14f84c8','9a985722-79aa-4675-ad14-791f7ea663e5','9a91b459-9359-4f30-b257-7dd50fbedd4e','M',6),('9a985722-7e87-4991-a3b8-3f1f993d6faa','9a985722-79aa-4675-ad14-791f7ea663e5','9a91b459-9359-4f30-b257-7dd50fbedd4e','L',0),('9a9e5e40-fd42-421c-b420-86073b48e8cb','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a960472-9ed8-46ce-8000-9eaa4ae4f660','29',100),('9a9e5e41-0007-41a8-9ce9-89b02f67f30a','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a960472-9ed8-46ce-8000-9eaa4ae4f660','30',50),('9a9e5e41-011e-4eab-83ce-05fa19b50db3','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a960472-9ed8-46ce-8000-9eaa4ae4f660','31',100),('9a9e5e41-022d-4c31-b205-6350abb9eb2a','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a91b459-9359-4f30-b257-7dd50fbedd4e','29',100),('9a9e5e41-03f1-42d6-b067-465457f7cf7b','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a91b459-9359-4f30-b257-7dd50fbedd4e','30',100),('9a9e5e41-050f-4327-826b-c41a8efccec0','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','9a91b459-9359-4f30-b257-7dd50fbedd4e','31',100),('9a9e6231-6c1e-4048-8762-52d598173a27','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a960472-9ed8-46ce-8000-9eaa4ae4f660','29',8),('9a9e6231-6c97-4187-b573-9212a471f243','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a960472-9ed8-46ce-8000-9eaa4ae4f660','30',10),('9a9e6231-6cf9-4db9-b464-b42a2e9b7f59','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a960472-9ed8-46ce-8000-9eaa4ae4f660','31',5),('9a9e6231-6d5e-4dd2-9c0e-3b083f119592','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','29',10),('9a9e6231-6dce-443d-b2cc-ce11d36d815f','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','30',10),('9a9e6231-6e2d-440e-a020-5db103785db6','9a9e6231-6929-423f-92b9-8cf2f16eb363','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','31',1),('9a9e6785-d02e-4065-a374-1303b977b4f3','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','29',10),('9a9e6785-d1a1-4b15-9021-5a14011995d9','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a9604c8-2c2b-4304-aadc-12bb7d85f9e3','30',10),('9a9e6785-d26c-4595-965a-6b2625c30145','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a960472-9ed8-46ce-8000-9eaa4ae4f660','29',10),('9a9e6785-d301-42d7-95eb-a6bba8b6bc97','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','9a960472-9ed8-46ce-8000-9eaa4ae4f660','30',10),('9aaffeba-e6a8-4206-af6d-f2bad5b03952','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a9393a3-a838-41f8-83c5-02035f12af02','NONE',0),('9aaffeba-e7cf-49b9-906f-0f096816c811','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a91b459-9359-4f30-b257-7dd50fbedd4e','NONE',1),('9ab00298-9cd2-4cb5-ab0c-9c824aa0a55a','9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','9a941ca8-c4c1-40b8-a868-bb502e3958c4','NONE',1);
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `thumbnail_url` varchar(450) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_guild_url` varchar(450) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `sold` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `selling_price` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_code_unique` (`code`),
  UNIQUE KEY `products_name_unique` (`name`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('9a944d5c-c37a-4520-8048-d8d49b054e83','CTL1699617437bIu3','9a944ac9-ebc8-4470-8003-01bf53f337d0','Áo sơ mi dài tay Café-DriS','ao-so-mi-dai-tay-cafe-dris','Café-DriS là tên  chiếc áo sơ mi này vì với chất liệu Nano-Tech 100% - với sợi nano nhỏ được dệt tỉ mỉ và vẫn giữ nguyên tính năng chống nhăn và kháng khuẩn của sợi vải để bạn luôn thoải mái và tự tin mặc trong mỗi buổi sáng','50% S.Café + 50% Recycled PET',399000,0,'images/product_images/9a944d5c-c37a-4520-8048-d8d49b054e83/thumbnail.webp','images/product_images/size_guild_all.png',399,0,'2023-11-10 04:57:17','2023-11-10 04:57:17',NULL,399000),('9a944ec4-27ff-4c99-8b20-1d116a9f73e6','CTL1699617673dafC','9a8a8f8b-58a7-40e0-95ba-e3dbfcf7d6de','Áo dài tay Cotton Compact V2','ao-dai-tay-cotton-compact-v2','Bề mặt vải Cotton mềm mịn, cảm giác mát lần đầu chạm tay','95% Cotton Compact + 5% Spandex',229000,0,'images/product_images/9a944ec4-27ff-4c99-8b20-1d116a9f73e6/thumbnail.webp','images/product_images/size_guild_all.png',600,0,'2023-11-10 05:01:13','2023-11-10 05:01:13',NULL,229000),('9a944fa6-ef36-4f08-912d-260f66ed3e8c','CTL1699617821cdk9','9a984c41-1578-4808-824c-98fa36901d85','Quần Joggers Daily Wear','quan-joggers-daily-wear','Công nghệ ứng dụng: Quần jogger nam Daily Wear ứng dụng HeiQ ViroBlock giúp ức chế và tiêu diệt vi khuẩn trên bề mặt vải','100% Polyester',269000,0,'images/product_images/9a944fa6-ef36-4f08-912d-260f66ed3e8c/thumbnail.webp','images/product_images/size_guild_all.png',150,0,'2023-11-10 05:03:41','2023-11-12 04:44:01',NULL,269000),('9a945732-93c9-4fb8-b13e-3b2d32793b0c','CTL1699619087ZD43','9a9450bc-cd47-4cc8-a33d-e6b7b10287f2','Combo 3 Tất Cotton Supima','combo-3-tat-cotton-supima',NULL,'80% Supima Cotton + 18% Spandex + 2% Cao su',139000,0,'images/product_images/9a945732-93c9-4fb8-b13e-3b2d32793b0c/thumbnail.jpg','images/product_images/size_guild_all.png',149,1,'2023-11-10 05:24:47','2023-11-11 07:29:18',NULL,139000),('9a9609d4-4b88-4b87-a101-d6aef2297094','CTL1699692006cDEx','9a960860-f995-4be2-bf22-9f731d10bb75','Áo Polo Ice Cooling','ao-polo-ice-cooling',NULL,'85% Polyamide + 15% Spandex',309000,0,'images/product_images/9a9609d4-4b88-4b87-a101-d6aef2297094/thumbnail.jpg','images/product_images/size_guild_all.png',400,0,'2023-11-11 01:40:06','2023-11-11 01:40:06',NULL,309000),('9a962c88-9d21-422a-966d-43df894fdb1d','CTL1699697829qr8w','9a944a13-b916-40d8-aea2-983c688cf02f','Jeans Copper Denim OG Slim','jeans-copper-denim-og-slim','Dáng OG Slim: Dáng ôm tôn dáng, ống quần từ phần đùi xuống gấu của OG là rộng hơn Slim Fit','99% Cotton - 1% Spandex / 12 Oz',519000,0,'images/product_images/9a962c88-9d21-422a-966d-43df894fdb1d/thumbnail.webp','images/product_images/size_guild_all.png',600,0,'2023-11-11 03:17:09','2023-11-11 03:17:09',NULL,519000),('9a9850a6-2792-4238-a419-1a43da8d2677','CTL1699789787I6Om','9a984c41-1578-4808-824c-98fa36901d85','Quần dài thể thao Pro Active','quan-dai-the-thao-pro-active',NULL,'100% Polyester',379000,0,'images/product_images/9a9850a6-2792-4238-a419-1a43da8d2677/thumbnail.jpg','images/product_images/size_guild_all.png',600,0,'2023-11-12 04:49:47','2023-11-12 04:49:47',NULL,379000),('9a985210-fdd1-48e5-bcd5-883b39663621','CTL1699790025WqPa','9a944ac9-ebc8-4470-8003-01bf53f337d0','Sơ mi dài tay Easycare','so-mi-dai-tay-easycare',NULL,'100% sợi Polyester Nano-tech',450000,67,'images/product_images/9a985210-fdd1-48e5-bcd5-883b39663621/thumbnail.webp','images/product_images/size_guild_all.png',50,0,'2023-11-12 04:53:45','2023-11-12 04:53:45',NULL,148500),('9a98536e-9810-4701-82a0-8e123d9cdd21','CTL1699790254FR5P','9a960860-f995-4be2-bf22-9f731d10bb75','Polo thể thao Cleandye','polo-the-thao-cleandye','Áo Polo Nam Thể Thao Nhuộm Sạch Cleandye Thoáng Khí Cao Cấp','100% Polyester',289000,48,'images/product_images/9a98536e-9810-4701-82a0-8e123d9cdd21/thumbnail.jpg','images/product_images/size_guild_all.png',41,0,'2023-11-12 04:57:34','2023-11-30 02:51:30',NULL,150000),('9a98560b-9f1c-4856-912a-6ac9b1bbb496','CTL1699790693SQJW','9a960860-f995-4be2-bf22-9f731d10bb75','Polo Excool','polo-excool',NULL,'56% Polyester PET + 44% Polyester PTT Sorona',399000,30,'images/product_images/9a98560b-9f1c-4856-912a-6ac9b1bbb496/thumbnail.webp','images/product_images/size_guild_all.png',299,1,'2023-11-12 05:04:53','2023-11-12 05:04:53',NULL,279300),('9a985722-79aa-4675-ad14-791f7ea663e5','CTL1699790875uxnl','9a960860-f995-4be2-bf22-9f731d10bb75','Polo Excool Woven','polo-excool-woven','Áo Polo Nam Tay Tay Ngắn Woven Excool Thời Trang','53% Polyester PET high stretch + 47% Polyester PTT Sorona',349000,20,'images/product_images/9a985722-79aa-4675-ad14-791f7ea663e5/thumbnail.webp','images/product_images/size_guild_all.png',46,3,'2023-11-12 05:07:55','2023-11-12 05:07:55',NULL,279200),('9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','CTL1700049763aHsr','9a944a13-b916-40d8-aea2-983c688cf02f','Jeans Basics dáng Slim fit','jeans-basics-dang-slim-fit','Quần Jeans nam Basics dáng Slim fit năng động','Denim',490000,0,'images/product_images/9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5/thumbnail.webp',NULL,550,1,'2023-11-15 05:02:48','2023-11-15 05:02:48',NULL,490000),('9a9e6231-6929-423f-92b9-8cf2f16eb363','CTL1700050429fZfk','9a944a13-b916-40d8-aea2-983c688cf02f','Jeans dáng Slim Fit V2','jeans-dang-slim-fit-v2','Quần Jeans Nam Dáng Slim Fit V2 Thời Trang','78% Cotton+ 10% Polyester + 11% Rayon + 1% Spandex',459000,13,'images/product_images/9a9e6231-6929-423f-92b9-8cf2f16eb363/thumbnail.jpg',NULL,44,2,'2023-11-15 05:13:49','2023-11-15 05:13:49',NULL,399330),('9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','CTL1700051323FheY','9a944a13-b916-40d8-aea2-983c688cf02f','Jeans Copper Denim Straight','jeans-copper-denim-straight','Quần Jeans Nam Dáng Straight Copper Denim Vải Cotton Thoáng Khí','100% Cotton / 12 Oz',599000,12,'images/product_images/9a9e6785-ca70-4bb7-bc2e-f873a6bcae51/thumbnail.jpg',NULL,40,1,'2023-11-15 05:28:43','2023-11-18 05:43:39',NULL,527120),('9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e','CTL1700806836ovJN','9a8a8f8b-58a7-40e0-95ba-e3dbfcf7d6de','hehe22','hehe22',NULL,NULL,334,0,'images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/thumbnail.jpg','images/product_images/9aaffeba-e1ea-4e51-a18b-c6e4ebdf6b5e/size_guild.jpg',2,0,'2023-11-23 23:20:36','2023-12-01 05:33:29','2023-12-01 05:33:29',334);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sales_date_unique` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,'2023-01-25',1200000),(2,'2023-02-25',1100000),(3,'2023-03-25',800000),(4,'2023-04-25',3700000),(5,'2023-05-25',4000000),(6,'2023-06-25',2200000),(7,'2023-07-25',3000000),(8,'2023-08-25',3500000),(9,'2023-09-25',2900000),(10,'2023-10-25',3100000),(11,'2023-11-25',3000000),(12,'2023-12-25',3200000),(13,'2023-11-26',798660),(14,'2023-11-29',678530),(15,'2023-11-30',1435420);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solds`
--

DROP TABLE IF EXISTS `solds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solds` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `count` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `solds_product_id_date_unique` (`product_id`,`date`),
  CONSTRAINT `solds_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solds`
--

LOCK TABLES `solds` WRITE;
/*!40000 ALTER TABLE `solds` DISABLE KEYS */;
INSERT INTO `solds` VALUES ('9a945732-93c9-4fb8-b13e-3b2d32793b0d','9a945732-93c9-4fb8-b13e-3b2d32793b0c','2023-11-25',12),('9a945732-93c9-4fb8-b13e-3b2d32793b0e','9a9609d4-4b88-4b87-a101-d6aef2297094','2023-11-24',11),('9a9609d4-4b88-4b87-a101-d6aef2297091','9a9609d4-4b88-4b87-a101-d6aef2297094','2023-11-25',2),('9ab42977-6f76-4303-ab21-469318378083','9a9e6231-6929-423f-92b9-8cf2f16eb363','2023-11-26',1),('9ab9f98c-35d0-4d58-85ee-948e8b0eb335','9a9e6231-6929-423f-92b9-8cf2f16eb363','2023-11-29',1),('9ab9f98c-3daf-48b1-af9e-c8089526792d','9a985722-79aa-4675-ad14-791f7ea663e5','2023-11-29',1),('9abc322b-720d-482e-87e4-eb75a3ec2a1e','9a9e5e3f-95f9-4b36-8625-9cf0a2179ac5','2023-11-30',1),('9abc322b-823c-48a7-a08d-3a9d53ab9e45','9a9e6785-ca70-4bb7-bc2e-f873a6bcae51','2023-11-30',1),('9abc4dad-e77a-454e-98ba-a50342da9881','9a98560b-9f1c-4856-912a-6ac9b1bbb496','2023-11-30',1),('9abc512c-b679-46ba-99c7-a7d74882e7ba','9a945732-93c9-4fb8-b13e-3b2d32793b0c','2023-11-30',1);
/*!40000 ALTER TABLE `solds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_logins` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_logins_provider_name_provider_key_unique` (`provider_name`,`provider_key`),
  KEY `user_logins_user_id_foreign` (`user_id`),
  CONSTRAINT `user_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logins`
--

LOCK TABLES `user_logins` WRITE;
/*!40000 ALTER TABLE `user_logins` DISABLE KEYS */;
INSERT INTO `user_logins` VALUES ('9aae958e-850b-4bee-b9b4-5d2e8c9b094f','google','116954638573889783142','9aae958e-7739-4396-a2f1-65308c2c2154'),('9abc4bb6-c84e-4f6b-8c90-79134ba98a08','google','101524846367439712023','9abc4b28-9148-45e2-8e88-c47c6e6f9ef9');
/*!40000 ALTER TABLE `user_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('CUSTOMER','STAFF','ADMIN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CUSTOMER',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('2c2cbec8-4ecd-41ea-be5f-ed4d30b8ac5a','Admin 1','admin1@gmail.com','2023-11-02 21:22:26','$2y$10$ce94ZRG9TY7O9Owv.H2UOuYJJgD4Le6tg2cFnKR6ycCb9Oag9xvuu',NULL,NULL,0,'ADMIN','NCwxyNcbVWWpoKYFNl4N1BwsKFTnis6rMqbsjppSw2WvhicEAdv2WeBm7XpB','2023-11-02 09:38:50','2023-11-15 04:56:09',NULL),('3de1491c-dc8c-4f0b-8c3f-8f86bfb43c48','Staff 2','staff2@gmail.com','2023-11-02 21:22:26','$2y$10$QvEXOsv4DxarvgOY0l/8d.BklR9W4Qo33KiS/4K7af6fmuSPVQSTG',NULL,NULL,0,'STAFF',NULL,'2023-11-02 09:38:50','2023-11-02 09:38:50',NULL),('79532a9e-3ec5-4ce1-ba98-b3d3a364b333','Staff 1','staff1@gmail.com','2023-11-02 21:22:26','$2y$10$DWi5KvHpiGuMghm82WTwr.hbxex/xSVUg3HCBh3M.4r69M2GOr7Q2',NULL,NULL,0,'STAFF',NULL,'2023-11-02 09:38:50','2023-11-27 07:55:22',NULL),('9a849a2d-b0d9-4bb9-8807-1bb49cbaed69','Vu Strong','vubamanh05@gmail.com','2023-11-02 09:39:06','$2y$10$F/2gJWE64AgpO2FbgA6KN.EXxGeuive1Lkwixp2nYCOWzWAOWCbVC','0868154161','Nguyen Lan Ha Noi',0,'CUSTOMER','jR7OAWmLYPj6aTWgc87JCuuIY9uCr0V3iVHjFbeCxWznwYJ0yf0NALLY5RIh','2023-11-02 09:38:50','2023-11-28 23:22:56',NULL),('9a84a502-638b-4455-90ab-36fe0f7ca118','aa','manh@gmail.com',NULL,'$2y$10$l6ZBHojbmf49iBTXVgePuOz6dfUzbrXyiz6UFYDTQz/Wovr7EnWLK',NULL,NULL,0,'CUSTOMER',NULL,'2023-11-02 10:09:07','2023-11-02 10:09:07',NULL),('9aae958e-7739-4396-a2f1-65308c2c2154','Strong Phim','phimstrong@gmail.com','2023-11-25 06:30:41',NULL,NULL,NULL,0,'CUSTOMER',NULL,'2023-11-25 06:30:41','2023-11-25 06:30:41',NULL),('9ab6af1d-7e8b-45c1-b7b4-6e213a8cdc85','Staff 3','staff3@gmail.com','2023-11-27 07:08:46','$2y$10$0e5r/3DhUBnFxdIwQHDfgeNujI.Nf6A7DF95frXwFpg3ImqfDJKbi',NULL,NULL,0,'STAFF',NULL,'2023-11-27 07:08:46','2023-11-27 07:08:46',NULL),('9abc4b28-9148-45e2-8e88-c47c6e6f9ef9','strongtify','strongtify@gmail.com','2023-11-30 02:04:47','$2y$10$y3SzFQ1RKg/aa.xakYTF0.eXd8NOCkrmENmaJE4eeLygbmGCdmpAG','0868154161',NULL,0,'CUSTOMER',NULL,'2023-11-30 02:04:14','2023-11-30 02:04:47',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-03  8:42:18
