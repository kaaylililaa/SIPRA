<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - SIPRA</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f3ef;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
        }

        h1 {
            color: #5c3d2e;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
        }

        .simpan {
            background: #6f4e37;
            color: white;
        }

        .kembali {
            background: #ddd;
            color: #333;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="nama_kategori">
            Nama Kategori
        </label>

        <input
            type="text"
            id="nama_kategori"
            name="nama_kategori"
            value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
            required
        >

        <button type="submit" class="btn simpan">
            Simpan Perubahan
        </button>

        <a href="{{ route('kategori.index') }}" class="btn kembali">
            Kembali
        </a>

    </form>

</div>

</body>
</html>