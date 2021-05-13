$('#update-user-form').submit(function(e) {
    e.preventDefault();
});

async function update_user() {
    // Verify confirm password are same
    const formElement = document.querySelector("#update-user-form")

    if (!isValidPassword()) {
        return false
    }

    // post to api to update user
    const url = "/users/update"
    const request = {
        method: "POST",
        body: new FormData(formElement)
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

async function create_post() {
    const url = '/api/posts'
    const request = {
        method: "POST",
        body: new FormData(document.getElementById("create-post-form"))
    }

    const response = await fetch(url, request)
    if (!response.ok) {
        alert(`Unable to create post - response ${response.status} - ${response.statusText}`)
        return false
    }
    window.location.reload();
}


async function get_my_posts() {
    const user_id = document.querySelector("#user_id").getAttribute("value") // user id stored in view

    let url = `api/posts?user_id=${user_id}`

    const request = {
        method: "GET"
    }

    const response = await fetch(url, request);
    if (!response.ok) {
        alert(`failed to fetch posts - response ${response.status} - ${response.statusText}`)
        return false
    }

    const postsData = await response.json()

    if (!postsData || postsData.posts.length == 0) {
        console.log("No posts found")
        return false
    }

    const postArray = postsData['posts']

    //date is converted from utc time to local browser time - "2021-01-01 00:00:00 UTC"
    postArray.forEach(postObj => {
                document.getElementById("posts").insertAdjacentHTML(
                        "afterend",
                        `<div class="container post">
                    <p class="post_id" style="display: none;" value=${postObj["post_id"]}></p>
                    <div class="row">
                        <div class="col-cm">
                            <p><b>Created On: </b>${new Date(`${postObj["created_on"]} UTC`).toLocaleString()}</p> 
                        </div>
                        <div class="col-cm">
                            <button class="btn btn-outline-danger btn-sm" onClick="delete_post(this)">Delete post</button>
                        </div>
                    </div>
                    <div class="row">
                        <p>${postObj["post_content"]}</p>
                </div>
            </div>`
            
        )
    });
}


async function delete_post(clicked_button) {

    const post_id_to_delete = clicked_button.parentNode.parentNode.parentNode.querySelector(".post_id").getAttribute("value")

    const url = `/api/posts/${post_id_to_delete}/delete`
    const request = {
        method: "POST",
    }

    const response = await fetch(url, request)
    if (!response.ok) {
        alert(`Unable to delete post - response ${ response.status } - ${ response.statusText }`)
        return false
    }
    window.location.reload()
}

get_my_posts().then().catch(err => {});