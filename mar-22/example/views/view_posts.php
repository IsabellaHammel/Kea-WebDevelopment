<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/app.css">
    <title>POSTS</title>
</head>
<body>

    <?php
    $post_id = 1;
    $post_status = 0; // 1 like || 0 dislike
    ?>

    <div id="posts">
        <div id="post_1" class="post" data-post-id="1">
            <div>This is post one</div>
            <button class="like <?php if($post_status == 1){echo 'hide';} ?>" onclick="like(); return false">Like</button>
            <button class="dislike <?php if($post_status == 0){echo 'hide';} ?>" onclick="dislike(); return false">Dislike</button>
        </div>
        <div id="post_2" class="post" data-post-id="2">
            <div>This is post two</div>
            <button class="like" onclick="like(); return false">Like</button>
            <button class="dislike" onclick="dislike(); return false">Dislike</button>
        </div>
        <div id="post_3" class="post" data-post-id="3">
            <div>This is post three</div>
            <button class="like" onclick="like(); return false">Like</button>
            <button class="dislike" onclick="dislike(); return false">Dislike</button>
        </div>
    </div>
    

    <script>
        async function like(){
            let button = event.target
            let buttonParent = button.parentNode
            // let post_id = buttonParent.id
            let post_id_from_data_attr = buttonParent.getAttribute("data-post-id")
            let conn = await fetch(`/posts/${post_id_from_data_attr}/1`, {
                method:"POST"
            })
            // if(conn.status != 200){alert("something went wrong")}
            if(!conn.ok){
                alert("sorry, we are updating our servers")
                return
            }
            buttonParent.querySelector(".like").classList.add('hide')
            buttonParent.querySelector(".dislike").classList.remove('hide')


            // // hide the button inside the form
            // form.style.display = "none"
        }

        async function dislike(){
            let button = event.target
            let buttonParent = button.parentNode
            // let post_id = buttonParent.id
            let post_id_from_data_attr = buttonParent.getAttribute("data-post-id")
            let conn = await fetch(`/posts/${post_id_from_data_attr}/0`, {
                method:"POST"
            })
            if(!conn.ok){
                alert("sorry, we are updating our servers")
                return
            }
            buttonParent.querySelector(".dislike").classList.add('hide')
            buttonParent.querySelector(".like").classList.remove('hide')
        }
    </script>
</body>
</html>