<table>
    <thead>
        <tr>
            <th style="font-weight: bold;">Nama</th>
            <th style="font-weight: bold;">Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>