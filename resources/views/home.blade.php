<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #813434;
            margin: 0;
            padding: 0;
        }
        
        /* Container for the logged-in section */
        .logged-in-container {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            border: 3px solid #333;
            border-radius: 10px;
        }
        
        /* Log out button */
        .logout-button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
          /* making this button appear in the rightmost corner of the screen */
          
        }
        
        /* Navigation links */
        .nav-links {
            margin-top: 10px;
        }
        
        .nav-links a {
            display: inline-block;
            margin-right: 10px;
            text-decoration: none;
            color: #090707;
        }
        
        /* Create a New Post section */
        .create-post-container {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            border: 3px solid #333;
            border-radius: 10px;
        }
        
        .create-post-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .create-post-container input[type="text"],
        .create-post-container textarea,
        .create-post-container select {
            display: block;
            width: 99%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .create-post-container button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        /* Container for the blog posts */
        .blog-posts-container {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            border: 3px solid #333;
            border-radius: 10px;
        }
        
        .blog-posts-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .blog-post {
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        
        /* Welcome message for non-logged-in users */
        .welcome-message-container {
            border: 10px solid #0d0d0d;
            background-color: #cd5d07;
            padding: 20px;
            text-align: center;
            color: #100d0d;
           
           
           
        }
        
        .welcome-message-container h2 {
            font-size: 24px;
            margin: 0;
        }

   
    </style>
</head>
<body>
    @auth

     <div class="welcome-message-container">
        <h2>Welcome to My Blog with Laravel</h2>
    </div>
    <br>
    <br>
    <div class="logged-in-container">
        <p style="text-align: center; font-size: 20px;">Congrats you are logged in</p>
        <form action="/logout" method="POST">
            @csrf 
            <button class="logout-button">Logout</button>
            <br>
           <div class="nav-links" style="text-align: center;">
    <a href="{{ url('viewcategory') }}" style="font-size: 18px; text-decoration: underline; margin-right: 15px;">Categories</a>
    <a href="{{ url('viewtag') }}" style="font-size: 18px; text-decoration: underline;">Tags</a>
</div>

        </form>

        <!-- Other HTML code above -->

        <div class="create-post-container">
            <h2>Create a New Post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Title" required>
                <textarea name="body" placeholder="Body content..." required></textarea>
                <select name="category_id" required>
    <option value="">Select a category</option>
    @foreach(App\Models\Category::all() as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
                <div>
                    Tags:
                    @foreach(App\Models\tags::all() as $tag)
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
                <br>
                <button type="submit">Save post</button>
            </form>
        </div>

        <!-- Include the 'all-posts.blade.php' file -->
        @include('all-posts')
    </div>
    @else 
    <div class="welcome-message-container">
        <h2>Welcome to My Blog with Laravel</h2>
    </div>
    <div style="background: rgb(18, 26, 29); ">
        <br>
        @include('login')
        <br>
        @include('register')
    </div>
    @endauth
</body>
</html>
