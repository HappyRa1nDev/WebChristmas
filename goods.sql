INSERT INTO goods (`name`, `price`, `description`, `image`)
VALUES
('Шоколадный дед мороз', 100, 'description 1','static/img/product-2.png'),
('Новогодняя Ёлка', 9900, 'description 2','static/img/product-3.jpg'),
('Сладкая коробка', 600, 'description 3','static/img/product-4.jpg'),
('Фигурка деда мороза', 2000, 'description 4','static/img/product-5.jpg'),
('Новогодний шар', 3000, 'description 5','static/img/product-6.jpg'),
('Шар на елку', 300, 'description 6','static/img/product-7.jpg'),
('Мишура', 120, 'description 7','static/img/product-8.jpg'),
('Гирлянда \"Лампочки\"', 1200, 'description 8','static/img/product-9.jpg'),
('Новогоднее шампанское', 240, 'description 9','static/img/product-10.jpg'),
('Коробка конфет', 250, 'description 10','static/img/product-11.jpg'),
('Подарок \"Сюрприз\"', 900, 'description 11','static/img/product-12.jpg'),
('Звезда на Елку', 400 , 'description 12','static/img/product-13.jpg'),
('Шапка новогодняя', 600, 'description 13','static/img/product-14.jpg'),
('Бенгальские огни', 100, 'description 14', 'static/img/product-15.jpg'),
('Хлопушка', 80, 'description 15','static/img/product-16.png')


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    salt VARCHAR(64) NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE
);

CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    goods_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (goods_id) REFERENCES goods(id) ON DELETE CASCADE
);

//получить товары через связанную таблицу
SELECT * FROM goods JOIN carts ON goods.id = carts.goods_id WHERE carts.user_id = 6;