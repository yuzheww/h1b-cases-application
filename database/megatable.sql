-- Name: Yuzhe Wang, Yan He, Yibo Yan
-- db final project

-- create database
DROP DATABASE IF EXISTS H_info;
CREATE DATABASE H_info;

USE H_info;


-- create megatable
DROP TABLE IF EXISTS big_table;
CREATE TABLE big_table(
	case_number CHAR(18), -- case numbers have ficed length of 18
    case_status VARCHAR(20),
    case_submitted DATE,
    decision_date DATE,
    visa_class VARCHAR(20),
    employment_start_date DATE,
    employment_end_date DATE,
    employer_name VARCHAR(30),
    employer_city VARCHAR(30),
    emp_state_abb VARCHAR(20),
    employer_postal_code INT,
    employer_country VARCHAR(30),
    employer_phone BIGINT,
    agent_attorney_name VARCHAR(20),
    agent_attorney_city VARCHAR(20),
    agent_attorney_state VARCHAR(10),
    job_title VARCHAR(30),
    soc_code VARCHAR(20),
    soc_name VARCHAR(20),
    full_time_position VARCHAR(5),
	prevailing_wage INT,
    pw_unit_of_pay VARCHAR(10),
	wage_unit_of_pay VARCHAR(10),
    worksite_city VARCHAR(20),
    worksite_county VARCHAR(20),
    worksite_state_abb VARCHAR(20),
    worksite_postal_code INT,
    h_year YEAR,
    naic_code INT,
	wage_rate_of_pay DECIMAL(32,2),
    total_wage DECIMAL(32,2),
    sector_data INT,
    emp_state_full VARCHAR(20),
    emp_state_and_city VARCHAR(30),
    worksite_state_full VARCHAR(30),
    worksite_state_and_city VARCHAR(30)
);
-- after creating the megatable, use load_data.sql to population the megatable
