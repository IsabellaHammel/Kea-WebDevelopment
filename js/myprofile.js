async function update_user() {
    // Verify confirm password are same
    const formElement = document.querySelector("#update-user")


    // post to api to update user
    const url = "/users/update"
    const request = {
        method: "POST",
        body: new FormData(formElement)
    }

    const response = await fetch(url, request) // await fetch to finish
    if (!response.ok) {
        alert(`Unable to update user - response ${response.status} - ${response.statusText}`)
    } else {
        alert('User updated!')
    }

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