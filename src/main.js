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

document.addEventListener("DOMContentLoaded", () => {
    const nameForm = document.getElementById("name-table-form");
    nameForm.addEventListener("submit", (event) => onNameTableSubmit(event, nameForm));

    const courseForm = document.getElementById("course-table-form");
    courseForm.addEventListener("submit", (event) => onCourseTableSubmit(event, courseForm));
});
