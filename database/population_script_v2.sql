-- Faculty Project Management System - Complete Database Population
-- Usmanu Danfodiyo University Sokoto
-- Department-by-Department Population

USE faculty_projects;

-- Disable foreign key checks for easier population
SET FOREIGN_KEY_CHECKS = 0;

-- Clear existing data (optional - use with caution!)
/*
TRUNCATE TABLE bookings;
TRUNCATE TABLE proposed_topics;
TRUNCATE TABLE approved_topics;
TRUNCATE TABLE projects;
DELETE FROM users WHERE role = 'student';
*/

-- Enable foreign key checks back
SET FOREIGN_KEY_CHECKS = 1;

-- =============================================================================
-- 1. COMPUTER SCIENCE DEPARTMENT (150 Students)
-- Admission Numbers: [20-23]1031[0001-0150]
-- =============================================================================

-- Computer Science Students
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- 2020 Batch (40 students)
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
('Bashir Aliyu', '2010310011@udusok.edu.ng', '0801000011', 'student123', 'student', '2010310011', 1),
('Maryam Abubakar', '2010310012@udusok.edu.ng', '0801000012', 'student123', 'student', '2010310012', 1),
('Nafisa Shehu', '2010310013@udusok.edu.ng', '0801000013', 'student123', 'student', '2010310013', 1),
('Abdullahi Musa', '2010310014@udusok.edu.ng', '0801000014', 'student123', 'student', '2010310014', 1),
('Halima Yakubu', '2010310015@udusok.edu.ng', '0801000015', 'student123', 'student', '2010310015', 1),
('Jamilu Rabiu', '2010310016@udusok.edu.ng', '0801000016', 'student123', 'student', '2010310016', 1),
('Khadija Isah', '2010310017@udusok.edu.ng', '0801000017', 'student123', 'student', '2010310017', 1),
('Lawan Suleiman', '2010310018@udusok.edu.ng', '0801000018', 'student123', 'student', '2010310018', 1),
('Mariam Abdul', '2010310019@udusok.edu.ng', '0801000019', 'student123', 'student', '2010310019', 1),
('Nuhu Bala', '2010310020@udusok.edu.ng', '0801000020', 'student123', 'student', '2010310020', 1),
('Omar Faruk', '2010310021@udusok.edu.ng', '0801000021', 'student123', 'student', '2010310021', 1),
('Patricia John', '2010310022@udusok.edu.ng', '0801000022', 'student123', 'student', '2010310022', 1),
('Qasim Umar', '2010310023@udusok.edu.ng', '0801000023', 'student123', 'student', '2010310023', 1),
('Rahma Sani', '2010310024@udusok.edu.ng', '0801000024', 'student123', 'student', '2010310024', 1),
('Sadiq Mohammed', '2010310025@udusok.edu.ng', '0801000025', 'student123', 'student', '2010310025', 1),
('Tijjani Ali', '2010310026@udusok.edu.ng', '0801000026', 'student123', 'student', '2010310026', 1),
('Umar Farouq', '2010310027@udusok.edu.ng', '0801000027', 'student123', 'student', '2010310027', 1),
('Victoria Paul', '2010310028@udusok.edu.ng', '0801000028', 'student123', 'student', '2010310028', 1),
('Wasiu Adekunle', '2010310029@udusok.edu.ng', '0801000029', 'student123', 'student', '2010310029', 1),
('Xavier Obi', '2010310030@udusok.edu.ng', '0801000030', 'student123', 'student', '2010310030', 1),
('Yakubu Adamu', '2010310031@udusok.edu.ng', '0801000031', 'student123', 'student', '2010310031', 1),
('Zara Mohammed', '2010310032@udusok.edu.ng', '0801000032', 'student123', 'student', '2010310032', 1),
('Abdulrahman Sani', '2010310033@udusok.edu.ng', '0801000033', 'student123', 'student', '2010310033', 1),
('Bilikisu Aliyu', '2010310034@udusok.edu.ng', '0801000034', 'student123', 'student', '2010310034', 1),
('Chinedu Okoro', '2010310035@udusok.edu.ng', '0801000035', 'student123', 'student', '2010310035', 1),
('David Ojo', '2010310036@udusok.edu.ng', '0801000036', 'student123', 'student', '2010310036', 1),
('Ezekiel James', '2010310037@udusok.edu.ng', '0801000037', 'student123', 'student', '2010310037', 1),
('Faith Moses', '2010310038@udusok.edu.ng', '0801000038', 'student123', 'student', '2010310038', 1),
('Grace Samuel', '2010310039@udusok.edu.ng', '0801000039', 'student123', 'student', '2010310039', 1),
('Henry Williams', '2010310040@udusok.edu.ng', '0801000040', 'student123', 'student', '2010310040', 1),

