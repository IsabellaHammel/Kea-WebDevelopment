$('#update-user-form').submit(function(e) {
    e.preventDefault();
});

async function update_user() {
    // Verify confirm password are same
    if (!isValidPassword()) {
        return false
    }

    const formElement = document.querySelector("#update-user-form")
    const formData = new FormData(formElement)

    // post to api to update user
    const url = "/users/update"
    const request = {
        method: "POST",
        body: formData
    }

    const response = await fetch(url, request) // await fetch to finish
    if (!response.ok) {
        alert(`Unable to update user - response ${response.status} - ${response.statusText}`)
        return false
    }
    alert('User updated!')
    window.location.reload();
}

function toggle_update() {
    const update_element = document.getElementsByClassName("user-update")[0].classList
    const update_button = document.getElementById("toggle_update_btn")
    if (update_element.contains("hide")) {
        update_element.remove("hide")
        update_button.innerHTML = "Hide Update Info"

    } else {
        update_element.add("hide")
        update_button.innerHTML = "Show Update Info"
    }
}

function isValidPassword() {
    let password = document.getElementById("floatingPassword").value
    let confirm_password = document.getElementById("floatingConfirmPassword").value

    if (password.length == 0) {
        return true
    }

    if (password.length < 8 || password.length > 50) {
        alert("Password is invalid")
        return false
    }

    if (password !== confirm_password) {
        alert("Password does not match")
        return false
    }
    return true
}