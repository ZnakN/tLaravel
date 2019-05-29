@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h1>Employees</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <a href="{{route('employees.create')}}" class="btn btn-primary" >Create employee</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <h3>Employees List</h3>
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
                        First Name
                    </th>
                    <th>
                        Last Name
                    </th>
                    <th>
                        Company
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
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->first_name}}</td>
                        <td>{{$employee->last_name}}</td>
                        <td>{{$employee->company->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>
                            <form method="POST" action="{{route('employees.destroy',['id'=>$employee->id])}}" onsubmit="return confirm('Do you really want to detete this employee?');"    >
                                @method('DELETE')
                                {{csrf_field()}}
                                <a href="{{route('employees.edit',['id'=>$employee->id])}}" class="btn btn-primary" >Edit</a>
                                <input type="submit" class="btn btn-danger" value="Delete" >
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <div>
                {{$employees->links()}}
            </div>
        </div>
    </div>

@endsection
