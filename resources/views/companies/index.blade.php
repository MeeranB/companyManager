@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>{{ __('Companies') }}</span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('companies.create') }}">Add company</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th style="width: 16.66%" scope="col">Logo</th>
                                <th scope="col">Email</th>
                                <th scope="col">Website</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <th scope="row">{{ $company->id }}</th>
                                <td>{{ $company->name }}</td>
                                <td><img class="img-fluid" src="{{ asset('storage/'.$company->logo) }}"></td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->website }}</td>
                                <td>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('companies.edit', $company) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        @if ($companies->links()->paginator->hasPages())
                            <div class="mt-4 p-4 box has-text-centered">
                                {{ $companies->links() }}
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
