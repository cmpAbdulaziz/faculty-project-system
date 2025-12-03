-- Comprehensive Database Population Script
-- Faculty Project Management System
-- Usmanu Danfodiyo University Sokoto

USE faculty_projects;

-- Disable foreign key checks for easier population
SET FOREIGN_KEY_CHECKS = 0;

-- Clear existing data (optional - be careful!)
-- TRUNCATE TABLE bookings;
-- TRUNCATE TABLE proposed_topics;
-- TRUNCATE TABLE approved_topics;
-- TRUNCATE TABLE projects;
-- TRUNCATE TABLE users;
-- TRUNCATE TABLE coordinator_availability;

-- Enable foreign key checks back
SET FOREIGN_KEY_CHECKS = 1;

-- Department codes for admission numbers
-- Computer Science: 1031, Statistics: 1032, Mathematics: 1033, Geology: 1034, Physics: 1035

-- =============================================================================
-- 1. ADD MORE COORDINATORS (One for each department)
-- =============================================================================
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
('Dr. Aminu Bello', 'cs_coordinator2@udusok.edu.ng', '08011111112', 'coordinator123', 'coordinator', NULL, 1),
('Dr. Fatima Sani', 'stats_coordinator2@udusok.edu.ng', '08022222223', 'coordinator123', 'coordinator', NULL, 2),
('Dr. Chinedu Eze', 'math_coordinator2@udusok.edu.ng', '08033333334', 'coordinator123', 'coordinator', NULL, 3),
('Dr. Grace Okoro', 'geo_coordinator2@udusok.edu.ng', '08044444445', 'coordinator123', 'coordinator', NULL, 4),
('Dr. Mohammed Ibrahim', 'physics_coordinator2@udusok.edu.ng', '08055555556', 'coordinator123', 'coordinator', NULL, 5);

-- Update departments with new coordinator IDs
UPDATE departments SET coordinator_id = 8 WHERE id = 1;
UPDATE departments SET coordinator_id = 9 WHERE id = 2; 
UPDATE departments SET coordinator_id = 10 WHERE id = 3;
UPDATE departments SET coordinator_id = 11 WHERE id = 4;
UPDATE departments SET coordinator_id = 12 WHERE id = 5;

-- =============================================================================
-- 2. ADD 150 STUDENTS PER DEPARTMENT (Total: 750 students)
-- =============================================================================

-- Computer Science Students (2010310001-2010310150, 2110310001-2110310150 mixed)
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- 2020 Batch (75 students)
('Abubakar Sadiq', '2010310001@udusok.edu.ng', '0801000001', 'student123', 'student', '2010310001', 1),
('Aisha Mohammed', '2010310002@udusok.edu.ng', '0801000002', 'student123', 'student', '2010310002', 1),
('Yusuf Bello', '2010310003@udusok.edu.ng', '0801000003', 'student123', 'student', '2010310003', 1),
('Fatima Ahmed', '2010310004@udusok.edu.ng', '0801000004', 'student123', 'student', '2010310004', 1),
('Ibrahim Sani', '2010310005@udusok.edu.ng', '0801000005', 'student123', 'student', '2010310005', 1),
('Zainab Abdullahi', '2010310006@udusok.edu.ng', '0801000006', 'student123', 'student', '2010310006', 1),
('Musa Haruna', '2010310007@udusok.edu.ng', '0801000007', 'student123', 'student', '2010310007', 1),
('Hauwa Usman', '2010310008@udusok.edu.ng', '0801000008', 'student123', 'student', '2010310008', 1),
('Sani Ibrahim', '2010310009@udusok.edu.ng', '0801000009', 'student123', 'student', '2010310009', 1),
('Amina Suleiman', '2010310010@udusok.edu.ng', '0801000010', 'student123', 'student', '2010310010', 1),
-- Add 65 more 2020 CS students...
('Bashir Aliyu', '2010310075@udusok.edu.ng', '0801000075', 'student123', 'student', '2010310075', 1),

