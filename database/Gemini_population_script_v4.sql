INSERT INTO approved_topics (title, case_study, student_id, supervisor_name, date_of_approval, department_id)

    SELECT 
        'Development of a Mobile-Based Project Management System' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-08-25' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Statistical Modelling of COVID-19 Spread in Northern Nigeria' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-08-28' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Solution of Boundary Value Problems using Spectral Methods' AS title, 
        'Sokoto State Case' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-10-11' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Geophysical Investigation of Solid Waste Disposal Sites' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-09-20' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Theoretical Study of Superconductivity in High-Tc Materials' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-09-11' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Implementation of a Secure Authentication Protocol for E-Learning' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-11-05' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Principal Component Analysis of Economic Indicators' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-10-17' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Optimization of Logistics Networks using Graph Theory' AS title, 
        'Sokoto State Case' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-10-20' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Petroleum System Modeling of a Sedimentary Basin' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-09-21' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Experimental Determination of the Speed of Light in Different Media' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-11-16' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Fuzzy Logic-Based Decision Support System for Student Advising' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-11-16' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Application of Time Series Analysis to Stock Market Volatility' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-08-29' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Application of Group Theory in Chemistry and Physics' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-09-18' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Assessment of Heavy Metal Contamination in River Sediments' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-10-22' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Design and Calibration of a Gamma-Ray Spectrometer' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-09-18' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Deep Neural Network for Fake News Detection in African Languages' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-10-20' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Logistic Regression for Predicting Loan Default Rates' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-11-09' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Numerical Simulation of Heat Transfer in Composites' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-10-28' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Remote Sensing and GIS for Land Use/Land Cover Change Detection' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-09-21' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Simulation of Quantum Dots for Electronic Devices' AS title, 
        'Sokoto State Case' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-10-12' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Comparative Analysis of Cloud Computing Service Models' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-09-02' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Design of Optimal Sampling Techniques for Environmental Surveys' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-11-19' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Mathematical Analysis of Financial Derivatives' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Sadiya Umar' AS supervisor_name, 
        '2025-09-17' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Mineralogical and Chemical Characterization of Local Clays' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-09-30' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Investigation of Material Properties using X-ray Diffraction' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-10-16' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Design of an Optimized Data Compression Algorithm' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-10-12' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Analysis of Variance (ANOVA) in Agricultural Experiments' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-08-19' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Stochastic Calculus for Option Pricing' AS title, 
        'Sokoto State Case' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-09-05' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Hydrocarbon Potential of Cretaceous Basins in Nigeria' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-09-19' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Modeling of Atmospheric Pollution Dispersion' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-11-16' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Machine Vision System for Quality Control in Manufacturing' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-09-07' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Non-linear Regression Modeling of Population Growth' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-11-16' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Game Theory Application to Resource Allocation' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-10-31' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Structural Controls on Mineralization in a Nigerian Schist Belt' AS title, 
        'Sokoto State Case' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-11-15' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Application of Plasma Etching in Semiconductor Manufacturing' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Sadiya Umar' AS supervisor_name, 
        '2025-09-14' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Blockchain for Supply Chain Traceability in Agriculture' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-09-25' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Statistical Inference in High-Dimensional Data' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-10-13' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Study of Fixed Point Theorems in Functional Analysis' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-08-22' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Paleoclimatic Reconstruction from Microfossil Records' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-08-23' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Analysis of Cosmic Ray Muons at Sea Level' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-09-20' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Predictive Modeling of University Dropout Rates using ML' AS title, 
        'UDUS Research' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-10-23' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Modeling and Forecasting Electricity Demand using ARIMA' AS title, 
        'Sokoto State Case' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-10-05' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Modeling of Drug Concentration in the Human Body' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Sadiya Umar' AS supervisor_name, 
        '2025-09-08' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Rock Mechanics Analysis for Tunnel Stability Assessment' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-11-10' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Thermodynamic Efficiency of Solar Thermal Collectors' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Mike Nweke' AS supervisor_name, 
        '2025-09-04' AS date_of_approval, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Biometric Authentication using Fingerprint and Iris Fusion' AS title, 
        'Field Work Focused' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Aliyu Jibrin' AS supervisor_name, 
        '2025-10-30' AS date_of_approval, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Bayesian Hierarchical Modeling in Health Studies' AS title, 
        'Simulated Data Analysis' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        'Prof. Hauwa Kolo' AS supervisor_name, 
        '2025-08-20' AS date_of_approval, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Iterative Methods for Solving Large Linear Systems' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Sadiya Umar' AS supervisor_name, 
        '2025-11-11' AS date_of_approval, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Geochronology and Tectonic Setting of Basement Rocks' AS title, 
        'Sokoto State Case' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Sadiya Umar' AS supervisor_name, 
        '2025-11-19' AS date_of_approval, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Development of an Optical Fiber Sensor for Temperature Measurement' AS title, 
        'Theoretical Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        'Dr. Ben Chukwu' AS supervisor_name, 
        '2025-11-01' AS date_of_approval, 
        5 AS department_id
    ;
