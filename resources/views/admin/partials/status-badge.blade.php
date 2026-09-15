@if ($reservasi->status === 'menunggu_pembatalan')
    <span class="badge text-bg-warning">Menunggu pembatalan</span>
@elseif ($reservasi->status_pembayaran === 'menunggu_verifikasi')
    <span class="badge text-bg-warning">Menunggu verifikasi bayar</span>
@elseif ($reservasi->status_pembayaran === 'lunas')
    <span class="badge text-bg-success">Lunas</span>
@elseif ($reservasi->status_pembayaran === 'dikembalikan')
    <span class="badge text-bg-secondary">DP dikembalikan</span>
@elseif ($reservasi->status_pembayaran === 'kadaluarsa')
    <span class="badge text-bg-secondary">Kadaluarsa</span>
@elseif ($reservasi->status === 'dibatalkan')
    <span class="badge text-bg-secondary">Dibatalkan</span>
@elseif ($reservasi->status === 'selesai')
    <span class="badge text-bg-dark">Selesai</span>
@else
    <span class="badge text-bg-info">Belum bayar</span>
@endif
