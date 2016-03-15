create table user (
id int NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
password varchar(100) NOT NULL,
create_at TIMESTAMP,
PRIMARY KEY (id)
); 

create table twitts (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id int,
message varchar(100),
image_path varchar(140) DEFAULT NULL,
create_at TIMESTAMP
); 

