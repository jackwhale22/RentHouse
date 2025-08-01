<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pesan</title>
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
        
        .badge-pending { background-color: #f59e0b; }
        .badge-contacted { background-color: #3b82f6; }
        .badge-closed { background-color: #6b7280; }
        .badge-selesai { background-color: #10b981; }
        .badge-dibatalkan { background-color: #ef4444; }
        
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
        <h1>LAPORAN PESAN KOS</h1>
        <h2>{{ auth()->user()->name }}</h2>
    </div>
    
    <div class="period">
        Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
        @if($statusKontak)
            | Status Kontak: {{ ucfirst($statusKontak) }}
        @endif
        @if($statusTransaksi)
            | Status Transaksi: {{ ucfirst($statusTransaksi) }}
        @endif
    </div>
    
    <div class="stats-container">
        <div class="stats-row">
            <div class="stat-box">
                <span class="stat-number">{{ $totalMessages }}</span>
                <span class="stat-label">Total Pesan</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ $pendingMessages }}</span>
                <span class="stat-label">Menunggu</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ $contactedMessages }}</span>
                <span class="stat-label">Dihubungi</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">{{ $completedTransactions }}</span>
                <span class="stat-label">Selesai</span>
            </div>
        </div>
    </div>
    
    @if($messages->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Tanggal</th>
                    <th width="20%">Penyewa</th>
                    <th width="20%">Kos</th>
                    <th width="25%">Pesan</th>
                    <th width="10%">Status Kontak</th>
                    <th width="10%">Status Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $index => $message)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <strong>{{ $message->penyewa->name }}</strong><br>
                            {{ $message->penyewa->email }}<br>
                            @if($message->penyewa->phone)
                                {{ $message->penyewa->phone }}
                            @endif
                        </td>
                        <td>
                            <strong>{{ $message->kos->nama_kos }}</strong><br>
                            {{ Str::limit($message->kos->lokasi, 30) }}
                        </td>
                        <td>
                            @if($message->catatan)
                                {{ Str::limit($message->catatan, 80) }}
                            @else
                                <em>Tidak ada pesan</em>
                            @endif
                        </td>
                        <td>
                            @if($message->status_kontak == 'pending')
                                <span class="badge badge-pending">Menunggu</span>
                            @elseif($message->status_kontak == 'contacted')
                                <span class="badge badge-contacted">Dihubungi</span>
                            @else
                                <span class="badge badge-closed">Ditutup</span>
                            @endif
                        </td>
                        <td>
                            @if($message->status_transaksi == 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($message->status_transaksi == 'selesai')
                                <span class="badge badge-selesai">Selesai</span>
                            @else
                                <span class="badge badge-dibatalkan">Dibatalkan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 30px; color: #666;">
            <p>Tidak ada data pesan pada periode yang dipilih.</p>
        </div>
    @endif
    
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y, H:i:s') }} WIB
    </div>
    
    <div class="signature">
        <div class="signature-box">
            <div>{{ \Carbon\Carbon::now()->format('d F Y') }}</div>
            <div class="signature-line">{{ auth()->user()->name }}</div>
        </div>
    </div>
</body>
</html>