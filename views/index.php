<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>

<body>
    <h1 class="text-lg font-bold my-4">Home Page</h1>
    <form action="/transactions" method="POST" enctype="multipart/form-data">
        <label for="myFile">Choose file</label>
        <input type="file" name="myFile" accept=".csv" multiple class="border border-black/20 rounded p-1" required/>
        <button class="border border-black rounded px-2 py-1 bg-white text-black hover:invert"> Upload </button>
    </form>

    <?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error): ?>
    <p> <?= htmlspecialchars($error) ?> </p>
    <?php endforeach; ?>
    <?php endif; ?>

    <div class="my-8">
        <?php include __DIR__ . '/transactions.php' ?>
    </div>

</body>

</html>