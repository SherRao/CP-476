const onSubmit = (event, form) => {
    event.preventDefault();

    const data = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "login.php");
    xhr.onload = onLoad;
    xhr.send(data);
};

const onLoad = () => {
    if (xhr.status !== 200) {
        document.getElementById("messages").innerHTML = "<h3>Login Failed</h3>";
        return;
    }

    const response = JSON.parse(xhr.responseText);
    if (response.connected === "true")
        location.href = "/index.html";

    else if(response.message)
        document.getElementById("messages").innerHTML = response.message;

    else
        document.getElementById("messages").innerHTML = "<h3>Login Failed</h3>";

};

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    loginForm.addEventListener("submit", (event) => onSubmit(event, loginForm));
});
