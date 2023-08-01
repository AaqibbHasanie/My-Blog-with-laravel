@if (session('success'))
    <div style="background-color: #4CAF50; color: #fff; text-align: center; padding: 10px;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="background-color: #f44336; color: #fff; text-align: center; padding: 10px;">
        {{ session('error') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #813434;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        table {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            background-color: #fff;
            border: 2px solid black;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .add-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .add-btn:hover {
            background-color: #45a049;
        }
        .form-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
        }
        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-container button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container button[type="submit"]:hover {
            background-color: #45a049;
        }

        .table-container {
            border: 1px solid black;
            width: 90%;
            background-color: white;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 30px;
        }
    </style>
</head>
<body>
      <nav style="background-color: #333; color: #fff; padding: 10px; text-align: center;">
    
      <form action="/logout" method="POST">
        <button class="logout-button"> <a href="{{ route('home') }}" style="color: black;  text-decoration: none;">Home</a></button>
            @csrf 
            <button style="margin-left: 14px;" class="logout-button">Logout</button>
        </form>
</nav>
    <div class="table-container">
        <br><br>
        <h1>All Categories</h1>
        <button class="add-btn" id="add-category-btn" >Add Category</button>

        <div class="form-container" id="category-form">
            <form action="/create-category" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Enter Category Name" style="width: 96%;">
                <button type="submit">Save Category</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="/delete-category/{{ $category->id }}" method="POST"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}')" style="margin-top:10px;">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form-container" id="edit-form-container">
            <form id="edit-form" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="name" id="edit-category-name" style="width: 96%;">
                <button type="submit">Update</button>
            </form>
        </div>
        <br><br><br>
    </div>

    <script>
        document.getElementById("add-category-btn").addEventListener("click", function() {
            var categoryForm = document.getElementById("category-form");
            categoryForm.style.display = "block";
        });

        function editCategory(categoryId, categoryName) {
            var editFormContainer = document.getElementById("edit-form-container");
            editFormContainer.style.display = "block";
            var editForm = document.getElementById("edit-form");
            editForm.action = "/update-category/" + categoryId;
            document.getElementById("edit-category-name").value = categoryName;
        }
    </script>
</body>
</html>
