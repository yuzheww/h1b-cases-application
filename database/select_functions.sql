-- Name: Yuzhe Wang, Yan He, Yibo Yan
-- db final project

USE H_info;

-- 1
DROP PROCEDURE IF EXISTS queryNum; -- this function is to give the information about incoming case number
DELIMITER //
CREATE PROCEDURE queryNum(IN case_num CHAR(18))
BEGIN
	SELECT * FROM big_table WHERE case_num = case_number;
 
END//
DELIMITER ;


-- 2
DROP PROCEDURE IF EXISTS queryInterval; -- this number returns the cases whose wage in total is in the selected interval
DELIMITER //
CREATE PROCEDURE queryInterval(IN pl DOUBLE,IN pr DOUBLE)
BEGIN
	SELECT case_number, case_status,job_title,total_wage  FROM big_table WHERE total_wage >= pl and total_wage <= pr LIMIT 10;
 
END//
DELIMITER ;

-- 3
DROP PROCEDURE IF EXISTS queryPercentage;
DELIMITER //
CREATE PROCEDURE queryPercentage(IN tgt VARCHAR(30)) -- -- this stored procedure is  to return the count of total and selected type as well as percentage of selected type on total
BEGIN
  DECLARE cnt INT;
     DECLARE cnt1 INT;
     SET cnt = (SELECT count(*) as fst FROM big_table WHERE case_status = tgt);
     SET cnt1 = (SELECT count(*) as scd FROM big_table);
 SELECT cnt as tot, cnt1 as total, cnt/cnt1 AS res;
END//
DELIMITER ;


-- 4
DROP PROCEDURE IF EXISTS queryEmployer;
DELIMITER //
CREATE PROCEDURE queryEmployer(IN tgt VARCHAR(20)) -- this sp returns the information about employer information
BEGIN
	 SELECT employer_name,
               employer_city,
			   emp_state_abb,
			   emp_state_full,
			   emp_state_and_city,
			   employer_postal_code,
			   employer_country,
			   employer_phone,
			   naic_code
      FROM EmployerInfo
      WHERE employer_name = tgt;

END//
DELIMITER ;

-- 5
DROP PROCEDURE IF EXISTS queryAttorney; -- this sp returns the information about attorney of given clue
DELIMITER //
CREATE PROCEDURE queryAttorney(IN tgt VARCHAR(30))
BEGIN
	 DECLARE cnt INT;
	 SET cnt = (SELECT count(*) FROM big_table WHERE agent_attorney_name = tgt);
     SELECT  DISTINCT agent_attorney_name ,agent_attorney_city,agent_attorney_state,cnt FROM agentinfo WHERE agent_attorney_name = tgt;
	
END//
DELIMITER ;

-- 6
DROP PROCEDURE IF EXISTS queryState;
DELIMITER //
CREATE PROCEDURE queryState(IN tgt VARCHAR(30)) -- this sp returns city name and number of total foreign registered worker work in this city in the selected state
BEGIN
	SELECT  DISTINCT worksite_county, count(*) AS cnt FROM worksiteInfo WHERE worksite_state_abb = tgt GROUP BY worksite_county LIMIT 50;
END//
DELIMITER ;