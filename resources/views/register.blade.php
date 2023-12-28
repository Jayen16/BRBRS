@extends('layouts.app')
@section('title', 'Registration')
@section('content')


<div class="h-full flex justify-center">
    <div class="flex flex-row w-full h-screen">
<div class="w-full h-full flex flex-col bg-cover bg-center " style="background-image: url('{{ asset('images/library.jpg') }}');">

        <div class="container mx-auto my-auto">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-sm mx-auto bg-white p-8 rounded-md shadow-md">
            @csrf
                <h1 class="text-2xl font-bold mb-6 text-center">Create your account</h1>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')  
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">{{ __('username') }}</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ session('email') }}" autocomplete="email" disabled>
                
                @error('email')  
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                
                @error('username')  
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm-password">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                
                @error('password')  
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                </div>
                <div class='w-full flex items-center'>
                        <button type="submit" class="w-full bg-green-600 text-white text-sm font-bold py-2 px-4 rounded-md hover:bg-green-700 transition duration-300" >
                            {{ __('Register') }}
                        </button>
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('logout.google') }}" class="bg-red-400 text-white text-sm font-bold py-2 px-4 rounded-md flex items-center justify-center hover:bg-red-500 transition duration-300">
                        LOGOUT&nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-escape ml-1" viewBox="0 0 16 16">
                            <path d="M8.538 1.02a.5.5 0 1 0-.076.998 6 6 0 1 1-6.445 6.444.5.5 0 0 0-.997.076A7 7 0 1 0 8.538 1.02Z"/>
                            <path d="M7.096 7.828a.5.5 0 0 0 .707-.707L2.707 2.025h2.768a.5.5 0 1 0 0-1H1.5a.5.5 0 0 0-.5.5V5.5a.5.5 0 0 0 1 0V2.732z"/>
                        </svg>
                    </a>
                </div>
                

            </form>
                
          </div>
    </div>
</div>
</div>

@endsection
