<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::latest()->paginate(5);
  
        return view('accounts.index',compact('accounts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required',
            'fileno' => 'required',
            'color' => 'required',
            'rackno' => 'required',
        ]);
  
        Account::create($request->all());
   
        return redirect()->route('accounts.index')
                        ->with('success','accounts created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('accounts.show',compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {

        return view('accounts.edit',compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $request->validate([
            'year' => 'required',
            'fileno' => 'required',
            'color' => 'required',
            'rackno' => 'required',
        ]);
  
        $account->update($request->all());
  
        return redirect()->route('accounts.index')
                        ->with('success','accounts updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::find($id)->delete();
  
        return redirect()->route('accounts.index')
                        ->with('success','accounts deleted successfully');
    }

    public function search($year) {

        $name = Request::input('year');

        return View('accounts.search')->with('account', Account::where('year', 'like', '%' . $year . '%')->paginate(7));
    }
}
