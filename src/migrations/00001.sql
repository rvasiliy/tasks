create table `user` (
    `id` int(11) primary key auto_increment not null,
    `create_at` timestamp default current_timestamp() not null,
    `name` varchar(100) not null,
    `email` varchar(255) not null,
    `password` varchar(255) not null,
    `is_admin` bit default 0 not null
);