-- 2021 Batch (40 students)
('Isaac Johnson', '2110310001@udusok.edu.ng', '0801000041', 'student123', 'student', '2110310001', 1),
('Joy Peter', '2110310002@udusok.edu.ng', '0801000042', 'student123', 'student', '2110310002', 1),
('Kingsley David', '2110310003@udusok.edu.ng', '0801000043', 'student123', 'student', '2110310003', 1),
('Linda Matthew', '2110310004@udusok.edu.ng', '0801000044', 'student123', 'student', '2110310004', 1),
('Michael Andrew', '2110310005@udusok.edu.ng', '0801000045', 'student123', 'student', '2110310005', 1),
('Nancy James', '2110310006@udusok.edu.ng', '0801000046', 'student123', 'student', '2110310006', 1),
('Oluwaseun Ade', '2110310007@udusok.edu.ng', '0801000047', 'student123', 'student', '2110310007', 1),
('Patience John', '2110310008@udusok.edu.ng', '0801000048', 'student123', 'student', '2110310008', 1),
('Queen Esther', '2110310009@udusok.edu.ng', '0801000049', 'student123', 'student', '2110310009', 1),
('Rachel Thomas', '2110310010@udusok.edu.ng', '0801000050', 'student123', 'student', '2110310010', 1),
('Samuel Daniel', '2110310011@udusok.edu.ng', '0801000051', 'student123', 'student', '2110310011', 1),
('Temitope Ola', '2110310012@udusok.edu.ng', '0801000052', 'student123', 'student', '2110310012', 1),
('Uchechi Ngozi', '2110310013@udusok.edu.ng', '0801000053', 'student123', 'student', '2110310013', 1),
('Victoria Chukwu', '2110310014@udusok.edu.ng', '0801000054', 'student123', 'student', '2110310014', 1),
('Williams Brown', '2110310015@udusok.edu.ng', '0801000055', 'student123', 'student', '2110310015', 1),
('Xander Smith', '2110310016@udusok.edu.ng', '0801000056', 'student123', 'student', '2110310016', 1),
('Yvonne Jones', '2110310017@udusok.edu.ng', '0801000057', 'student123', 'student', '2110310017', 1),
('Zion Miller', '2110310018@udusok.edu.ng', '0801000058', 'student123', 'student', '2110310018', 1),
('Adams Wilson', '2110310019@udusok.edu.ng', '0801000059', 'student123', 'student', '2110310019', 1),
('Barbara Moore', '2110310020@udusok.edu.ng', '0801000060', 'student123', 'student', '2110310020', 1),
('Charles Taylor', '2110310021@udusok.edu.ng', '0801000061', 'student123', 'student', '2110310021', 1),
('Diana Anderson', '2110310022@udusok.edu.ng', '0801000062', 'student123', 'student', '2110310022', 1),
('Edward Thomas', '2110310023@udusok.edu.ng', '0801000063', 'student123', 'student', '2110310023', 1),
('Florence Jackson', '2110310024@udusok.edu.ng', '0801000064', 'student123', 'student', '2110310024', 1),
('George White', '2110310025@udusok.edu.ng', '0801000065', 'student123', 'student', '2110310025', 1),
('Helen Harris', '2110310026@udusok.edu.ng', '0801000066', 'student123', 'student', '2110310026', 1),
('Irene Martin', '2110310027@udusok.edu.ng', '0801000067', 'student123', 'student', '2110310027', 1),
('James Thompson', '2110310028@udusok.edu.ng', '0801000068', 'student123', 'student', '2110310028', 1),
('Karen Garcia', '2110310029@udusok.edu.ng', '0801000069', 'student123', 'student', '2110310029', 1),
('Lawrence Martinez', '2110310030@udusok.edu.ng', '0801000070', 'student123', 'student', '2110310030', 1),
('Megan Robinson', '2110310031@udusok.edu.ng', '0801000071', 'student123', 'student', '2110310031', 1),
('Nathan Clark', '2110310032@udusok.edu.ng', '0801000072', 'student123', 'student', '2110310032', 1),
('Olivia Rodriguez', '2110310033@udusok.edu.ng', '0801000073', 'student123', 'student', '2110310033', 1),
('Paul Lewis', '2110310034@udusok.edu.ng', '0801000074', 'student123', 'student', '2110310034', 1),
('Queen Lee', '2110310035@udusok.edu.ng', '0801000075', 'student123', 'student', '2110310035', 1),
('Robert Walker', '2110310036@udusok.edu.ng', '0801000076', 'student123', 'student', '2110310036', 1),
('Sarah Hall', '2110310037@udusok.edu.ng', '0801000077', 'student123', 'student', '2110310037', 1),
('Thomas Allen', '2110310038@udusok.edu.ng', '0801000078', 'student123', 'student', '2110310038', 1),
('Ursula Young', '2110310039@udusok.edu.ng', '0801000079', 'student123', 'student', '2110310039', 1),
('Vincent King', '2110310040@udusok.edu.ng', '0801000080', 'student123', 'student', '2110310040', 1),

