@extends('layouts.app')

@section('content')
<div class="h-full flex justify-center">
    <div class="flex flex-row w-full h-screen">
    <div class="w-full h-full flex flex-col bg-cover bg-center " style="background-image: url('{{ asset('images/library.jpg') }}');">

        <div class="flex justify-center container mx-auto my-auto">
            <div class="max-w-xl p-8 text-center text-gray-800 bg-white shadow-xl lg:max-w-3xl rounded-3xl lg:p-12">
                <h3 class="text-2xl">You have successfully created an account!"</h3>
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                    </svg>
                </div>



                <p>An email for verification has been sent to your inbox. Kindly check.</p>
                <div class="mt-4">
                    <button onclick="window.location.href='{{ route('login') }}'" class="px-2 py-2 text-white bg-green-600 rounded">Go To Dashboard</button>

                    <p class="mt-4 text-sm"><i>To access the dashboard and prevent impersonation, <br>your email address must be verified.</i>
                  
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>