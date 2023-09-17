-- Name: Yuzhe Wang, Yan He, Yibo Yan
-- db final project

-- the following load data statement works on our windows device
-- if the following code does not work on your device due to personal settings, 
-- use test_data.sql under the same directory (db) to populate the magatable
 SET @@SESSION.sql_mode='ALLOW_INVALID_DATES';
 LOAD DATA INFILE "H1b_EDA_data.csv"
		INTO TABLE big_table 
        FIELDS TERMINATED BY ','
		OPTIONALLY ENCLOSED BY '"'
		LINES TERMINATED BY '\n'
        (case_number, case_status,@var1, @var2
        ,visa_class,@var3,@var4,employer_name,
        employer_city,emp_state_abb,employer_postal_code,employer_country,employer_phone,
        agent_attorney_name,agent_attorney_city,agent_attorney_state,job_title,
        soc_code,soc_name, full_time_position,prevailing_wage,pw_unit_of_pay,
        wage_unit_of_pay,worksite_city,worksite_county,worksite_state_abb,
        worksite_postal_code,h_year,naic_code,wage_rate_of_pay,total_wage,sector_data,
        emp_state_full,emp_state_and_city,worksite_state_full,worksite_state_and_city)
        
        SET case_submitted = STR_TO_DATE(@var1,'%m/%d/%Y'),
		decision_date = STR_TO_DATE(@var2,'%m/%d/%Y'),
		employment_start_date = STR_TO_DATE(@var3,'%m/%d/%Y'),
		employment_end_date = STR_TO_DATE(@var4,'%m/%d/%Y');
        
-- after loading data to the megatable, use decomposed_tables.sql to create and populate the decompose tables