-- 2021 Batch (75 students)
('Chiamaka Nwosu', '2110310001@udusok.edu.ng', '0801000076', 'student123', 'student', '2110310001', 1),
('Emeka Okafor', '2110310002@udusok.edu.ng', '0801000077', 'student123', 'student', '2110310002', 1),
('Grace Johnson', '2110310003@udusok.edu.ng', '0801000078', 'student123', 'student', '2110310003', 1),
('Samuel David', '2110310004@udusok.edu.ng', '0801000079', 'student123', 'student', '2110310004', 1),
('Peace Michael', '2110310005@udusok.edu.ng', '0801000080', 'student123', 'student', '2110310005', 1),
('Daniel James', '2110310006@udusok.edu.ng', '0801000081', 'student123', 'student', '2110310006', 1),
('Sarah Peter', '2110310007@udusok.edu.ng', '0801000082', 'student123', 'student', '2110310007', 1),
('Joshua Thomas', '2110310008@udusok.edu.ng', '0801000083', 'student123', 'student', '2110310008', 1),
('Ruth Andrew', '2110310009@udusok.edu.ng', '0801000084', 'student123', 'student', '2110310009', 1),
('Mark Daniel', '2110310010@udusok.edu.ng', '0801000085', 'student123', 'student', '2110310010', 1);
-- Add remaining students... (in practice, you'd add all 150)

-- Statistics Students (2010320001-2010320150, 2110320001-2110320150 mixed)
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- 2020 Batch
('Adebayo Tunde', '2010320001@udusok.edu.ng', '0802000001', 'student123', 'student', '2010320001', 2),
('Chinyere Okoro', '2010320002@udusok.edu.ng', '0802000002', 'student123', 'student', '2010320002', 2),
('Oluwaseun Adeyemi', '2010320003@udusok.edu.ng', '0802000003', 'student123', 'student', '2010320003', 2),
('Ngozi Eze', '2010320004@udusok.edu.ng', '0802000004', 'student123', 'student', '2010320004', 2),
('Kolawole Bamidele', '2010320005@udusok.edu.ng', '0802000005', 'student123', 'student', '2010320005', 2),
-- Add more statistics students...

-- Mathematics Students (2010330001-2010330150, 2110330001-2110330150 mixed)
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- 2021 Batch
('John Matthews', '2110330001@udusok.edu.ng', '0803000001', 'student123', 'student', '2110330001', 3),
('Mary Calculus', '2110330002@udusok.edu.ng', '0803000002', 'student123', 'student', '2110330002', 3),
('Paul Algebra', '2110330003@udusok.edu.ng', '0803000003', 'student123', 'student', '2110330003', 3),
-- Add more mathematics students...

-- Geology Students (2010340001-2010340150, 2110340001-2110340150 mixed)
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- 2022 Batch
('Rocky Stone', '2210340001@udusok.edu.ng', '0804000001', 'student123', 'student', '2210340001', 4),
('Crystal Gem', '2210340002@udusok.edu.ng', '0804000002', 'student123', 'student', '2210340002', 4),
-- Add more geology students...

-- Physics Students (2010350001-2010350150, 2110350001-2110350150 mixed)
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- 2023 Batch
('Newton Laws', '2310350001@udusok.edu.ng', '0805000001', 'student123', 'student', '2310350001', 5),
('Einstein Theory', '2310350002@udusok.edu.ng', '0805000002', 'student123', 'student', '2310350002', 5);
-- Add more physics students...

-- =============================================================================
-- 3. ADD 50+ PROJECTS PER DEPARTMENT (Total: 250+ projects)
-- =============================================================================

-- Computer Science Projects
INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, availability_status, department_id) VALUES
('Web-Based Student Management System', 'Aliyu Mohammed', 'Dr. Ahmed Bello', 2023, 'available', 1),
('E-Commerce Platform Development', 'Fatima Sani', 'Dr. John Okoro', 2023, 'available', 1),
('Mobile Health Application', 'Chinedu Eze', 'Prof. Grace Williams', 2022, 'borrowed', 1),
('AI-Based Course Recommendation', 'Aisha Ibrahim', 'Dr. Mohammed Sani', 2023, 'booked', 1),
('Blockchain Voting System', 'Bala Yusuf', 'Dr. Smart Contract', 2022, 'available', 1),
('IoT Smart Home System', 'Zainab Abdullahi', 'Dr. Tech IoT', 2023, 'available', 1),
('Data Mining Student Performance', 'Musa Haruna', 'Dr. Data Analyst', 2022, 'available', 1),
('Cybersecurity Framework', 'Hauwa Usman', 'Dr. Security Expert', 2023, 'borrowed', 1),
('Machine Learning Fraud Detection', 'Sani Ibrahim', 'Dr. AI Specialist', 2022, 'available', 1),
('Cloud Computing Resource Management', 'Amina Suleiman', 'Dr. Cloud Architect', 2023, 'booked', 1),
('Social Media Analytics Tool', 'Bashir Aliyu', 'Dr. Social Analyst', 2022, 'available', 1),
('Virtual Reality Learning Platform', 'Chiamaka Nwosu', 'Dr. VR Developer', 2023, 'available', 1),
('Automated Attendance System', 'Emeka Okafor', 'Dr. Automation Expert', 2022, 'borrowed', 1),
('Online Examination System', 'Grace Johnson', 'Dr. Education Tech', 2023, 'available', 1),
('Library Management System', 'Samuel David', 'Dr. Library Science', 2022, 'available', 1),
-- Add 35 more CS projects...
('Big Data Analytics Platform', 'Daniel James', 'Dr. Big Data Expert', 2023, 'available', 1);

