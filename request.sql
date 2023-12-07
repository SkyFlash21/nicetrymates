CREATE DATABASE IF NOT EXISTS nicetrymates;
USE nicetrymates;

-- Create users table
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hashedpassword VARCHAR(255) NOT NULL,
    lastconnection DATETIME,
    token VARCHAR(255)
);


CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS answers;
CREATE TABLE answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    answer VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    question_id INT NOT NULL
);

-- Generate 5 questions
INSERT INTO questions (question, description) VALUES
    ('What is your favorite color?', 'Please choose one color.'),
    ('What is your favorite food?', 'Please specify your favorite dish.'),
    ('What is your favorite movie?', 'Please provide the title of the movie.'),
    ('What is your favorite hobby?', 'Please describe your favorite activity.'),
    ('What is your favorite book?', 'Please mention the title of the book.');

-- Generate 3 answers for each question
INSERT INTO answers (answer, description, question_id) VALUES
    ('Red', 'The color red.', 0),
    ('Blue', 'The color blue.', 0),
    ('Green', 'The color green.', 0),
    ('Pizza', 'A delicious Italian dish.', 1),
    ('Sushi', 'A Japanese delicacy.', 1),
    ('Burger', 'A classic American favorite.', 1),
    ('The Shawshank Redemption', 'A critically acclaimed drama film.', 2),
    ('The Godfather', 'A classic crime film.', 2),
    ('Pulp Fiction', 'A Quentin Tarantino masterpiece.', 2),
    ('Playing sports', 'Engaging in physical activities.', 3),
    ('Reading books', 'Exploring different worlds through literature.', 3),
    ('Painting', 'Expressing creativity through art.', 3),
    ('To Kill a Mockingbird', 'A classic novel by Harper Lee.', 4),
    ('1984', 'A dystopian novel by George Orwell.', 4),
    ('The Great Gatsby', 'A literary masterpiece by F. Scott Fitzgerald.', 4);
