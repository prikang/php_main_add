CREATE TABLE users (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(200),
    Email VARCHAR(200),
    Age INT,
    Password VARCHAR(200)
);

CREATE TABLE notes (
    sno INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    title VARCHAR(50),
    description TEXT,
    tstamp DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(Id)
);
