@extends('layouts.app')

@section('import-css')
    <!-- Import the custom event.css file -->
    <link rel="stylesheet" href="{{ asset('/css/table-style.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-5 overflow-hidden">
        <div class="table-responsive text-nowrap mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <div class="row g-2">
                            <form action="{{ route('code.distribute') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-auto">
                                    <button type="submit" class="btn btn-success import-btn">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        DISTRIBUTE CODE 
                                    </button>
                                </div>
                            </form>
                        </div>
                    </tr>
                    <tr>
                        @foreach ($data[0][0] as $column)
                            <th class="col">{{ strtoupper($column) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach (array_slice($data[0], 1) as $row)
                        <tr class="align-middle table-group-divider">
                            @foreach ($row as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


