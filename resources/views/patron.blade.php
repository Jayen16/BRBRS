@extends('layouts.app')
@section('title', 'Patron')
@section('nav')
@endsection

@section('content')
    <!-- CONTAINER -->
    <div class="flex w-full mt-2 py-10 h-[90vh] bg-[#F6FFF1]">
        <div class="flex w-full mx-64 gap-12">
          <div class="flex flex-col w-full rounded-md">
  
            <div>
              <div>
                <div x-data="{ openTab: 1 }" class="pt-3">
                  <div class="w-full">
                    <p class="font-semibold text-2xl text-white text-center uppercase p-2 bg-green-800 rounded-md">
                      Library Patrons
                    </p>
  
                    <div x-data="{ open: false }">

                      <div  x-data="{ showModal: false }" class="flex justify-end" id="ajaxModal">
                        <button x-on:click="showModal = true" id="AddPatronStatus"
                          class="bg-green-800 hover:bg-green-800 p-3 rounded-md text-white font-medium mt-4">Add
                          Patron
                        </button>

                        <x-Addpatron />
                        
                      </div>

  
                    <!-- STUDENT -->
                    <div class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                      <!-- Search bar -->
                      <div class="flex items-center my-4">
                        <div class="w-full relative mx-auto text-gray-600">
                          <input class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                            type="search" name="search" id="search" placeholder="Search here...">
                          <button type="submit" class="absolute right-0 top-0 mt-4 mr-4">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                              xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                              viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                              xml:space="preserve" width="512px" height="512px">
                              <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2">
                        <thead id="patrons-table-th" class="bg-green-800 text-white text-left sticky top-0 z-10">
                          <tr class="bg-green-800 text-white text-center">
                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                              Unique ID
                            </th>
                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                              Patron ID
                            </th>
                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                              Name
                            </th>
                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                              Patron Type
                            </th>
                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                              Registration Status
                            </th>
                            <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                               Action
                            </th>
                          </tr>
                        </thead>
  
                        <tbody id="patrons-table">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-4" id="pagination-links"></div>

        </div>

    <script>
      
        $(document).ready(function () {
            var sortColumn = 'id';
            var sortOrder = 'asc';
            var search = '';
    
            function fetchData(page = 1) {
                $.ajax({
                    url: '/api/patron',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        page: page, 
                        limit: 5,
                        sortColumn: sortColumn,
                        sortOrder: sortOrder,
                        search: search,
                    },
                    success: function (data) {

                        $('#patrons-table').empty();
    
                        if (data.data.length > 0) {
                            $.each(data.data, function (index, patron) {
                                var $btnEdit = '<button x-on:click="showModal = true" href="javascript:void(0)" data-id="' + patron['id'] + '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPatron">Edit</button>';
                                var $btnDelete = '<button href="javascript:void(0)" data-id="' + patron['id'] + '" data-original-title="Delete" class="btn btn-danger btn-sm deletePatron">Delete</button>';

                                $('#patrons-table').append(
                                    '<tr class="text-center">' +
                                        '<td class="py-2 px-8 border-b border-gray-200">' + patron['school_id'] + '</td>' +
                                        '<td class="py-2 px-8 border-b border-gray-200">' + patron['patron_id'] + '</td>' +
                                        '<td class="py-2 px-8 border-b border-gray-200">' + patron['first_name'] + ' ' + patron['last_name'] + '</td>' +
                                        '<td class="py-2 px-8 border-b border-gray-200">' + patron['type'] + '</td>' +
                                        '<td class="py-2 px-8 border-b border-gray-200">' + patron['registration_status'] + '</td>' +
                                        '<td class="py-2 px-8 border-b border-gray-200">' + $btnEdit + ' ' + $btnDelete + '</td>' +
                                    '</tr>'
                                );
                            });
                        } else {
                            // If there are no patrons, append a row with a message
                            $('#patrons-table').append(
                                '<tr class="text-center">' +
                                    '<td colspan="6" class="py-2 px-8 border-b border-gray-200">No Patron Record</td>' +
                                '</tr>'
                            );
                        }

                        $('#pagination-links').html(data.links);
                    },
                    error: function (error) {
                        console.log('Error fetching data:', error);
                    }
                });
            }
    
            fetchData();

            $(document).on('click', '#pagination-links a', function (e) {
                  e.preventDefault();
                  var page = $(this).attr('href').split('page=')[1];
                  fetchData(page);
              });



                $('body').on('click', '.editPatron', function() {
                  var id = $(this).data('id');
                  $.get("{{ url('/api/editpatron') }}/" + id, function(data) {

                      let alpineInstance = document.getElementById('ajaxModal');
                      if (alpineInstance) {
                          alpineInstance.__x.$data.showModal = true;
                      } else {
                          console.error('#ajaxModal element not found');
                      }

                      console.log(data.data);

                      $('#modelHeading').html("Edit Patron");
                      $('#saveBtn').text('Save');
                      $('#saveBtn').val("edit-patron");

                      $('#id').val(data.data.id);
                      $('#patron_id').val(data.data.patron_id);
                      $('#school_id').val(data.data.school_id);
                      $('#first_name').val(data.data.first_name);
                      $('#middle_name').val(data.data.middle_name);
                      $('#last_name').val(data.data.last_name);
                      $('#program').val(data.data.program);
                      $('#sex').val(data.data.sex);
                      $('#type').val(data.data.type);
                      $('#registration_status').val(data.data.registration_status);


                      $('#school_id').prop('disabled', true);

                        if (data.data.type == 'Student') {
                            $('#programContainer').show();
                        } else {
                            $('#programContainer').hide();
                        }
            

                  });
            });


            $('body').on('click', '.deletePatron', function() {
                var id = $(this).data("id");
        
                Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete patron!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "DELETE",
                    url: "{{ url('/api/deletepatron') }}/" + id, 
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {


                      let successMessage = data.success;
                     document.querySelector('[x-data]').__x.$data.showMessage = true;
                     document.querySelector('[x-data]').__x.$data.successMessage = successMessage;
                 
                     setTimeout(() => {
                         document.querySelector('[x-data]').__x.$data.showMessage = false;
                         document.querySelector('[x-data]').__x.$data.successMessage = '';
                     }, 5000);

                     fetchData();


                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                    });
                }
                });
            });
    
            $('#addNewPatron').click(function() {
                $('#saveBtn').val("add-patron");
                $('#id').val('');
                $('#patronForm').trigger("reset");
                $('#ajaxModel').modal('show');
            });

            
            $('#patrons-table-th').on('click', function () {
                var column = $(this).data('column');
    
                sortOrder = (sortColumn === column && sortOrder === 'asc') ? 'desc' : 'asc';
    
                sortColumn = column;
    
                fetchData();
            });
    
            // Add event listener for search
            $('#search').on('input', function () {
                search = $(this).val();
                fetchData();
            });



            $('#saveBtn').click(function(e) {

               e.preventDefault(); 

                $(this).html('Save');

                var actionType = $(this).attr('value');

                var patronId = $('#school_id').val();

                var url = (actionType === 'create') ? "{{ route('addpatrons') }}" : '{{ url('api/updatepatron') }}/' + patronId; 

                
                $.ajax({
                    data: $('#patronForm').serialize(),
                    url: url,
                    type: (actionType === 'create') ? 'POST' : 'PUT',
                    dataType: 'json',
                    success: function(data) {
                      
                      $('#patronForm').trigger("reset");
                     let alpineInstance = document.getElementById('ajaxModal');
                 
                     if (alpineInstance) {
                         alpineInstance.__x.$data.showModal = false;
                     } else {
                         console.error('#ajaxModal element not found');
                     }
                 
                     let successMessage = data.success;
                     document.querySelector('[x-data]').__x.$data.showMessage = true;
                     document.querySelector('[x-data]').__x.$data.successMessage = successMessage;
                 
                     setTimeout(() => {
                         document.querySelector('[x-data]').__x.$data.showMessage = false;
                         document.querySelector('[x-data]').__x.$data.successMessage = '';
                     }, 5000);

                     fetchData();
                     $('#saveBtn').val("create");
                    },
                    error: function(data) {

                      let erroMessage = data.error;
                     document.querySelector('[x-data]').__x.$data.showError = true;
                     document.querySelector('[x-data]').__x.$data.erroMessage = erroMessage;
                 
                     setTimeout(() => {
                         document.querySelector('[x-data]').__x.$data.showError = false;
                         document.querySelector('[x-data]').__x.$data.erroMessage = '';
                     }, 5000);


                      let errorResponse = JSON.parse(data.responseText);
                      let validationErrors = errorResponse.error;
                      
                      displayValidationError('school_id', validationErrors.school_id);
                      displayValidationError('patron_id', validationErrors.patron_id);
                      displayValidationError('last_name', validationErrors.last_name);
                      displayValidationError('first_name', validationErrors.first_name);
                      displayValidationError('type', validationErrors.type);
                      displayValidationError('registration_status', validationErrors.registration_status);

                      function displayValidationError(field, errors) {
                          let errorMessageHtml = '<p id="' + field + '_error" style="color: red;">' + (errors ? errors.join(', ') : '') + '</p>';
                          $('#' + field + '_error').html(errorMessageHtml);
                      }


                      $('#saveBtn').html('Save Changes');
                    }

                    
                });
            });
        });


        
    </script>



@endsection



