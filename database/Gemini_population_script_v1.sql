-- Additional Data Population Script (50+ records per table)
-- Context: Faculty Project Management System
USE faculty_projects;

-- =============================================================================
-- 1. BATCH INSERT: 50 NEW STUDENTS
-- =============================================================================
-- We use a loop-like structure using UNION ALL for bulk insertion clarity.
-- Note: We assign them randomly to departments (1-5)
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES 
('Zainab Aliyu', 'zainab.aliyu.extra1@udusok.edu.ng', '08100000001', 'student123', 'student', 'EXT/2023/001', 1),
('Musa Ibrahim', 'musa.ibrahim.extra2@udusok.edu.ng', '08100000002', 'student123', 'student', 'EXT/2023/002', 2),
('Chinwe Obi', 'chinwe.obi.extra3@udusok.edu.ng', '08100000003', 'student123', 'student', 'EXT/2023/003', 3),
('David Okeke', 'david.okeke.extra4@udusok.edu.ng', '08100000004', 'student123', 'student', 'EXT/2023/004', 4),
('Fatima Yusuf', 'fatima.yusuf.extra5@udusok.edu.ng', '08100000005', 'student123', 'student', 'EXT/2023/005', 5),
('Samuel Adebayo', 'samuel.ade.extra6@udusok.edu.ng', '08100000006', 'student123', 'student', 'EXT/2023/006', 1),
('Grace Okafor', 'grace.okafor.extra7@udusok.edu.ng', '08100000007', 'student123', 'student', 'EXT/2023/007', 2),
('Bilal Haruna', 'bilal.haruna.extra8@udusok.edu.ng', '08100000008', 'student123', 'student', 'EXT/2023/008', 3),
('Esther Sunday', 'esther.sun.extra9@udusok.edu.ng', '08100000009', 'student123', 'student', 'EXT/2023/009', 4),
('Kabir Mohammed', 'kabir.moh.extra10@udusok.edu.ng', '08100000010', 'student123', 'student', 'EXT/2023/010', 5),
('Amina Bello', 'amina.bello.extra11@udusok.edu.ng', '08100000011', 'student123', 'student', 'EXT/2023/011', 1),
('Joseph Eze', 'joseph.eze.extra12@udusok.edu.ng', '08100000012', 'student123', 'student', 'EXT/2023/012', 2),
('Sadiq Umar', 'sadiq.umar.extra13@udusok.edu.ng', '08100000013', 'student123', 'student', 'EXT/2023/013', 3),
('Blessing John', 'blessing.john.extra14@udusok.edu.ng', '08100000014', 'student123', 'student', 'EXT/2023/014', 4),
('Gideon Paul', 'gideon.paul.extra15@udusok.edu.ng', '08100000015', 'student123', 'student', 'EXT/2023/015', 5),
('Hassan Sani', 'hassan.sani.extra16@udusok.edu.ng', '08100000016', 'student123', 'student', 'EXT/2023/016', 1),
('Victor Moses', 'victor.moses.extra17@udusok.edu.ng', '08100000017', 'student123', 'student', 'EXT/2023/017', 2),
('Mary Danjuma', 'mary.danjuma.extra18@udusok.edu.ng', '08100000018', 'student123', 'student', 'EXT/2023/018', 3),
('Usman Abubakar', 'usman.abu.extra19@udusok.edu.ng', '08100000019', 'student123', 'student', 'EXT/2023/019', 4),
('Joy Peters', 'joy.peters.extra20@udusok.edu.ng', '08100000020', 'student123', 'student', 'EXT/2023/020', 5),
('Solomon King', 'solomon.king.extra21@udusok.edu.ng', '08100000021', 'student123', 'student', 'EXT/2023/021', 1),
('Rukayya Shehu', 'rukayya.shehu.extra22@udusok.edu.ng', '08100000022', 'student123', 'student', 'EXT/2023/022', 2),
('Peter Pan', 'peter.pan.extra23@udusok.edu.ng', '08100000023', 'student123', 'student', 'EXT/2023/023', 3),
('Sarah Connor', 'sarah.connor.extra24@udusok.edu.ng', '08100000024', 'student123', 'student', 'EXT/2023/024', 4),
('Tony Stark', 'tony.stark.extra25@udusok.edu.ng', '08100000025', 'student123', 'student', 'EXT/2023/025', 5),
('Bruce Wayne', 'bruce.wayne.extra26@udusok.edu.ng', '08100000026', 'student123', 'student', 'EXT/2023/026', 1),
('Clark Kent', 'clark.kent.extra27@udusok.edu.ng', '08100000027', 'student123', 'student', 'EXT/2023/027', 2),
('Diana Prince', 'diana.prince.extra28@udusok.edu.ng', '08100000028', 'student123', 'student', 'EXT/2023/028', 3),
('Barry Allen', 'barry.allen.extra29@udusok.edu.ng', '08100000029', 'student123', 'student', 'EXT/2023/029', 4),
('Hal Jordan', 'hal.jordan.extra30@udusok.edu.ng', '08100000030', 'student123', 'student', 'EXT/2023/030', 5),
('Arthur Curry', 'arthur.curry.extra31@udusok.edu.ng', '08100000031', 'student123', 'student', 'EXT/2023/031', 1),
('Victor Stone', 'victor.stone.extra32@udusok.edu.ng', '08100000032', 'student123', 'student', 'EXT/2023/032', 2),
('Billy Batson', 'billy.batson.extra33@udusok.edu.ng', '08100000033', 'student123', 'student', 'EXT/2023/033', 3),
('Carter Hall', 'carter.hall.extra34@udusok.edu.ng', '08100000034', 'student123', 'student', 'EXT/2023/034', 4),
('Shiera Sanders', 'shiera.sanders.extra35@udusok.edu.ng', '08100000035', 'student123', 'student', 'EXT/2023/035', 5),
('Ray Palmer', 'ray.palmer.extra36@udusok.edu.ng', '08100000036', 'student123', 'student', 'EXT/2023/036', 1),
('Oliver Queen', 'oliver.queen.extra37@udusok.edu.ng', '08100000037', 'student123', 'student', 'EXT/2023/037', 2),
('Dinah Lance', 'dinah.lance.extra38@udusok.edu.ng', '08100000038', 'student123', 'student', 'EXT/2023/038', 3),
('Wally West', 'wally.west.extra39@udusok.edu.ng', '08100000039', 'student123', 'student', 'EXT/2023/039', 4),
('John Stewart', 'john.stewart.extra40@udusok.edu.ng', '08100000040', 'student123', 'student', 'EXT/2023/040', 5),
('Kyle Rayner', 'kyle.rayner.extra41@udusok.edu.ng', '08100000041', 'student123', 'student', 'EXT/2023/041', 1),
('Guy Gardner', 'guy.gardner.extra42@udusok.edu.ng', '08100000042', 'student123', 'student', 'EXT/2023/042', 2),
('Jessica Cruz', 'jessica.cruz.extra43@udusok.edu.ng', '08100000043', 'student123', 'student', 'EXT/2023/043', 3),
('Simon Baz', 'simon.baz.extra44@udusok.edu.ng', '08100000044', 'student123', 'student', 'EXT/2023/044', 4),
('Alan Scott', 'alan.scott.extra45@udusok.edu.ng', '08100000045', 'student123', 'student', 'EXT/2023/045', 5),
('Jay Garrick', 'jay.garrick.extra46@udusok.edu.ng', '08100000046', 'student123', 'student', 'EXT/2023/046', 1),
('Ted Grant', 'ted.grant.extra47@udusok.edu.ng', '08100000047', 'student123', 'student', 'EXT/2023/047', 2),
('Kent Nelson', 'kent.nelson.extra48@udusok.edu.ng', '08100000048', 'student123', 'student', 'EXT/2023/048', 3),
('Rex Tyler', 'rex.tyler.extra49@udusok.edu.ng', '08100000049', 'student123', 'student', 'EXT/2023/049', 4),
('Al Pratt', 'al.pratt.extra50@udusok.edu.ng', '08100000050', 'student123', 'student', 'EXT/2023/050', 5);

