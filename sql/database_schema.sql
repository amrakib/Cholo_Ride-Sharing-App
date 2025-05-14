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
    Profile_Pic VARCHAR(255), -- added Profile_Pic
    UserStatus VARCHAR(30)
);

-- ======================
-- Test Case Insertion (UPDATED AGAIN)
-- ======================
INSERT INTO User (Student_ID, Name, Gsuite_Email, Password, Address, Gender, Phone_Number) VALUES
('23101125', 'Tawfiq', 'tawfiq@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23101137', 'Imtiaz', 'Imtiaz@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23102352', 'Ezio', 'Ezio@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23102621', 'Geralt', 'Geralt@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23101621', 'Desmond', 'Desmond@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23109200', 'Razor', 'Razor@gmail.com', '123tawfiq', 'Mirpur, Dhaka', 'Male', '01712345678'),
('23101126', 'Razeen', 'razeen@gmail.com', '123razeen', 'Banani, Dhaka', 'Male', '01812345679');


-- ======================
-- Private Vehicle
-- ======================
CREATE TABLE Private_Vehicle (
    Vehicle_Type VARCHAR(20),
    Model_Name VARCHAR(50),
    Vehicle_Number VARCHAR(20) PRIMARY KEY,
    License_Number VARCHAR(30),
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
("Brac University"),
("Adabor"),
("Agargaon"),
("Azimpur"),
("Badda"),
("Banani"),
("Bangshal"),
("Baridhara"),
("Basabo"),
("Bailey Road"),
("Bashundhara"),
("Cantonment"),
("Chawkbazar"),
("Demra"),
("Dhanmondi"),
("Gendaria"),
("Gulshan"),
("Hazaribagh"),
("Jatrabari"),
("Kafrul"),
("Kalabagan"),
("Kamrangirchar"),
("Khilgaon"),
("Khilkhet"),
("Kollanpur"),
("Kotwali"),
("Lalbagh"),
("Lalmatia"),
("Mirpur 1"),
("Mirpur 2"),
("Mirpur 10"),
("Mirpur 11"),
("Mirpur 12"),
("Mirpur 13"),
("Mohakhali"),
("Mohammadpur"),
("Motijheel"),
("Mugda"),
("Nawabganj"),
("Pallabi"),
("Paltan"),
("Ramna"),
("Rampura"),
("Shahbagh"),
("Shahjahanpur"),
("Tejgaon"),
("Uttara"),
("Wari"),
("Zigatola");
-- ======================
-- Admin
-- ======================
CREATE TABLE Admin (
    Admin_Key VARCHAR(30) PRIMARY KEY,
    Gsuite_Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL
);

INSERT INTO Admin VALUES
("admin123", "admin123@gmail.com","adminpassword"),
("admin666", "admin666@gmail.com","adminpassword");

-- ======================
-- Trips
-- ======================
CREATE TABLE Trips (
    Trip_ID INT PRIMARY KEY AUTO_INCREMENT,
    Student_ID VARCHAR(20),
    where_loc VARCHAR(50),
    Capacity INT,
    Time TIME,
    Date DATE,
    Vehicle_Info VARCHAR(50),
    Fare DECIMAL(5,2),
    Meet_up_location VARCHAR(100),
    Mode_of_Commute VARCHAR(30),
    trip_status VARCHAR(30),
    to_loc VARCHAR(50),
    Used_capacity INT,
    FOREIGN KEY (Student_ID) REFERENCES User(Student_ID) ON DELETE SET NULL,
    FOREIGN KEY (where_loc) REFERENCES Locations(area_locations) ON DELETE SET NULL,
    FOREIGN KEY (to_loc) REFERENCES Locations(area_locations) ON DELETE SET NULL
)AUTO_INCREMENT=10001;

-- >>>>>>>>>>>>>>>>>>>>>>
-- Trip experiment values
-- >>>>>>>>>>>>>>>>>>>>>>
INSERT INTO Trips (
    Student_ID, where_loc, Capacity, Time, Date,
    Fare, Meet_up_location, Mode_of_Commute,
    trip_status, to_loc, Used_capacity
) VALUES

-- ("23101137","Dhanmondi",5,"12:30","2018-05-02",50.55,"Abahani","Public","Available","Gulshan",5),
("23102352","Gulshan",5,"16:35","2022-05-03",24.55,"Abahani","Public","Available","Lalmatia",1),
("23102621","Mohakhali",5,"23:30","2025-09-02",61.55,"Abahani","Public","Available","Uttara",3),
("23101126","Uttara",5,"07:30","2015-07-01",26.55,"Abahani","Public","Available","Mirpur 1",1),
("23109200","Mirpur 1",5,"12:30","2002-01-20",88.55,"Abahani","Public","Available","Badda",3);

INSERT INTO Trips (Student_ID, where_loc, Capacity, Time, Date, Fare, Meet_up_location, Mode_of_Commute, trip_status, to_loc, Used_capacity)
VALUES 
("23101137", "Dhanmondi", 4, "12:00", "2025-05-01", 50.00, "Dhanmondi 27", "Public", "Completed", "Gulshan", 3); -- Trip_ID = LAST_INSERT_ID() = @TripID1

SET @TripID1 = LAST_INSERT_ID();

INSERT INTO Trips (Student_ID, where_loc, Capacity, Time, Date, Fare, Meet_up_location, Mode_of_Commute, trip_status, to_loc, Used_capacity)
VALUES 
("23101137", "Mirpur 1", 4, "14:30", "2025-05-05", 60.00, "Mirpur 10", "Bike", "Available", "Badda", 2); -- Trip_ID = LAST_INSERT_ID() = @TripID2

SET @TripID2 = LAST_INSERT_ID();

-- Ezio (23102352) created a trip
INSERT INTO Trips (Student_ID, where_loc, Capacity, Time, Date, Fare, Meet_up_location, Mode_of_Commute, trip_status, to_loc, Used_capacity)
VALUES 
("23102352", "Mohakhali", 3, "10:15", "2025-05-03", 40.00, "Mohakhali Bus Stand", "Public", "Completed", "Lalmatia", 2); -- @TripID3

SET @TripID3 = LAST_INSERT_ID();

-- Geralt (23102621) created a trip
INSERT INTO Trips (Student_ID, where_loc, Capacity, Time, Date, Fare, Meet_up_location, Mode_of_Commute, trip_status, to_loc, Used_capacity)
VALUES 
("23102621", "Banani", 2, "08:45", "2025-05-04", 35.00, "Banani 11", "Bike", "Cancelled", "Uttara", 1); -- @TripID4

SET @TripID4 = LAST_INSERT_ID();




-- ======================
-- Trip Joiners
-- ======================
CREATE TABLE Trip_Joiners (
    Trip_Leader_ID VARCHAR(30),
    Student_ID VARCHAR(20),
    Trip_ID INT,
    PRIMARY KEY (Trip_Leader_ID,Student_ID, Trip_ID),
    FOREIGN KEY (Student_ID) REFERENCES User(Student_ID) ON DELETE CASCADE,
    FOREIGN KEY (Trip_ID) REFERENCES Trips(Trip_ID) ON DELETE CASCADE,
    FOREIGN KEY (Trip_Leader_ID) REFERENCES User(Student_ID) ON DELETE CASCADE
);

-- ======================
-- Trip Joiners (using the trip variables)
-- ======================

-- Imtiaz joins Ezio's trip
-- INSERT INTO Trip_Joiners (Student_ID, Trip_ID)
-- VALUES ('23101137', @TripID3);

-- Imtiaz joins Geralt’s trip
-- INSERT INTO Trip_Joiners (Student_ID, Trip_ID)
-- VALUES ('23101137', @TripID4);

-- Ezio and Geralt join Imtiaz’s first trip
-- INSERT INTO Trip_Joiners (Student_ID, Trip_ID)
-- VALUES 
-- ('23102352', @TripID1),
-- ('23102621', @TripID1);


-- ======================
-- Trip Member Ratings
-- ======================
CREATE TABLE Trip_Member_Ratings (
    Rater_ID VARCHAR(20),
    Rated_ID VARCHAR(20),
    Trip_ID INT,
    Rating_Score INT CHECK (Rating_Score >= 1 AND Rating_Score <= 5),
    Comment TEXT,
    PRIMARY KEY (Rater_ID, Rated_ID, Trip_ID),
    FOREIGN KEY (Rater_ID) REFERENCES User(Student_ID) ON DELETE CASCADE,
    FOREIGN KEY (Rated_ID) REFERENCES User(Student_ID) ON DELETE CASCADE,
    FOREIGN KEY (Trip_ID) REFERENCES Trips(Trip_ID) ON DELETE CASCADE
);

-- Imtiaz rated Ezio in TripID3
INSERT INTO Trip_Member_Ratings (Rater_ID, Rated_ID, Trip_ID, Rating_Score, Comment)
VALUES ('23101137', '23102352', @TripID3, 5, 'Very punctual and polite');

-- Imtiaz rated Geralt in TripID4
INSERT INTO Trip_Member_Ratings (Rater_ID, Rated_ID, Trip_ID, Rating_Score, Comment)
VALUES ('23101137', '23102621', @TripID4, 4, 'Smooth ride but slightly late');

-- Ezio rated Imtiaz in TripID1
INSERT INTO Trip_Member_Ratings (Rater_ID, Rated_ID, Trip_ID, Rating_Score, Comment)
VALUES ('23102352', '23101137', @TripID1, 5, 'Friendly and cooperative');

-- Geralt rated Imtiaz in TripID1
INSERT INTO Trip_Member_Ratings (Rater_ID, Rated_ID, Trip_ID, Rating_Score, Comment)
VALUES ('23102621', '23101137', @TripID1, 4, 'Good passenger, no complaints');

-- Geralt rated Ezio in TripID1 (even though Ezio was a co-passenger)
INSERT INTO Trip_Member_Ratings (Rater_ID, Rated_ID, Trip_ID, Rating_Score, Comment)
VALUES ('23102621', '23102352', @TripID1, 3, 'Could be more communicative');

-- ======================
-- View for Reported_Trips
-- ======================

-- For fething the Trip_ID we are usinf this Query
-- SELECT Trip_ID, Student_ID, Date FROM Trips;


CREATE TABLE Reported_Trips (
    Report_ID INT AUTO_INCREMENT PRIMARY KEY,
    Trip_ID INT,
    Reporter_ID VARCHAR(20),
    Reason TEXT,
    Status VARCHAR(20) DEFAULT 'Pending',
    Report_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Trip_ID) REFERENCES Trips(Trip_ID) ON DELETE CASCADE,
    FOREIGN KEY (Reporter_ID) REFERENCES User(Student_ID) ON DELETE CASCADE
);

INSERT INTO Reported_Trips (Trip_ID, Reporter_ID, Reason, Status)
VALUES 
(10001, '23102621', 'Passenger was talking loudly the entire trip.', 'Pending'),
(10002, '23102352', 'Driver was 20 minutes late.', 'Resolved'),
(10003, '23101137', 'Rider did not follow the agreed route.', 'Pending'),
(10004, '23102352', 'Trip got cancelled at the last moment without notice.', 'Pending'),
(10005, '23101126', 'Driver overcharged at the end of the ride.', 'Resolved');


CREATE TABLE Notifications (
    Notification_ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID VARCHAR(20),
    Message TEXT,
    Status ENUM('Unread', 'Read') DEFAULT 'Unread',
    Created_At DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (User_ID) REFERENCES User(Student_ID)
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