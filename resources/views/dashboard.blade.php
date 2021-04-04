@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-text">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2 class="text-center">Total No of Code</h2>
                        <p class="dashboard-show-count"> {{ $code }} </p>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a class="btn btn-primary"
                       title="click to Generate code"
                       href="{{ url('/code-generator/create') }}">
                        Generate Code
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
