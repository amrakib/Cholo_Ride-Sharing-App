-- ======================
-- User Table (UPDATED AGAIN)
-- ======================
CREATE TABLE User (
    Student_ID VARCHAR(20) PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Gsuite_Email VARCHAR(100) UNIQUE NOT NULL,
    Scanned_ID VARCHAR(255),
    Semester VARCHAR(20),
    Department VARCHAR(50),
    Thana VARCHAR(50),
    Phone_Number VARCHAR(15), -- updated
    Password VARCHAR(100) NOT NULL,
    Address VARCHAR(255),     -- added Address
    Gender VARCHAR(10),       -- added Gender
    Role ENUM('admin', 'user') NOT NULL DEFAULT 'user' -- added Role for ADMIN and USER
);

-- ======================
-- Test Case Insertion (UPDATED AGAIN)
-- ======================
INSERT INTO User (Student_ID, Name, Gsuite_Email, Password, Address, Gender, Phone_Number, Role) VALUES
('23101125', 'Tawfiq', 'tawfiq@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23102151', 'Imtiaz', 'Imtiaz@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23102352', 'Ezio', 'Ezio@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23102621', 'Geralt', 'Geralt@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23101621', 'Desmond', 'Desmond@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23109200', 'Razor', 'Razor@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23101126', 'Razeen', 'razeen@gmail.com', '123razeen', 'Banani, Dhaka', 'Male', '01812345679');
('20000000', 'Admin_User', 'admin@g.bracu.ac.bd', '123admin','Banani', 'Dhaka', 'Male', '01813345679' , 'admin');

-- ======================
-- Private Vehicle
-- ======================
CREATE TABLE Private_Vehicle (
    Vehicle_Type VARCHAR(20),
    Model_Name VARCHAR(50),
    Vehicle_Number VARCHAR(20) PRIMARY KEY,
    License_Number VARCHAR(30) UNIQUE,
    Capacity INT,
    Owner_ID VARCHAR(20),
    FOREIGN KEY (Owner_ID) REFERENCES User(Student_ID)
);

-- ======================
-- Test Case Insertion into Private Vehicle
-- ======================
INSERT INTO Private_Vehicle
VALUES ("Bike", "Fzs v3", "618968","123456",1,"23101125");



-- ======================
-- Locations
-- ======================


CREATE Table Locations (
    area_locations varchar(30) PRIMARY KEY
);


-- ======================
-- Location default values
-- ======================
INSERT INTO Locations VALUES
("Dhanmondi"),
("Gulshan"),
("Badda"),
("Mohakhali"),
("Uttara"),
("Mirpur"),
("Lalmatia");

-- ======================
-- Admin
-- ======================
CREATE TABLE Admin (
    Admin_Key VARCHAR(30) PRIMARY KEY,
    Password VARCHAR(100) NOT NULL
);

-- ======================
-- Trips
-- ======================
CREATE TABLE Trips (
    Trip_ID VARCHAR(30) PRIMARY KEY,
    Student_ID VARCHAR(20),
    where_loc VARCHAR(50),
    Capacity INT,
    Time TIME,
    Date DATE,
    Fare DECIMAL(4,2),
    Meet_up_location VARCHAR(100),
    Mode_of_Commute VARCHAR(30),
    trip_status VARCHAR(30),
    to_loc VARCHAR(50),
    Used_capacity INT,
    FOREIGN KEY (Student_ID) REFERENCES User(Student_ID) ON DELETE SET NULL,
    FOREIGN KEY (where_loc) REFERENCES Locations(area_locations) ON DELETE SET NULL,
    FOREIGN KEY (to_loc) REFERENCES Locations(area_locations) ON DELETE SET NULL
);

-- ======================
-- Trip experiment values
-- ======================

INSERT INTO Trips VALUES
("123","23102151","Dhanmondi",5,"12:30","2018-5-02",50.55,"Abahani","BIKE","Available","Gulshan",5),
("124","23102352","Gulshan",5,"16:35","2022-5-03",24.55,"Abahani","BIKE","Available","Lalmatia",1),
("125","23102621","Mohakhali",5,"23:30","2025-9-02",61.55,"Abahani","BIKE","Available","Uttara",3),
("126","23101126","Uttara",5,"07:30","2015-7-01",26.55,"Abahani","BIKE","Available","Mirpur",1),
("127","23109200","Mirpur",5,"12:30","2002-1-20",88.55,"Abahani","BIKE","Available","Badda",3);


-- ======================
-- Trip Joiners
-- ======================
CREATE TABLE Trip_Joiners (
    Student_ID VARCHAR(20),
    Trip_ID VARCHAR(30),
    PRIMARY KEY (Student_ID, Trip_ID),
    FOREIGN KEY (Student_ID) REFERENCES User(Student_ID) ON DELETE CASCADE,
    FOREIGN KEY (Trip_ID) REFERENCES Trips(Trip_ID) ON DELETE CASCADE
);

-- ======================
-- Trip Member Ratings
-- ======================
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

-- ======================
-- View for Average Ratings
-- ======================
CREATE VIEW User_Average_Ratings AS
SELECT 
    Rated_ID AS Student_ID,
    AVG(Rating_Score) AS Average_Rating
FROM Trip_Member_Ratings
GROUP BY Rated_ID;