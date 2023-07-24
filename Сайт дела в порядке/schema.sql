/* таблица данных о пользователях*/
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(255) UNIQUE NOT NULL,
    users_name VARCHAR(255) NOT NULL,
    users_password VARCHAR(50)
);

/*таблица данных о проектах*/
CREATE TABLE Projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name_projects VARCHAR(255) NOT NULL,
    Users_id INT,
    FOREIGN KEY (users_id) REFERENCES Users (id),
    UNIQUE index (users_id, name_projects)
);

/*таблица данных о задачах*/
CREATE TABLE Tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status_tasks BOOLEAN,
    name_tasks VARCHAR(255) NOT NULL,
    random_file VARCHAR(255),
    projects_id INT NOT NULL,
    end_time DATETIME,
    FOREIGN KEY (projects_id) REFERENCES Projects (id),
    index(name_tasks)
);
