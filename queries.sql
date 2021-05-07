/* DATE 12-04-2021 virender.freak6@gmail.com */

ALTER TABLE `users` CHANGE `password` `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL; 


/* DATE 07-05-2021 virender.freak6@gmail.com */

ALTER TABLE `login_records` CHANGE `login_time` `login_time` DATETIME NULL DEFAULT NULL;
ALTER TABLE `login_records` CHANGE `logout_time` `logout_time` DATETIME NULL DEFAULT NULL;