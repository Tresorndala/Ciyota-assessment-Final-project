-- Remove the database if it exists
DROP DATABASE IF EXISTS ciyota_assessment;

-- Create the new database
CREATE DATABASE ciyota_assessment;
USE ciyota_assessment;

-- Create the Class table
CREATE TABLE `Class` (
    `classID` INT PRIMARY KEY AUTO_INCREMENT,
    `className` VARCHAR(255)
);

-- Create the Student table with the default country of origin set to DR Congo
CREATE TABLE `Student` (
    `studentID` INT PRIMARY KEY AUTO_INCREMENT,
    `studentIndex` INT UNIQUE,
    `studentName` VARCHAR(255),
    `classID` INT,
    `refugeeStatus` BOOLEAN DEFAULT TRUE, -- Field to identify refugee status
    `countryOfOrigin` VARCHAR(255) DEFAULT 'DR Congo',  -- Default country of origin set to DR Congo
    FOREIGN KEY (`classID`) REFERENCES Class(`classID`)
);

-- Create the Teacher table
CREATE TABLE `Teacher` (
    `teacherID` INT PRIMARY KEY AUTO_INCREMENT,
    `teacherName` VARCHAR(255),
    `teacherContact` INT,
    `teacherEmail` VARCHAR(255),
    `teacherPwd` VARCHAR(255)
);

-- Create the Subjects table
CREATE TABLE `Subjects` (
    `subjectID` INT PRIMARY KEY AUTO_INCREMENT,
    `subjectName` VARCHAR(255)
);

-- Insert subjects specific in Ugandan and DR Congo system for secondary school
INSERT INTO `Subjects` (`subjectName`) VALUES 
('Mathematics'), 
('English Language'), 
('Biology'), 
('Chemistry'), 
('Physics'), 
('Geography'), 
('History'), 
('Civics'), 
('Agricultural Science'), 
('French'), 
('Commerce'), 
('Economics');

-- Create the Term table
CREATE TABLE `Term` (
    `termID` INT PRIMARY KEY AUTO_INCREMENT,
    `termName` VARCHAR(50)
);

-- Insert typical term names used in Ugandan schools, suitable for CIYOTA context
INSERT INTO `Term` (`termName`) VALUES 
('Term 1'), 
('Term 2'), 
('Term 3');

-- Create the Assessment table
CREATE TABLE `Assessment`(
    `assessmentID` INT PRIMARY KEY AUTO_INCREMENT,
    `assessmentName` VARCHAR(255)
);

-- Insert different assessment types common in Ugandan and DR Congo secondary schools
INSERT INTO `Assessment` (`assessmentName`) VALUES 
('Quizzes 0 - 20'), 
('Class activities 1 - 20'), 
('Group Work 1- 20'), 
('Project Work 1- 20'), 
('End of Term Exams - 200');

-- Create the Grade table
CREATE TABLE `Grade` (
    `gradeID` INT PRIMARY KEY AUTO_INCREMENT,
    `assessmentID` INT,
    `studentID` INT,
    `subjectID` INT,
    `termID` INT,
    `score` INT,
    `year` INT,
    `teacherID` INT,
    `gradeScale` VARCHAR(50), -- Field to track grading scales (e.g., Uganda's A-E or DR Congo's 0-20 scale)
    FOREIGN KEY (`assessmentID`) REFERENCES `Assessment`(`assessmentID`),
    FOREIGN KEY (`studentID`) REFERENCES `Student`(`studentID`),
    FOREIGN KEY (`subjectID`) REFERENCES `Subjects`(`subjectID`),
    FOREIGN KEY (`termID`) REFERENCES `Term`(`termID`),
    FOREIGN KEY (`teacherID`) REFERENCES `Teacher`(`teacherID`)
);

-- Insert class names for secondary school levels in Uganda and DR Congo context
INSERT INTO `Class` (`className`) VALUES 
('S.1'), 
('S.2'), 
('S.3'), 
('S.4'), 
('S.5'), 
('S.6');

-- Set foreign key constraint for Grade table
ALTER TABLE `Grade`
  ADD CONSTRAINT `assess_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `Student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;


