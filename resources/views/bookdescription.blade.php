@extends('layouts.app')


@section('nav')
@endsection

@section('content')
<div class="min-h-screen bg-[#F6FFF1] w-full">
        <!-- CONTAINER -->
        <div class="flex w-full mt-2 py-10 h-[90vh]">
            <div class="flex w-full mx-64 gap-4">
                <div class="button-container sticky top-10 z-10">
                    <button onclick="window.location='{{ route('listbooks') }}'"
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
                                <img class="w-full object-cover" src="" alt="Atomic Habits Image" id="book-image">
                                {{-- <img src="{{ asset('books/sample.png') }}" alt="Example Image"> --}}
                            </div>

                            <div class="w-full h-[60vh] overflow-y-auto mt-6 px-3 pt-4 ">
                                <p class="font-medium text-lg">Book Title: <span class="font-normal text-lg" id="book-title"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Location Rack: <span
                                        class="font-normal text-lg" id="book-location_rack"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Edition: <span class="font-normal text-lg" id="book-edition">
                                        Edition</span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Author: <span class="font-normal text-lg" id="book-author"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Publisher: <span
                                        class="font-normal text-lg" id="book-publisher"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Copyright Year: <span
                                        class="font-normal text-lg" id="book-copyright_year"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Category: <span
                                        class="font-normal text-lg" id="book-category"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">Condition: <span
                                        class="font-normal text-lg" id="book-condition"></span></p>
                                <!-- <hr> -->
                                <p class="font-medium text-lg mt-3">ISBN: <span
                                        class="font-normal text-lg" id="book-isbn"></span></p>
                                <!-- <hr> -->
                            </div>

                        </div>
                    </div>


                    <div class="w-full h-full">
                        <div class="flex flex-col p-1 h-full">
                            <div class="flex justify-between items-center">
                                <p class="font-medium text-3xl" id="book-main-title">TITLE</p>
                                <p class="text-xl">Status: <span class="font-medium text-xl" id="book-status"></span></p>
                            </div>
                            <p class="text-lg" id="book-author"></p>
                            <hr class="my-3">
                            <div>
                                <p class="font-semibold text-xl text-gray-500">Description</p>
                            </div>
                            <div class="h-[50vh] overflow-y-auto">
                                <p class="text-xl text-justify text-gray-800 leading-6" id="book-description">
                                   
                                </p>
                            </div>
                            <hr class="my-4">

                            <p class="font-semibold text-xl font-md text-gray-600">Borrow History</p>
                            <div class="h-[60vh] ">
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
                                            <th class="uppercase text-sm py-2 px-8 border-b border-gray-200 w-[20rem]">
                                                DATE Returned
                                            </th>
                                        </tr>
                                    </thead>
          {{-- <tr id="noRecordsMessage" class="text-center ">
                                            <td class="py-8 px-8 border-b border-gray-200 text-gray-500" colspan="5">
                                                No existing records found.
                                            </td>
                                        </tr> --}}

                                    <tbody id="tableBody">
                                    
                                    </tbody>
                                </table>
                            </div>
               

                            @php
                                $bookId = request()->segment(count(request()->segments()));
                                $selectedBook = \App\Models\Book::find($bookId);
                             @endphp

                            <div class="flex justify-end gap-2">
                                <!-- borrow modal -->
                                <div x-data="{ showModal: false, statusValue: '' }" class="mb-4 flex justify-end" id="borrowModal">    

                                    <button x-on:click="
                                    if ('{{ $selectedBook->status }}' === 'borrowed') {
                                        statusValue = 'Return Book';
                                    } else if ('{{ $selectedBook->status }}' === 'available') {
                                        statusValue = 'Borrow Book';
                                    }
                                    showModal = true;
                                    sessionStorage.setItem('statusValue', statusValue);
                                    " id="status_button" data-status="{{ $selectedBook->status }}"

                                class="bg-green-800 hover:bg-green-800 p-3 rounded-md text-white font-medium mt-4">
                                    {{ $selectedBook->status === 'borrowed' ? 'Return' : 'Borrow' }}
                                </button>

                                    <x-BorrowBook :bookId="$bookId" />
                                                            
                                </div>
                        </div>
                        
                    </div>
                </div>

                <!-- End Right Column -->
            </div>
        </div>
    </div>
