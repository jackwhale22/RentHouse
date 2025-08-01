<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
// ADD THESE MISSING IMPORTS
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;  // atau use PDF; jika menggunakan alias
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MessagesExport;
class PemilikController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalKos = $user->kos()->count();
        $verifiedKos = $user->kos()->where('is_verified', true)->count();
        $pendingKos = $user->kos()->where('is_verified', false)->count();
        $totalTransaksi = Transaksi::whereHas('kos', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        $recentKos = $user->kos()->latest()->take(5)->get();

        return view('pemilik.dashboard', compact('totalKos', 'verifiedKos', 'pendingKos', 'totalTransaksi', 'recentKos'));
    }

    public function myKos()
    {
        $user = Auth::user();
        $kosList = $user->kos()->paginate(10);
        return view('pemilik.my-kos', compact('kosList'));
    }

    public function createKos()
    {
        return view('pemilik.create-kos');
    }

    public function storeKos(Request $request)
    {
        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/kos'), $filename);
            $data['foto'] = 'uploads/kos/' . $filename;
        }

        Kos::create($data);

        return redirect()->route('pemilik.my-kos')->with('success', 'Kos berhasil ditambahkan dan menunggu verifikasi admin');
    }

    public function editKos($id)
    {
        $kos = Kos::where('user_id', Auth::id())->findOrFail($id);
        return view('pemilik.edit-kos', compact('kos'));
    }

    public function updateKos(Request $request, $id)
    {
        $kos = Kos::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama_kos' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_ketersediaan' => 'required|in:tersedia,tidak_tersedia',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($kos->foto && file_exists(public_path($kos->foto))) {
                unlink(public_path($kos->foto));
            }

            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/kos'), $filename);
            $data['foto'] = 'uploads/kos/' . $filename;
        }

        $kos->update($data);

        return redirect()->route('pemilik.my-kos')->with('success', 'Kos berhasil diupdate');
    }

    public function deleteKos($id)
    {
        $kos = Kos::where('user_id', Auth::id())->findOrFail($id);

        // Delete photo if exists
        if ($kos->foto && file_exists(public_path($kos->foto))) {
            unlink(public_path($kos->foto));
        }

        $kos->delete();

        return redirect()->route('pemilik.my-kos')->with('success', 'Kos berhasil dihapus');
    }

    public function messages()
    {
        $user = Auth::user();
        $messages = Transaksi::whereHas('kos', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['kos', 'penyewa'])->orderBy('created_at', 'desc')->paginate(10);

        return view('pemilik.messages', compact('messages'));
    }

    public function messageDetail($id)
    {
        $user = Auth::user();
        $message = Transaksi::whereHas('kos', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['kos', 'penyewa'])->findOrFail($id);

        return view('pemilik.message-detail', compact('message'));
    }

    public function updateContactStatus(Request $request, $id)
    {
        $user = Auth::user();
        $message = Transaksi::whereHas('kos', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($id);

        $request->validate([
            'status_kontak' => 'required|in:pending,contacted,closed',
        ]);

        $message->update([
            'status_kontak' => $request->status_kontak,
        ]);

        return redirect()->back()->with('success', 'Status kontak berhasil diperbarui');
    }

    public function replyMessage(Request $request, $id)
    {
        $user = Auth::user();
        $message = Transaksi::whereHas('kos', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($id);

        $request->validate([
            'balasan_pemilik' => 'required|string',
        ]);

        $message->update([
            'balasan_pemilik' => $request->balasan_pemilik,
            'tanggal_balasan' => now(),
            'status_kontak' => 'contacted',
        ]);

        return redirect()->back()->with("success", "Balasan berhasil dikirim");
    }

    public function updateTransaksiStatus(Request $request, $id)
    {
        $user = Auth::user();
        $transaksi = Transaksi::whereHas("kos", function ($query) use ($user) {
            $query->where("user_id", $user->id);
        })->findOrFail($id);

        $request->validate([
            "status_transaksi" => "required|in:pending,dibatalkan,selesai",
        ]);

        $transaksi->update([
            "status_transaksi" => $request->status_transaksi,
        ]);

        return redirect()->back()->with("success", "Status transaksi berhasil diperbarui");
    }
    /**
     * Show messages report page
     */
    public function messagesReport(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $statusKontak = $request->get('status_kontak', '');
        $statusTransaksi = $request->get('status_transaksi', '');

        $query = Transaksi::with(['penyewa', 'kos'])
            ->whereHas('kos', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        if ($statusKontak) {
            $query->where('status_kontak', $statusKontak);
        }

        if ($statusTransaksi) {
            $query->where('status_transaksi', $statusTransaksi);
        }

        $messages = $query->orderBy('created_at', 'desc')->get();

        // Statistics
        $totalMessages = $messages->count();
        $pendingMessages = $messages->where('status_kontak', 'pending')->count();
        $contactedMessages = $messages->where('status_kontak', 'contacted')->count();
        $closedMessages = $messages->where('status_kontak', 'closed')->count();

        $pendingTransactions = $messages->where('status_transaksi', 'pending')->count();
        $completedTransactions = $messages->where('status_transaksi', 'selesai')->count();
        $cancelledTransactions = $messages->where('status_transaksi', 'dibatalkan')->count();

        return view('pemilik.messages-report', compact(
            'messages',
            'startDate',
            'endDate',
            'statusKontak',
            'statusTransaksi',
            'totalMessages',
            'pendingMessages',
            'contactedMessages',
            'closedMessages',
            'pendingTransactions',
            'completedTransactions',
            'cancelledTransactions'
        ));
    }

    /**
     * Print messages report
     */
    public function printMessagesReport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $statusKontak = $request->get('status_kontak', '');
        $statusTransaksi = $request->get('status_transaksi', '');

        $query = Transaksi::with(['penyewa', 'kos'])
            ->whereHas('kos', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        if ($statusKontak) {
            $query->where('status_kontak', $statusKontak);
        }

        if ($statusTransaksi) {
            $query->where('status_transaksi', $statusTransaksi);
        }

        $messages = $query->orderBy('created_at', 'desc')->get();

        // Statistics
        $totalMessages = $messages->count();
        $pendingMessages = $messages->where('status_kontak', 'pending')->count();
        $contactedMessages = $messages->where('status_kontak', 'contacted')->count();
        $closedMessages = $messages->where('status_kontak', 'closed')->count();

        $pendingTransactions = $messages->where('status_transaksi', 'pending')->count();
        $completedTransactions = $messages->where('status_transaksi', 'selesai')->count();
        $cancelledTransactions = $messages->where('status_transaksi', 'dibatalkan')->count();

        return view('pemilik.messages-print', compact(
            'messages',
            'startDate',
            'endDate',
            'statusKontak',
            'statusTransaksi',
            'totalMessages',
            'pendingMessages',
            'contactedMessages',
            'closedMessages',
            'pendingTransactions',
            'completedTransactions',
            'cancelledTransactions'
        ));
    }

    /**
     * Export messages to PDF
     */
    public function exportMessagesPDF(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $statusKontak = $request->get('status_kontak', '');
        $statusTransaksi = $request->get('status_transaksi', '');

        $query = Transaksi::with(['penyewa', 'kos'])
            ->whereHas('kos', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        if ($statusKontak) {
            $query->where('status_kontak', $statusKontak);
        }

        if ($statusTransaksi) {
            $query->where('status_transaksi', $statusTransaksi);
        }

        $messages = $query->orderBy('created_at', 'desc')->get();

        // Statistics
        $totalMessages = $messages->count();
        $pendingMessages = $messages->where('status_kontak', 'pending')->count();
        $contactedMessages = $messages->where('status_kontak', 'contacted')->count();
        $closedMessages = $messages->where('status_kontak', 'closed')->count();

        $pendingTransactions = $messages->where('status_transaksi', 'pending')->count();
        $completedTransactions = $messages->where('status_transaksi', 'selesai')->count();
        $cancelledTransactions = $messages->where('status_transaksi', 'dibatalkan')->count();

        $pdf = Pdf::loadView('pemilik.messages-pdf', compact(
            'messages',
            'startDate',
            'endDate',
            'statusKontak',
            'statusTransaksi',
            'totalMessages',
            'pendingMessages',
            'contactedMessages',
            'closedMessages',
            'pendingTransactions',
            'completedTransactions',
            'cancelledTransactions'
        ));

        $filename = 'laporan-pesan-' . Carbon::parse($startDate)->format('d-m-Y') . '-' . Carbon::parse($endDate)->format('d-m-Y') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export messages to Excel
     */
    public function exportMessagesExcel(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $statusKontak = $request->get('status_kontak', '');
        $statusTransaksi = $request->get('status_transaksi', '');

        $filename = 'laporan-pesan-' . Carbon::parse($startDate)->format('d-m-Y') . '-' . Carbon::parse($endDate)->format('d-m-Y') . '.xlsx';

        return Excel::download(new MessagesExport($startDate, $endDate, $statusKontak, $statusTransaksi), $filename);
    }

}
