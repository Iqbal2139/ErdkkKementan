<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'tahun' => 'required',
        ]);

        $user = User::select('users.*', 'roles.type')
                        ->join('roles', 'users.role_id', 'roles.id')
                        ->where('username','=',$request->username)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                Session::put('loginId', $user->id);
                Session::put('nama', $user->name);
                Session::put('cityCode', $user->city_code);
                Session::put('districtCode', $user->district_code);
                Session::put('tahunErdkk', $user->tahun);
                Session::put('role', $user->type);
                Session::put('role_id', $user->role_id);
                Session::put('provinceCode', $user->province_code);

                if ($user->is_default) {
                    return redirect('ganti-password');
                } else {
                    return redirect()->route('dashboard');
                }
            } else {
                return back()->with('fail','Password not match!');
            }
        } else {
            return back()->with('fail','This email is not register.');
        }

    }


    public function dashboard()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        return view('ringkasan.index',compact('data'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function submitGantiPassword(Request $request) {
        $id = Session::get('loginId');

        $up = User::where('id', $id)
        ->where('is_default', 1)
        ->update(['password' => Hash::make($request->get('password')), 'is_default' => 0]);

        if ($up) {
            $res = [
                'status' => 200,
                'message' => 'Berhasil update password'
            ];
        } else {
            $res = [
                'status' => 400,
                'message' => 'Gagal update password'
            ];
        }

        return response()->json($res);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
