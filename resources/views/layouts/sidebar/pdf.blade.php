<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF con Laravel</title>
</head>
<body>
<h1>Soy un título</h1>
<@foreach ($categoria as $item)
    <h2> $item->nombre  </h2>
@endforeach
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque consectetur corporis deleniti dolore fugit incidunt
    magni nam, nesciunt nisi pariatur perferendis quam qui quisquam sit velit? Aspernatur debitis dolore maiores!</p>
</body>
</html>
