<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Input; /* For input */
use Validator;
use Session;
use DB;
use Mail;
use Hash;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Imagine\Image\Box;
use Image\Image\ImageInterface;
use App\Helper\helpers;
use App\Model\Loan;


class LoanDetails extends Controller
{
    /****
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loan_data = Loan::all();

        //dd($loan_data);
        $title="Loan Details";
        return view('admin.loan.loan_index', compact('loan_data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $loanData = Loan::find($id);

        return view('admin.ajax.edit-loan', compact('loanData'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        
        $lid = $request->lid;
        $rate = $request->rateofinterest;
        $terms = $request->terms;

        

        if(strlen($rate!=0) && strlen($terms!=0))
            {
                $loan = Loan::find($lid);
                $loan->rateofinterest=$rate;
                $loan->terms=$terms;
                $loan->save();
                

              

                
                return \Redirect::to('/admin/loan/loan_index')->with('success','Loan Updated');
            }


            else
            {
                return \Redirect::to('/admin/loan/loan_index')->with('failure','loan Updated fail!');
            }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
