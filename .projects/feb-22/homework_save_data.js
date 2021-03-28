// Create a system that uses javascript objects with functions in it.
// When the user clicks on that button, the data is saved in a json object that is pushed to an array
// the system is coded with javascript objects - functions in objects
// the data is validated before it is pushed to the array
// when the data is pushed, the newly created user appears in the DOM

let usersDb = []

const user_handler = {
    "show_user": function(user) {
        const div_user = `
            <div class="user">
                <p id="user_id"><b>${user.id}</b></p>
                <p><b>Name: </b>${user.fullname()}</p>
                <p><b>Phone: </b>${user.phone}</p>
                <p><b>Email: </b>${user.email}</p>
                <button onclick="user_handler.delete(this)"> <!-- this refers to clicked button -->
                    delete
                </button>
            </div>`
        one("#users").insertAdjacentHTML("beforeend", div_user)
    },
    "show_users": function() {
        usersDb.forEach(user => {
            this.show_user(user)
        })
    },
    "delete": function(clicked_button) {
        if (usersDb.length == 0) {
            return
        }
        const user_id_to_delete = clicked_button.parentNode.querySelector("#user_id").innerText

        // only take users that are not matching user we want to delete
        // filter returns a new array that we replace the old usersDb with - the filter uses a lambda function in parameter
        const users_to_save = usersDb.filter(user_in_db => user_in_db.id != user_id_to_delete)

        usersDb = users_to_save
        event.target.parentNode.remove()
        console.log(usersDb)
    }
}

// MAIN
user_handler.show_users()
    // -----------------------------

// all functions below can also be moved into user_handler

function save_user() { // Called on submit
    const is_general_inputs_valid = validate_general()
    const is_password_valid = validate_password()

    if (!is_general_inputs_valid || !is_password_valid) {
        return
    }

    const user = prepare_user()
    usersDb.push(user)
    user_handler.show_user(user)
}

function prepare_user() {
    const user = {
        id: Math.floor(Math.random() * 100).toString(),
        firstname: one("#first_name").value,
        lastname: one("#last_name").value,
        phone: one("#phone").value,
        email: one("#email").value,
        password: one("#password").value,
        fullname: function() { return `${this.firstname} ${this.lastname}` },
        toJson: function() { return JSON.stringify(this) } // this refers to itself, stringify only converts attributes and not functions
    }
    return user
}

function validate_general() {
    // clear errors
    all("[data-input-type]").forEach(element => {
        element.classList.remove("error")
    })

    // validate fields
    let is_ok = true

    all("[data-input-type]").forEach(element => {
        switch (element.getAttribute("data-input-type")) { //str or int
            case "str":
                if (!is_valid_input_text(element)) {
                    is_ok = false
                }
                break

            case "int":
                if (!is_valid_phone(element)) {
                    is_ok = false
                }
                break

            case "email":
                // if (!is_valid_email(element)) {
                //     is_ok = false
                // }

                // Ternary operator is same as above if
                // condition ? value_if_true : value_if_false
                is_ok = !is_valid_email(element) ? false : is_ok
                break
        }
    })
    return is_ok
}

function validate_password() {
    const password_elememt = one("#password")
    const confirm_password_element = one("#confirm_password")
    const is_input_valid = is_valid_input_text(password_elememt)
    const is_password_confirmed = password_elememt.value === confirm_password_element.value

    if (!is_password_confirmed) {
        confirm_password_element.classList.add("error")
    }
    return is_input_valid && is_password_confirmed
}

function is_valid_input_text(element) {
    const min = element.getAttribute("data-min")
    const max = element.getAttribute("data-max")
    let total_characters = element.value.length
    if (total_characters < min || total_characters > max) {
        element.classList.add("error")
        return false
    }
    return true
}

function is_valid_phone(element) {
    const min = parseInt(element.getAttribute("data-min")) // text to number with parseInt()
    const max = parseInt(element.getAttribute("data-max")) // text to number with parseInt()
    let phone = parseInt(element.value)
    if (!phone || phone < min || phone > max) {
        element.classList.add("error")
        return false
    }
    return true
}

function is_valid_email(element) {
    const re = /^[a-z0-9]+[\._]?[a-z0-9]+[@]\w+[.]\w{2,3}$/;
    if (!re.test(element.value.toLowerCase())) {
        element.classList.add("error")
        return false
    }
    return true
}

function clear_error() {
    event.target.classList.remove("error")
}

function one(selector) {
    return document.querySelector(selector)
}

function all(selector) {
    return document.querySelectorAll(selector)
}