<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\supplier;

class SupplierController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $total_supplier = supplier::count();
        $supplier_data = supplier::all();

        return view('supplier.index',compact('total_supplier','supplier_data'));
    }


    public function tambah(Request $request){
        if($request->isMethod('get')){
            return view('supplier.tambah');
        }else{
            $rules = [
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required'
            ];

            $pesan = [
              'nama.required' => 'Nama Supplier Tidak Boleh Kosong',
              'alamat.required' => 'Alamat Supplier Tidak Boleh Kosong',
              'no_telp.required' => 'No telepon Tidak Boleh Kosong',
            ];

            $v = Validator::make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
               $supplier = new supplier();
               $supplier->nama_supplier = $request->get('nama');
               $supplier->Alamat = $request->get('alamat');
               $supplier->no_telp = $request->get('no_telp');
               $supplier->email = $request->get('email');
               $supplier->save();
               return redirect('supplier/index');
            }
        }
    }
    public function edit(Request $request,$id){
        $supplier = supplier::where('id',$id)->get();
        return view('supplier.edit',compact('supplier'));
    }

    public function update(Request $request,$id){
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required'
        ];

        $pesan = [
          'nama.required' => 'Nama Supplier Tidak Boleh Kosong',
          'alamat.required' => 'Alamat Supplier Tidak Boleh Kosong',
          'no_telp.required' => 'No telepon Tidak Boleh Kosong',
        ];

        $v = Validator::make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
           $supplier = supplier::find($id);
           $supplier->nama_supplier = $request->get('nama');
           $supplier->Alamat = $request->get('alamat');
           $supplier->no_telp = $request->get('no_telp');
           $supplier->email = $request->get('email');
           $supplier->save();
           return redirect('supplier/index');
        }
    }

    public function delete($id){
        $supplier_del = supplier::findOrfail($id);
        $supplier_del->delete();
        return response()->json(['status' => 'Data Supplier Telah Berhasil Di hapus']);
    }

}

