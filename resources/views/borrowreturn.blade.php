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
                                            type="search" name="search" placeholder="Search here..." id="searchInput">
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
                                <div class="float-right">
                                    <button id='downloadPDF' class="bg-green-700 rounded p-3 text-white"> History PDF </button>
                             
                                </div>
                                <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2" id="borrow-table">
                                    <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
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
                                            </th>
                                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                DATE BORROWED
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="tableBody">
                                        <tr id="noRecordsMessage" class="text-center ">
                                            <td class="py-8 px-8 border-b border-gray-200 text-gray-500"
                                                colspan="5">
                                                No existing records found.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>

                            <div x-show="openTab === 2"
                                class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                                <!-- Search bar -->
                                <div class="flex items-center my-4">
                                    <div class="w-full relative mx-auto text-gray-600">
                                        <input
                                            class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                            type="search" name="search" placeholder="Search here..." id="searchReturnInput">
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
                                    <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
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
                                        <tr id="noRecordsMessageReturned" class="text-center ">
                                            <td class="py-8 px-8 border-b border-gray-200 text-gray-500"
                                                colspan="5">
                                                No existing records found.
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td class="py-2 px-8 border-b border-gray-200 font-semibold">
                                                <a href="#" class="clickable-cell">7881652752</a>
                                            </td>
                                            <td class="py-2 px-8 border-b border-gray-200 font-semibold">
                                                <a href="#" class="clickable-cell">346457282</a>
                                            </td>
                                            <td class="py-2 px-8 border-b border-gray-200">
                                                <a href="#" class="clickable-cell">Juan dela Cruz</a>
                                            </td>
                                            <td class="py-2 px-8 border-b border-gray-200">
                                                <a href="#" class="clickable-cell">Student</a>
                                            </td>
                                            <td class="py-2 px-8 border-b border-gray-200">
                                                <a href="#" class="clickable-cell">Atomic Habits</a>
                                            </td>
                                            <td class="py-2 px-8 border-b border-gray-200">
                                                <a href="#" class="clickable-cell">11-28-2023</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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

  

   $(function() {

 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var borrowTable = $('#borrow-table').DataTable({
    dom: 'lrtip',
    processing: true,
    serverSide: true,
    autoWidth: false,
    ajax: {
        url: "{{ route('BorrowHistory') }}",
        type: 'GET',
        data: function (d) {
            d.search = $('#searchInput').val(); 
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'patron_name', name: 'patron_name', render: function(data) {
            return capitalizeFirstLetter(data); 
        }},
        { data: 'patron_type', name: 'patron_type', render: function(data) {
            return capitalizeFirstLetter(data);
        }},
        { data: 'book_title', name: 'book_title', render: function(data) {
            return capitalizeFirstLetter(data); 
        }},
        { data: 'created_at', name: 'created_at', render: function(data) {
            return formatDate(data); 
        }}
    ],
    columnDefs: [
        {
            targets: [1, 2, 3], 
            render: function(data) {
                return capitalizeFirstLetter(data); 
            }
        },
        {
            targets: 4, 
            render: function(data) {
                return formatDate(data);
            }
        }
    ],  buttons: [
            'print'
        ]
  
});


var returnTable = $('#return-table').DataTable({
        dom: 'lrtip',
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('ReturnHistory') }}",
            type: 'GET',
            data: function (d) {
                d.search = $('#searchReturnInput').val(); 
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'borrow_id', name: 'borrow_id'},
            { data: 'patron_name', name: 'patron_name', render: function(data) {
                return capitalizeFirstLetter(data); 
            }},
            { data: 'patron_type', name: 'patron_type', render: function(data) {
                return capitalizeFirstLetter(data);
            }},
          
            { data: 'book_title', name: 'book_title', render: function(data) {
                return capitalizeFirstLetter(data); 
            }},
            { data: 'created_at', name: 'created_at', render: function(data) {
                return formatDate(data); 
            }}
        ],
        columnDefs: [
            {
                targets: [2,3,4], 
                render: function(data) {
                    return capitalizeFirstLetter(data); 
                }
            },
            {
                targets: 5, 
                render: function(data) {
                    return formatDate(data);
                }
        }
    ],
    buttons: [
        'pdf'
    ]
});

    // Event listener for the search input
        $('#searchInput').on('keyup', function() {
            borrowTable.search($(this).val()).draw(); // Trigger search and redraw the table
        });


        $('#searchReturnInput').on('keyup', function() {
            returnTable.search($(this).val()).draw(); // Trigger search and redraw the return table
        });



    function capitalizeFirstLetter(str) {
        return str.replace(/\b\w/g, function(match) {
            return match.toUpperCase();
        });
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true };
        return date.toLocaleDateString('en-US', options);
    }
});



</script>



@endsection