-- =============================================================================
-- 2. BATCH INSERT: 50 NEW PROJECTS
-- =============================================================================
INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, availability_status, department_id) VALUES
('Automated Library Archiving', 'Pending Assignment', 'Dr. Archive', 2023, 'available', 1),
('Machine Learning in Agriculture', 'Pending Assignment', 'Dr. AgroTech', 2023, 'available', 1),
('Network Security Protocols', 'Pending Assignment', 'Dr. NetSec', 2022, 'available', 1),
('Database Optimization Techniques', 'Pending Assignment', 'Dr. DB Admin', 2023, 'available', 1),
('5G Network Simulation', 'Pending Assignment', 'Dr. Telecom', 2023, 'available', 1),
('Ethical Hacking Frameworks', 'Pending Assignment', 'Dr. Cyber', 2022, 'available', 1),
('Natural Language Processing for Hausa', 'Pending Assignment', 'Dr. Linguistics', 2023, 'available', 1),
('Computer Vision for Traffic Control', 'Pending Assignment', 'Dr. Vision', 2023, 'available', 1),
('Robotics in Healthcare', 'Pending Assignment', 'Dr. Robot', 2022, 'available', 1),
('Blockchain in Supply Chain', 'Pending Assignment', 'Dr. Chain', 2023, 'available', 1),
-- Statistics (Dept 2)
('Bayesian Inference Models', 'Pending Assignment', 'Dr. Bayes', 2023, 'available', 2),
('Time Series Analysis of Stock Market', 'Pending Assignment', 'Dr. Market', 2022, 'available', 2),
('Multivariate Analysis of Census Data', 'Pending Assignment', 'Dr. Census', 2023, 'available', 2),
('Probability Distributions in Genetics', 'Pending Assignment', 'Dr. Gene', 2023, 'available', 2),
('Statistical Quality Control', 'Pending Assignment', 'Dr. Quality', 2022, 'available', 2),
('Regression Analysis of Rainfall', 'Pending Assignment', 'Dr. Climate', 2023, 'available', 2),
('Hypothesis Testing in Pharmacology', 'Pending Assignment', 'Dr. Pharma', 2023, 'available', 2),
('Stochastic Processes', 'Pending Assignment', 'Dr. Stoch', 2022, 'available', 2),
('Demographic Transitions', 'Pending Assignment', 'Dr. Demo', 2023, 'available', 2),
('Biostatistics in Epidemiology', 'Pending Assignment', 'Dr. Epi', 2023, 'available', 2),
-- Mathematics (Dept 3)
('Differential Equations in Engineering', 'Pending Assignment', 'Dr. DiffEq', 2023, 'available', 3),
('Graph Theory Optimization', 'Pending Assignment', 'Dr. Graph', 2022, 'available', 3),
('Linear Algebra in Computer Graphics', 'Pending Assignment', 'Dr. Linear', 2023, 'available', 3),
('Numerical Analysis of Fluids', 'Pending Assignment', 'Dr. Fluid', 2023, 'available', 3),
('Topology and Space', 'Pending Assignment', 'Dr. Space', 2022, 'available', 3),
('Abstract Algebra Structures', 'Pending Assignment', 'Dr. Abstract', 2023, 'available', 3),
('Calculus of Variations', 'Pending Assignment', 'Dr. Calc', 2023, 'available', 3),
('Mathematical Logic', 'Pending Assignment', 'Dr. Logic', 2022, 'available', 3),
('Chaos Theory', 'Pending Assignment', 'Dr. Chaos', 2023, 'available', 3),
('Combinatorics and Probability', 'Pending Assignment', 'Dr. Combo', 2023, 'available', 3),
-- Geology (Dept 4)
('Sedimentary Basins of Sokoto', 'Pending Assignment', 'Dr. Sediment', 2023, 'available', 4),
('Petroleum Geology', 'Pending Assignment', 'Dr. Petrol', 2022, 'available', 4),
('Mineralogy of Northern Nigeria', 'Pending Assignment', 'Dr. Mineral', 2023, 'available', 4),
('Geophysics in Construction', 'Pending Assignment', 'Dr. GeoPhys', 2023, 'available', 4),
('Environmental Geochemistry', 'Pending Assignment', 'Dr. ChemGeo', 2022, 'available', 4),
('Structural Geology Mapping', 'Pending Assignment', 'Dr. Structure', 2023, 'available', 4),
('Hydrogeology of Aquifers', 'Pending Assignment', 'Dr. Aqua', 2023, 'available', 4),
('Remote Sensing in Geology', 'Pending Assignment', 'Dr. Remote', 2022, 'available', 4),
('Volcanology Studies', 'Pending Assignment', 'Dr. Volcano', 2023, 'available', 4),
('Paleontology and Fossils', 'Pending Assignment', 'Dr. Fossil', 2023, 'available', 4),
-- Physics (Dept 5)
('Solid State Physics', 'Pending Assignment', 'Dr. Solid', 2023, 'available', 5),
('Nuclear Physics Applications', 'Pending Assignment', 'Dr. Nuclear', 2022, 'available', 5),
('Optics and Lasers', 'Pending Assignment', 'Dr. Laser', 2023, 'available', 5),
('Thermodynamics of Engines', 'Pending Assignment', 'Dr. Thermo', 2023, 'available', 5),
('Astrophysics and Stars', 'Pending Assignment', 'Dr. Astro', 2022, 'available', 5),
('Electromagnetism Simulations', 'Pending Assignment', 'Dr. Electro', 2023, 'available', 5),
('Nanotechnology', 'Pending Assignment', 'Dr. Nano', 2023, 'available', 5),
('Plasma Physics', 'Pending Assignment', 'Dr. Plasma', 2022, 'available', 5),
('Geophysics', 'Pending Assignment', 'Dr. Geo', 2023, 'available', 5),
('Medical Physics Imaging', 'Pending Assignment', 'Dr. MedPhys', 2023, 'available', 5);

