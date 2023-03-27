DROP TABLE NameTable;
DROP TABLE CourseTable;

CREATE TABLE NameTable (
    studentId INTEGER PRIMARY KEY,
    studentName VARCHAR(128) NOT NULL
);

CREATE TABLE CourseTable (
    studentId INTEGER NOT NULL,
    courseCode VARCHAR(6) NOT NULL,
    test1Grade INTEGER NOT NULL,
    test2Grade INTEGER NOT NULL,
    test3Grade INTEGER NOT NULL,
    finalTestGrade INTEGER NOT NULL
);
