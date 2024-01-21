@extends('layouts.app')
@section('title', 'History')
@section('nav')
@endsection

@section('content')
<div class="min-h-screen bg-[#F6FFF1] w-full">
 <!-- CONTAINER -->
 <div class="flex w-full mt-2 py-10 h-[90vh]">
    <div class="flex w-full mx-32 gap-12">
        <div class="flex flex-col w-full rounded-md">

            <div>
                <div>
                    <div x-data="{ openTab: 1 }" class="pt-3">
                        <div class="w-full">
                            <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md border-2">
                                <button x-on:click="openTab = 1"
                                    :class="{ 'bg-green-800 text-white': openTab === 1 }"
                                    class="flex-1 py-3 px-4 rounded-md focus:outline-none border-2 uppercase font-medium focus:shadow-outline-blue transition-all duration-300">Borrowed</button>
                                <button x-on:click="openTab = 2"
                                    :class="{ 'bg-green-800 text-white': openTab === 2 }"
                                    class="flex-1 py-3 px-4 rounded-md focus:outline-none border-2 uppercase font-medium focus:shadow-outline-blue transition-all duration-300">Returned</button>
                            </div>

                            <div x-show="openTab === 1" >
                                <div  class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                                <!-- Search bar -->
                                <div class="flex items-center my-4">
                                    <div class="w-full relative mx-auto text-gray-600">
                                        <input
                                            class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                            type="search" name="searchBorrow" id="searchBorrow" placeholder="Search here...">
                                        <button type="submit" class="absolute right-0 top-0 mt-4 mr-4">
                                            <svg class="text-gray-600 h-4 w-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                                style="enable-background:new 0 0 56.966 56.966;"
                                                xml:space="preserve" width="512px" height="512px">
                                                <path
                                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                {{-- <div class="float-right">
                                    <button id='downloadPDF' class="bg-green-700 rounded p-3 text-white"> History PDF </button>
                             
                                </div> --}}
                                <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2" id="borrow-table">
                                    <thead id="tableBodyBorrowed-th" class="bg-green-800 text-white text-left sticky top-0 z-10">
                                        <tr class="bg-green-800 text-white text-center">
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                BORROW NO.
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                PATRON'S NAME
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                PATRON TYPE
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                BORROWED BOOK
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                BORROW STATUS
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                DATE BORROWED
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="tableBodyBorrowed">
                                     
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4" id="pagination-container-borrow"></div>
                         </div>

                            <div x-show="openTab === 2"
                                class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                                <!-- Search bar -->
                                <div class="flex items-center my-4">
                                    <div class="w-full relative mx-auto text-gray-600">
                                        <input
                                            class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                            type="search" name="searchReturn" id="searchReturn" placeholder="Search here...">
                                        <button type="submit" class="absolute right-0 top-0 mt-4 mr-4">
                                            <svg class="text-gray-600 h-4 w-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                                style="enable-background:new 0 0 56.966 56.966;"
                                                xml:space="preserve" width="512px" height="512px">
                                                <path
                                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2" id="return-table">
                                    <thead id="tableBodyReturned-th" class="bg-green-800 text-white text-left sticky top-0 z-10">
                                        <tr class="bg-green-800 text-white text-center">
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                RETURN NO.
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                BORROW NO.
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                PATRON'S NAME
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                PATRON TYPE
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                BORROWED BOOK
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                DATE RETURNED
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="tableBodyReturned">
                      
                                    </tbody>
                                </table>

                            </div>
                            <div id="pagination-container-return" class="mt-4"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Right Column -->
    </div>
</div>
</div>
</div>


</div>

<!-- Include jsPDF library -->


<script type="text/javascript">

