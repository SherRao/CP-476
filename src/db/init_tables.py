import mysql.connector
import csv
import sys

DATABASE_NAME = "cp476"
NAME_FILE_FILENAME = "NameFile.csv"
COURSE_FILE_FILENAME = "CourseFile.csv"
STUDENT_INSERT_STRING = "INSERT INTO NameTable VALUES({},'{}')"
COURSE_INSERT_STRING = "INSERT INTO CourseTable VALUES({},'{}',{},{},{},{})"
FINAL_GRADE_INSERT_STRING = "INSERT INTO FinalGradeTable VALUES({},'{}',{},{})"

name_to_id = {}


def main():
    username = sys.argv[1]
    password = sys.argv[2]
    host = "localhost"
    auth_plugin = sys.argv[3] if len(sys.argv) > 3 else None

    print("SQL connection information:")
    print(f"Host: {host}")
    print(f"Username: {username}")
    print(f"Password: {password}")
    print(f"Database: {DATABASE_NAME}")
    print(f"Auth Plugin: {auth_plugin}")
    print("")

    connection = mysql.connector.connect(
        host=host,
        user=username,
        passwd=password,
        database=DATABASE_NAME,
    )

    print("Connected!", DATABASE_NAME)
    cursor = connection.cursor()

    print("Inserting data into student table")
    insert_records(connection, cursor, NAME_FILE_FILENAME, STUDENT_INSERT_STRING)

    print("Inserting data into course table")
    insert_records(connection, cursor, COURSE_FILE_FILENAME, COURSE_INSERT_STRING)

    print("Inserting data into final grade table")
    insert_final_grades(connection, cursor);

    cursor.close()
    connection.close()
    return


def read_csv(filename):
    with open(filename, "r") as file:
        reader = csv.reader(file)
        next(reader, None)
        for row in reader:
            yield row

    return


def insert_records(connection, cursor, filename, input_string, output=False):
    for row in read_csv(filename):
        stripped = [item.strip() for item in row]
        if output:
            print(input_string.format(*stripped))

        cursor.execute(input_string.format(*stripped))
        connection.commit()

    return


def insert_final_grades(connection, cursor):
    for row in read_csv("CourseFile.csv"):
        stripped = [item.strip() for item in row]
        student_id = stripped[0]
        course_id = stripped[1]
        t1 = float(stripped[2])
        t2 = float(stripped[3])
        t3 = float(stripped[4])
        fg = float(stripped[5])
        grade = (.2 * t1) + (.2 * t2) + (.2 * t3) + (.4 * fg)
        cursor.execute(FINAL_GRADE_INSERT_STRING.format(student_id, "NUL", course_id, grade))
        connection.commit()

    return

if (__name__ == "__main__"):
    main();
