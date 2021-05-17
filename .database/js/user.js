async function get_my_posts() {
    const user_id = document.querySelector("#user_id").getAttribute("value") // user id stored in view

    let url = `../api/posts?user_id=${user_id}`

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
                            <div class="row">
                                <div class="col-cm">
                                    <p><b>Created On: </b>${new Date(`${postObj["created_on"]} UTC`).toLocaleString()}</p> 
                                </div>
                            </div>
                            <div class="row">
                                <p>${postObj["post_content"]}</p>
                        </div>
                    </div>`
        )
    });
}

get_my_posts().then().catch(err => {});