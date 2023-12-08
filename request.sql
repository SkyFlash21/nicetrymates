CREATE DATABASE IF NOT EXISTS nicetrymates;
USE nicetrymates;

-- Create users table
DROP TABLE IF EXISTS user_answers;
DROP TABLE IF EXISTS answers;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hashedpassword VARCHAR(255) NOT NULL,
    lastconnection DATETIME,
    connectiontoken VARCHAR(255),
    lastquestion_id INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    image VARCHAR(255)
);

CREATE TABLE answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    answer VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    question_id INT NOT NULL,
    point_value INT NOT NULL,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS user_answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    question_id INT NOT NULL,
    answer_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (answer_id) REFERENCES answers(id) ON DELETE CASCADE
);


-- Generate 5 questions
INSERT INTO questions (question, description) VALUES
    ('What is your favorite color?', 'Please choose one color.'),
    ('What is your favorite food?', 'Please specify your favorite dish.'),
    ('What is your favorite movie?', 'Please provide the title of the movie.'),
    ('What is your favorite hobby?', 'Please describe your favorite activity.'),
    ('What is your favorite book?', 'Please mention the title of the book.');

-- Generate 3 answers for each question
INSERT INTO answers (answer, description, question_id, point_value) VALUES
    ('Red', 'The color red.', 1, -1),
    ('Blue', 'The color blue.', 1, -1),
    ('Green', 'The color green.', 1, 1),
    ('Pizza', 'A delicious pizza.', 2, -1),
    ('Burger', 'A tasty burger.', 2, -1),
    ('Sushi', 'Fresh sushi rolls.', 2, 1),
    ('The Shawshank Redemption', 'A classic movie.', 3, -1),
    ('The Godfather', 'An iconic film.', 3, -1),
    ('Pulp Fiction', 'A Quentin Tarantino masterpiece.', 3, 1),
    ('Reading', 'Enjoying a good book.', 4, -1),
    ('Playing sports', 'Engaging in physical activities.', 4, -1),
    ('Painting', 'Expressing creativity through art.', 4, 1),
    ('To Kill a Mockingbird', 'A literary classic.', 5, -1),
    ('1984', 'A dystopian novel.', 5, -1),
    ('The Great Gatsby', 'A tale of the Jazz Age.', 5, 1);
    
