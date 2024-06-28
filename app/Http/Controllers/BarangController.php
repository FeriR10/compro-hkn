<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Diskon;
use App\Models\Kategori;


class BarangController extends Controller
{
    public function barang()
    {
        $barang = Barang::get();
        return view('suplier.barang',[
            'barang' => $barang,
        ]);
    }
    public function tambah()
    {   
        $kategoris = Kategori::get();
        return view('suplier.tambah',[
            'kategoris' => $kategoris
        ]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'kode_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        ]);

        

        $barangs = new Barang();
        $barangs->nama_barang = $request->nama_barang;
        $barangs->id_kategori = $request->id_kategori;
        $barangs->kode_barang = $request->kode_barang;
        $barangs->qty = $request->qty;
        if ($request->harga !== null) {
            // Mengganti titik dengan kosong untuk konversi ke integer
            $harga = (int)str_replace('.', '', $request->harga);
            
            // Debugging: Cek nilai setelah konversi
            var_dump($harga);
        
            // Set nilai harga pada objek $barang
            $barangs->harga = $harga;
            
            // Simpan objek $barang ke database
            $barangs->save();
        } else {
            // Tindakan jika $request->harga null, misalnya memberikan nilai default atau melempar exception
            $barangs->harga = 0; // Nilai default
            // atau
            // throw new Exception('Harga tidak boleh null');
            $barangs->save();
        }
        
        if($request->hasfile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = Storage::disk('public')->put('images/barang', $file);
            $barangs->thumbnail = $path;
            
        }
        $barangs->save();
        
        Session::flash('status', 'success');
        Session::flash('message', 'Tambah Barang sukses');
        return redirect('/barang');
      
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        return view('suplier.edit',[
            'barang' => $barang,
            'kategoris' => $kategori
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'id_kategori' => 'required',
            'kode_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
        ]);

        // update data 
        $barang = Barang::find($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->id_kategori = $request->id_kategori;
        if ($request->harga !== null) {
            // Mengganti titik dengan kosong untuk konversi ke integer
            $harga = (int)str_replace('.', '', $request->harga);
            
            // Debugging: Cek nilai setelah konversi
            var_dump($harga);
        
            // Set nilai harga pada objek $barang
            $barang->harga = $harga;
            
            // Simpan objek $barang ke database
            $barang->save();
        } else {
            // Tindakan jika $request->harga null, misalnya memberikan nilai default atau melempar exception
            $barang->harga = 0; // Nilai default
            // atau
            // throw new Exception('Harga tidak boleh null');
            $barang->save();
        }
        $barang->qty = $request->qty;
        $barang->harga = (int) str_replace('.', '', $request->harga);

        if($request->hasFile('thumbnail')){
            if($barang->thumbnail){
                Storage::disk('public')->delete($barang->thumbnail);
            }
            $file = $request->file('thumbnail');
            $path = Storage::disk('public')->put('images/barang', $file);
            $barang->thumbnail = $path;
        }
        $barang->update();

        Session::flash('status', 'success');
        Session::flash('message', 'Edit Barang sukses');
        return redirect('/barang');
    }

    public function delete($id)
    {
        $barang = Barang::find($id);
        Storage::delete('images/barang/' . $barang->thumbnail);
        $barang->delete();
        return redirect('/barang');
    }
    public function barangjual()
    {
        $barang = Barang::get();
        return view('suplier.barangjual',[
            'barang' => $barang,
        ]);
    }
    public function index()
    {
        $barangs = Barang::get();
        $keranjangs = Keranjang::where('users_id', Auth::user()->id)->get();
        return view('suplier.barangjual', compact('barangs', 'keranjangs'));
       
    }
    public function viewdiskon()
    {
        $diskon = Diskon::get();
        return view('suplier.diskon',[
            'diskon' => $diskon,
        ]);
    }
    public function creatediskon()
    {
        return view('suplier.creatediskon');
    }
    public function creatediskonProcess(Request $request)
    {
        $request->validate([
            'diskon' => 'required',
        ]);
        $diskon = new Diskon();
        $diskon->diskon = $request->diskon;
        $diskon->persen = $request->diskon / 100;
        $diskon->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Diskon Berhasil Di Tambahkan');
        return redirect('/viewdiskon');
    }
    public function deletediskon($id)
    {
        $diskon = Diskon::find($id);
        $diskon->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Diskon Berhasil Di HAPUS');
        return redirect('/viewdiskon');
    }
    public function kategori()
    {
       $kategori = Kategori::get();
        return view('suplier.kategori',[
            'kategoris' => $kategori,
        ]);
    }
    public function createkategori(Request $request)
    {
        $request->validate([
            'kategori_barang' => 'required',
        ]);

        $kategoris = new Kategori();
        $kategoris->kategori_barang = $request->kategori_barang;
       
        $kategoris->save();
        
        Session::flash('status', 'success');
        Session::flash('message', 'Tambah Kategori sukses');
        return redirect('/kategori');
      
    }

    
    public function editkategori($id)
    {
        $kategoris = Kategori::find($id);
        return view('suplier.editkategori',[
            'kategoris' => $kategoris
        ]);
    }
    public function editkategoriudpate(Request $request, $id)
    {
        $request->validate([
            'kategori_barang' => 'required',
        ]);
        $kategoris = Kategori::find($id);
        $kategoris->kategori_barang = $request->kategori_barang;
        $kategoris->update();
        Session::flash('status', 'success');
        Session::flash('message', 'Edit Kategori sukses');
        return redirect('/kategori');
    }
    
}
