<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class PenyewaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalTransaksi = $user->transaksis()->count();
        $pendingTransaksi = $user->transaksis()->where('status_transaksi', 'pending')->count();

        $recentKos = Kos::verified()->available()->latest()->take(6)->get();
        $recentTransaksi = $user->transaksis()->with('kos')->latest()->take(5)->get();

        return view('penyewa.dashboard', compact('totalTransaksi', 'pendingTransaksi', 'recentKos', 'recentTransaksi'));
    }

    public function searchKos(Request $request)
    {
        $query = Kos::verified()->available()->with('pemilik');

        // Search by name or location
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kos', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('harga', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        // Filter by location
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', "%{$request->lokasi}%");
        }

        $kosList = $query->paginate(12);

        return view('penyewa.search', compact('kosList'));
    }

    public function showKos($id)
    {
        $kos = Kos::verified()->available()->with('pemilik')->findOrFail($id);
        return view('penyewa.detail-kos', compact('kos'));
    }

    public function contactPemilik(Request $request, $id)
    {
        $kos = Kos::verified()->available()->findOrFail($id);

        $request->validate([
            'catatan' => 'nullable|string|max:500',
        ]);

        // Check if user already contacted for this kos
        $existingTransaksi = Transaksi::where('kos_id', $id)
            ->where('penyewa_id', Auth::id())
            ->first();

        if ($existingTransaksi) {
            return redirect()->back()->with('error', 'Anda sudah menghubungi pemilik kos ini sebelumnya');
        }

        Transaksi::create([
            'kos_id' => $id,
            'penyewa_id' => Auth::id(),
            'catatan' => $request->catatan,
            'status_transaksi' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Berhasil menghubungi pemilik kos. Silakan hubungi pemilik melalui kontak yang tersedia.');
    }

    public function myTransaksi()
    {
        $user = Auth::user();
        $transaksis = $user->transaksis()->with('kos.pemilik')->paginate(10);
        return view('penyewa.my-transaksi', compact('transaksis'));
    }

    public function cancelTransaksi($id)
    {
        $transaksi = Transaksi::where('penyewa_id', Auth::id())->findOrFail($id);

        if ($transaksi->status_transaksi === 'pending') {
            $transaksi->update(['status_transaksi' => 'dibatalkan']);
            return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan');
        }

        return redirect()->back()->with("error", "Transaksi tidak dapat dibatalkan");
    }

    public function myMessages()
    {
        $user = Auth::user();
        $messages = Transaksi::where("penyewa_id", $user->id)
            ->whereNotNull("balasan_pemilik")
            ->with(["kos.pemilik"])
            ->orderBy("updated_at", "desc")
            ->paginate(10);

        return view("penyewa.my-messages", compact("messages"));
    }

    public function messageDetail($id)
    {
        $user = Auth::user();
        $message = Transaksi::where("penyewa_id", $user->id)
            ->whereNotNull("balasan_pemilik")
            ->with(["kos.pemilik"])
            ->findOrFail($id);

        return view("penyewa.message-detail", compact("message"));
    }

    public function replyToPemilik(Request $request, $id)
    {
        $user = Auth::user();
        $message = Transaksi::where("penyewa_id", $user->id)
            ->whereNotNull("balasan_pemilik")
            ->findOrFail($id);

        $request->validate([
            "catatan" => "required|string",
        ]);

        $message->update([
            "catatan" => $request->catatan,
            "status_kontak" => "contacted", // Change status to contacted when penyewa replies
        ]);

        return redirect()->back()->with("success", "Balasan Anda berhasil dikirim ke pemilik.");
    }
}
