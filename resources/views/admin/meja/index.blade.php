@extends('layouts.admin')

@section('title', 'Data Meja - Kopi Naki')

@section('admin')

<div class="reservation-card mb-4">
    <h2 class="reservation-title mb-1">Tambah Meja Baru</h2>
    <p class="reservation-subtitle mb-4">
        Meja yang berstatus tidak aktif akan berwarna kuning pada halaman pilih meja.
    </p>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.meja.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Lantai</label>
                <select name="lantai" id="admin-lantai" class="form-select" required>
                    <option value="">Pilih lantai</option>
                    <option value="1" @selected(old('lantai') == '1')>Lantai 1</option>
                    <option value="2" @selected(old('lantai') == '2')>Lantai 2</option>
                    <option value="3" @selected(old('lantai') == '3')>Lantai 3</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Nomor Meja</label>
                <input type="number" name="nomor_meja" class="form-control" min="1" value="{{ old('nomor_meja') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" min="1" value="{{ old('kapasitas') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Pemandangan</label>
                <select name="pemandangan" id="admin-pemandangan" class="form-select" required>
                    <option value="">Pilih pemandangan</option>
                    <option value="indoor" @selected(old('pemandangan') === 'indoor')>Indoor</option>
                    <option value="outdoor" @selected(old('pemandangan') === 'outdoor')>Outdoor</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fasilitas</label>
                <select name="fasilitas" id="admin-fasilitas" class="form-select" required>
                    <option value="">Pilih fasilitas</option>
                    <option value="parkiran" @selected(old('fasilitas') === 'parkiran')>Dekat parkiran</option>
                    <option value="kasir" @selected(old('fasilitas') === 'kasir')>Dekat kasir</option>
                    <option value="no_smoking" @selected(old('fasilitas') === 'no_smoking')>Area no smoking</option>
                    <option value="kamar_mandi" @selected(old('fasilitas') === 'kamar_mandi')>Dekat kamar mandi</option>
                    <option value="mushola" @selected(old('fasilitas') === 'mushola')>Dekat mushola</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="tersedia" @selected(old('status', 'tersedia') === 'tersedia')>Aktif / tersedia</option>
                    <option value="nonaktif" @selected(old('status') === 'nonaktif')>Tidak aktif</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="2">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Gambar meja (opsional)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-recommend">
                    <i class="bi bi-plus-lg me-1"></i>
                    Simpan Meja
                </button>
            </div>
        </div>
    </form>
</div>

<div class="reservation-card">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <h2 class="reservation-title mb-0">Daftar Meja</h2>
        <form method="GET" action="{{ route('admin.meja.index') }}" class="flex-grow-1" style="max-width: 420px;">
            <div class="input-group">
                <input
                    type="text"
                    name="q"
                    class="form-control"
                    value="{{ $kata }}"
                    placeholder="Cari kode, lantai, atau fasilitas"
                >
                <button class="btn btn-recommend" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Lantai</th>
                    <th>Kapasitas</th>
                    <th>Pemandangan</th>
                    <th>Fasilitas</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mejas as $meja)
                    <tr>
                        <td class="fw-bold">{{ $meja->kode_meja }}</td>
                        <td>{{ $meja->lantai }}</td>
                        <td>{{ $meja->kapasitas }} orang</td>
                        <td>{{ ucfirst($meja->pemandangan) }}</td>
                        <td>{{ $meja->labelFasilitas() }}</td>
                        <td>
                            @if ($meja->status === 'nonaktif')
                                <span class="badge text-bg-warning">Tidak aktif</span>
                            @else
                                <span class="badge text-bg-success">Aktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if ($meja->status === 'nonaktif')
                                <form method="POST" action="{{ route('admin.meja.aktifkan', $meja) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm">Aktifkan</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.meja.nonaktifkan', $meja) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-warning btn-sm">Tidak aktif</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Tidak ada data meja{{ $kata !== '' ? ' untuk pencarian tersebut' : '' }}.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $mejas->links() }}
</div>

@endsection

@section('js')
<script>
    (function () {
        const aturan = {
            1: { pemandangan: ['indoor', 'outdoor'], fasilitas: ['parkiran', 'kasir'] },
            2: { pemandangan: ['indoor'], fasilitas: ['no_smoking'] },
            3: { pemandangan: ['indoor', 'outdoor'], fasilitas: ['kamar_mandi', 'mushola'] }
        };
        const lantaiSelect = document.getElementById('admin-lantai');
        const pemandanganSelect = document.getElementById('admin-pemandangan');
        const fasilitasSelect = document.getElementById('admin-fasilitas');

        function aturOpsi(select, allowed) {
            const current = select.value;
            Array.from(select.options).forEach(function (option) {
                if (!option.value) {
                    return;
                }
                const boleh = allowed.indexOf(option.value) !== -1;
                option.disabled = !boleh;
                option.hidden = !boleh;
            });
            if (current && allowed.indexOf(current) === -1) {
                select.value = '';
            }
        }

        function terapkan() {
            const aturanLantai = aturan[lantaiSelect.value];
            if (!aturanLantai) {
                aturOpsi(pemandanganSelect, []);
                aturOpsi(fasilitasSelect, []);
                return;
            }
            aturOpsi(pemandanganSelect, aturanLantai.pemandangan);
            aturOpsi(fasilitasSelect, aturanLantai.fasilitas);
        }

        lantaiSelect.addEventListener('change', terapkan);
        terapkan();
    })();
</script>
@endsection
