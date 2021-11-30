create database `shopping_db` default character set utf8 collate utf8_unicode_ci;

use shopping_db;

create table nhomsanpham
(
    id int primary key not null auto_increment,
    ten varchar(100) not null unique,
    mota varchar(255),
    anh varchar(255),
    trangthai tinyint(1) default '1',
    uutien tinyint default '0',
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp
);

create table sanpham
(
    id int primary key not null auto_increment,
    ten varchar(100) not null unique,
    mota varchar(255),
    gia float(9,3) not null,
    giaban float(9,3) default '0',
    anh varchar(255),
    danhsachanh text,
    trangthai tinyint(1) default '1',
    uutien tinyint default '0',
    nhomsanphamid int not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    foreign key (nhomsanphamid) references nhomsanpham (id)
);

create table `order`
(
    id int primary key auto_increment,
    ten varchar(100) not null,
    mota varchar(255),
    email varchar(100) not null,
    phone varchar(100) not null,
    diachi varchar(255) null,
    trangthai tinyint(1) default '1',
    users_id bigint unsigned not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    foreign key (users_id) references users (id)
);

create table order_detail
(
    order_id int not null,
    sanpham_id int not null,
    soluong int not null,
    gia float(9,3) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp,
    foreign key (order_id) references `order` (id),
    foreign key (sanpham_id) references sanpham (id)
);

insert into nhomsanpham(ten) values
('Điện thoại'),
('Máy tính'),
('Ti vi'),
('Đồng hồ'),
('Quần áo'),
('Túi xách'),
('Vòng tay'),
('Tủ lạnh');

insert into sanpham(ten, gia, nhomsanphamid) values
('Iphone', 20, 1),
('Macbook', 30, 2),
('Samsung galaxy', 22, 1);

