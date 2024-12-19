<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
</head>
<body>

    @auth
    <p>Congrats you are logged in.</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Logout</button>
    </form>

    <div style="border: 3px solid black;" >
        <h2>Create a New Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="post title" autocomplete="off">
            <textarea name="body" placeholder="body content..." autocomplete="off"></textarea>
            <button>Save Post</button>
        </form>
    </div>

    <div style="border: 3px solid black;" >
        <h2>All Posts</h2>
        @if(isset($posts))
            @foreach($posts as $post)
            <div style="background-color: gray; padding: 10px; margin: 10px;">
                <h3>{{$post['title']}}</h3>
                {{$post['body']}}
            </div>
            @endforeach
        @else
            <p>No posts available</p>
        @endif
    </div>
    @endauth

    @guest
    <div style="border: 3px solid black;" >
        <h2>Register</h2>
        <form action="/register" method="POST">
              @csrf
              <input name="name" type="text" placeholder="name" autocomplete="name">
              <input name="email" type="text" placeholder="email" autocomplete="email">
              <input name="password" type="password" placeholder="password" autocomplete="new-password">
              <button>Register</button>
        </form>
    </div>

    <div style="border: 3px solid black;" >
        <h2>Login</h2>
        <form action="/login" method="POST">
              @csrf
              <input name="loginname" type="text" placeholder="name" autocomplete="username">
              <input name="loginpassword" type="password" placeholder="password" autocomplete="current-password">
              <button>Log in</button>
        </form>
    </div>
    @endguest

</body>
</html>
