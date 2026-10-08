<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Peminjaman - {{ $peminjaman->anggota->nama }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; line-height: 1.5; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #22c55e; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #166534; }
        .header p { margin: 5px 0 0; font-size: 12px; color: #555; }
        .content { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f0fdf4; color: #166534; width: 35%; }
        .footer { text-align: right; margin-top: 40px; }
        .signature { margin-top: 60px; font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PERPUSTAKAAN DALUANG MANAH</h2>
        <p>Kelurahan Cipanengah, Kota Sukabumi</p>
        <p><strong>BUKTI TRANSAKSI PEMINJAMAN BUKU</strong></p>
    </div>

    <div class="content">
        <p>Data Peminjam:</p>
        <table>
            <tr>
                <th>Nomor Anggota</th>
                <td>{{ $peminjaman->anggota->nomor_anggota }}</td>
            </tr>
            <tr>
                <th>Nama Peminjam</th>
                <td>{{ $peminjaman->anggota->nama }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $peminjaman->anggota->no_telp }}</td>
            </tr>
        </table>

        <p style="margin-top:20px;">Detail Buku yang Dipinjam:</p>
        <table>
            <tr>
                <th>ID Transaksi</th>
                <td>TRX-{{ str_pad($peminjaman->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <th>Judul Buku</th>
                <td>{{ $peminjaman->buku->judul_buku }}</td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Batas Pengembalian</th>
                <td style="color:red; font-weight:bold;">{{ \Carbon\Carbon::parse($peminjaman->tenggat_waktu)->format('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Sukabumi, {{ date('d F Y') }}</p>
        <p>Admin / Petugas Perpustakaan,</p>
        <div class="signature">
            {{ auth()->user()->nama }}
        </div>
    </div>
</body>
</html>