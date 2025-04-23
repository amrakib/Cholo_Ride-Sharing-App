-- Database Schema for Trip Sharing System

-- User Table
CREATE TABLE User (
    Student_ID VARCHAR(20) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Gsuite_Email VARCHAR(100) UNIQUE NOT NULL,
    Scanned_ID TEXT,
    Semester VARCHAR(20),
    Department VARCHAR(50),
    Thana VARCHAR(50)
);

-- User Phone Numbers
CREATE TABLE User_Phone_Numbers (
    Student_ID VARCHAR(20),
    Phone_Number VARCHAR(15),
    PRIMARY KEY (Student_ID, Phone_Number),
    FOREIGN KEY (Student_ID) REFERENCES User(Student_ID) ON DELETE CASCADE
);

-- Private Vehicle
CREATE TABLE Private_Vehicle (
    Vehicle_Number VARCHAR(20) PRIMARY KEY,
    Model_Name VARCHAR(50),
    License_Number VARCHAR(30) UNIQUE,
    Owner_ID VARCHAR(20),
    FOREIGN KEY (Owner_ID) REFERENCES User(Student_ID) ON DELETE SET NULL
);

-- Admin
CREATE TABLE Admin (
    Admin_Key VARCHAR(30) PRIMARY KEY,
    Password VARCHAR(100) NOT NULL
);

-- Trips
CREATE TABLE Trips (
    Trip_ID VARCHAR(30) PRIMARY KEY,
    Student_ID VARCHAR(20),
    Thana VARCHAR(50),
    Capacity INT,
    Time TIME,
    Date DATE,
    Fare DECIMAL(10,2),
    Meet_up_location VARCHAR(100),
    Recurring_Trip BOOLEAN,
    Mode_of_Commute VARCHAR(30),
    FOREIGN KEY (Student_ID) REFERENCES User(Student_ID) ON DELETE SET NULL
);

-- Trip Joiners
CREATE TABLE Trip_Joiners (
    Student_ID VARCHAR(20),
    Trip_ID VARCHAR(30),
    PRIMARY KEY (Student_ID, Trip_ID),
    FOREIGN KEY (Student_ID) REFERENCES User(Student_ID) ON DELETE CASCADE,
    FOREIGN KEY (Trip_ID) REFERENCES Trips(Trip_ID) ON DELETE CASCADE
);

-- Trip Member Ratings
CREATE TABLE Trip_Member_Ratings (
    Rater_ID VARCHAR(20),
    Rated_ID VARCHAR(20),
    Trip_ID VARCHAR(30),
    Rating_Score INT CHECK (Rating_Score >= 1 AND Rating_Score <= 5),
    Comment TEXT,
    PRIMARY KEY (Rater_ID, Rated_ID, Trip_ID),
    FOREIGN KEY (Rater_ID) REFERENCES User(Student_ID) ON DELETE CASCADE,
    FOREIGN KEY (Rated_ID) REFERENCES User(Student_ID) ON DELETE CASCADE,
    FOREIGN KEY (Trip_ID) REFERENCES Trips(Trip_ID) ON DELETE CASCADE
);

-- Optional: View for Average Ratings
CREATE VIEW User_Average_Ratings AS
SELECT 
    Rated_ID AS Student_ID,
    AVG(Rating_Score) AS Average_Rating
FROM Trip_Member_Ratings
GROUP BY Rated_ID;
