-- Migration: Add is_featured column to certificates and activities tables
-- Run this SQL in your InfinityFree phpMyAdmin

ALTER TABLE `certificates` ADD COLUMN `is_featured` TINYINT(1) NOT NULL DEFAULT 0 AFTER `file_type`;
ALTER TABLE `activities` ADD COLUMN `is_featured` TINYINT(1) NOT NULL DEFAULT 0 AFTER `documentation`;
