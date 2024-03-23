CREATE TABLE `grid`(
    `id_grid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `num_columns` BIGINT NOT NULL,
    `num_rows` BIGINT NOT NULL
);
ALTER TABLE
    `grid` ADD PRIMARY KEY `grid_id_grid_primary`(`id_grid`);
CREATE TABLE `time`(
    `id_time_to_solve` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `unit` VARCHAR(255) NOT NULL DEFAULT 'seconds',
    `time_to_solve` BIGINT NOT NULL
);
ALTER TABLE
    `time` ADD PRIMARY KEY `time_id_time_to_solve_primary`(`id_time_to_solve`);
CREATE TABLE `images`(
    `id_image` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `image_path` VARCHAR(255) NOT NULL,
    `id_gallery` BIGINT NOT NULL
);
ALTER TABLE
    `images` ADD PRIMARY KEY `images_id_image_primary`(`id_image`);
CREATE TABLE `gallery`(
    `id_gallery` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT
);
ALTER TABLE
    `gallery` ADD PRIMARY KEY `gallery_id_gallery_primary`(`id_gallery`);
CREATE TABLE `level`(
    `id_level` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_grid` BIGINT NOT NULL,
    `id_time_to_solve` BIGINT NOT NULL,
    `id_gallery` BIGINT NOT NULL
);
ALTER TABLE
    `level` ADD INDEX `level_id_grid_index`(`id_grid`);
ALTER TABLE
    `level` ADD INDEX `level_id_time_to_solve_index`(`id_time_to_solve`);
ALTER TABLE
    `level` ADD INDEX `level_id_gallery_index`(`id_gallery`);
ALTER TABLE
    `level` ADD PRIMARY KEY `level_id_level_primary`(`id_level`);
ALTER TABLE
    `level` ADD CONSTRAINT `level_id_grid_foreign` FOREIGN KEY(`id_grid`) REFERENCES `grid`(`id_grid`);
ALTER TABLE
    `images` ADD CONSTRAINT `images_id_gallery_foreign` FOREIGN KEY(`id_gallery`) REFERENCES `gallery`(`id_gallery`);
ALTER TABLE
    `level` ADD CONSTRAINT `level_id_time_to_solve_foreign` FOREIGN KEY(`id_time_to_solve`) REFERENCES `time`(`id_time_to_solve`);
ALTER TABLE
    `level` ADD CONSTRAINT `level_id_gallery_foreign` FOREIGN KEY(`id_gallery`) REFERENCES `gallery`(`id_gallery`);