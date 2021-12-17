@extends('layouts.page')

@section('content')
    <city-profile :city="{{ $input->toJson() }}"></city-profile>
@endsection