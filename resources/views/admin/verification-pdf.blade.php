<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Verifikasi Kos</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 15px;
            font-size: 10px;
            line-height: 1.3;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 16px;
            margin: 0 0 5px 0;
            color: #333;
            font-weight: bold;
        }

        .header h2 {
            font-size: 12px;
            margin: 0;
            color: #666;
            font-weight: normal;
        }

        .period {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            background: #f5f5f5;
            padding: 8px;
            border-radius: 3px;
        }

        .stats-container {
            margin-bottom: 15px;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .stat-box {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            border-radius: 3px;
            background: #f9f9f9;
            width: 23%;
        }

        .stat-number {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 8px;
            color: #666;
            text-transform: uppercase;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
        }

        .table td {
            font-size: 8px;
        }

        .badge {
            padding: 1px 4px;
            border-radius: 2px;
            font-size: 7px;
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
            margin-top: 20px;
            text-align: right;
            font-size: 8px;
            color: #666;
        }

        .signature {
            margin-top: 30px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 150px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 40px;
            padding-top: 3px;
        }

        .page-break {
            page-break-after: always;
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

    <div class="stats-container">
        <div class="stats-row">
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
    </div>

    @if($kosList->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Tanggal</th>
                    <th width="20%">Nama Kos</th>
                    <th width="20%">Pemilik</th>
                    <th width="15%">Lokasi</th>
                    <th width="10%">Harga</th>
                    <th width="8%">Status</th>
                    <th width="12%">Fasilitas</th>
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
                                <br><small style="color: #666;">{{ Str::limit($kos->deskripsi, 40) }}</small>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $kos->pemilik->name }}</strong><br>
                            {{ $kos->pemilik->email }}<br>
                            @if($kos->pemilik->phone)
                                {{ $kos->pemilik->phone }}
                            @endif
                        </td>
                        <td>{{ Str::limit($kos->lokasi, 30) }}</td>
                        <td>Rp {{ number_format($kos->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($kos->is_verified)
                                <span class="badge badge-verified">Verified</span>
                            @else
                                <span class="badge badge-pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($kos->fasilitas)
                                {{ Str::limit($kos->fasilitas, 30) }}
                            @else
                                <em>-</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 30px; color: #666;">
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
</body>

</html>