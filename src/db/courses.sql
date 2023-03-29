USE cp476;
DROP TABLE NameTable;
DROP TABLE CourseTable;
DROP TABLE FinalGradeTable;

CREATE TABLE NameTable (
    StudentId INTEGER PRIMARY KEY,
    StudentName VARCHAR(128) NOT NULL
);

CREATE TABLE CourseTable (
    StudentId INTEGER NOT NULL,
    CourseCode VARCHAR(6) NOT NULL,
    Test1Grade INTEGER NOT NULL,
    Test2Grade INTEGER NOT NULL,
    Test3Grade INTEGER NOT NULL,
    FinalTestGrade INTEGER NOT NULL
);

CREATE TABLE FinalGradeTable (
    StudentId INTEGER NOT NULL,
    StudentName VARCHAR(128),
    CourseCode VARCHAR(6) NOT NULL,
    FinalGrade INTEGER NOT NULL
);
