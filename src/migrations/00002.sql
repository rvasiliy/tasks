create table `task` (
    `id` int(11) primary key auto_increment not null,
    `create_at` timestamp default current_timestamp() not null,
    `update_at` timestamp default current_timestamp() not null,
    `description` longtext not null,
    `status` varchar(20) default 'new' not null,
    `author` varchar(255) not null,
    `author_email` varchar(255) not null
);
