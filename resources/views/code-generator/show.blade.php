@extends('layouts.app')
@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-center">No of Code {{ $code->total() }}</h2>

        <div class="row float-right mx-auto mb-3">
            <form method='post' action='/export'>
                @csrf
                <input type="submit" class="btn btn-primary" name="export_excel" value="Excel Export"/>
                <input type="submit" class="btn btn-primary fa-download" name="export_pdf" value='PDF Export'/>
            </form>
        </div>


        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Created By</th>
                    <th>Created AT</th>
                </tr>
                </thead>
                <tbody>
                @if($code->total()>0)
                    @foreach($code as $key=>$row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $row->random_code }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No Records found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        {{ $code->links() }}
    </div>
@endsection
