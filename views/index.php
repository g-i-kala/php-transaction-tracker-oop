<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    Home Page
    <form action="/upload" method="POST" enctype="multipart/form-data">
        <label for="myFile">Choose file</label>
        <input type="file" name="myFile" accept=".csv" multiple/>
        <button> Upload </button>
    </form>

    <?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error): ?>
    <p> <?= htmlspecialchars($error) ?> </p>
    <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>