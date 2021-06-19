@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Chào mừng {{ Auth::user()->name }} đến với vgs travel</h1>
    </div>
@endsection
