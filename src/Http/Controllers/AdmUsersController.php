<?php

namespace Dartika\Adm\Http\Controllers;

use App\Http\Controllers\Controller;
use Dartika\Adm\Models\AdmUser;
use Illuminate\Http\Request;

class AdmUsersController extends Controller
{
    public function index(Request $request)
    {
        $admUsers = AdmUser::paginate();

        return view('dartika-adm::sections.adm_users.index', compact('admUsers'));
    }

    public function create()
    {
        return view('dartika-adm::sections.adm_users.edit');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:admin_users',
            'password' => 'required|confirmed'
        ]);

        AdmUser::create($request->all());

        flash(trans('adm.success.saved'))->success();

        return redirect()->route('dartika-adm.adm_users.index');
    }

    public function edit(AdmUser $admUser)
    {
        return view('dartika-adm::sections.adm_users.edit', compact('admUser'));
    }

    public function update(AdmUser $admUser, Request $request)
    {
        $this->validate($request, [
            'email' => "required|email|unique:admin_users,email,{$admUser->id}",
            'password' => 'confirmed'
        ]);

        $admUser->update($request->all());

        flash(trans('adm.success.saved'))->success();

        return redirect()->route('dartika-adm.adm_users.index');
    }

    public function delete(AdmUser $admUser, Request $request)
    {
        if (\Auth::user()->id === $admUser->id) { // can't delete itself
            return redirect()->route('dartika-adm.adm_users.index')->withErrors([trans('validation.not_in', [ 'attribute' => trans('adm.auth.user') ])]);
        }
        
        $admUser->delete();

        flash(trans('adm.success.deleted'))->success();
        
        return redirect()->route('dartika-adm.adm_users.index');
    }
}