-- 2022 Batch (35 students)
('Walter Scott', '2210310001@udusok.edu.ng', '0801000081', 'student123', 'student', '2210310001', 1),
('Xena Green', '2210310002@udusok.edu.ng', '0801000082', 'student123', 'student', '2210310002', 1),
('Yvette Adams', '2210310003@udusok.edu.ng', '0801000083', 'student123', 'student', '2210310003', 1),
('Zack Nelson', '2210310004@udusok.edu.ng', '0801000084', 'student123', 'student', '2210310004', 1),
('Aaron Carter', '2210310005@udusok.edu.ng', '0801000085', 'student123', 'student', '2210310005', 1),
('Bella Mitchell', '2210310006@udusok.edu.ng', '0801000086', 'student123', 'student', '2210310006', 1),
('Caleb Perez', '2210310007@udusok.edu.ng', '0801000087', 'student123', 'student', '2210310007', 1),
('Daisy Roberts', '2210310008@udusok.edu.ng', '0801000088', 'student123', 'student', '2210310008', 1),
('Eli Turner', '2210310009@udusok.edu.ng', '0801000089', 'student123', 'student', '2210310009', 1),
('Fiona Phillips', '2210310010@udusok.edu.ng', '0801000090', 'student123', 'student', '2210310010', 1),
('Gabriel Campbell', '2210310011@udusok.edu.ng', '0801000091', 'student123', 'student', '2210310011', 1),
('Hannah Parker', '2210310012@udusok.edu.ng', '0801000092', 'student123', 'student', '2210310012', 1),
('Ian Evans', '2210310013@udusok.edu.ng', '0801000093', 'student123', 'student', '2210310013', 1),
('Julia Edwards', '2210310014@udusok.edu.ng', '0801000094', 'student123', 'student', '2210310014', 1),
('Kevin Collins', '2210310015@udusok.edu.ng', '0801000095', 'student123', 'student', '2210310015', 1),
('Luna Stewart', '2210310016@udusok.edu.ng', '0801000096', 'student123', 'student', '2210310016', 1),
('Mason Sanchez', '2210310017@udusok.edu.ng', '0801000097', 'student123', 'student', '2210310017', 1),
('Nora Morris', '2210310018@udusok.edu.ng', '0801000098', 'student123', 'student', '2210310018', 1),
('Owen Rogers', '2210310019@udusok.edu.ng', '0801000099', 'student123', 'student', '2210310019', 1),
('Penelope Reed', '2210310020@udusok.edu.ng', '0801000100', 'student123', 'student', '2210310020', 1),
('Quinn Cook', '2210310021@udusok.edu.ng', '0801000101', 'student123', 'student', '2210310021', 1),
('Ryan Morgan', '2210310022@udusok.edu.ng', '0801000102', 'student123', 'student', '2210310022', 1),
('Sofia Bell', '2210310023@udusok.edu.ng', '0801000103', 'student123', 'student', '2210310023', 1),
('Tyler Murphy', '2210310024@udusok.edu.ng', '0801000104', 'student123', 'student', '2210310024', 1),
('Uma Bailey', '2210310025@udusok.edu.ng', '0801000105', 'student123', 'student', '2210310025', 1),
('Victor Rivera', '2210310026@udusok.edu.ng', '0801000106', 'student123', 'student', '2210310026', 1),
('Wendy Cooper', '2210310027@udusok.edu.ng', '0801000107', 'student123', 'student', '2210310027', 1),
('Xander Richardson', '2210310028@udusok.edu.ng', '0801000108', 'student123', 'student', '2210310028', 1),
('Yara Cox', '2210310029@udusok.edu.ng', '0801000109', 'student123', 'student', '2210310029', 1),
('Zane Howard', '2210310030@udusok.edu.ng', '0801000110', 'student123', 'student', '2210310030', 1),
('Adam Ward', '2210310031@udusok.edu.ng', '0801000111', 'student123', 'student', '2210310031', 1),
('Brooke Torres', '2210310032@udusok.edu.ng', '0801000112', 'student123', 'student', '2210310032', 1),
('Carson Peterson', '2210310033@udusok.edu.ng', '0801000113', 'student123', 'student', '2210310033', 1),
('Dakota Gray', '2210310034@udusok.edu.ng', '0801000114', 'student123', 'student', '2210310034', 1),
('Emery Ramirez', '2210310035@udusok.edu.ng', '0801000115', 'student123', 'student', '2210310035', 1),

