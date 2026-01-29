@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container-fluid">

    @include('profile.partials.alert')

    @if(auth()->user()->role === 'admin')
    @include('profile.partials.admin')
    @elseif(auth()->user()->role === 'ceo')
    @include('profile.partials.ceo')
    @else
    <div class="alert alert-danger">
        Role tidak dikenali
    </div>
    @endif

</div>
@endsection