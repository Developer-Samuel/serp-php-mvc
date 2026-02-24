<?php

declare(strict_types=1);

use App\Core\Template\Vite;

$page = $_SERVER['INERTIA_PAGE'] ?? [
    'component' => 'Pages/Home',
    'props' => [],
    'url' => '/'
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

    <link rel="stylesheet" href="<?= Vite::css('resources/ts/app.ts') ?>">
</head>
<body>
    <div
        id="app"
        data-page='<?= htmlspecialchars(json_encode($page), ENT_QUOTES, 'UTF-8') ?>'
    ></div>

    <script type="module" src="<?= Vite::asset('resources/ts/app.ts') ?>"></script>
</body>
</html>