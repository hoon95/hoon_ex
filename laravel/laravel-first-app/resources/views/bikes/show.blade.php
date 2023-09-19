@extends('layout')

@section('content')

<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <!-- {{print_r($bike)}} -->
    <h3>{{$bike['name']}}</h3>
    <h3>{{$bike['brand']}}</h3>
    <h3>{{$bike['price']}}</h3>
</div>

@endsection('content')