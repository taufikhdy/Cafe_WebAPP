<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Vinkla\Hashids\Facades\Hashids;


use Illuminate\Support\Facades\Session;


class AuthCustomerController extends Controller
{
    //

    public function wrongway()
    {
        return view('components.wrongway');
    }

    public function thankyou()
    {
        return view('components.thankyou');
    }

    public function loginByQr(Request $request, $hash)
    {
        $id = Hashids::connection('meja')->decode($hash)[0] ?? null;

        if (!$id) {
            return view('components.wrongway');
        }

        $meja = Meja::find($id);

        if (!$meja) {
            return view('components.wrongway');
        }


        $request->session()->regenerate();
        Auth::guard('meja')->login($meja);

        $id_customer = Auth::guard('meja')->user()->id;

        $customer = Meja::findOrFail($id_customer);
        $customer->status = 'terisi';
        $customer->save();

        if (Auth::guard('meja')->user()->username === null) {
            return redirect()->route('customer.form');
        }
        // if (
        //     Auth::guard('meja')->user()->username === null &&
        //     Auth::guard('meja')->user()->status === 'kosong'
        // ) {
        //     $meja->update([
        //         'username' => null,
        //         'status' => 'kosong'
        //     ]);
        //     $meja->save();

        //     Auth::guard('meja')->logout();
        //     $request->session()->invalidate();
        //     $request->session()->regenerateToken();

        //     return redirect()->route('');
        // }

        return redirect()->route('customer.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $id = $request->id_user;
        $meja = meja::findOrFail($id);
        $meja->update([
            'username' => null,
            'status' => 'kosong'
        ]);
        $meja->save();

        Auth::guard('meja')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('thankyou')
            ->withSuccess('Logout berhasil!');
    }
}
