<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function print_r;
use function redirect;
use function view;
use App\Companies;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Companies::paginate(10);

        return view('admin.companies.index',['companies'=>$companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $company = new Companies();
        return view('admin.companies.edit', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'email|required',
                'logo' => 'string',
                'website' => 'required'
            ]
        );
        if (!$validator->fails()) {

            $companies = new Companies($request->all());
            $companies->save();
            return redirect('/companies');

        } else {
            if ($validator->fails()) {
                return redirect('companies/create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::find($id);
        if ($company == null) {
            return abort(404);
        }
        return view('admin.companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'email|required',
                'logo' => 'string',
                'website' => 'required'
            ]
        );

        if (!$validator->fails()) {

            $company = Companies::find($id);
            if ($company != null) {
                $company->name = $request->post('name');
                $company->email = $request->post('email');
                $company->logo = $request->post('logo');
                $company->website = $request->post('website');
                $company->save();
            }
            return redirect('/companies');

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $company = Companies::find($id);
        if ($company == null) {
            return abort(404);
        } else {
            $company->delete();
        }
        return redirect('/companies');

    }


    public function uploadImage(Request $request)
    {
        $res = [];

        $validator = Validator::make($request->all(),
            [
                'file_name' => 'image',
            ],
            [
                'file_name.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
            ]);
        if (!$validator->fails()) {
            $fileName = $request->file_name->getClientOriginalName();
            $request->file_name->storeAs('logos', $request->file_name->getClientOriginalName());
            $res['fail'] = false;
            $res['file_name'] = $fileName;
            $res['message'] = '';

        } else {
            $res['fail'] = true;
            $res['file_name'] = '';
            $res['message'] = $validator->getMessageBag();
        }


        return Response::json($res);
    }


}
