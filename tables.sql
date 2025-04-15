USE task_db;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(60) NOT NULL,
    lastname VARCHAR(60) NOT NULL,
    email VARCHAR(120) NOT NULL,
    `password` VARCHAR(90) NOT NULL
);

CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    task TEXT NOT NULL,
    `status` ENUM('done', 'in progress', 'not started') DEFAULT 'not started',
    duedate DATE NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
