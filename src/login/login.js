const onSubmit = (event, form) => {
    event.preventDefault();

    const data = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "login.php");
    xhr.onload = () => onResultReturned(xhr);
    xhr.send(data);
};

const onResultReturned = (xhr) => {
    const errorDiv = document.getElementById("error-message");
    if (xhr.status !== 200) {
        errorDiv.innerHTML = "<h3>Login Failed!</h3>";
        return;
    }

    const response = JSON.parse(xhr.responseText);
    if (response.loggedIn) {
        location.href = "http://localhost:8080/index.html";
        return
    }

    errorDiv.innerHTML = "<h3>Login Failed</h3>";
    if(response.message)
        errorDiv.innerHTML += response.message;
};

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    loginForm.addEventListener("submit", (event) => onSubmit(event, loginForm));
});
