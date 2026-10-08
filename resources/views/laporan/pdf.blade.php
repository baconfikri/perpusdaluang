<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulan {{ $nama_bulan }} {{ $tahun }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f3f4f6; }
        .footer { margin-top: 40px; text-align: right; font-size: 14px; }
        .signature { margin-top: 70px; font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PERPUSTAKAAN DALUANG MANAH</h2>
        <p>Laporan Rekapitulasi Sirkulasi Peminjaman Buku</p>
        <p>Periode: Bulan {{ $nama_bulan }} {{ $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:5%; text-align:center;">No</th>
                <th style="width:15%;">Tgl Pinjam</th>
                <th style="width:25%;">Nama Peminjam</th>
                <th style="width:30%;">Judul Buku</th>
                <th style="width:15%;">Tgl Kembali</th>
                <th style="width:10%; text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $index => $item)
            <tr>
                <td style="text-align:center;">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d/m/Y') }}</td>
                <td>{{ $item->anggota->nama }}</td>
                <td>{{ $item->buku->judul_buku }}</td>
                <td>{{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d/m/Y') : '-' }}</td>
                <td style="text-align:center;">{{ $item->status_transaksi }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; padding:20px;">Tidak ada transaksi pada bulan ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Sukabumi, {{ date('d F Y') }}</p>
        <p>Pengelola Perpustakaan,</p>
        <div class="signature">{{ auth()->user()->nama }}</div>
    </div>
</body>
</html>