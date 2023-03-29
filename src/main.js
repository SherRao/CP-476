const onNameTableSubmit = (event, form) => {
    event.preventDefault();
    const data = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "/newStudent.php");
    xhr.onload = () => onResultResponse(xhr, "name-table-error-message");
    xhr.send(data);
};

const onCourseTableSubmit = (event, form) => {
    event.preventDefault();
    const data = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "/newCourse.php");
    xhr.onload = () => onResultResponse(xhr, "course-table-error-message");
    xhr.send(data);
};

const onResultResponse = (xhr, errorDivId) => {
    const errorDiv = document.getElementById(errorDivId);
    if (xhr.status !== 200) {
        errorDiv.innerHTML = "<h3 style='color: red;'>Connection failed!</h3>";
        return;
    }

    console.log(xhr.responseText);
    const response = JSON.parse(xhr.responseText);
    if (response.status) {
        location.href = "http://localhost:8000";
        return
    }

    errorDiv.innerHTML = "<h3 style='color: red;'>Couldn't add student!</h3>";
    if(response.message)
        errorDiv.innerHTML += "<p>" + response.message + "</p>";
};

const onDelete = (event, rawStudentId) => {
    event.preventDefault();
    const xhr = new XMLHttpRequest();
    const data = new FormData();

    const type = rawStudentId.substring(0, 1);
    const studentId = type == "s" ? rawStudentId.substring(1) : rawStudentId.substring(1, 10);
    data.append("studentId", studentId);
    data.append("type", type);
    if(type == "c")
        data.append("courseCode", rawStudentId.substring(10));

    xhr.open("POST", "/deleteStudent.php");
    xhr.onload = () => location.href = "http://localhost:8000";
    xhr.send(data);
};


document.addEventListener("DOMContentLoaded", () => {
    const nameForm = document.getElementById("name-table-form");
    nameForm.addEventListener("submit", (event) => onNameTableSubmit(event, nameForm));

    const courseForm = document.getElementById("course-table-form");
    courseForm.addEventListener("submit", (event) => onCourseTableSubmit(event, courseForm));

    const nameTable = document.getElementById("name-table");
    for (let i = 1, row; row = nameTable.rows[i]; i++) {
        if(row.cells.length != 3 || row.cells[2].children.length == 0)
            continue;

        const deleteButton = row.cells[2].children[0];
        deleteButton.addEventListener("click", (event) => onDelete(event, deleteButton.id));
    }

    const courseTable = document.getElementById("course-table");
    for (let i = 1, row; row = courseTable.rows[i]; i++) {
        if(row.cells.length != 7 || row.cells[6]?.children.length == 0)
            continue;

        const deleteButton = row.cells[6].children[0];
        deleteButton.addEventListener("click", (event) => onDelete(event, deleteButton.id));
    }
});