$(document).ready(function () {
    fetchBorrowHistory();
    fetchReturnHistory();
    var searchBorrow = '';
    var searchReturn = '';
    var sortColumn = 'created_at';
    var sortOrder = 'asc';



    function fetchBorrowHistory(page = 1) {
        $.ajax({
            url: '/api/history/borrow',
            type: 'GET',
            dataType: 'json',
            data: {
                sortColumn: sortColumn,
                sortOrder: sortOrder,
                search: searchBorrow,
                limit: 10,
                page: page,
            },
            success: function (data) {
               
                $('#tableBodyBorrowed').empty();


                if (data.data.length > 0) {
                    $.each(data.data, function (index, borrow) {
                        
                        // Access related 'borrower' data
                        var patronName = borrow.borrower ? borrow.borrower.first_name+ ' ' + borrow.borrower.last_name: '';
                        var patronType = borrow.borrower ? borrow.borrower.type : '';
                        var bookTitle = borrow.book ? borrow.book.title : '';
                        var bookStatus = borrow ? borrow.borrow_status : '';

                        $('#tableBodyBorrowed').append(
                            '<tr class="text-center">' +
                            '<td class="py-3 px-8 border-b border-gray-200">' + (index+1) + '</td>' +
                            '<td class="py-3 px-8 border-b border-gray-200">' + patronName + '</td>' +
                            '<td class="py-3 px-8 border-b border-gray-200">' + patronType + '</td>' +
                            '<td class="py-3 px-8 border-b border-gray-200">' + bookTitle + '</td>' +
                            '<td class="py-3 px-8 border-b border-gray-200">' + bookStatus + '</td>' +
                            '<td class="py-3 px-8 border-b border-gray-200">' + formatDate(borrow.created_at) + '</td>' +
                            '</tr>'
                        );
                    });
                } else {
                    $('#tableBodyBorrowed').append(
                        '<tr class="text-center">' +
                        '<td class="py-8 px-8 border-b border-gray-200 text-gray-500" colspan="6">' +
                        'No existing records found.' +
                        '</td>' +
                        '</tr>'
                    );
                }

                $('#pagination-container-borrow').html(data.links);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            }
        });
    }

    fetchBorrowHistory();

    // Event listener for pagination links
    $(document).on('click', '#pagination-container-borrow a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetchBorrowHistory(page);
    });

    $('#tableBodyBorrowed-th').on('click', function () {
                var column = $(this).data('column');
    
                sortOrder = (sortColumn === column && sortOrder === 'asc') ? 'desc' : 'asc';
    
                sortColumn = column;
    
                fetchBorrowHistory();
         });

    $('#searchBorrow').on('input', function () {
        fetchBorrowHistory();
        searchBorrow = $(this).val();
    });

    ////////////////////////////////
    function fetchReturnHistory(page = 1) {
        $.ajax({
            url: '/api/history/return',
            type: 'GET',
            dataType: 'json',
            data: {
                sortColumn: sortColumn,
                sortOrder: sortOrder,
                search: searchReturn,
                limit: 10,
                page: page,
            },
            success: function (data) {
               
                $('#tableBodyReturned').empty();

                if (data.data.length > 0) {
                    $.each(data.data, function (index, returnHistory) {


                        $('#tableBodyReturned').append(
                            '<tr class="text-center">' +
                                '<td class="py-3 px-8 border-b border-gray-200">' + (index + 1) + '</td>' +
                                '<td class="py-3 px-8 border-b border-gray-200">' + returnHistory.borrow_id + '</td>' +
                                '<td class="py-3 px-8 border-b border-gray-200">' + returnHistory.borrower.first_name +" " + returnHistory.borrower.last_name  + '</td>' +
                                '<td class="py-3 px-8 border-b border-gray-200">' + returnHistory.borrower.type + '</td>' +
                                '<td class="py-3 px-8 border-b border-gray-200">' + returnHistory.book.title + '</td>' +
                                '<td class="py-3 px-8 border-b border-gray-200">' + formatDate(returnHistory.updated_at) + '</td>' +
                            '</tr>'
                        );
                    });
                } else {
                    $('#tableBodyReturned').append(
                        '<tr class="text-center">' +
                        '<td class="py-8 px-8 border-b border-gray-200 text-gray-500" colspan="6">' +
                        'No existing records found.' +
                        '</td>' +
                        '</tr>'
                    );
                }

                $('#pagination-container-return').html(data.links);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            }
        });
    }

    fetchReturnHistory();

    // Event listener for pagination links
    $(document).on('click', '#pagination-container-return a', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetchReturnHistory(page);
    });


    $('#searchReturn').on('input', function () {
        fetchReturnHistory();
        searchReturn = $(this).val();
    });

    $('#tableBodyReturned-th').on('click', function () {
                var column = $(this).data('column');
    
                sortOrder = (sortColumn === column && sortOrder === 'asc') ? 'desc' : 'asc';
    
                sortColumn = column;
    
                fetchReturnHistory();
         });

    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
        return date.toLocaleDateString('en-US', options);
    }


});
</script>



@endsection
