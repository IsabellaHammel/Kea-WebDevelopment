async function update_user_password() {
    // Verify confirm password are same
    const formElement = document.querySelector("#update-password-form")
    const token = document.querySelector("#token").getAttribute("value")

    if (!isValidPassword()) {
        return false
    }

    // post to api to update user
    const url = "/api/restore"
    const formData = new FormData(formElement)
    formData.append("restore_token", token)

    const request = {
        method: "POST",
        body: formData
    }

    const response = await fetch(url, request) // await fetch to finish
    if (!response.ok) {
        alert(`Unable to update password - response ${response.status} - ${response.statusText}`)
        return false
    }
    alert('Password updated!')
    return false
}

function isValidPassword() {
    let password = document.getElementById("floatingPassword").value
    let confirm_password = document.getElementById("floatingConfirmPassword").value

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