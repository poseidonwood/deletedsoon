<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DokterController extends Controller
{
  public function index()
  {
    $dokter = Dokter::latest()->get();
    return view('dokter.index', compact('dokter'));
  }
  public function create()
  {
    $dokter = Dokter::latest()->get();
    return view('dokter.create');
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'namadokter' => 'required',
      'spesialisasi' => 'required',
      'nohp' => 'required',
      'status' => 'required'
    ]);

    $dokter = dokter::create([
      'namadokter' => $request->namadokter,
      'spesialisasi' => $request->spesialisasi,
      'nohp' => $request->nohp,
      'status' => $request->status,
    ]);
    if ($dokter) {
      return redirect()
      ->route('dokter.index')
      ->with([
        'success' => 'New data has been created successfully'
      ]);
    } else {
      return redirect()
      ->back()
      ->withInput()
      ->with([
        'error' => 'Some problem occurred, please try again'
      ]);
    }
  }
  public function edit($id)
  {
    $dokter = dokter::findOrFail($id);
    return view('dokter.edit', compact('dokter'));
  }
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'namadokter' => 'required',
      'spesialisasi' => 'required',
      'nohp' => 'required',
      'status' => 'required'
    ]);

    $dokter = dokter::findOrFail($id);

    $dokter->update([
      'namadokter' => $request->namadokter,
      'spesialisasi' => $request->spesialisasi,
      'nohp' => $request->nohp,
      'status' => $request->status,
    ]);

    if ($dokter) {
      return redirect()
      ->route('dokter.index')
      ->with([
        'success' => 'Data berhasil diubah'
      ]);
    } else {
      return redirect()
      ->back()
      ->withInput()
      ->with([
        'error' => 'Some problem has occured, please try again'
      ]);
    }
  }
  public function destroy($id)
  {
    $dokter = dokter::findOrFail($id);
    $dokter->delete();

    if ($dokter) {
      return redirect()
      ->route('dokter.index')
      ->with([
        'success' => 'Data berhasil dihapus'
      ]);
    } else {
      return redirect()
      ->route('dokter.index')
      ->with([
        'error' => 'Some problem has occurred, please try again'
      ]);
    }
  }
}
