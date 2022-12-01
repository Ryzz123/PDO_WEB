CREATE DATABASE ecomerc;

CREATE TABLE product (
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL ,
    category VARCHAR(255) NOT NULL ,
    harga INT NOT NULL ,
    desc_product VARCHAR(500) NOT NULL ,
    ctreated_at DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    gambar VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE =  InnoDB;

DESC product;

ALTER TABLE product
ADD ctreated_at DATE NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE product
ADD gambar VARCHAR(255) NOT NULL ;

SELECT * FROM product;

INSERT INTO product(nama, category, harga, desc_product,gambar) VALUES ('lampu','elektronik',20000,'tes aja','https://');