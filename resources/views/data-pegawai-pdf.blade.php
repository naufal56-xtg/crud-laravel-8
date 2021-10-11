<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <table id="customers">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Pegawai</th>
                <th width="10%">Jenis Kelamin</th>
                <th>No Handphone</th>
                <th>Tanggal Buat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
            <tr>
                <td class="py-5">{{ $index+1}}</td>
                <td class="py-5">{{ $item->nama }}</td>
                <td class="py-5">{{ $item->jenis_kl }}</td>
                <td class="py-5">{{ $item->no_telp }}</td>
                <td class="py-5">{{ $item->created_at->format('d F, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>