-- Name: Yuzhe Wang, Yan He, Yibo Yan
-- db final project

-- use H_info database
USE H_info;


-- CREATE decompose tables
DROP TABLE IF EXISTS EmploymentTime;
DROP TABLE IF EXISTS AgentInfo;
DROP TABLE IF EXISTS JobInfo;
DROP TABLE IF EXISTS WageInfo;
DROP TABLE IF EXISTS WorksiteInfo;
DROP TABLE IF EXISTS ApplicationInfo;
DROP TABLE IF EXISTS EmployerInfo;

CREATE TABLE IF NOT EXISTS EmployerInfo(
    employer_name VARCHAR(30),
    employer_city VARCHAR(30),
    emp_state_abb VARCHAR(5),
    emp_state_full VARCHAR(20),
    emp_state_and_city VARCHAR(30),
    employer_postal_code INT,
    employer_country VARCHAR(30),
    employer_phone BIGINT,
    naic_code INT,
    PRIMARY KEY(employer_name)
);

CREATE TABLE IF NOT EXISTS ApplicationInfo(
	case_number CHAR(18), -- case numbers have fixed length
    case_status VARCHAR(20),
    case_submitted DATE,
    decision_date DATE,
    visa_class VARCHAR(20),
    employer_name VARCHAR(30),
    PRIMARY KEY(case_number),
    CONSTRAINT fk_em1 FOREIGN KEY (employer_name) REFERENCES EmployerInfo(employer_name) 
												  ON UPDATE CASCADE -- should be affected if employer name is updated
												  ON DELETE NO ACTION -- should not delete a case if employer is deleted
);

CREATE TABLE IF NOT EXISTS EmploymentTime(
    case_number CHAR(18),
    employment_start_date DATE,
    employment_end_date DATE,
    h_year YEAR,
	PRIMARY KEY(case_number),
    CONSTRAINT fk_cn1 FOREIGN KEY (case_number) REFERENCES ApplicationInfo(case_number) 
												ON UPDATE CASCADE -- should be affected if case is updated
												ON DELETE CASCADE -- should be deleted if case is deleted
);

CREATE TABLE IF NOT EXISTS AgentInfo(
    case_number CHAR(18),
    agent_attorney_name VARCHAR(20),
    agent_attorney_city VARCHAR(20),
	agent_attorney_state VARCHAR(10),
    PRIMARY KEY(case_number),
    CONSTRAINT fk_cn2 FOREIGN KEY (case_number) REFERENCES ApplicationInfo(case_number) 
												ON UPDATE CASCADE -- should be affected if case is updated
												ON DELETE CASCADE -- should be deleted if case is deleted
);



CREATE TABLE IF NOT EXISTS JobInfo(
    case_number CHAR(18),
	job_title VARCHAR(30),
	soc_code VARCHAR(20),
	soc_name VARCHAR(20),
	full_time_position VARCHAR(5),
    PRIMARY KEY(case_number),
    CONSTRAINT fk_cn3 FOREIGN KEY (case_number) REFERENCES ApplicationInfo(case_number) 
												ON UPDATE CASCADE -- should be affected if case is updated
												ON DELETE CASCADE -- should be deleted if case is deleted
);


 CREATE TABLE IF NOT EXISTS WageInfo(
    case_number CHAR(18),
	prevailing_wage INT,
    pw_unit_of_pay VARCHAR(10),
	wage_unit_of_pay VARCHAR(10),
    wage_rate_of_pay DECIMAL(32,2),
    total_wage DECIMAL(32,2),
    sector_data INT,
    PRIMARY KEY(case_number),
    CONSTRAINT fk_cn4 FOREIGN KEY (case_number) REFERENCES ApplicationInfo(case_number) 
												ON UPDATE CASCADE -- should be affected if case is updated
												ON DELETE CASCADE -- should be deleted if case is deleted
);

 CREATE TABLE IF NOT EXISTS WorksiteInfo(
    case_number CHAR(18),
    worksite_city VARCHAR(20),
    worksite_county VARCHAR(20),
    worksite_state_abb VARCHAR(5),
    worksite_postal_code INT,
    worksite_state_full VARCHAR(30),
    worksite_state_and_city VARCHAR(30),
    PRIMARY KEY(case_number),
    CONSTRAINT fk_cn5 FOREIGN KEY (case_number) REFERENCES ApplicationInfo(case_number) 
												ON UPDATE CASCADE -- should be affected if case is updated
												ON DELETE CASCADE -- should be deleted if case is deleted
    
);


-- IMPORT DATA from the magatable to the decompose tables
INSERT IGNORE INTO EmployerInfo
        (SELECT DISTINCT employer_name,
				         employer_city,
						 emp_state_abb,
					     emp_state_full,
					     emp_state_and_city,
					     employer_postal_code,
					     employer_country,
					     employer_phone,
					     naic_code
          FROM big_table); 

INSERT INTO ApplicationInfo
	   (SELECT case_number,
               case_status,
               case_submitted,
               decision_date,
               visa_class,
               employer_name
        FROM big_table);

INSERT INTO EmploymentTime
	   (SELECT case_number,
			   employment_start_date,
			   employment_end_date,
			   h_year
        FROM big_table);
        
INSERT INTO AgentInfo
	   (SELECT case_number,
			   agent_attorney_name,
			   agent_attorney_city,
			   agent_attorney_state
        FROM big_table);
        
INSERT INTO JobInfo
	   (SELECT case_number,
			   job_title,
			   soc_code,
			   soc_name,
			   full_time_position
        FROM big_table);
        
INSERT INTO WageInfo
	   (SELECT case_number,
			   prevailing_wage,
    		   pw_unit_of_pay,
			   wage_unit_of_pay,
    		   wage_rate_of_pay,
    		   total_wage,
    		   sector_data
        FROM big_table);
        
INSERT INTO WorksiteInfo
	   (SELECT case_number,
			   worksite_city,
    		   worksite_county,
    		   worksite_state_abb,
    		   worksite_postal_code,
    		   worksite_state_full,
    		   worksite_state_and_city
        FROM big_table);