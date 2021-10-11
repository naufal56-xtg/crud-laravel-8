<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'like', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Employee::orderBy('created_at', 'desc')->paginate(5);
        }
        return view('data_pegawai', [
            'data' => $data,
        ]);
    }

    public function export()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('data-pegawai-pdf');
        return $pdf->download('datapegawai.pdf');
    }

    public function excel()
    {
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    public function create()
    {
        return view('tambah_pegawai');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:25'],
            'jenis_kl' => ['required'],
            'foto' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'no_telp' => ['required', 'numeric']
        ]);
        // $nameImg = time() . '.' . $request->foto->extension();
        // $request->foto->move(public_path('foto'), $nameImg);
        $input = $request->all();

        if ($image = $request->file('foto')) {
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('foto'), $profileImage);
            $input['foto'] = "$profileImage";
        }
        Employee::create($input);
        return redirect()->route('pegawai')->with('berhasil', 'Data Pegawai Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data = Employee::find($id);
        return view('edit_pegawai', [
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Employee::find($id);
        $request->validate([
            'nama' => ['required', 'string', 'max:25'],
            'jenis_kl' => ['required'],
            'foto' => ['image', 'mimes:png,jpg,jpeg'],
            'no_telp' => ['required', 'numeric']
        ]);
        $input = $request->all();

        if ($image = $request->file('foto')) {
            unlink('foto/' . $data->foto);
            $destinationPath = 'foto/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        } else {
            unset($input['foto']);
        }
        $data->update($input);
        return redirect()->route('pegawai')->with('berhasil', 'Data Pegawai Berhasil Diubah');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        unlink('foto/' . $data->foto);
        $data->delete();
        return redirect()->route('pegawai')->with('berhasil', 'Data Pegawai Berhasil Dihapus');
    }
}
