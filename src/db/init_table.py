import mysql.connector
import csv
import os

DATABASE_NAME = "course_reg"
STUDENT_INSERT_STRING = "INSERT INTO students VALUES({},'{}')"
COURSE_INSERT_STRING = "INSERT INTO courses VALUES({},'{}',{},{},{},{})"


def main():
    connection = mysql.connector.connect(host="localhost", user=os.environ.get("USERNAME"),
        passwd=os.environ.get("PASSWORD"),
        database=DATABASE_NAME,
        auth_plugin=os.environ.get("DB_AUTH"),
    )

    print("Connected to database", DATABASE)
    cursor = connection.cursor()
    print("Inserting records into students table")
    insert_records(
        connection,
        cursor,
        "NameFile.csv",
        STUDENT_INSERT_STRING,
    )
    print("Inserting records into courses table")
    insert_records(
        connection,
        cursor,
        "CourseFile.csv",
        COURSE_INSERT_STRING,
    )
    cursor.close()
    connection.close()

def read_csv(filename):
    with open(filename, "r") as f:
        reader = csv.reader(f)
        next(reader, None)
        for row in reader:
            yield row


def insert_records(connection, cursor, filename, input_string, output=False):
    for row in read_csv(filename):
        stripped_row = [item.strip() for item in row]
        if output:
            print(input_string.format(*stripped_row))
        cursor.execute(input_string.format(*stripped_row))
        connection.commit()


if (__name__ == "__main__"):
    main();
