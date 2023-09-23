<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/htmx.org@1.9.5"></script>
    <link rel="icon" href="/img/azul.png">


</head>
<body>
    <?php if (isset($includeNav) && $includeNav) include 'partials/header.php'; ?>
    
        <?php include $content; ?>
    
    <?php if (isset($includeNav) && $includeNav) include 'partials/footer.php'; ?>

</body>
</html>