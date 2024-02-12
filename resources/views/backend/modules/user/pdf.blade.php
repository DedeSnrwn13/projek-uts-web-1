<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Dede Sunarwan" />

    <title>Laporan Daftar User PDF</title>
</head>

<body>
    <h5 style="text-align: center;">Laporan Daftar User PDF</h5>

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                    <td>{{ $user->created_at != $user->updated_at ? $user->updated_at->toDayDateTimeString() : 'No Updated' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
