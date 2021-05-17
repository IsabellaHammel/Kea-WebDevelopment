# Homework - PHP validation only, views, bridges

## Create a signup form
- name min 2 max 20
- last name min 2 max 20
- phone 8 digits - cannot start with a 0 - use a regex
- email - must be a valid email
- password - min 8 max 50
- confirm password - same as the password, they must match

# bridge
- success -> if all the data is valid, redirect the user to the login form
- error -> take the user back to the signup form with a nice message displaying the error

# routes
- get -> signup view
- post -> signup form data
- get error -> signup error