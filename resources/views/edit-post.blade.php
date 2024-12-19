<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
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
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #555;
            text-align: center;
            margin-bottom: 20px;
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
            height: 150px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Post</h1>
        <form action="/edit-post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" id="title" name="title" value="{{$post->title}}" required>
            </div>
            <div class="form-group">
                <label for="body">Post Content</label>
                <textarea id="body" name="body" required>{{$post->body}}</textarea>
            </div>
            <div class="form-group">
                <button>Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
