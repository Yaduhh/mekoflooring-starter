<!-- resources/views/google/analytics-data.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Google Analytics Data</h1>
    @if($data)
        <p>Total Sessions: {{ $data->getRows()[0][0] }}</p>
    @else
        <p>No data available.</p>
    @endif
@endsection
