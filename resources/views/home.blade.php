@extends('layouts.app')


@section('nav')
@endsection

@section('content')
<div class="min-h-screen bg-[#F6FFF1] w-full">
    {{-- <div class="flex row justify-content-center">
        <div class="flex ">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}


    @include('components.dashboard') 
         

</div>
@endsection
