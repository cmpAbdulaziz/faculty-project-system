-- Insert 50 new students with specific admission number patterns
-- Statistics (1032), Mathematics (1033), Geology (1034), Physics (1035)
-- Serial numbers chosen between 0050-0150 to minimize collision with initial data
INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) VALUES
-- Statistics Students (Dept ID 2)
('Bello Suleiman', '2210320074@udusok.edu.ng', '08064093524', 'student123', 'student', '2210320074', 2),
('Yusuf Mohammed', '2310320140@udusok.edu.ng', '08080187530', 'student123', 'student', '2310320140', 2),
('Samuel Aliyu', '2310320127@udusok.edu.ng', '08016570012', 'student123', 'student', '2310320127', 2),
('Musa Aliyu', '2210320100@udusok.edu.ng', '08023047773', 'student123', 'student', '2210320100', 2),
('Zainab Monday', '2210320127@udusok.edu.ng', '08070221414', 'student123', 'student', '2210320127', 2),
('Chinedu John', '2010320101@udusok.edu.ng', '08011237046', 'student123', 'student', '2010320101', 2),
('David John', '2010320073@udusok.edu.ng', '08045801423', 'student123', 'student', '2010320073', 2),
('Bello John', '2210320114@udusok.edu.ng', '08061230790', 'student123', 'student', '2210320114', 2),
('Emmanuel Monday', '2010320063@udusok.edu.ng', '08069934391', 'student123', 'student', '2010320063', 2),
('David Ibrahim', '2210320071@udusok.edu.ng', '08038500897', 'student123', 'student', '2210320071', 2),
('Grace James', '2310320133@udusok.edu.ng', '08023293212', 'student123', 'student', '2310320133', 2),
('Bello Peter', '2310320086@udusok.edu.ng', '08077965015', 'student123', 'student', '2310320086', 2),

-- Mathematics Students (Dept ID 3)
('Aisha Monday', '2110330139@udusok.edu.ng', '08094724035', 'student123', 'student', '2110330139', 3),
('Esther Okeke', '2010330105@udusok.edu.ng', '08048360817', 'student123', 'student', '2010330105', 3),
('Sani Eze', '2210330052@udusok.edu.ng', '08064875651', 'student123', 'student', '2210330052', 3),
('Fatima Joseph', '2010330135@udusok.edu.ng', '08034000667', 'student123', 'student', '2010330135', 3),
('Chinedu Aliyu', '2310330145@udusok.edu.ng', '08028428130', 'student123', 'student', '2310330145', 3),
('Ibrahim Eze', '2010330058@udusok.edu.ng', '08084008523', 'student123', 'student', '2010330058', 3),
('Aisha Monday', '2310330103@udusok.edu.ng', '08061175558', 'student123', 'student', '2310330103', 3),
('Aisha Daniel', '2310330107@udusok.edu.ng', '08041850809', 'student123', 'student', '2310330107', 3),
('Aisha Okafor', '2310330114@udusok.edu.ng', '08054831267', 'student123', 'student', '2310330114', 3),
('Emmanuel Joseph', '2110330109@udusok.edu.ng', '08096250610', 'student123', 'student', '2110330109', 3),
('Peace Peter', '2110330074@udusok.edu.ng', '08026631962', 'student123', 'student', '2110330074', 3),
('Blessing Peter', '2010330085@udusok.edu.ng', '08096955254', 'student123', 'student', '2010330085', 3),
('Emmanuel Aliyu', '2110330092@udusok.edu.ng', '08011074961', 'student123', 'student', '2110330092', 3),

-- Geology Students (Dept ID 4)
('Musa Okeke', '2110340120@udusok.edu.ng', '08081855348', 'student123', 'student', '2110340120', 4),
('Blessing Eze', '2310340081@udusok.edu.ng', '08037005118', 'student123', 'student', '2310340081', 4),
('Emmanuel Ibrahim', '2210340144@udusok.edu.ng', '08019092881', 'student123', 'student', '2210340144', 4),
('Ngozi Aliyu', '2210340105@udusok.edu.ng', '08074093965', 'student123', 'student', '2210340105', 4),
('Bello Aliyu', '2010340067@udusok.edu.ng', '08080114272', 'student123', 'student', '2010340067', 4),
('Chinedu Okafor', '2110340055@udusok.edu.ng', '08046563131', 'student123', 'student', '2110340055', 4),
('Ngozi Paul', '2110340150@udusok.edu.ng', '08067399761', 'student123', 'student', '2110340150', 4),
('Joy Sani', '2310340093@udusok.edu.ng', '08041593739', 'student123', 'student', '2310340093', 4),
('Emmanuel Sani', '2110340126@udusok.edu.ng', '08020955345', 'student123', 'student', '2110340126', 4),
('Yakubu Ibrahim', '2210340125@udusok.edu.ng', '08090483462', 'student123', 'student', '2210340125', 4),
('Fatima Umar', '2110340105@udusok.edu.ng', '08091952591', 'student123', 'student', '2110340105', 4),
('Musa Eze', '2210340107@udusok.edu.ng', '08051561775', 'student123', 'student', '2210340107', 4),

-- Physics Students (Dept ID 5)
('Samuel Aliyu', '2210350084@udusok.edu.ng', '08042520779', 'student123', 'student', '2210350084', 5),
('Peace Paul', '2110350107@udusok.edu.ng', '08060666276', 'student123', 'student', '2110350107', 5),
('Blessing Mohammed', '2310350092@udusok.edu.ng', '08025079759', 'student123', 'student', '2310350092', 5),
('Ngozi Abdullahi', '2110350097@udusok.edu.ng', '08010174661', 'student123', 'student', '2110350097', 5),
('Yusuf Umar', '2310350134@udusok.edu.ng', '08037736295', 'student123', 'student', '2310350134', 5),
('Aisha Peter', '2010350058@udusok.edu.ng', '08049743959', 'student123', 'student', '2010350058', 5),
('Emmanuel Bello', '2010350068@udusok.edu.ng', '08071117287', 'student123', 'student', '2010350068', 5),
('Samuel Mohammed', '2110350091@udusok.edu.ng', '08098633450', 'student123', 'student', '2110350091', 5),
('Esther Sunday', '2110350110@udusok.edu.ng', '08047293434', 'student123', 'student', '2110350110', 5),
('Grace Bello', '2010350050@udusok.edu.ng', '08042910684', 'student123', 'student', '2010350050', 5),
('Sani Bello', '2110350095@udusok.edu.ng', '08066630155', 'student123', 'student', '2110350095', 5),
('Yakubu Eze', '2110350056@udusok.edu.ng', '08053676979', 'student123', 'student', '2110350056', 5),
('Sani Suleiman', '2110350109@udusok.edu.ng', '08016199259', 'student123', 'student', '2110350109', 5);
