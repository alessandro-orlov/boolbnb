@extends('layouts.app')

@section('content')
    @foreach ($apartment->promos as $promo)
        <h2>la promo {{ $promo->name }} è stata attivata sull'appartamento {{ $apartment->title }}</h2>
    @endforeach
@endsection


