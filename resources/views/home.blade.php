<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Upload Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h2 {
            color: #555;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea, .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group button {
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-group button:hover {
            background: #0056b3;
        }

        .post {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .post h3 {
            margin: 0 0 10px;
        }

        .post p {
            margin: 0;
        }

        .post-actions {
            margin-top: 10px;
        }

        .post-actions a, .post-actions button {
            text-decoration: none;
            color: #1b44c9;
            margin-right: 10px;
            font-size: 0.9rem;
        }

        .post-actions button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .auth-message {
            margin-bottom: 20px;
            padding: 10px;
            background: #e2f4e2;
            border: 1px solid #b7e0b7;
            border-radius: 5px;
            color: #2d6b2d;
        }

        .save-post-btn {
            background: #28a745 !important;
            color: white;
            padding: 12px 20px !important;
            border-radius: 25px !important;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 2px 4px rgba(40, 167, 69, 0.2);
        }

        .save-post-btn:hover {
            background: #218838 !important;
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .logout-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        @auth
        <div class="auth-message">Congrats, you are logged in.</div>

        <div class="form-section">
            <h2>Create a New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter post title" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="body">Post Content</label>
                    <textarea id="body" name="body" placeholder="Enter body content..." autocomplete="off"></textarea>
                </div>
                <div class="form-group">
                    <button class="save-post-btn">Create New Post</button>
                </div>
            </form>
        </div>

        <div class="posts-section">
            <h2>All Posts</h2>
            @if(isset($posts))
                @foreach($posts as $post)
                <div class="post">
                    <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                    <p>{{$post['body']}}</p>
                    <div class="post-actions">
                        <a href="/edit-post/{{$post->id}}">Edit</a>
                        <form action="/delete-post/{{$post->id}}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <p>No posts available</p>
            @endif
        </div>

        <form action="/logout" method="POST">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
        @endauth

        @guest
        <div class="form-section">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" placeholder="Enter your name" autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Enter your email" autocomplete="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Enter your password" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <button>Register</button>
                </div>
            </form>
        </div>

        <div class="form-section">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label for="loginname">Name</label>
                    <input id="loginname" name="loginname" type="text" placeholder="Enter your name" autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="loginpassword">Password</label>
                    <input id="loginpassword" name="loginpassword" type="password" placeholder="Enter your password" autocomplete="current-password">
                </div>
                <div class="form-group">
                    <button>Log in</button>
                </div>
            </form>
        </div>
        @endguest
    </div>
</body>
</html>
