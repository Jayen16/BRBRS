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
                <div x-data="{ showCategoryModal: false }" class="flex flex-col w-1/4 h-full items-center border border-1 border-gray-300 rounded-md bg-white">
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
                        </ul>
                        <ul class="categoryClass justify-center font-medium text-lg px-2 py-0 text-left">
                            <a class= "category-link">                             
                            </a>                    
                        </ul>

                    </div>

                    <div class="mb-4 flex justify-end" id="categoryModal">

                        <button x-on:click="showCategoryModal = true" href="javascript:void(0)" id="insertNewCategory"
                            class="bg-green-800 hover:bg-green-800 p-3 rounded-md text-white font-medium mt-4">Manage Category
                        </button>

                        <x-Categories/>                        

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

            //DISPLAY DYNAMIC CATEGORY FROM DATABASE SA GILID TO BOOK CATEGORIES 
            function fetchCategoriesAndPopulate() {
            $.ajax({
                url: '{{ route("CategoryList") }}',
                method: 'GET',
                success: function(response) {

                    var categories = response.categories;

                    var categoryContainer = $('.categoryClass');
                    var categoryModalList = $('.categoryModalList');

                    //NEED TO PARA MACLEAR AND DISPLAY UPDATED DATA ULI
                    categoryContainer.empty();

                    categories.forEach(function(category) {
                        var categoryLink = $('<a>')
                            .attr('href', '{{ route("showcategory", ":category") }}'.replace(':category', category))
                            .addClass('category-link w-full md:w-auto')
                            .attr('data-category', category);

                        var listItem = $('<li>')
                            .addClass('hover:border-black hover:bg-gray-100 border-2 border rounded-md pl-5 p-2 m-2 text-left')
                            .text(category);

                        categoryLink.append(listItem);
                        categoryContainer.append(categoryLink);
                    });

       
                },
                error: function(error) {
                    console.error('Error fetching categories:', error);
                }
            });
            }

            //PANG DISPLAY WITHOUT REFRESHING THE PAGE , CATEGORY LIST SA MODAL TO
            function updateCategoryModalList() {
            $.ajax({
                url: '{{ route("CategoryList") }}',
                method: 'GET',
                success: function(response) {
                    var categories = response.categories;

                    $('#categoryListContainer').empty(); // Clear previous categories

                    categories.forEach(function(category) {
                        var categoryItem = $('<div>')
                            .addClass('flex flex-row justify-between border border-gray-200 rounded-lg p-2 mb-3');

                        var categoryName = $('<label>')
                            .text(category)
                            .addClass('w-2/3 px-3');

                        var deleteLink = $('<a>')
                            .addClass('delete-category')
                            .data('category', category)
                            .attr('href', '#');

                        var deleteButtonContent =
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">' +
                            '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>' +
                            '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>' +
                            '</svg>';

                        deleteLink.html(deleteButtonContent);

                        categoryItem.append(categoryName, deleteLink);
                        $('#categoryListContainer').append(categoryItem);
                    });

                    // Attach delete functionality
                    $('.delete-category').on('click', function(e) {
                        e.preventDefault();
                        var deleteLink = $(this);
                        var categoryToDelete = deleteLink.data('category');

                        $.ajax({
                            url: '/delete/category/' + categoryToDelete,
                            method: 'DELETE',
                            success: function(deleteResponse) {
                                console.log(`Category '${categoryToDelete}' deleted successfully.`);
                                deleteLink.closest('.flex').remove(); // Remove deleted category
                            },
                            error: function(deleteError) {
                                console.error('Error deleting category:', deleteError);
                            }
                        });
                    });
                },
                error: function(error) {
                    console.error('Error fetching categories:', error);
                }
            });
            }


            function deleteCategory(categoryToDelete) {
                $.ajax({
                    url: '/delete/category/' + categoryToDelete,
                    method: 'DELETE',
                    success: function(deleteResponse) {
                        console.log(`Category '${categoryToDelete}' deleted successfully.`);
                        fetchCategoriesAndPopulate();
                         categorySelection();

                    },
                    error: function(deleteError) {
                        console.error('Error deleting category:', deleteError);
                    }
                });
            }


            function categorySelection(){
                $.ajax({
                url: '/category/display', 
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // clear muna categ para display updated
                    $('#category').empty();

                    var categories = response.categories; 

                    categories.forEach(function(category) {
                        // Category list sa add book ito
                        $('#category').append('<option value="' + category + '">' + category + '</option>');           
                            
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error); 
                }
            });
            }

            var table;

            $(document).ready(function() {         

                fetchCategoriesAndPopulate();
                updateCategoryModalList();
                categorySelection();
  
            });



            //CATEGORY OPTION SA MODAL, PAMIMILIAN


         //DISPLAY DATA FROM API FOR DATATABLE
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
                        data: 'isbn',  name: 'isbn'
                    },
                    {
                        data: 'title',  name: 'title'
                    },
                    {
                        data: 'publisher',  name: 'publisher'
                    },
                    {
                        data: 'location_rack',  name: 'location_rack'
                    },
                    {
                        data: 'status', name: 'status'
                    },
                    {
                        data: 'action', name: 'action', orderable: false, searchable: false
                    },
                ],

         
            });


            $('#customSearchBox').on('keyup', function() {
                table.search(this.value).draw();
            });


                   

            table.on('xhr', function() {
                var data = table.ajax.json().data; 

                $('#tableBody').empty();

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

                    $('#tableBody').append(newRow); 
                });

            });


            $(document).on('click', '.category-link', function(e) {
                e.preventDefault();
                var category = $(this).data('category');

                if (table) {
                    table.ajax.url("{{ route('showcategory', ':category') }}".replace(':category', category)).load();
                    $('#category_title').text(category);
                } else {
                    console.error('Table instance is not defined.');
                }
            });



            //DELETE BOOK
            $('body').on('click', '.deleteBook', function () {
                var book_id = $(this).data("id");

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
                    $('#modelHeader').text("Create New Book");
                    $('#book_id').val('');
                    $('#bookForm').trigger("reset");
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


             //CREATE AND FOR UPDATE BOOKS
             $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Saving..');

                var formData = new FormData();
                var bookImageFile = $('#book_image')[0].files[0];

                if (bookImageFile) {
                        formData.append('book_image', bookImageFile);
                    }



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

                       table.draw();
                   },
                   error: function (data) {
                       console.log('Error:', data);
                       $('#saveBtn').html('Save');
                   }
               });


            });


            //EDIT BOOKS
            $('body').on('click', '.editBook', function () {
                var book_id = $(this).data('id');
                $.get("{{ url('/edit/book') }}/" + book_id, function (data) {

                    $('#modelHeader').html("Edit Book");
                    
                    let alpineInstance = document.getElementById('ajaxModal');
                    if (alpineInstance) {
                        alpineInstance.__x.$data.showModal = true; 
                    } else {
                        console.error('#ajaxModal element not found');
                    }

                    $('#saveBtn').text('Save');
                    $('#saveBtn').val("edit-book");
                   
                    $('#book_number_id').val(data.id);
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



            //DISPLAY CATEGORY LIST SA MODAL WITH DELETE BUTTON
            $('#categoryListContainer').on('click', '.delete-category', function(e) {
                e.preventDefault();
                var deleteLink = $(this);
                var categoryToDelete = deleteLink.data('category');
                deleteCategory(categoryToDelete);
                fetchCategoriesAndPopulate();
                deleteLink.closest('.flex').remove();
               
            });

            // ADD NEW CATEGORY
            $('#categoryForm').submit(function(e) {
                e.preventDefault();
                var categoryName = $('#category_name').val();

                if (categoryName.trim() !== '') {
                    $.ajax({
                        url: '{{ route("category.add") }}',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            category_name: categoryName
                        },
                        success: function(response) {
                            console.log('Category added successfully:', response);

                            var categoryItem = $('<div>')
                                .addClass('flex flex-row justify-between border border-gray-200 rounded-lg p-2 mb-3');

                            var categoryNameElement = $('<label>')
                                .text(response.category.category)
                                .addClass('w-2/3 px-3');

                            var deleteLink = $('<a>')
                                .addClass('delete-category')
                                .data('category', response.category.category)
                                .attr('href', '#');

                            var deleteButtonContent =
                                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">' +
                                '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>' +
                                '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>' +
                                '</svg>';

                            deleteLink.html(deleteButtonContent);

                            categoryItem.append(categoryNameElement, deleteLink);
                            $('#categoryListContainer').append(categoryItem);
                            $('#category_name').val('');
                            categorySelection();
                            fetchCategoriesAndPopulate();
                        },
                        error: function(error) {
                            console.error('Error adding category:', error);
                        }
                    });
                } else {
                    console.error('Category name cannot be empty');
                }
            });
        

 

        });


    </script>
</div>
@endsection