@extends('layouts.app')


@section('nav')
@endsection

@section('content')
<div class="min-h-screen bg-[#F6FFF1] w-full">
        <!-- CONTAINER -->
        <div class="flex w-full mt-2 py-10 h-[90vh]">
            <div class="flex w-full mx-64 gap-4">
                <div class="button-container sticky top-10 z-10">
                    <button
                        class="bg-green-700 rounded px-3 py-1.5 text-white hover:bg-[#14532D] flex justify-center items-center gap-1 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l14 0"></path>
                            <path d="M5 12l6 6"></path>
                            <path d="M5 12l6 -6"></path>
                        </svg>
                        <span>back</span>
                    </button>
                </div>

                <div class="flex w-full gap-6">
                    <div class="w-1/4 h-full">
                        <div class="flex flex-col items-center h-full">
                            <div class="w-full border-2 border-gray-600 rounded-lg">
                                <img class="w-full object-cover" src="../Atomic+Habits.png" alt="Atomic Habits Image">
                            </div>

                            <div class="w-full h-[60vh] overflow-y-auto mt-6 px-3 pt-4 ">
                                <p class="font-medium text-lg">Book Title: <span class="font-normal text-lg">Atomic
                                        Habits</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Location Rack: <span
                                        class="font-normal text-lg">Location</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Edition: <span class="font-normal text-lg">1st
                                        Edition</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Author: <span class="font-normal text-lg">James
                                        Clear</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Publisher: <span
                                        class="font-normal text-lg">Bookworm Inc.</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Copyright Year: <span
                                        class="font-normal text-lg">2000</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Category: <span
                                        class="font-normal text-lg">Category</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Condition: <span
                                        class="font-normal text-lg">New</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">ISBN: <span
                                        class="font-normal text-lg">0215789247</span></p>
                                <!-- <hr> -->
                            </div>

                        </div>
                    </div>

                    <!--FROM API TO ng BorrowController@Show , GAGAMITIN ANG UNIQUE ID-->
                    @if($selectedBook->isNotEmpty())
                    <p>ID of the selected book: {{ $selectedBook->first()->id }}</p>
                    @else
                    <p>No book found</p>
                    @endif


                    <div class="w-full h-full">
                        <div class="flex flex-col p-1 h-full">
                            <div class="flex justify-between items-center">
                                <p class="font-medium text-3xl">Atomic Habits: Tiny Changes, Remarkable Results</p>
                                <p class="text-xl">Status: <span class="font-medium text-xl">Available</span></p>
                            </div>
                            <p class="text-lg">Author/s: James Clear</p>
                            <hr class="my-3">
                            <div>
                                <p class="font-semibold text-xl text-gray-500">Description</p>
                            </div>
                            <div class="h-[50vh] overflow-y-auto">
                                <p class="text-xl text-justify text-gray-800 leading-6">Lorem ipsum dolor sit amet,
                                    consectetur
                                    adipiscing
                                    elit. Quisque
                                    ullamcorper, mi vel
                                    consequat sodales, odio massa imperdiet nisi, a iaculis nunc nibh ac est. Maecenas
                                    quam nulla, condimentum at consectetur eget, ullamcorper sit amet justo. Phasellus
                                    in fringilla est. Donec leo risus, interdum ac lorem sit amet, cursus lacinia
                                    libero. Cras mollis, sem non congue euismod, ex dui consequat dolor, a tincidunt
                                    sapien velit non erat. Nullam a nunc non arcu tempus varius id et ante. Phasellus
                                    sed ex quis lacus efficitur tincidunt. Aliquam erat volutpat. Nulla laoreet dui
                                    urna, nec placerat nibh finibus at.

                                    Ut ac auctor nibh, at imperdiet mauris. Donec mi leo, aliquam et ligula in, blandit
                                    pulvinar augue. Cras commodo velit odio, id sollicitudin ligula vehicula ultrices.
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                                    egestas. Fusce lacinia nec velit vel tempor. Interdum et malesuada fames ac ante
                                    ipsum primis in faucibus. Maecenas vulputate tellus sed lorem mollis, vel tempus
                                    eros finibus. Quisque volutpat, dui et tristique accumsan, enim quam laoreet velit,
                                    a molestie ex nulla consequat lorem. Nullam pellentesque quam dolor, nec convallis
                                    tortor hendrerit et. Phasellus tellus neque, vestibulum vehicula ipsum eu, rhoncus
                                    eleifend justo. In hac habitasse platea dictumst. Phasellus mattis suscipit sem eu
                                    ultrices. Vivamus commodo mollis ex quis ullamcorper.
                                    Sed porttitor nulla eget vehicula ullamcorper. Duis auctor felis sit amet diam
                                    dapibus, in tempus leo posuere. Integer bibendum id justo sed dictum. Proin pretium
                                    sapien dui, eget dapibus est fermentum ac. Curabitur condimentum mi fringilla lorem
                                    venenatis, in bibendum augue blandit. Phasellus nisi elit, euismod a dapibus sit
                                    amet, porta vel turpis. Curabitur nec enim id diam condimentum finibus. Morbi rutrum
                                    leo ac sem aliquam, in placerat erat ultricies. Donec eget mi suscipit, gravida arcu
                                    a, aliquet nisl. Sed vehicula malesuada ligula at pharetra. Morbi id consectetur
                                    lorem. Nulla viverra, lorem id dapibus interdum, mauris enim varius purus, id
                                    venenatis sem lectus nec mi. Suspendisse auctor gravida magna, id condimentum erat
                                    sollicitudin eu.

                                    Aliquam erat volutpat. Suspendisse vehicula diam vitae tellus pretium, a porta ex
                                    feugiat. Phasellus facilisis finibus turpis, ac semper erat dapibus vitae. Vivamus
                                    euismod enim ut sagittis mattis. Etiam at urna urna. Proin eu vestibulum erat.
                                    Curabitur in lectus est. Vivamus vel lectus laoreet, imperdiet purus id, varius ex.
                                    Quisque vitae enim leo. Sed in vulputate felis. Nam sagittis nunc ac neque feugiat
                                    bibendum eget sed lacus.</p>
                            </div>
                            <hr class="my-4">

                            <p class="font-semibold text-xl font-md text-gray-600">Borrow History</p>
                            <div class="h-[25vh] overflow-y-auto">
                                <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2">
                                    <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
                                        <tr class="bg-green-800 text-white text-center">
                                            <th
                                                class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                BORROW NO.
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                BORROWER'S NAME
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                borrower TYPE
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                Date BORROWED
                                            </th>
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[16rem]">
                                                DATE Returned
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="tableBody">
                                        <tr id="noRecordsMessage" class="text-center ">
                                            <td class="py-8 px-8 border-b border-gray-200 text-gray-500" colspan="5">
                                                No existing records found.
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="py-1 px-8 border-b border-gray-200 font-semibold">
                                                346457282
                                            </td>
                                            <td class="py-1 px-8 border-b border-gray-200">
                                                Juan dela Cruz
                                            </td>
                                            <td class="py-1 px-8 border-b border-gray-200">
                                                Student
                                            </td>
                                            <td class="py-1 px-8 border-b border-gray-200">
                                                11-22-2023
                                            </td>
                                            <td class="py-1 px-8 border-b border-gray-200">
                                                11-28-2023
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end gap-2">
                                <!-- borrow modal -->
                                <div x-data="{ showModal: false }" class="mb-4 flex justify-end" id="borrowModal">               
                                    <button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"
                                        class="bg-green-800 hover:bg-green-800 p-3 rounded-md text-white font-medium mt-4">Borrow
                                    </button>   

                                    @php
                                        $bookId = request()->segment(count(request()->segments()));
                                    @endphp

                                {{-- ETONG PHP CODE SA TAAS  KINUHA UNG ID IPAPASOK SA BORROW MODAL SA BABA --}}

                                    <x-BorrowBook :bookId="$bookId" />
                                                            
                                </div>
                                 <!-- borrow modal -->
                                {{-- BORROWING AND RETURN MAGSHARE NLNG SILA DYAN SA MODAL, SA CONDITION NALANG MAG CHECK
                                    IF BORROWED , DISPLAY NAME NG BUTTON "RETURN" 
                                    IF HINDI NAMAN BORROWED, DISPLAY NAME BUTTON " BORROW " --}}
                                  
                            </div>

                        </div>
                    </div>
                </div>

                <!-- End Right Column -->
            </div>
        </div>
    </div>
</div>

<script>


    // purpose nito ay para hindi magsara ung modal... pag nagsusubmit kasi automatic close ung modal
    $('#borrowForm').on('submit', function(e) {
        e.preventDefault(); 

        // var bookId = '{{ $bookId }}'; 

        // alert(bookId);
    });
</script>
@endsection
