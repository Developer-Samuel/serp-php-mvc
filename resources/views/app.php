<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

    <link rel="stylesheet" href="<?= vite_css('app.ts') ?>">
</head>
<body>
    <div
        id="app"
        data-page='<?= inertia_page($page) ?>'
    ></div>

    <script type="module" src="<?= vite('app.ts') ?>"></script>
</body>
</html>