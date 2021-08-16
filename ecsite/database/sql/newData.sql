--
-- Database: ecsite
--

DROP DATABASE ecsite;
CREATE DATABASE IF NOT EXISTS ecsite DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ecsite;

CREATE USER IF NOT EXISTS 'root'@'localhost' IDENTIFIED BY 'pwd';
GRANT ALL ON ecsite.* TO 'root'@'localhost';


CREATE TABLE `items` (
    `id` int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY COMMENT 'コメントID',
    `name` varchar(10) NOT NULL COMMENT '作成したユーザーID',
    `amount` int(10) NOT NULL COMMENT 'トピックID',
);

INSERT INTO items VALUES
('tokuho', 200),
('tokuho', 300);


CREATE TABLE `new_items` (
    `id` bigint(100000) UNSIGNED AUTO_INCREMENT COMMENT '商品ID',
    `name` varchar(100) DEFAULT NULL COMMENT '商品名',
    `amount` int(100) NOT NULL COMMENT '金額',
    `updated_by` varchar(20) NOT NULL DEFAULT 'default' COMMENT '最終更新者',
    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最終更新日時'
);