-- Statistics Projects
INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, availability_status, department_id) VALUES
('Statistical Analysis of Student Performance', 'Adebayo Tunde', 'Dr. Statistician', 2023, 'available', 2),
('Weather Pattern Prediction Model', 'Chinyere Okoro', 'Dr. Climate Expert', 2022, 'borrowed', 2),
('Economic Trend Analysis', 'Oluwaseun Adeyemi', 'Dr. Economist', 2023, 'available', 2),
('Healthcare Data Analytics', 'Ngozi Eze', 'Dr. Health Statistician', 2022, 'available', 2),
('Sports Performance Statistics', 'Kolawole Bamidele', 'Dr. Sports Analyst', 2023, 'booked', 2),
-- Add 45 more statistics projects...
('Population Growth Modeling', 'Statistics Student', 'Dr. Demographer', 2023, 'available', 2);

-- Mathematics Projects
INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, availability_status, department_id) VALUES
('Mathematical Modeling of Disease Spread', 'John Matthews', 'Dr. Mathematical Biologist', 2023, 'available', 3),
('Cryptography Algorithms Analysis', 'Mary Calculus', 'Dr. Cryptography Expert', 2022, 'borrowed', 3),
('Financial Mathematics Applications', 'Paul Algebra', 'Dr. Financial Mathematician', 2023, 'available', 3),
-- Add 47 more mathematics projects...
('Number Theory Applications', 'Math Student', 'Dr. Number Theorist', 2023, 'available', 3);

-- Geology Projects
INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, availability_status, department_id) VALUES
('Mineral Exploration Techniques', 'Rocky Stone', 'Dr. Geologist', 2023, 'available', 4),
('Groundwater Quality Analysis', 'Crystal Gem', 'Dr. Hydrogeologist', 2022, 'borrowed', 4),
-- Add 48 more geology projects...
('Seismic Risk Assessment', 'Geology Student', 'Dr. Seismologist', 2023, 'available', 4);

-- Physics Projects
INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, availability_status, department_id) VALUES
('Renewable Energy Systems', 'Newton Laws', 'Dr. Energy Physicist', 2023, 'available', 5),
('Quantum Computing Applications', 'Einstein Theory', 'Dr. Quantum Physicist', 2022, 'borrowed', 5);
-- Add 48 more physics projects...

-- =============================================================================
-- 4. CREATE REALISTIC BOOKINGS, BORROWINGS, AND RETURNS
-- =============================================================================

-- Computer Science Bookings (Mixed statuses)
INSERT INTO bookings (project_id, student_id, booking_status, booked_at, expires_at, collected_at, due_date, returned_at) VALUES
-- Pending bookings (will expire)
(3, 13, 'pending', DATE_SUB(NOW(), INTERVAL 1 HOUR), DATE_ADD(NOW(), INTERVAL 1 HOUR), NULL, NULL, NULL),
(4, 14, 'pending', DATE_SUB(NOW(), INTERVAL 30 MINUTE), DATE_ADD(NOW(), INTERVAL 90 MINUTE), NULL, NULL, NULL),

-- Collected/borrowed projects
(1, 15, 'collected', DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY), DATE_ADD(NOW(), INTERVAL 5 DAY), NULL),
(8, 16, 'collected', DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 23 HOUR), DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_ADD(NOW(), INTERVAL 6 DAY), NULL),

-- Returned projects
(2, 17, 'returned', DATE_SUB(NOW(), INTERVAL 10 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 10 DAY), DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY)),
(5, 18, 'returned', DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 13 DAY), DATE_SUB(NOW(), INTERVAL 15 DAY), DATE_SUB(NOW(), INTERVAL 8 DAY), DATE_SUB(NOW(), INTERVAL 7 DAY)),

-- Expired bookings
(6, 19, 'expired', DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), NULL, NULL, NULL);

