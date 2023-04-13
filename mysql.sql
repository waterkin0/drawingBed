create database image;

create table image_address
(
id int auto_increment comment 'id',
title varchar(20) not null comment'名称',
address text not null comment'地址',
addtime varchar(20) not null comment'时间',
primary key(id)
)
charset = utf8;

insert into image_address
(title, address, addtime)
values
('1', '/image/1.jpg', NOW())

insert into image_address
(title, address, addtime)
values
('cookie!session!token!', '/blogs_images/cookie!session!token!.jpg', NOW())

ALTER TABLE image_address MODIFY title varchar(50);