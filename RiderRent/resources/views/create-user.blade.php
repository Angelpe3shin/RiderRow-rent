<!-- resources/views/create-user.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create a New User</h1>

    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->

    <form action="/createUser" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Поля для данных пользователя -->
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="Max" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="Mustermann" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="test@gmail.com" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="4917612345678" required>

        <label for="password">Password:</label>
        <input type="password" name="password" value="test123" required>

        <!-- Поля для данных адреса -->
        <label for="street">Street:</label>
        <input type="text" name="street" value="Test Street" required>

        <label for="house_number">House Number:</label>
        <input type="text" name="house_number" value="52" required>

        <label for="zip_code">ZIP Code:</label>
        <input type="text" name="zip_code" value="04109" required>

        <label for="city">City:</label>
        <input type="text" name="city" value="Leipzig" required>

        <!-- Поля для данных страны -->
        <label for="country_name">Country Name:</label>
        <input type="text" name="country_name" value="Germany" required>

        <label for="country_code">Country Code:</label>
        <input type="text" name="country_code" value="DE" required>

        <button type="submit">Create User</button>
    </form>
</body>
</html>
