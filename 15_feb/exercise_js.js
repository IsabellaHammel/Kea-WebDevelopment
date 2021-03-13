/*- When the user saves an item the id of the item is also stored in localStorage. 
  The id is automatically generated (Math.random())
- Since the item is not only a name anymore, I suggest you use JSON objects for it.
  {"id":12212, "name":"THE NAME YOU GIVE TO IT"}
  localStorage that has text that looks like an array with JSON objects in it
- When the objects are rendered, the id is also shown
- When the user clicks on "delete item", then item is deleted from the website and also from localStorage. 
  You will need a loop and an if statement to compare the id of the element with the id of localStorage*/
// #########################################################################################################

function create_item() {
    const item_name = document.querySelector("#item_name").value
    const item = prepare_item(item_name)
    save_item(item)
    render_item(item)
}

function prepare_item(name) {
    const item = {
        "id": Math.floor(Math.random() * 100).toString(),
        "name": name
    }
    return item
}

function save_item(item) {
    let items = []

    if (localStorage.items) {
        items = JSON.parse(localStorage.items)
    }
    items.push(item)
    commit_storage(items)
}

function delete_item(clicked_button) {
    const items_json = localStorage.items

    if (!items_json) {
        return
    }

    const items = JSON.parse(items_json)
    const item_id_to_delete = clicked_button.parentNode.querySelector(".div_id").innerText

    const items_to_save = []

    for (const item of items) {
        if (item["id"] != item_id_to_delete) {
            items_to_save.push(item)
        }
    }
    commit_storage(items_to_save)
    location.reload()
}

function commit_storage(items) {
    const items_stringified = JSON.stringify(items)
    localStorage.items = items_stringified
}

// ###########

function show_items() {
    if (localStorage.items) {
        const items = JSON.parse(localStorage.items) // array of dict = item

        items.forEach(item => render_item(item))

        // for (const item of items){
        //   render_item(item)
        // }
    }
}
show_items()

// ###########


function render_item(item) {
    let div_item = `
    <div class="item">
        <div class="div_id">${item["id"]}</div>
        <div class="div_name">${item["name"]}</div>
        <button onclick="delete_item(this)">Delete item</button>
    </div>`
    document.querySelector("#items").insertAdjacentHTML('beforeend', div_item)
}