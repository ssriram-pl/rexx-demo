@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="content">

            <div class="container">
                <div class="mb-5">
                    <div class="col-md-12 text-center">
                        <h1 class="page-header">Code Generator</h1>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" autocomplete="off" action="/code-generator/add">
                    @csrf
                    <div class="form-group row">
                        <label for="no-of-code" class="col-sm-4 col-form-label" style="text-align: right">No of
                            Code</label>
                        <div class="col-sm-4">
                            <input type="text" pattern="\d*" name="no_of_code"
                                   class="form-control @error('no_of_code') is-invalid @enderror" maxlength="4"
                                   value="{{ old('no_of_code') }}"
                                   placeholder="Enter the Number" />

                            @error('no_of_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">Generate Code</button>

                            <a class="btn btn-dark "
                               title="Back to Dashboard"
                               href="{{ url('/dashboard') }}">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
