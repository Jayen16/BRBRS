@extends('layouts.app')
@section('title', 'Books')

@section('nav')
@endsection

@section('content')
    <script></script>
    <div class="min-h-screen bg-[#F6FFF1] w-full">
        <div class="flex w-full mt-2 py-10 h-[90vh]">
            <div class="flex w-full mx-32 gap-12">
                <!-- Categories  -->
                <div class="flex flex-col w-1/4 h-full items-center border border-1 border-gray-300 rounded-md bg-white">
                    <p
                        class="font-lg text-xl font-bold text-gray-100 uppercase tracking-wider bg-green-800 w-full text-center py-3 rounded-t-md">
                        Book Categories
                    </p>
                    <div class="w-full max-h-[75vh] overflow-y-auto">
                        <ul class="justify-center font-medium text-lg px-2 py-0 text-left">
                            <a href="{{route('showcategory', 'All Categories')}}" class= "category-link w-full md:w-auto" data-category="All Categories">
                                <li class="hover:border-black hover:bg-gray-100 border-2 border rounded-md pl-5 p-2 m-2 text-left mt-4">
                                    All
                                </li>
                            </a>
                            <a href="{{route('showcategory', 'Fiction')}}" class= "category-link w-full md:w-auto" data-category="Fiction">
                                <li class="hover:border-black hover:bg-gray-100 border-2 border rounded-md pl-5 p-2 m-2 text-left mt-4">
                                    Fiction
                                </li>
                            </a>
                        
                            <a href="{{route('showcategory', 'Non-Fiction')}}" class="category-link w-full md:w-auto" data-category="Non-Fiction">
                                <li class="hover:border-black hover:bg-gray-100 border-2 border rounded-md pl-5 p-2 m-2 text-left">
                                    Non-Fiction
                                </li>
                            </a>
                            <a href="{{route('showcategory', 'Reference')}}" class="category-link w-full md:w-auto" data-category="Reference">
                                <li class="hover:border-black hover:bg-gray-100 border-2 border rounded-md pl-5 p-2 m-2 text-left">
                                    Reference
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>

                <!-- Start Right Column -->
           

                <div class="flex flex-col w-full rounded-md">

                    <p class="font-semibold text-2xl text-white text-center uppercase p-2 bg-green-800 rounded-md" id="category_title">
                        ALL CATEGORIES                     
                    </p>


                    <div>

          
                            <div x-data="{ showModal: false }" class="mb-4 flex justify-end" id="ajaxModal">

                                <button x-on:click="showModal = true" href="javascript:void(0)" id="createNewBook"
                                    class="bg-green-800 hover:bg-green-800 p-3 rounded-md text-white font-medium mt-4">Add Book
                                </button>

                                <x-Addbook />                        

                            </div>


                                

                        <!-- Search bar -->
                        <div class="flex items-center mt-4">
                            <div class="w-full relative mx-auto text-gray-600">
                                <input class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                    id="customSearchBox" type="search" name="search" placeholder="Search books here...">
                                <button type="submit" class="absolute right-0 top-0 mt-4 mr-4">
                                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px"
                                        y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                        xml:space="preserve" width="512px" height="512px">
                                        <path
                                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                            <table class="table table-bordered table-hover rounded-md shadow-md mt-2 "
                                style="background: white;" width="100%" id="data-table">
                                <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
                                    <tr class="bg-green-800 text-white text-center">
                                        <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl" name="isbn">
                                            ISBN NO.
                                        </th>
                                        <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="title">
                                            BOOK TITLE
                                        </th>
                                        <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="publisher">
                                            PUBLISHER
                                        </th>
                                        <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="location rack">
                                            LOCATION RACK
                                        </th>
                                        <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="status">
                                            STATUS
                                        </th>

                                        <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="action">
                                            ACTION                                                
                                        </th>

                                    

                                    </tr>
                                </thead>

                                <tbody id="tableBody">
                                    <td id="noRecordsMessage" class="text-center ">

                                    </td>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Right Column -->
                </div>
            </div>
        </div>

    </div>


