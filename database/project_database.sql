-- faculty_projects_simple.sql
CREATE DATABASE IF NOT EXISTS faculty_projects CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE faculty_projects;

-- Departments (1 coordinator per department)
CREATE TABLE departments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL UNIQUE,
  coordinator_id INT UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Users: students and coordinators (Simple passwords for now)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  phone_number VARCHAR(150) NOT NULL,
  password VARCHAR(255) NOT NULL, -- Simple text passwords for testing
  role ENUM('student', 'coordinator') NOT NULL DEFAULT 'student',
  admission_no VARCHAR(50) UNIQUE,
  department_id INT NOT NULL,
  is_suspended BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
);

-- Now add foreign key after users table exists
ALTER TABLE departments ADD FOREIGN KEY (coordinator_id) REFERENCES users(id) ON DELETE SET NULL;

-- Projects
CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  student_name VARCHAR(255) NOT NULL,
  supervisor_name VARCHAR(255) NOT NULL,
  year_of_submission YEAR,
  availability_status ENUM('available', 'borrowed', 'booked') NOT NULL DEFAULT 'available',
  department_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE
);

-- Bookings
CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  project_id INT NOT NULL,
  student_id INT NOT NULL,
  booking_status ENUM('pending', 'collected', 'expired', 'returned') NOT NULL DEFAULT 'pending',
  booked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  expires_at DATETIME NOT NULL,
  collected_at DATETIME NULL,
  due_date DATETIME NULL,
  returned_at DATETIME NULL,
  FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Proposed Topics
CREATE TABLE proposed_topics (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  case_study VARCHAR(255),
  student_id INT NOT NULL,
  supervisor_name VARCHAR(255) NOT NULL,
  problem_statement TEXT NOT NULL,
  topic_objectives TEXT NOT NULL,
  status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
  department_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Approved Topics
CREATE TABLE approved_topics (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  case_study VARCHAR(255),
  student_id INT NOT NULL,
  supervisor_name VARCHAR(255) NOT NULL,
  date_of_approval DATE,
  department_id INT NOT NULL,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Coordinator Availability
CREATE TABLE coordinator_availability (
  id INT AUTO_INCREMENT PRIMARY KEY,
  coordinator_id INT NOT NULL UNIQUE,
  status ENUM('available', 'unavailable') NOT NULL DEFAULT 'unavailable',
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (coordinator_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert departments first
INSERT INTO departments (name) VALUES
('Computer Science'),
('Statistics'),
('Mathematics'),
('Geology'),
('Physics');

-- Insert users with simple passwords
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- Coordinators (password: coordinator123)
('Dr. Computer Science Coordinator', 'cs_coordinator@udusok.edu.ng', '08011111111', 'coordinator123', 'coordinator', NULL, 1),
('Dr. Statistics Coordinator', 'stats_coordinator@udusok.edu.ng', '08022222222', 'coordinator123', 'coordinator', NULL, 2),
('Dr. Mathematics Coordinator', 'math_coordinator@udusok.edu.ng', '08033333333', 'coordinator123', 'coordinator', NULL, 3),
('Dr. Geology Coordinator', 'geo_coordinator@udusok.edu.ng', '08044444444', 'coordinator123', 'coordinator', NULL, 4),
('Dr. Physics Coordinator', 'physics_coordinator@udusok.edu.ng', '08055555555', 'coordinator123', 'coordinator', NULL, 5),
-- Students (password: student123)
('Test CS Student', 'cs_student@udusok.edu.ng', '08066666666', 'student123', 'student', 'UGP/CS/2020/001', 1),
('Test Stats Student', 'stats_student@udusok.edu.ng', '08077777777', 'student123', 'student', 'UGP/STAT/2020/001', 2);

-- Update departments with coordinator IDs
UPDATE departments SET coordinator_id = 1 WHERE id = 1;
UPDATE departments SET coordinator_id = 2 WHERE id = 2;
UPDATE departments SET coordinator_id = 3 WHERE id = 3;
UPDATE departments SET coordinator_id = 4 WHERE id = 4;
UPDATE departments SET coordinator_id = 5 WHERE id = 5;

-- Sample data for testing
INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, department_id) VALUES
('Web-Based Student Management System', 'Aliyu Mohammed', 'Dr. Ahmed Bello', 2023, 1),
('Data Analysis of Student Performance', 'Fatima Sani', 'Dr. John Okoro', 2023, 2);

INSERT INTO proposed_topics (title, case_study, student_id, supervisor_name, problem_statement, topic_objectives, department_id) VALUES
('AI-Based Course Recommendation System', 'Computer Science Department', 6, 'Dr. Smart AI', 'Students struggle to choose appropriate courses...', 'Develop AI system to recommend courses...', 1);

INSERT INTO coordinator_availability (coordinator_id, status) VALUES
(1, 'unavailable'), (2, 'unavailable'), (3, 'unavailable'), (4, 'unavailable'), (5, 'unavailable');