</div>
<x-BorrowBook :bookId="$bookId" />


<script>
    $(document).ready(function() {
        var bookId = {{ $id }}; // Make sure $id exists and is passed correctly
        var apiUrl = '/description/book/' + bookId; // Replace with your API endpoint

        $.ajax({
            url: apiUrl,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
        
                var selectedBook = response.book;
                
                // Populate HTML elements with book details
                $('#book-title').text(selectedBook.title);
                $('#book-location_rack').text(selectedBook.location_rack);
                $('#book-edition').text(selectedBook.edition)
                $('#book-author').text(selectedBook.author);
                $('#book-publisher').text(selectedBook.publisher);
                $('#book-copyright_year').text(selectedBook.copyright_year);
                $('#book-category').text(selectedBook.category);
                $('#book-condition').text(selectedBook.condition);
                $('#book-isbn').text(selectedBook.isbn);

                $('#book-main-title').text(selectedBook.title);
                $('#book-description').text(selectedBook.description);

                //CAPITALIZE LANG FIRST LETTER
                var book_status = selectedBook.status.toLowerCase();
                book_status = book_status.charAt(0).toUpperCase() + book_status.slice(1);

                $('#book-status').text(book_status);

                var imageUrl = '{{ asset("books") }}' + '/' + selectedBook.book_image;
                $('#book-image').attr('src', imageUrl);
               
                
                if (selectedBook.status === 'borrowed') {
                    $('#status_button').text("Return");

                } else if (selectedBook.status === 'available') {
                    $('#status_button').text("Borrow");
                }
               
  
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });



        $.ajax({
            url: '/history/book/{{ $id }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var historyArray = response.data;

                // console.log(historyArray);
                $('#tableBody').empty();

                if (historyArray.length === 0) {

                    var noHistoryRow = $('<tr class="text-center"><td colspan="5" class="p-3 border-b border-gray-200">No history of Borrowing</td></tr>');
                     $('#tableBody').append(noHistoryRow);

              } else {

                historyArray.forEach(function(historyItem) {
                    var newRow = $('<tr class="text-center">' +
                        '<td class="py-1 px-8 border-b border-gray-200 font-semibold"><p class="borrower_no"></p></td>' +
                        '<td class="py-1 px-8 border-b border-gray-200"><p class="borrower_name"></p></td>' +
                        '<td class="py-1 px-8 border-b border-gray-200"><p class="borrower_type"></p></td>' +
                        '<td class="py-1 px-8 border-b border-gray-200"><p class="borrow_status"></p></td>' +
                        '<td class="py-1 px-8 border-b border-gray-200"><p class="borrower_returned"></p></td>' +
                        '</tr>');

                    // Set the text content of each cell in the new row

                    //CAPITALIZE LANG FIRST LETTER
                    var status = historyItem.borrow_status.toLowerCase();
                    status = status.charAt(0).toUpperCase() + status.slice(1);

                    newRow.find('.borrower_no').text(historyItem.id);
                    newRow.find('.borrower_name').text(historyItem.borrower.name);
                    newRow.find('.borrower_type').text(historyItem.borrower.type);
                    newRow.find('.borrow_status').text(status);
                    newRow.find('.borrower_returned').text(formatDate(historyItem.created_at));

                    // Append the new row to the table body
                    $('#tableBody').append(newRow);
                });

            }

        
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        

        function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
        return date.toLocaleDateString('en-US', options);
    }


    });



</script>

<script>


    // purpose nito ay para hindi magsara ung modal... pag nagsusubmit kasi automatic close ung modal
    $('#borrowForm').on('submit', function(e) {
        e.preventDefault(); 
    });



</script>
@endsection
