CREATE TABLE `tag` (
`id` bigint NOT NULL AUTO_INCREMENT,
`image_id` bigint NOT NULL,
`label` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
`start_x` int(100) NULL DEFAULT 0,
`start_y` int(100) NULL DEFAULT 0,
`end_x` int(100) NULL DEFAULT 0,
`end_y` int(100) NULL DEFAULT 0,
PRIMARY KEY (`id`) ,
INDEX `image_id` (`image_id`)
);

CREATE TABLE `image` (
`id` bigint NOT NULL AUTO_INCREMENT,
`content` longblob NOT NULL,
`mime` varchar(100) NOT NULL,
`extension` varchar(10) NOT NULL,
`size` bigint NOT NULL,
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`) 
);

CREATE TABLE `label` (
`id` bigint NOT NULL AUTO_INCREMENT,
`parent_id` bigint NULL DEFAULT NULL,
`text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
PRIMARY KEY (`id`) ,
INDEX `parent_id` (`parent_id`),
INDEX `test` (`text`)
);

CREATE TABLE `image_label` (
`image_id` bigint NOT NULL,
`label_id` bigint NOT NULL,
PRIMARY KEY (`label_id`, `image_id`) 
);


ALTER TABLE `tag` ADD CONSTRAINT `image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);
ALTER TABLE `label` ADD CONSTRAINT `parent_label` FOREIGN KEY (`parent_id`) REFERENCES `label` (`id`);
ALTER TABLE `image_label` ADD CONSTRAINT `fk_tag_label_label_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);
ALTER TABLE `image_label` ADD CONSTRAINT `fk_image_label_label_1` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`);