-- 2023 Batch (35 students)
('Finley James', '2310310001@udusok.edu.ng', '0801000116', 'student123', 'student', '2310310001', 1),
('Grayson Watson', '2310310002@udusok.edu.ng', '0801000117', 'student123', 'student', '2310310002', 1),
('Harper Brooks', '2310310003@udusok.edu.ng', '0801000118', 'student123', 'student', '2310310003', 1),
('Ivy Kelly', '2310310004@udusok.edu.ng', '0801000119', 'student123', 'student', '2310310004', 1),
('Jaxon Sanders', '2310310005@udusok.edu.ng', '0801000120', 'student123', 'student', '2310310005', 1),
('Kai Price', '2310310006@udusok.edu.ng', '0801000121', 'student123', 'student', '2310310006', 1),
('Liam Bennett', '2310310007@udusok.edu.ng', '0801000122', 'student123', 'student', '2310310007', 1),
('Maya Wood', '2310310008@udusok.edu.ng', '0801000123', 'student123', 'student', '2310310008', 1),
('Noah Barnes', '2310310009@udusok.edu.ng', '0801000124', 'student123', 'student', '2310310009', 1),
('Olive Ross', '2310310010@udusok.edu.ng', '0801000125', 'student123', 'student', '2310310010', 1),
('Parker Henderson', '2310310011@udusok.edu.ng', '0801000126', 'student123', 'student', '2310310011', 1),
('Quincy Coleman', '2310310012@udusok.edu.ng', '0801000127', 'student123', 'student', '2310310012', 1),
('Riley Jenkins', '2310310013@udusok.edu.ng', '0801000128', 'student123', 'student', '2310310013', 1),
('Sawyer Perry', '2310310014@udusok.edu.ng', '0801000129', 'student123', 'student', '2310310014', 1),
('Taylor Powell', '2310310015@udusok.edu.ng', '0801000130', 'student123', 'student', '2310310015', 1),
('Uriah Long', '2310310016@udusok.edu.ng', '0801000131', 'student123', 'student', '2310310016', 1),
('Violet Patterson', '2310310017@udusok.edu.ng', '0801000132', 'student123', 'student', '2310310017', 1),
('Wyatt Hughes', '2310310018@udusok.edu.ng', '0801000133', 'student123', 'student', '2310310018', 1),
('Ximena Flores', '2310310019@udusok.edu.ng', '0801000134', 'student123', 'student', '2310310019', 1),
('Yosef Washington', '2310310020@udusok.edu.ng', '0801000135', 'student123', 'student', '2310310020', 1),
('Zara Butler', '2310310021@udusok.edu.ng', '0801000136', 'student123', 'student', '2310310021', 1),
('Asher Simmons', '2310310022@udusok.edu.ng', '0801000137', 'student123', 'student', '2310310022', 1),
('Brielle Foster', '2310310023@udusok.edu.ng', '0801000138', 'student123', 'student', '2310310023', 1),
('Caleb Gonzales', '2310310024@udusok.edu.ng', '0801000139', 'student123', 'student', '2310310024', 1),
('Delilah Bryant', '2310310025@udusok.edu.ng', '0801000140', 'student123', 'student', '2310310025', 1),
('Elias Alexander', '2310310026@udusok.edu.ng', '0801000141', 'student123', 'student', '2310310026', 1),
('Freya Russell', '2310310027@udusok.edu.ng', '0801000142', 'student123', 'student', '2310310027', 1),
('Gideon Griffin', '2310310028@udusok.edu.ng', '0801000143', 'student123', 'student', '2310310028', 1),
('Hazel Diaz', '2310310029@udusok.edu.ng', '0801000144', 'student123', 'student', '2310310029', 1),
('Ivan Hayes', '2310310030@udusok.edu.ng', '0801000145', 'student123', 'student', '2310310030', 1),
('Jade Myers', '2310310031@udusok.edu.ng', '0801000146', 'student123', 'student', '2310310031', 1),
('Kobe Ford', '2310310032@udusok.edu.ng', '0801000147', 'student123', 'student', '2310310032', 1),
('Lila Hamilton', '2310310033@udusok.edu.ng', '0801000148', 'student123', 'student', '2310310033', 1),
('Milo Graham', '2310310034@udusok.edu.ng', '0801000149', 'student123', 'student', '2310310034', 1),
('Nova Sullivan', '2310310035@udusok.edu.ng', '0801000150', 'student123', 'student', '2310310035', 1);

-- Continue with other departments in separate scripts...

SELECT 'Computer Science Department: 150 students added successfully' as status;