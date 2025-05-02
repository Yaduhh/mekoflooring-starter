<?php
namespace App\Http\Controllers;

use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Illuminate\Pagination\LengthAwarePaginator;

class GoogleAnalyticsController extends Controller
{
    public function index()
    {
        // Mengambil data pengunjung dan tampilan halaman untuk periode 1 bulan terakhir
        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::months(1));

        // Format data untuk mempermudah tampilan
        $formattedData = $analyticsData->map(function ($data) {
            return [
                'pageTitle' => $data['pageTitle'],
                'activeUsers' => $data['activeUsers'],
                'screenPageViews' => $data['screenPageViews'],
            ];
        });

        // Mengambil statistik umum
        $totalActiveUsers = $formattedData->sum('activeUsers');
        $totalPageViews = $formattedData->sum('screenPageViews');

        // Mengambil top referrers dan top browsers
        $topReferrers = Analytics::fetchTopReferrers(Period::months(1));
        $topBrowsers = Analytics::fetchTopBrowsers(Period::months(1));

        // Menyusun data tambahan
        $topReferrersArray = $topReferrers->pluck('pageReferrer')->toArray();  // Ambil hanya URL atau nama referrer
        $topBrowsersArray = $topBrowsers->pluck('browser')->toArray(); // Ambil hanya nama browser

        // Menyusun data untuk dikirim ke view
        $dataOverview = [
            'topReferrers' => $topReferrersArray,
            'topBrowsers' => $topBrowsersArray,
        ];

        // Ambil halaman saat ini dan set jumlah data per halaman
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentData = $formattedData->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedData = new LengthAwarePaginator(
            $currentData,
            $formattedData->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // Kirim data ke view, pastikan $formattedData disertakan
        return view('admin.google.analytics', compact('paginatedData', 'totalActiveUsers', 'totalPageViews', 'dataOverview', 'formattedData'));
    }
}
