async function deactivate_user(id) {

    // post to api to update user
    const url = `/users/${id}/deactivate`
    const request = {
        method: "POST"
    }

    const response = await fetch(url, request) // await fetch to finish
    if (!response.ok) {
        alert(`Unable to deactivate user - response ${ response.status } - ${ response.statusText }`)
        return false
    }
    alert('User deactivated!')
    window.location.reload();
}

async function activate_user(id) {

    // post to api to update user
    const url = `/users/${id}/activate`
    const request = {
        method: "POST"
    }

    const response = await fetch(url, request) // await fetch to finish
    if (!response.ok) {
        alert(`Unable to activate user - response ${ response.status } - ${ response.statusText }`)
        return false
    }
    alert('User activated!')
    window.location.reload();
}