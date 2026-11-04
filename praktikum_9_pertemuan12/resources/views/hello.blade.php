<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa Praktikum PBO</h1>
    <ul>
        @foreach ($mahasiswas as $mhs)
            <li>{{ $mhs->nama }} - {{ $mhs->nim }}</li>
        @endforeach
    </ul>
</body>
</html>