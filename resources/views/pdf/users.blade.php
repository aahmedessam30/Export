<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users Table</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 5px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #04AA6D;
            color: white;
        }

    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('messages.Full Name') }}</th>
                <th scope="col">{{ __('messages.Username') }}</th>
                <th scope="col">{{ __('messages.Email') }}</th>
                <th scope="col">{{ __('messages.Phone') }}</th>
                <th scope="col">{{ __('messages.Roles') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
