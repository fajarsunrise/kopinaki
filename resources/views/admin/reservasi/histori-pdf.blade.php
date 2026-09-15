<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Histori Reservasi {{ $labelPeriode }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }
        h1 {
            font-size: 18px;
            margin: 0 0 4px;
        }
        p {
            margin: 0 0 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #f3eee6;
        }
        .muted {
            color: #666;
            font-size: 10px;
        }
        .right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Histori Reservasi Kopi Naki</h1>
    <p>
        Periode {{ $periode === 'hari' ? 'harian' : 'bulanan' }}: <strong>{{ $labelPeriode }}</strong><br>
        @if ($kata !== '')
            Filter pencarian: <strong>{{ $kata }}</strong><br>
        @endif
        <span class="muted">Dicetak {{ $dicetakPada }}</span>
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Pelanggan</th>
                <th>Meja</th>
                <th>Jadwal</th>
                <th>DP</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservasis as $index => $reservasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reservasi->kode_reservasi }}</td>
                    <td>
                        {{ $reservasi->nama }}<br>
                        <span class="muted">{{ $reservasi->whatsapp }}</span>
                    </td>
                    <td>{{ $reservasi->meja->kode_meja ?? '-' }}</td>
                    <td>
                        {{ $reservasi->tanggal->format('d-m-Y') }}
                        {{ $reservasi->jam->format('H:i') }}
                    </td>
                    <td>Rp {{ number_format($reservasi->jumlah_dp, 0, ',', '.') }}</td>
                    <td>{{ $reservasi->labelStatus() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data histori pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($reservasis->isNotEmpty())
        <p class="right" style="margin-top: 12px;">
            Total data: <strong>{{ $reservasis->count() }}</strong>
            &nbsp;|&nbsp;
            Total DP: <strong>Rp {{ number_format($reservasis->sum('jumlah_dp'), 0, ',', '.') }}</strong>
        </p>
    @endif
</body>
</html>