-- =============================================================================
-- 3. BATCH INSERT: 50 BOOKINGS (Using Dynamic SQL)
-- =============================================================================
-- This inserts bookings by dynamically pairing the newest projects with students.
-- We use modulo arithmetic on IDs to distribute them somewhat randomly.
INSERT INTO bookings (project_id, student_id, booking_status, expires_at, due_date)
SELECT 
    p.id, 
    u.id, 
    'pending', 
    DATE_ADD(NOW(), INTERVAL 2 DAY), 
    NULL
FROM projects p
JOIN users u ON p.department_id = u.department_id
WHERE u.role = 'student' 
AND p.availability_status = 'available'
AND u.id > (SELECT MIN(id) FROM users) -- Attempt to grab varied users
LIMIT 55; -- Grab 55 to be safe

-- Update some to 'collected' to vary the data
UPDATE bookings SET booking_status = 'collected', collected_at = NOW(), due_date = DATE_ADD(NOW(), INTERVAL 7 DAY)
WHERE id IN (SELECT id FROM (SELECT id FROM bookings ORDER BY id DESC LIMIT 20) AS sub);

-- =============================================================================
-- 4. BATCH INSERT: 50 PROPOSED TOPICS
-- =============================================================================
INSERT INTO proposed_topics (title, case_study, student_id, supervisor_name, problem_statement, topic_objectives, status, department_id)
SELECT 
    CONCAT('Proposed Study on ', p.title), -- Generate title based on existing project titles
    'UDUS Case Study', 
    u.id, 
    'Dr. Supervisor', 
    'The problem is significant because...', 
    'To analyze and implement...', 
    ELT(1 + FLOOR(RAND() * 3), 'pending', 'approved', 'rejected'), -- Random Status
    u.department_id
FROM users u
JOIN projects p ON u.department_id = p.department_id
WHERE u.role = 'student'
ORDER BY RAND() -- Randomize selection
LIMIT 50;

-- =============================================================================
-- 5. BATCH INSERT: 50 APPROVED TOPICS
-- =============================================================================
INSERT INTO approved_topics (title, case_study, student_id, supervisor_name, date_of_approval, department_id)
SELECT 
    CONCAT('Approved Research: ', p.title), 
    'Sokoto State', 
    u.id, 
    'Prof. Senior Supervisor', 
    CURDATE(), 
    u.department_id
FROM users u
JOIN projects p ON u.department_id = p.department_id
WHERE u.role = 'student'
ORDER BY RAND()
LIMIT 50;
