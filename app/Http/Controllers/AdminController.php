<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kos;
use App\Models\Transaksi;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KosVerificationExport;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalKos = Kos::count();
        $totalTransaksi = Transaksi::count();
        $pendingKos = Kos::where('is_verified', false)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalKos', 'totalTransaksi', 'pendingKos'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function verifyKos()
    {
        $pendingKos = Kos::where('is_verified', false)->with('pemilik')->paginate(10);
        return view('admin.verify-kos', compact('pendingKos'));
    }

    public function approveKos($id)
    {
        $kos = Kos::findOrFail($id);
        $kos->update(['is_verified' => true]);

        return redirect()->back()->with('success', 'Kos berhasil diverifikasi');
    }

    public function rejectKos($id)
    {
        $kos = Kos::findOrFail($id);

        // Delete photo if exists
        if ($kos->foto && file_exists(public_path($kos->foto))) {
            unlink(public_path($kos->foto));
        }

        $kos->delete();

        return redirect()->back()->with('success', 'Kos berhasil ditolak dan dihapus');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->isAdmin()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus admin');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }

    /**
     * Show verification report page
     */
    public function verificationReport(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));
        $status = $request->get('status', '');

        $query = Kos::with(['pemilik'])
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        if ($status !== '') {
            $query->where('is_verified', $status === 'verified' ? true : false);
        }

        $kosList = $query->orderBy('created_at', 'desc')->get();

        // Statistics
        $totalKos = $kosList->count();
        $verifiedKos = $kosList->where('is_verified', true)->count();
        $pendingKos = $kosList->where('is_verified', false)->count();
        $verifiedToday = Kos::where('is_verified', true)
            ->whereDate('updated_at', today())
            ->count();

        return view('admin.verification-report', compact(
            'kosList',
            'startDate',
            'endDate',
            'status',
            'totalKos',
            'verifiedKos',
            'pendingKos',
            'verifiedToday'
        ));
    }

    /**
     * Print verification report
     */
    public function printVerificationReport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status', '');

        $query = Kos::with(['pemilik'])
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        if ($status !== '') {
            $query->where('is_verified', $status === 'verified' ? true : false);
        }

        $kosList = $query->orderBy('created_at', 'desc')->get();

        // Statistics
        $totalKos = $kosList->count();
        $verifiedKos = $kosList->where('is_verified', true)->count();
        $pendingKos = $kosList->where('is_verified', false)->count();
        $verifiedToday = Kos::where('is_verified', true)
            ->whereDate('updated_at', today())
            ->count();

        return view('admin.verification-print', compact(
            'kosList',
            'startDate',
            'endDate',
            'status',
            'totalKos',
            'verifiedKos',
            'pendingKos',
            'verifiedToday'
        ));
    }

    /**
     * Export verification to PDF
     */
    public function exportVerificationPDF(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status', '');

        $query = Kos::with(['pemilik'])
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        if ($status !== '') {
            $query->where('is_verified', $status === 'verified' ? true : false);
        }

        $kosList = $query->orderBy('created_at', 'desc')->get();

        // Statistics
        $totalKos = $kosList->count();
        $verifiedKos = $kosList->where('is_verified', true)->count();
        $pendingKos = $kosList->where('is_verified', false)->count();
        $verifiedToday = Kos::where('is_verified', true)
            ->whereDate('updated_at', today())
            ->count();

        $pdf = Pdf::loadView('admin.verification-pdf', compact(
            'kosList',
            'startDate',
            'endDate',
            'status',
            'totalKos',
            'verifiedKos',
            'pendingKos',
            'verifiedToday'
        ));

        $filename = 'laporan-verifikasi-kos-' . Carbon::parse($startDate)->format('d-m-Y') . '-' . Carbon::parse($endDate)->format('d-m-Y') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export verification to Excel
     */
    public function exportVerificationExcel(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status', '');

        $filename = 'laporan-verifikasi-kos-' . Carbon::parse($startDate)->format('d-m-Y') . '-' . Carbon::parse($endDate)->format('d-m-Y') . '.xlsx';

        return Excel::download(new KosVerificationExport($startDate, $endDate, $status), $filename);
    }

    /**
     * Get kos details for modal
     */
    public function getKosDetails($id)
    {
        $kos = Kos::with('pemilik')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $kos
        ]);
    }
}