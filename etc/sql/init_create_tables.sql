create table if not exists `session` (
    `session_id`    varchar(128) primary key,
    `session_value` text not null,
    `session_time`  int(11) not null
) engine=InnoDB default charset=utf8mb4;

create table if not exists `users` (
    `id`                         int auto_increment primary key,
    `nickname`                   varchar(255) not null,
    `profile_image_url`          varchar(255),
    `twitter_user_id`            int unique,
    `twitter_oauth_token`        varchar(255),
    `twitter_oauth_token_secret` varchar(255),
    `created_at`                 datetime,
    `updated_at`                 datetime,
    index idx_twitter (twitter_user_id)
) engine=InnoDB default charset=utf8mb4;
