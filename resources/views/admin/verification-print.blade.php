<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Verifikasi Kos - {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d
        {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0 0 5px 0;
            color: #333;
        }

        .header h2 {
            font-size: 14px;
            margin: 0;
            color: #666;
            font-weight: normal;
        }

        .period {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            background: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-box {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            background: #f9f9f9;
        }

        .stat-number {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        .table td {
            font-size: 10px;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
        }

        .badge-pending {
            background-color: #f59e0b;
        }

        .badge-verified {
            background-color: #10b981;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 200px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 60px;
            padding-top: 5px;
        }

        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN VERIFIKASI KOS</h1>
        <h2>Dashboard Admin</h2>
    </div>

    <div class="period">
        Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d
        {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
        @if($status)
            | Status: {{ $status === 'verified' ? 'Terverifikasi' : 'Menunggu' }}
        @endif
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <span class="stat-number">{{ $totalKos }}</span>
            <span class="stat-label">Total Kos</span>
        </div>
        <div class="stat-box">
            <span class="stat-number">{{ $pendingKos }}</span>
            <span class="stat-label">Menunggu</span>
        </div>
        <div class="stat-box">
            <span class="stat-number">{{ $verifiedKos }}</span>
            <span class="stat-label">Terverifikasi</span>
        </div>
        <div class="stat-box">
            <span class="stat-number">{{ $verifiedToday }}</span>
            <span class="stat-label">Hari Ini</span>
        </div>
    </div>

    @if($kosList->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="12%">Tanggal</th>
                    <th width="20%">Nama Kos</th>
                    <th width="18%">Pemilik</th>
                    <th width="15%">Lokasi</th>
                    <th width="12%">Harga</th>
                    <th width="8%">Status</th>
                    <th width="10%">Fasilitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kosList as $index => $kos)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kos->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <strong>{{ $kos->nama_kos }}</strong>
                            @if($kos->deskripsi)
                                <br><small style="color: #666;">{{ Str::limit($kos->deskripsi, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $kos->pemilik->name }}</strong><br>
                            {{ $kos->pemilik->email }}<br>
                            @if($kos->pemilik->phone)
                                {{ $kos->pemilik->phone }}
                            @endif
                        </td>
                        <td>{{ Str::limit($kos->lokasi, 40) }}</td>
                        <td>Rp {{ number_format($kos->harga, 0, ',', '.') }}/bln</td>
                        <td>
                            @if($kos->is_verified)
                                <span class="badge badge-verified">Terverifikasi</span>
                            @else
                                <span class="badge badge-pending">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            @if($kos->fasilitas)
                                {{ Str::limit($kos->fasilitas, 40) }}
                            @else
                                <em>Tidak ada</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px; color: #666;">
            <p>Tidak ada data kos pada periode yang dipilih.</p>
        </div>
    @endif

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i:s') }} WIB
    </div>

    <div class="signature">
        <div class="signature-box">
            <div>{{ \Carbon\Carbon::now()->format('d F Y') }}</div>
            <div class="signature-line">Administrator</div>
        </div>
    </div>

    <script>
        // Auto print when page loads
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>