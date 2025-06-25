<!-- resources/views/calculator.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Calculator Helper</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">

<div class="container">
    <h1 class="mb-4">🧮 Calculator Helper</h1>

    {{-- Form Kalkulasi Diskon --}}
    <h4>Hitung Diskon</h4>
    <form action="{{ route('calculate.discount') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="number" name="amount" class="form-control" placeholder="Harga Awal" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="discount" class="form-control" placeholder="Diskon (%)" required>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit">Hitung Diskon</button>
            </div>
        </div>
    </form>

    {{-- Form Penjumlahan --}}
    <h4>Penjumlahan</h4>
    <form action="{{ route('calculate.add') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="number" name="a" class="form-control" placeholder="Angka pertama" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="b" class="form-control" placeholder="Angka kedua" required>
            </div>
            <div class="col-md-4">
                <button class="btn btn-success" type="submit">Jumlahkan</button>
            </div>
        </div>
    </form>

    {{-- Form Pengurangan --}}
    <h4>Pengurangan</h4>
    <form action="{{ route('calculate.subtract') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="number" name="a" class="form-control" placeholder="Angka pertama" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="b" class="form-control" placeholder="Angka kedua" required>
            </div>
            <div class="col-md-4">
                <button class="btn btn-danger" type="submit">Kurangi</button>
            </div>
        </div>
    </form>

    {{-- Menampilkan Hasil --}}
    @if (session('result'))
        <div class="alert alert-info mt-3">
            <strong>Hasil:</strong> {{ session('result') }}
        </div>
    @endif
</div>

</body>
</html>
