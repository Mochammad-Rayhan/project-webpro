<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('nama' , 'asc')->get();
        return view('backend.v_user.index' , [
            'judul' => 'Data Admin Gudang' ,
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create' , [
            'judul' => 'Tambah Admin',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|max:255|email|unique:user',
            'role' => 'required',
            'hp' => 'required|min:10|max:13',
            'password' => 'required|min:4|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ]);
        $validatedData['status'] = 1;

        // Menggunakan ImageHelper
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Simpan gambar dengan ukuran yang ditentukan
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 300, 300);

            // Simpan nama file asli di database
            $validatedData['foto'] = $originalFileName;
        }

        // Password kombinasi
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        // huruf kecil ([a-z]), huruf besar ([A-Z]), angka (\d), dan simbol karakter (non-alphanumeric)

        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData, $messages);
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil tersimpan');
        } else {
            return redirect()->back()->withErrors([
                'password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.'
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.edit' , [
            'judul' => 'Edit Data Admin' ,
            'edit' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'nama' => 'required|max:255',
            'email' => 'required|max:255|email|unique:user,email,' . $user->id_admin . ',id_admin',
            'role' => 'required',
            'hp' => 'required|min:10|max:13',
            'password' => 'nullable|min:4|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:user';
        }

        $validatedData = $request->validate($rules, $messages);

        // upload foto
        if ($request->file('foto')) {

            // hapus foto lama
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('foto');

            $extension = $file->getClientOriginalExtension();

            $originalFileName =
                date('YmdHis') . '_' . uniqid() . '.' . $extension;

            $directory = 'storage/img-user/';

            ImageHelper::uploadAndResize(
                $file,
                $directory,
                $originalFileName,
                385,
                400
            );

            $validatedData['foto'] = $originalFileName;
        }

        // PASSWORD
        if ($request->filled('password')) {

            $validatedData['password'] =
                Hash::make($request->password);

        } else {

            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()
            ->route('backend.user.index')
            ->with('success', 'Data berhasil diperbarui');
    }


    public function formPassword()
    {
        return view('frontend.v_profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ], [
            'new_password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.'
        ]);

        $user = auth()->user();

        // cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama salah');
        }

        // update password (AMAN karena di model sudah "hashed")
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255|unique:user,email,' . $user->id_admin . ',id_admin',
            'hp' => 'nullable|min:10|max:13',
            'alamat' => 'nullable',
            'foto' => 'image|mimes:jpeg,jpg,png|max:1024',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp ? $request->hp : '-',
            'alamat' => $request->alamat,
        ];

        // upload foto
        if ($request->file('foto')) {

            // hapus foto lama
            if ($user->foto) {
                $oldPath = public_path('storage/img-user/' . $user->foto);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('foto');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('storage/img-user'), $filename);

            $data['foto'] = $filename;
        }

        $user->update($data);

        return back()->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $user->delete();
        return redirect()->route('backend.user.index')->with('success' , 'Data Berhasil dihapus');
    }
}
