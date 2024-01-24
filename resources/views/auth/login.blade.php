@extends('layouts.app')

{{-- @section('nav')
@endsection --}}
{{-- uncomment this above if you want to display Navigation tab (code nito nasa app.blade.php) --}}

@section('content')
    <div class="h-full flex justify-center">
        {{-- <div class="row justify-content-center">
         </div> --}}

        <div class="flex flex-row w-full h-screen">
            <div class="w-1/2 flex flex-col bg-cover bg-center h-full"
                style="background-image: url('{{ asset('images/library.jpg') }}');">
                <div class="flex items-center justify-center h-screen">
                    <div class="flex flex-col items-center">
                        <img class="w-[300px] mb-3" src="{{ asset('images/CvSU logo.png') }}" alt="cvsu logo">
                        <div class="text-center text-white mb-2">
                            <p class="font-bold" style="font-size: 30px;">Library Borrowing and Returning System</p>
                        </div>
                        <div class="text-center text-white">
                            <p class="font-medium text-md">
                                Borrow and Return Books with ease - Cavite State University's <br> Library Borrowing and
                                Returning
                                System
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right side -->
            <div class="w-1/2 flex flex-col">
                <div class="flex h-full justify-center items-center space-y-8 bg-[#F6FFF1]">
                    <div class="text-center rounded-3xl">
                        <div class="py-12 px-12 bg-white rounded-2xl shadow-xl z-20 border border-gray-2 00">

                            <form method="POST" action="{{ route('login') }}" id="loginForm">
                                @csrf
                         

                                <div>
                                    <h1 class="text-3xl font-bold text-center mb-2">Login your Account</h1>
                                    <p class="w-80 text-center text-sm mb-8 font-semibold text-gray-700 tracking-wide ">
                                        Borrow and Return Books with ease</p>
                                </div>

                                @error('username')
                                <span class="text-red-400 font-small" >
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="space-y-1 text-left mb-6">
                                    <p class="block tracking-wide text-grey-400 text-md font-medium" for="">
                                        Username
                                    </p>
                                    <input placeholder="Username" id="username" type="text" name="username" value="{{ old('username') }}"
                                        class="block text-sm py-3 px-4 rounded-md w-full border outline-none focus:border-green-600" />
                                
                                </div>

                             

                                <div class="space-y-1 text-left mb-10">
                                    <p class="block tracking-wide text-grey-400 text-md font-medium">
                                        Password
                                    </p>
                                    <input input id="password" type="password" placeholder="Password"
                                        class="block text-sm py-3 px-4 rounded-md w-full border outline-none focus:border-green-600" name="password" required autocomplete="current-password" />
                                </div>
                                @error('password')
                                    <span class="text-red">
                                        <strong>{{ $message }}</strong>
                                    </span>                           
                                 @enderror
                                <div class="text-center mt-6">
                                    <button type="submit" 
                                        class="py-3 w-64 text-xl text-white bg-green-600 hover:bg-green-700 transition-all duration-200 ease-in-out rounded-lg">
                                        Log in
                                    </button>
                                    <br><br>
                                    <a href="{{ route('register') }}"><small>Click here if you don't have an account yet.</small></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 text-center p-4 ml-2">
                    <p class="text-base font-medium text-gray-700">© Copyright 2023 Cavite State University |
                        Library Borrowing and Returning System - CvSU Library</p>
                </div>
            </div>
            <div class="flex-none absolute bottom-0 right-0">
                <img src="{{ asset('images/laya at diwa - Edited.png') }}" alt="Image" class="w-auto h-96 opacity-40" />
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault(); 
    
                var formData = $(this).serialize();
    
                $.ajax({
                    url: '/api/auth/login',
                    // url: "{{ route('login') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.message === 'Login successful') {
                            // Include the token in subsequent requests
                            $.ajaxSetup({
                                headers: {
                                    'Authorization': 'Bearer ' + response.token
                                }
                            });

                            window.location.href = '/dashboard';
                        } else if (response.message === 'Email not yet verified') {
                            alert('Email not verified! Please verify your email.');
                        } else {
                            console.log('Login unsuccessful');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);

                        var errorResponse = JSON.parse(xhr.responseText);

                        if (errorResponse.message) {
                            alert(errorResponse.message);
                        } else {
                            alert('Invalid Credentials.');
                        }
                    }
                });
            });
        });
    </script>
    
    
@endsection
