<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    <style>
        body {font-family: Arial, sans-serif; background-color: #813434;}
        h1 {text-align: center; margin-top: 20px; color: #000000;}
        form {max-width: 600px; margin: 0 auto; padding: 20px; border: 2px solid #ccc; background-color: #fff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);}
        input[type="text"], textarea, select {display: block; width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px;}
        select {background-color: #f9f9f9;}
        label {display: block; font-weight: bold; margin-bottom: 5px;}
        button[type="submit"] {padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;}
        button[type="submit"]:hover {background-color: #45a049;}
        div {margin-top: 15px;}
        div label {display: inline-block; margin-right: 10px; font-weight: normal;}
        div input[type="checkbox"] {vertical-align: middle;}
        div p {font-size: 16px; margin-bottom: 5px;}
        #nddf {margin-top: 0px; background: #333; border: none; border-radius: 0px; box-shadow: 0 0 0 0; padding: 0%;}
    </style>
</head>
<body>
    <nav id="nd" style="background-color: #333; color: #fff; padding: 10px; text-align: center; margin-top: 0px;">
        <form id="nddf" action="/logout" method="POST" >
            <button id="dnd" class="logout-button"> <a href="{{ route('home') }}" style="color: black; text-decoration: none;">Home</a></button>
            @csrf 
            <button style="margin-left: 10px;" class="logout-button">Logout</button>
        </form>
    </nav>

    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <label>Title</label>
        <input type="text" name="title" value="{{$post->title}}" required>
        
        <label>Body</label>
        <textarea name="body" required>{{$post->body}}</textarea>

        <!-- Display Category -->
        <label>Current Category: {{ $category->name }}</label>
        <select id="categorySelect" name="category_id" required>
            <option value="">Select a new category</option>
            @foreach(App\Models\Category::all() as $categoryOption)
                <option value="{{ $categoryOption->id }}" {{ $categoryOption->id === $category->id ? 'selected' : '' }}>
                    {{ $categoryOption->name }}
                </option>
            @endforeach
        </select>

        <input type="hidden" name="category_id" value="{{ $category->id }}" id="categoryIdInput">

        <!-- Display Selected Tags -->
        <label>Selected Tags:</label>
        @foreach($tags as $tag)
            {{ $tag->name }}
        @endforeach

        <!-- Display Available Tags -->
        <div>
                 <label>Tags:</label>
            @foreach(App\Models\Tags::all() as $tag)
                <label>
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        {{ in_array($tag->id, $tags->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
        <button type="submit">Save Changes</button>
    </form>

    <script>
        const categorySelect = document.getElementById('categorySelect');

        categorySelect.addEventListener('DOMContentLoaded', () => {
            document.getElementById('categoryIdInput').value = categorySelect.value;
        });

        categorySelect.addEventListener('change', () => {
            document.getElementById('categoryIdInput').value = categorySelect.value;
        });
    </script>
</body>
</html>
