@extends('layouts.app')
@section('title', 'Register')

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
                <div class="text-center rounded-3xl px-10">
                    <div class="py-8 px-8 pt-2 bg-white rounded-2xl shadow-xl z-20 border border-gray-2 00">
                        <div>
                            <h1 class="text-2xl font-medium text-center mb-2 mt-3">Self-Registration for Librarians<br>Accessing the Borrowing & Returning System<br>
                                <span class="text-base font-normal"><i>(For librarian of CvSU only)</i></span>
                            </h1>
                            <hr class="mb-2">
                            <p class="text-center text-sm mb-6 p-2 font-semibold text-gray-700 tracking-wide">
                                
                            Upon logging in, you are recognized as an employee or  an existing librarian  <br> at Ladislao N. Diwa Memorial Library. 
                             Consequently, you are granted authorization  <br> to utilize the book borrowing and returning system.</p>
                        </div>
                        <div class="flex items-center justify-center ">
                            <a href="{{ route('googlelogin') }}"                 
                                class="px-4 py-2 border flex gap-2 border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                                <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg"
                                    loading="lazy" alt="google logo">
                                <span class="text-gray-700">Register with Google</span>
                            </a>
                           
                        </div>

                        <br>
                        <a href="{{ route('login') }}"><small>Click here if you already have an account.</small></a>
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

@endsection
