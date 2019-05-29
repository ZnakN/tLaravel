@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h1>Companies</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <a href="{{route('companies.create')}}" class="btn btn-primary" >Create company</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <h3>Companies List</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{$company->id}}</td>
                        <td>{{$company->name}}</td>
                        <td>{{$company->email}}</td>
                        <td>
                            <form method="POST" action="{{route('companies.destroy',['id'=>$company->id])}}" onsubmit="return confirm('Do you really want to detete this company?');"    >
                                @method('DELETE')
                                {{csrf_field()}}
                                <a href="{{route('companies.edit',['id'=>$company->id])}}" class="btn btn-primary" >Edit</a>
                                <input type="submit" class="btn btn-danger" value="Delete" >
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <div>
                {{$companies->links()}}
            </div>
        </div>
    </div>

@endsection
