<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MejaController extends Controller
{
    public function index(Request $request)
    {
        $kata = trim((string) $request->query('q', ''));

        $mejas = Meja::query()
            ->when($kata !== '', function ($query) use ($kata) {
                $query->where(function ($query) use ($kata) {
                    $query->where('kode_meja', 'like', '%'.$kata.'%')
                        ->orWhere('deskripsi', 'like', '%'.$kata.'%')
                        ->orWhere('pemandangan', 'like', '%'.$kata.'%')
                        ->orWhere('fasilitas', 'like', '%'.$kata.'%')
                        ->orWhere('lantai', $kata)
                        ->orWhere('nomor_meja', $kata);
                });
            })
            ->orderBy('lantai')
            ->orderBy('nomor_meja')
            ->paginate(12)
            ->withQueryString();

        return view('admin.meja.index', compact('mejas', 'kata'));
    }

    public function store(Request $request)
    {
        $lantai = (int) $request->input('lantai');

        $validated = $request->validate([
            'lantai' => 'required|in:1,2,3',
            'nomor_meja' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('mejas')->where(fn ($query) => $query->where('lantai', $lantai)),
            ],
            'kapasitas' => 'required|integer|min:1|max:20',
            'pemandangan' => ['required', Rule::in(Meja::opsiPemandangan($lantai))],
            'fasilitas' => ['required', Rule::in(Meja::opsiFasilitas($lantai))],
            'deskripsi' => 'nullable|string|max:500',
            'status' => 'required|in:tersedia,nonaktif',
            'gambar' => 'nullable|image|max:2048',
        ], [
            'nomor_meja.unique' => 'Nomor meja pada lantai tersebut sudah digunakan.',
            'pemandangan.in' => 'Pemandangan tidak sesuai dengan lantai yang dipilih.',
            'fasilitas.in' => 'Fasilitas tidak sesuai dengan lantai yang dipilih.',
        ]);

        $kodeMeja = 'M'.$validated['lantai'].str_pad((string) $validated['nomor_meja'], 2, '0', STR_PAD_LEFT);

        if (Meja::where('kode_meja', $kodeMeja)->exists()) {
            return back()
                ->withInput()
                ->withErrors(['nomor_meja' => 'Kode meja '.$kodeMeja.' sudah ada.']);
        }

        $namaGambar = null;

        if ($request->hasFile('gambar')) {
            $folder = public_path('images/tables');
            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }

            $berkas = $request->file('gambar');
            $namaGambar = $kodeMeja.'.'.$berkas->getClientOriginalExtension();
            $berkas->move($folder, $namaGambar);
        }

        Meja::create([
            'kode_meja' => $kodeMeja,
            'nomor_meja' => $validated['nomor_meja'],
            'lantai' => $validated['lantai'],
            'kapasitas' => $validated['kapasitas'],
            'pemandangan' => $validated['pemandangan'],
            'fasilitas' => $validated['fasilitas'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'status' => $validated['status'],
            'gambar' => $namaGambar,
        ]);

        return redirect()
            ->route('admin.meja.index')
            ->with('success', 'Meja '.$kodeMeja.' berhasil ditambahkan.');
    }

    public function nonaktifkan(Meja $meja)
    {
        $meja->update(['status' => 'nonaktif']);

        return back()->with(
            'success',
            'Meja '.$meja->kode_meja.' dinonaktifkan. Pada halaman pilih meja, statusnya berwarna kuning.'
        );
    }

    public function aktifkan(Meja $meja)
    {
        $meja->update(['status' => 'tersedia']);

        return back()->with('success', 'Meja '.$meja->kode_meja.' diaktifkan kembali.');
    }
}
