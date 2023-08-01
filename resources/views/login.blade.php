<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            border: 3px solid black;
            background-color: white;
        }
        
        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .container form {
            display: flex;
            flex-direction: column;
        }
        
        .container input[type="text"],
        .container input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .container button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="Username">
            <input name="loginpassword" type="password" placeholder="Password">
            <button type="submit">Log in</button>
        </form>
    </div>
</body>
</html>
