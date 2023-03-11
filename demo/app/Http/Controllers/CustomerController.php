<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $customers = DB::table('customers')->where('user_id',$user_id)->get();
        return view('user.customer', compact("customers"));
    }
    /**
     * Validate form in.
     */

  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('user.createUpdate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make( 
            array(
                'billing_address' => $request->billing_address,
                'shipping_address' => $request->shipping_address
            ),
            array(
                'billing_address' => 'required|min:8',
                'shipping_address' => 'required|min:8'
            )
        );
        if ($validator->fails())
        {
            return back()->with('error', 'validation failed');
        }
        $user_id = \Auth::user()->id;
        $customer = new Customer;
        $customer->user_id = $user_id;
        $customer->billing_address = $request->billing_address;
        $customer->shipping_address = $request->shipping_address;
        $customer->point = 10;
        $customer->save();
        return back()->with('success', 'Succesfully Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = DB::table('customers')->where('id',$id)->first();
        return View::make('user.createUpdate')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make( 
            array(
                'billing_address' => $request->billing_address,
                'shipping_address' => $request->shipping_address
            ),
            array(
                'billing_address' => 'required|min:8',
                'shipping_address' => 'required|min:8'
            )
        );
        if ($validator->fails())
        {
            return back()->with('error', 'validation failed');
        }
        $customer = Customer::where('id',$id)->first();
        $customer->billing_address = $request->billing_address;
        $customer->shipping_address = $request->shipping_address;
        $customer->save();
        return back()->with('success', 'Succesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('customers')->where('id',$id)->delete();
        return back()->with('success', 'Succesfully Deleted');
    }
}
