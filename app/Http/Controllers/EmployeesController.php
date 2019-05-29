<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\Companies;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::paginate(10);

        return view('admin.employees.index',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = new Employees();
        $companies = Companies::all();
        return view('admin.employees.edit', ['employee' => $employee,'companies'=>$companies]);
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
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'email|required',
                'company_id' => 'required',
                'phone' => 'required'
            ]
        );
        if (!$validator->fails()) {

            $employee = new Employees($request->all());
            $employee->save();
            return redirect('/employees');

        } else {
            if ($validator->fails()) {
                return redirect('employees/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

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
        $employee = Employees::find($id);
        if ($employee == null) {
            return abort(404);
        }
        $companies = Companies::all();
        return view('admin.employees.edit', ['employee' => $employee,'companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'email|required',
                'company_id' => 'required',
                'phone' => 'required'

            ]
        );

        if (!$validator->fails()) {

            $employee = Employees::find($id);
            if ($employee != null) {
                $employee->first_name = $request->post('first_name');
                $employee->last_name = $request->post('last_name');
                $employee->email = $request->post('email');
                $employee->company_id = $request->post('company_id');
                $employee->phone = $request->post('phone');
                $employee->save();
            }
            return redirect('/employees');

        } else {
            if ($validator->fails()) {
                return redirect('companies/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
            }
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
        $employee = Employees::find($id);
        if ($employee == null) {
            return abort(404);
        } else {
            $employee->delete();
        }
        return redirect('/employees');

    }
}