<script type="text/javascript">




         //DISPLAY DATA FROM API
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#data-table').DataTable({
                dom: 'lrtip',
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('listbooks') }}",
                    type: 'GET'
                },
                columns: [{
                        data: 'isbn',
                        name: 'isbn'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'publisher',
                        name: 'publisher'
                    },
                    {
                        data: 'location_rack',
                        name: 'location_rack'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action', name: 'action', orderable: false, searchable: false
                    },
                    // Add more columns as needed
                ],

         
            });


            $('#customSearchBox').on('keyup', function() {
                table.search(this.value).draw();
            });


            // After DataTables retrieves data, populate the table body with rows
            table.on('xhr', function() {
                var data = table.ajax.json().data; // Retrieve the data from the DataTable

                // Clear previous rows
                $('#tableBody').empty();

                // Loop through the data and populate table rows dynamically
                $.each(data, function(index, item) {

            
                    var newRow = '<tr class="text-center">' +
                        '<td class="py-2 px-8 border-b border-gray-200 font-weight-bold">' + item
                        .isbn + '</td>' +
                        '<td class="py-2 px-8 border-b border-gray-200" id="book_title">' + item.title + '</td>'
                        '<td class="py-2 px-8 border-b border-gray-200">' + item.author + '</td>' +
                        '<td class="py-2 px-8 border-b border-gray-200">' + item.location_rack +
                        '</td>' +
                        '<td class="py-2 px-8 border-b border-gray-200">' + item.status + '</td>' +
                        '</tr>';

                    $('#tableBody').append(newRow); // Append each row to the table body
                });

            });


            //DELETE
            $('body').on('click', '.deleteBook', function () {
                var book_id = $(this).data("id");

                // Use SweetAlert for confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to delete this book!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('/deletebook') }}/" + book_id,
                            data: { _token: '{{ csrf_token() }}' },
                            success: function (data) {
                                table.draw();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });



            $('#createNewBook').click(function () {
                $('#saveBtn').val("create-book");
                $('#book_id').val('');
                $('#bookForm').trigger("reset");
                $('#modelHeading').html("Create New Book");
                $('#ajaxModel').modal('show');
            });



            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('preview');
                    output.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }


             //CREATE AND FOR UPDATE 
                $('#saveBtn').click(function (e) {
                    e.preventDefault();
                    $(this).html('Saving..');
                

                    var formData = new FormData();           
                    formData.append('book_image', $('#book_image')[0].files[0]);


                    $('#bookForm').find('input, textarea, select').not('#book_image').each(function () {
                        formData.append($(this).attr('name'), $(this).val());
                    });

                    $.ajax({
                        data: formData,
                        url: "{{ route('addbooks') }}",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('#bookForm').trigger("reset");
                            let alpineInstance = document.getElementById('ajaxModal');

                            if (alpineInstance) {
                                alpineInstance.__x.$data.showModal = false; 
                            } else {
                                console.error('#ajaxModal element not found');
                            }

                            // table.draw();
                            // console.log(data)
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Save');
                        }
                    });
            });

            //EDIT
            $('body').on('click', '.editBook', function () {
                var book_id = $(this).data('id');
                $.get("{{ url('/editbook') }}/" + book_id, function (data) {

                    let alpineInstance = document.getElementById('ajaxModal');
                    if (alpineInstance) {
                        alpineInstance.__x.$data.showModal = true; 
                    } else {
                        console.error('#ajaxModal element not found');
                    }

                    // Update modal content with fetched data
                    $('#modelHeading').html("Edit Book");
                    $('#saveBtn').text('Save');
                    $('#saveBtn').val("edit-book");

                    $('#book_id').val(data.id);
                    $('#title').val(data.title);
                    $('#author').val(data.author);
                    $('#status').val(data.status);
                    $('#isbn').val(data.isbn);
                    $('#category').val(data.category);
                    $('#location_rack').val(data.location_rack);
                    $('#condition').val(data.condition);
                    $('#edition').val(data.edition);
                    $('#publisher').val(data.publisher);
                    $('#copyright_year').val(data.copyright_year);
                    $('#accession_number').val(data.accession_number);
                    $('#description').val(data.description);

                    
                });
            });

                $('.category-link').on('click', function (e) {
                    e.preventDefault();
                    var category = $(this).data('category');

                    

                    table.ajax.url("{{ route('showcategory', ':category') }}".replace(':category', category)).load();

                    $('#category_title').text(category);


                });
        

        });
   


    </script>



    </div>
@endsection