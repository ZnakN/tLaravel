@extends('layouts.admin')


@php

$company_id = $employee->id ?? '';
if (!$company_id)
{
    $company_id = old($company_id)?? '';
}

@endphp



@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            @if (!$employee->id)
                <h1>Create Employee</h1>
            @else
                <h1>Update Employee {{$employee->name}}</h1>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <form method="POST" @if($employee->id) action="{{ route('employees.update',['id'=>$employee->id]) }}"
                  @else action="{{ route('employees.store') }}" @endif enctype="multipart/form-data">
                @if($employee->id) @method('PUT') @endif
                @csrf
                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text"
                               class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                               @if(old('first_name')) value="{{ old('first_name') }}"
                               @else value="{{$employee->first_name}}" @endif   required autocomplete="first_name"
                               autofocus>

                        @error('firts_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                               name="last_name" @if(old('last_name')) value="{{ old('last_name') }}"
                               @else value="{{$employee->last_name}}" @endif   required autocomplete="last_name"
                               autofocus>

                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" @if(old('email')) value="{{ old('email') }}"
                               @else value="{{$employee->email}}" @endif  required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="company_id" class="col-md-4 col-form-label text-md-right">Company</label>

                    <div class="col-md-6">
                        <select id="company_id" class="form-control @error('company_id') is-invalid @enderror"
                                name="company_id" required autocomplete="company_id">
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                    @if (($company_id)&&($company_id == $company->id))
                                        <option value="{{$company->id}}" selected="selected">{{$company->name}}</option>
                                    @else
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endif
                            @endforeach
                        </select>
                        @error('company_id')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                               name="phone" @if(old('phone')) value="{{ old('phone') }}"
                               @else value="{{$employee->phone}}" @endif  required autocomplete="phone">

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            @if($employee->id)
                                Update
                            @else
                                Create
                            @endif
                        </button>
                        <a href="{{route('employees.index')}}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>


            </form>
        </div>
    </div>

@endsection