-- Statistics Bookings
INSERT INTO bookings (project_id, student_id, booking_status, booked_at, expires_at, collected_at, due_date, returned_at) VALUES
(26, 163, 'collected', DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_SUB(NOW(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 3 DAY), DATE_ADD(NOW(), INTERVAL 4 DAY), NULL),
(27, 164, 'pending', DATE_SUB(NOW(), INTERVAL 2 HOUR), DATE_ADD(NOW(), INTERVAL 2 HOUR), NULL, NULL, NULL);

-- Add more bookings for other departments...

-- =============================================================================
-- 5. CREATE TOPIC PROPOSALS WITH APPROVALS/REJECTIONS
-- =============================================================================

-- Computer Science Topic Proposals
INSERT INTO proposed_topics (title, case_study, student_id, supervisor_name, problem_statement, topic_objectives, status, department_id) VALUES
-- Pending proposals
('AI-Powered Tutoring System', 'Computer Science Department', 13, 'Dr. AI Expert', 'Students need personalized learning...', 'Develop AI system that adapts to student learning styles...', 'pending', 1),
('Blockchain for Academic Records', 'University Administration', 14, 'Dr. Blockchain Specialist', 'Academic records are vulnerable to tampering...', 'Create secure blockchain system for academic records...', 'pending', 1),

-- Approved proposals
('Smart Campus Navigation', 'UDUS Main Campus', 15, 'Dr. Mobile Developer', 'New students struggle to navigate campus...', 'Develop mobile app with indoor navigation...', 'approved', 1),
('Automated Essay Scoring', 'Faculty of Science', 16, 'Dr. NLP Specialist', 'Manual essay grading is time-consuming...', 'Create AI system for automated essay evaluation...', 'approved', 1),

-- Rejected proposals
('Social Media Clone', 'General Application', 17, 'Dr. Web Developer', 'Existing social media platforms have limitations...', 'Build new social media platform with unique features...', 'rejected', 1),
('Simple Calculator App', 'Basic Programming', 18, 'Dr. App Developer', 'Many calculator apps exist but...', 'Create another calculator application...', 'rejected', 1);

-- Statistics Topic Proposals
INSERT INTO proposed_topics (title, case_study, student_id, supervisor_name, problem_statement, topic_objectives, status, department_id) VALUES
('Statistical Analysis of COVID-19 Spread', 'Sokoto State', 163, 'Dr. Health Statistician', 'Understanding disease spread patterns...', 'Analyze COVID-19 data and build prediction models...', 'approved', 2),
('Student Performance Correlation', 'Faculty of Science', 164, 'Dr. Educational Statistician', 'Identifying factors affecting student performance...', 'Find correlation between attendance and grades...', 'pending', 2);

-- Add more topic proposals for other departments...

-- =============================================================================
-- 6. CREATE APPROVED TOPICS
-- =============================================================================

-- Computer Science Approved Topics
INSERT INTO approved_topics (title, case_study, student_id, supervisor_name, date_of_approval, department_id) VALUES
('Smart Campus Navigation', 'UDUS Main Campus', 15, 'Dr. Mobile Developer', '2024-01-15', 1),
('Automated Essay Scoring', 'Faculty of Science', 16, 'Dr. NLP Specialist', '2024-01-20', 1),
('IoT-Based Classroom Management', 'Computer Science Department', 19, 'Dr. IoT Expert', '2024-02-01', 1);

-- Statistics Approved Topics
INSERT INTO approved_topics (title, case_study, student_id, supervisor_name, date_of_approval, department_id) VALUES
('Statistical Analysis of COVID-19 Spread', 'Sokoto State', 163, 'Dr. Health Statistician', '2024-01-18', 2);

-- Add more approved topics for other departments...

-- =============================================================================
-- 7. SET COORDINATOR AVAILABILITY
-- =============================================================================

INSERT INTO coordinator_availability (coordinator_id, status) VALUES
(8, 'available'),  -- CS Coordinator
(9, 'unavailable'), -- Stats Coordinator
(10, 'available'),  -- Math Coordinator
(11, 'unavailable'), -- Geology Coordinator
(12, 'available');  -- Physics Coordinator

-- =============================================================================
-- 8. SUSPEND SOME STUDENTS FOR TESTING
-- =============================================================================

UPDATE users SET is_suspended = TRUE WHERE id IN (20, 21, 165, 166, 320, 321);

-- =============================================================================
-- VERIFICATION QUERIES
-- =============================================================================

-- Check total counts
SELECT 'Users' as type, COUNT(*) as count FROM users
UNION ALL
SELECT 'Projects', COUNT(*) FROM projects
UNION ALL
SELECT 'Bookings', COUNT(*) FROM bookings
UNION ALL
SELECT 'Proposed Topics', COUNT(*) FROM proposed_topics
UNION ALL
SELECT 'Approved Topics', COUNT(*) FROM approved_topics;

-- Check department-wise counts
SELECT d.name as department, 
       COUNT(DISTINCT u.id) as students,
       COUNT(DISTINCT p.id) as projects,
       COUNT(DISTINCT b.id) as bookings,
       COUNT(DISTINCT pt.id) as proposed_topics,
       COUNT(DISTINCT at.id) as approved_topics
FROM departments d
LEFT JOIN users u ON d.id = u.department_id AND u.role = 'student'
LEFT JOIN projects p ON d.id = p.department_id
LEFT JOIN bookings b ON p.id = b.project_id
LEFT JOIN proposed_topics pt ON d.id = pt.department_id
LEFT JOIN approved_topics at ON d.id = at.department_id
GROUP BY d.id, d.name;

-- Check booking status distribution
SELECT booking_status, COUNT(*) as count 
FROM bookings 
GROUP BY booking_status;

-- Check topic proposal status distribution
SELECT status, COUNT(*) as count 
FROM proposed_topics 
GROUP BY status;