@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Create a Company') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                @if(preg_match('/(file)/', $error))
                                    @continue
                                @endif
                                <div class="bg-red-500 p-2 flex justify-center items-center rounded mt-6">
                                    <ul>
                                        <li>{{ $error }}</li>
                                    </ul>
                                </div>
                            @endforeach
                            @endif
                        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <label for="logo" class="text-green-400 text-2xl">
                                Upload a Logo:
                            </label>
                            <input type="file"
                                   name="logo"
                                   accept="image/*"
                                   class="p-4"
                            >
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input name="website" type="text" class="form-control" id="website" placeholder="Enter website">
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
