@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
           @if (!$company->id)
            <h1>Create Company</h1>
           @else
            <h1>Update Company {{$company->name}}</h1>
           @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <form method="POST"  @if($company->id) action="{{ route('companies.update',['id'=>$company->id]) }}"  @else action="{{ route('companies.store') }}" @endif enctype="multipart/form-data" >
            @if($company->id) @method('PUT') @endif
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" @if(old('name')) value="{{ old('name') }}" @else value="{{$company->name}}" @endif   required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" @if(old('email')) value="{{ old('email') }}" @else value="{{$company->email}}" @endif  required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="logo" class="col-md-4 col-form-label text-md-right">Logo</label>

                    <div class="col-md-6">

                        <img @if($company->logo) src="{{'/storage/logos/'.$company->logo}}" @else src="" @endif width="100px" height="100px"   id="image" alt="img" @if(!$company->logo) style="display: none" @endif >

                        <input id="file" type="file" class="form-control @error('logo') is-invalid @enderror" value="{{$company->logo}}"  name="file" >
                        <input type="hidden" name="logo" id="logo"  value="{{$company->logo}}" >
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="website" class="col-md-4 col-form-label text-md-right">Website</label>

                    <div class="col-md-6">
                        <input id="website" type="text" class="form-control" name="website"  @if(old('website')) value="{{ old('website') }}" @else value="{{$company->website}}" @endif  required autocomplete="website">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            @if($company->id)
                                Update
                            @else
                                Create
                            @endif
                        </button>
                        <a href="{{route('companies.index')}}" class="btn btn-danger"  >Cancel</a>
                    </div>
                </div>


            </form>
        </div>
    </div>

@endsection
