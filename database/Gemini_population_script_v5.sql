INSERT INTO proposed_topics (title, case_study, student_id, date_of_proposal, department_id)

    SELECT 
        'IoT-Based Smart Agriculture Monitoring System' AS title, 
        'Preliminary Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-14' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Predictive Modeling of Student Retention using Machine Learning' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-02' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Spectral Analysis of Differential Operators' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-02' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Seismic Hazard Assessment of the Nigerian Coastal Zone' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-18' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Computational Study of Magnetic Nanoparticles' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-01' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Comparative Study of SQL vs. NoSQL Databases for Web Apps' AS title, 
        'Literature Review' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-26' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Robust Regression Techniques for Outlier Detection in Financial Data' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-18' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Applied Knot Theory in Molecular Biology' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-03' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Geochemistry of Groundwater in Urban Areas' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-07' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Modeling the Performance of Photovoltaic-Thermal Systems' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-04' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Reinforcement Learning for Autonomous Drone Navigation' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-04' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Spatial Statistics for Analyzing Disease Clusters' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-24' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Homological Algebra and its Applications in Coding Theory' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-28' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Mapping and Characterization of Laterite Deposits for Construction' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-22' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Design and Testing of a Geiger Counter for Educational Use' AS title, 
        'Preliminary Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-19' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Implementation of Homomorphic Encryption in Cloud Storage' AS title, 
        'Preliminary Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-11' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Survival Analysis of Retailing Businesses in Sokoto' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-07' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Numerical Solution of Reaction-Diffusion Equations' AS title, 
        'Literature Review' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-24' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Tectonic Significance of Fractures in Basement Complexes' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-03' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Theoretical Analysis of Dark Matter Candidates' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-28' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Analysis of Malware Propagation in Mobile Networks' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-02' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Bootstrap Methods for Estimating Confidence Intervals in Small Samples' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-24' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Fuzzy Optimization of Water Distribution Networks' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-19' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Use of Drone Photogrammetry for Topographic Mapping' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-31' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Spectroscopic Analysis of Environmental Pollutants' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-11' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Development of a Gesture Recognition Interface' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-09' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Statistical Quality Control of Cement Production' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-26' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Wavelet Analysis for Image Compression' AS title, 
        'Preliminary Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-02' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Sedimentological Study of the Anambra Basin' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-14' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Study of Chaotic Behavior in Simple Pendulum Systems' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-29' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Big Data Analytics for University Resource Management' AS title, 
        'Literature Review' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-05' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Factor Analysis of University Staff Job Satisfaction' AS title, 
        'Preliminary Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-26' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Mathematical Modeling of Traffic Congestion' AS title, 
        'Literature Review' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-16' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Environmental Isotope Hydrology of the Chad Basin' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-09' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Application of Nuclear Magnetic Resonance in Material Science' AS title, 
        'Literature Review' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-01' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Designing a Secure Chat Application using End-to-End Encryption' AS title, 
        'Preliminary Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-30' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Time Series Analysis of Crude Oil Prices and the Nigerian Economy' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-16' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Nonlinear Dynamics and Bifurcation Theory' AS title, 
        'Literature Review' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-06' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Analysis of Geothermal Potential in North-Eastern Nigeria' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-15' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Modeling Electron Transport in Semiconductor Devices' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-23' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Computer Vision for Traffic Flow Optimization' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-14' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Application of Monte Carlo Simulation in Risk Assessment' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-18' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Complex Analysis and its Application to Fluid Flow' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-10-05' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Modeling of Coastal Erosion and Mitigation Strategies' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-23' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Acoustic Analysis of Musical Instruments' AS title, 
        'System Design Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-20' AS date_of_proposal, 
        5 AS department_id
    
UNION ALL

    SELECT 
        'Natural Language Processing for Hausa Language Translation' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 1 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-09-26' AS date_of_proposal, 
        1 AS department_id
    
UNION ALL

    SELECT 
        'Multivariate Analysis of Climatic Variables in North-West Nigeria' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 2 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-02' AS date_of_proposal, 
        2 AS department_id
    
UNION ALL

    SELECT 
        'Graph Coloring Algorithms for Timetabling Problems' AS title, 
        'Fieldwork and Data Collection Plan' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 3 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-08-30' AS date_of_proposal, 
        3 AS department_id
    
UNION ALL

    SELECT 
        'Paleomagnetic Study of Volcanic Rocks' AS title, 
        'Simulation Proposal' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 4 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-07-04' AS date_of_proposal, 
        4 AS department_id
    
UNION ALL

    SELECT 
        'Quantum Field Theory in Curved Spacetime' AS title, 
        'Preliminary Study' AS case_study, 
        (SELECT id FROM users WHERE role = 'student' AND department_id = 5 ORDER BY RAND() LIMIT 1) AS student_id,
        '2025-06-30' AS date_of_proposal, 
        5 AS department_id
    ;
