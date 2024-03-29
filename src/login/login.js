const onSubmit = (event, form) => {
    event.preventDefault();
    const data = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "/login/login.php");
    xhr.onload = () => onResultReturned(xhr);
    xhr.send(data);
};

const onResultReturned = (xhr) => {
    const errorDiv = document.getElementById("error-message");
    if (xhr.status !== 200) {
        errorDiv.innerHTML = "<h3 style='color: red;'>Connection failed!</h3>";
        return;
    }

    console.log(xhr.responseText);
    const response = JSON.parse(xhr.responseText);
    if (response.loggedIn) {
        location.href = "http://localhost:8000";
        return
    }

    errorDiv.innerHTML = "<h3 style='color: red;'>Login failed!</h3>";
    if(response.message)
        errorDiv.innerHTML += "<p>" + response.message + "</p>";
};

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    loginForm.addEventListener("submit", (event) => onSubmit(event, loginForm));
});
