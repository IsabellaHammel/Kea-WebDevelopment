var search_timer // used to stop the search_timer

function search() {
    if (search_timer) { clearTimeout(search_timer) }
    if (event.target.value.length >= 2) {
        search_timer = setTimeout(async function() { // how long we wait for the reponse

            const users = await search_users()

            // populate the results
            document.querySelector("#search_results").innerHTML = ""
            users.forEach(user => {
                let user_div = `
                    <div class="search_result">
                        <a href="/users/${user.user_id}">${user.user_fullname}</a>
                    </div>`
                document.querySelector("#search_results").insertAdjacentHTML('beforeend', user_div)
            })

            show_results()
        }, 500)
    } else {
        hide_results()
    }
}

async function search_users() { // async denotes function is run in background process/thread
    const url = '/search'
    const request = {
        method: "POST",
        body: new FormData(document.querySelector("form"))
    }

    let response = await fetch(url, request) // await fetch to finish
    if (!response.ok) { alert('Unable to search for users') }

    let users = await response.json()
    return users
}


$(document).on("click", function(event) { // event (click) handler in jquery
    // if click is not part of search and its child elements --> hide
    const is_not_in_search_element = $(event.target).closest("#search").length === 0

    if (is_not_in_search_element) {
        hide_results()
    }
});

function show_results() {
    document.querySelector("#search_results").style.display = "grid"
}

function hide_results() {
    document.querySelector("#search_results").style.display = "none"
}