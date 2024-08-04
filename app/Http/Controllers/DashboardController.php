<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $redirect = $this->dashboardService->getDashboardRedirect();

        if ($redirect === null) {
            return abort(404);
        }

        return redirect()->route($redirect);
    }

    public function writerDashboard()
    {
        $user = Auth::user();
        $data = $this->dashboardService->getWriterDashboardData($user);
        return view('writers.dashboard', $data);
    }

    public function editorDashboard()
    {
        $data = $this->dashboardService->getEditorDashboardData();
        return view('editors.dashboard', $data);
    }
}
