@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Create an Employee') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form action="{{ route('employees.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter first name">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Enter last name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input name="phone_number" type="tel" class="form-control" id="phone_number" placeholder="Enter phone number">
                                </div>
                                <p>Pick company</p>
                                <select name="company_id" class="form-control">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
