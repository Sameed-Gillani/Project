-- University Portal Database Schema
CREATE DATABASE IF NOT EXISTS university_portal_ai;
USE university_portal_ai;

-- 1. Departments Table
CREATE TABLE IF NOT EXISTS departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Courses Table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    instructor VARCHAR(255) NOT NULL,
    department_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE,
    UNIQUE KEY unique_course_dept (course_name, department_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Students Table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    department_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Enrollments Table
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_student_course (student_id, course_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Departments
INSERT IGNORE INTO departments (id, department_name) VALUES 
(1, 'Computer Science'), 
(2, 'Data Science'), 
(3, 'Financial Technology');

-- Insert Courses
INSERT IGNORE INTO courses (id, course_name, instructor, department_id) VALUES 
(1, 'Database Systems', 'Abdulwahab Tahir', 1),
(2, 'Web Engineering', 'Arsalan Khan', 2),
(3, 'Data Structures', 'Muhammad Tehaam', 1),
(4, 'Marketing Management', 'Amina Khan', 3),
(5, 'Intro to Blockchain', 'Usama Arshad', 3);

-- Insert Students
INSERT IGNORE INTO students (id, name, email, department_id) VALUES 
(1, 'Syed Mustafa', 'syedmustafa328@gmail.com', 1),
(2, 'Mahd Kazmi', 'mahdkazmi176@gmail.com', 2),
(3, 'Sameed Gillani', 'sameedgillani000@gmail.com', 3),
(4, 'Waleed Saeed', 'waleedsaeed987@gmail.com', 3),
(5, 'Umar Khalid', 'umarcheema@gmail.com', 3),
(6, 'Muhammad Abdullah', 'abdullah672@gmail.com', 2);