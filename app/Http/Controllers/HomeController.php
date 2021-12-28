<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Exports\ExcelExport;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Paginator::useBootstrap();
        $users = User::paginate(20);
        return view('home', ['users' => $users]);
    }

    public function search(User $user, Request $request)
    {
        $request->validate(['search' => 'required']);
        $data = $user->query()->where('name', 'LIKE', "%" . $request->search . "%")
            ->orWhere('username', 'LIKE', "%" . $request->search . "%")
            ->orWhere('email', 'LIKE', "%" . $request->search . "%")
            ->get();

        if ($data) {
            return view('search', ['users' => $data]);
        }
    }

    public function exportToPDF()
    {
        $users = User::all();
        $pdf = PDF::loadView('pdf.users', ['users' => $users]);
        return $pdf->download('users.pdf');
    }

    public function exportToEXCEL()
    {
        return Excel::download(new ExcelExport, 'users.xlsx');
    }
}
