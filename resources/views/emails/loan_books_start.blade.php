<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <p>
            Usuario: <span>{{ $user->name }}</span>, se inicio el prestamo, gracias por usar nuestro servicio.
        </p>
        <p>
            Fecha Finalizacion prestamo: <span>{{ $date_end }}</span>
        </p>
        <table>
            <thead>
                <tr>
                    <td>
                        Titulo
                    </td>
                    <td>
                        Autor
                    </td>
                    <td>
                        Cantidad
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>
                            {{ $book->title }}
                        </td>
                        <td>
                            {{ $book->author->name }}
                        </td>
                        <td>
                            <span>
                                @if (array_search($book->id, array_column(session('books'), 'id')) !== false)
                                    <span class="badge badge-success">
                                        {{ session('books')[$book->id]['quantity'] }}
                                    </span>
                                @else
                                    <span class="badge badge-primary">0</span>
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>
            Tenga en cuenta que el prestamo se terminara en {{ $date_end }}, se notificara, si se pasa la fecha seria sansionado.
        </p>
    </div>

</body>

</html>
