@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>Edit {{ $company->name }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('companies.update', $company) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{ $company->name }}" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{ $company->email }}" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input name="logo" type="text" class="form-control" id="logo" value="{{ $company->logo }}" placeholder="Enter logo">
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input name="website" type="text" class="form-control" value="{{ $company->website }}" id="website" placeholder="Enter website">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
