CREATE TABLE `tag` (
`id` bigint NOT NULL AUTO_INCREMENT,
`image_id` bigint NOT NULL,
`start_x` int(100) NULL DEFAULT 0,
`start_y` int(100) NULL DEFAULT 0,
`end_x` int(100) NULL DEFAULT 0,
`end_y` int(100) NULL DEFAULT 0,
PRIMARY KEY (`id`) ,
INDEX `image_id` (`image_id`)
);

CREATE TABLE `image` (
`id` bigint NOT NULL AUTO_INCREMENT,
`content` blob NOT NULL,
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

CREATE TABLE `tag_label` (
`tag_id` bigint NOT NULL,
`label_id` bigint NOT NULL,
PRIMARY KEY (`tag_id`, `label_id`) 
);

CREATE TABLE `userlabel` (
`id` bigint NOT NULL AUTO_INCREMENT,
`text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
PRIMARY KEY (`id`) ,
INDEX `text` (`text`)
);

CREATE TABLE `tag_userlabel` (
`tag_id` bigint NOT NULL,
`userlabel_id` bigint NOT NULL,
PRIMARY KEY (`tag_id`, `userlabel_id`) 
);


ALTER TABLE `tag` ADD CONSTRAINT `image` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);
ALTER TABLE `label` ADD CONSTRAINT `parent_label` FOREIGN KEY (`parent_id`) REFERENCES `label` (`id`);
ALTER TABLE `tag_label` ADD CONSTRAINT `fk_tag_label_tag_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);
ALTER TABLE `tag_label` ADD CONSTRAINT `fk_tag_label_label_1` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`);
ALTER TABLE `tag_userlabel` ADD CONSTRAINT `fk_tag_userlabel_userlabel_1` FOREIGN KEY (`userlabel_id`) REFERENCES `userlabel` (`id`);
ALTER TABLE `tag_userlabel` ADD CONSTRAINT `fk_tag_userlabel_tag_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

