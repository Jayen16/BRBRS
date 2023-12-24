@extends('layouts.app')


@section('nav')
@endsection

@section('content')
    <!-- CONTAINER -->
    <div class="min-h-screen bg-[#F6FFF1] w-full">
        <div class="flex w-full mt-2 py-10 h-[90vh]">
            <div class="flex w-full mx-32 gap-12">
                <div class="flex flex-col w-full rounded-md">

                    <div>
                        <div>
                            <div x-data="{ openTab: 1 }" class="pt-3">

                                <div x-data="{ showModal: false }" class="w-full mb-3 flex justify-end" id="ajaxModal">

                                    <button x-on:click="showModal = true" href="javascript:void(0)" id="addNewPatron"
                                        class="bg-green-800 hover:bg-green-800 p-3 rounded-md text-white font-medium">Add
                                        Patron
                                    </button>

                                    <x-Addpatron />


                                </div>
                                <div class="w-full">
                                    <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md border-2">
                                        <button x-on:click="openTab = 1" :class="{ 'bg-green-800 text-white': openTab === 1 }" 
                                            :class="{ 'bg-green-800 text-white': openTab === 1 }"
                                            class="flex-1 py-3 px-4 rounded-md focus:outline-none border-2 uppercase font-medium focus:shadow-outline-blue transition-all duration-300">Student</button>
                                        <button x-on:click="openTab = 2"  :class="{ 'bg-green-800 text-white': openTab === 2 }" 
                                            :class="{ 'bg-green-800 text-white': openTab === 2 }"
                                            class="flex-1 py-3 px-4 rounded-md focus:outline-none border-2 uppercase font-medium focus:shadow-outline-blue transition-all duration-300">Faculty</button>
                                        <button x-on:click="openTab = 3"  :class="{ 'bg-green-800 text-white': openTab === 3 }" 
                                            :class="{ 'bg-green-800 text-white': openTab === 3 }"
                                            class="flex-1 py-3 px-4 rounded-md focus:outline-none border-2 uppercase font-medium focus:shadow-outline-blue transition-all duration-300">Staff</button>
                                        <button x-on:click="openTab = 4"  :class="{ 'bg-green-800 text-white': openTab === 4 }" 
                                            :class="{ 'bg-green-800 text-white': openTab === 4 }"
                                            class="flex-1 py-3 px-4 rounded-md focus:outline-none border-2 uppercase font-medium focus:shadow-outline-blue transition-all duration-300">Guest</button>
                                    </div>

                                    <!-- STUDENT -->
                                    <div x-show="openTab === 1" class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                                        <!-- Search bar -->
                                        <div class="flex items-center my-4">
                                            <div class="w-full relative mx-auto text-gray-600">
                                                <input
                                                    class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                                    type="search" name="search" placeholder="Search here...">
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
                                        <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2"
                                            id="student-table1">
                                            <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
                                                <tr class="bg-green-800 text-white text-center">
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl"
                                                        name="school_id">
                                                        STUDENT NO.
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="name">
                                                        NAME
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="course">
                                                        COURSE
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="sex">
                                                        REGISTRATION STATUS
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="action">
                                                        ACTION
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

                                    <!-- FACULTY -->
                                    <div x-show="openTab === 2" class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                                        <!-- Search bar -->
                                        <div class="flex items-center my-4">
                                            <div class="w-full relative mx-auto text-gray-600">
                                                <input
                                                    class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                                    type="search" name="search" placeholder="Search here...">
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
                                        <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2"
                                            id="faculty-table2">
                                            <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
                                                <tr class="bg-green-800 text-white text-center">
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                        EMPLOYEE NO.
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                        NAME
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                        REGISTRATION STATUS
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]" name="action">
                                                        ACTION
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody id="tableEmployee">
                                                <tr id="noRecordsMessageEmployee" class="text-center">
                                                    <td class="py-8 px-8 border-b border-gray-200 text-gray-500"
                                                        colspan="5">
                                                        No existing records found.
                                                    </td>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- STAFF -->
                                    <div x-show="openTab === 3" class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                                        <!-- Search bar -->
                                        <div class="flex items-center my-4">
                                            <div class="w-full relative mx-auto text-gray-600">
                                                <input
                                                    class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                                    type="search" name="search" placeholder="Search here...">
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
                                        <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2"
                                            id="staff-table3">
                                            <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
                                                <tr class="bg-green-800 text-white text-center">
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                        STAFF ID
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                        NAME
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                        REGISTRATION STATUS
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]"
                                                        name="action">
                                                        ACTION
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody id="tableStaff">
                                                <tr id="noRecordsMessageStaff" class="text-center">
                                                    <td class="py-8 px-8 border-b border-gray-200 text-gray-500"
                                                        colspan="5">
                                                        No existing records found.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- GUEST -->
                                    <div x-show="openTab === 4"
                                        class="w-full shadow-md mt-1 overflow-y-auto max-h-[70vh]">
                                        <!-- Search bar -->
                                        <div class="flex items-center my-4">
                                            <div class="w-full relative mx-auto text-gray-600">
                                                <input
                                                    class=" w-full border-2 bg-white h-10 px-5 rounded-md text-lg focus:outline p-6"
                                                    type="search" name="search" placeholder="Search here...">
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
                                        <table class="w-full bg-white border border-gray-200 rounded-md shadow-md mt-2"
                                            id="guest-table4">
                                            <thead class="bg-green-800 text-white text-left sticky top-0 z-10">
                                                <tr class="bg-green-800 text-white text-center">
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem] rounded-tl">
                                                        GUEST ID
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                        NAME
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]">
                                                        REGISTRATION STATUS
                                                    </th>
                                                    <th class="py-3 px-8 border-b border-gray-200 w-[16rem]"
                                                        name="action">
                                                        ACTION
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody id="tableGuest">
                                                <tr id="noRecordsMessageGuest" class="text-center">
                                                    <td class="py-8 px-8 border-b border-gray-200 text-gray-500"
                                                        colspan="5">
                                                        No existing records found.
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

    <script>
        $(document).ready(function() {
          var tables = [
            $('#student-table1').DataTable({
              dom: 'lrtip',
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('patron') }}?type=student", 
                type: 'GET'
              },
              columns: [
             
                { data: 'school_id', name: 'school_id' },
                { data: 'name', name: 'name' },
                { data: 'course', name: 'course' },
                { data: 'sex', name: 'sex' },
                {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: false
                }
              ]
            }),
        
            $('#faculty-table2').DataTable({
              dom: 'lrtip',
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('patron') }}?type=faculty",
                type: 'GET'
              },
              columns: [
      
                { data: 'school_id', name: 'school_id' },
                { data: 'name', name: 'name' },
                { data: 'sex', name: 'sex' },
                {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: false
                }
              ]
            }),

            $('#staff-table3').DataTable({
              dom: 'lrtip',
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('patron') }}?type=faculty",
                type: 'GET'
              },
              columns: [
             
                { data: 'school_id', name: 'school_id' },
                { data: 'name', name: 'name' },
                { data: 'sex', name: 'sex' },
                {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: false
                }
              ]
            }),

            $('#guest-table4').DataTable({
              dom: 'lrtip',
              processing: true,
              serverSide: true,
              ajax: {
                url: "{{ route('patron') }}?type=guest",
                type: 'GET'
              },
              columns: [
    
                { data: 'school_id', name: 'school_id' },
                { data: 'name', name: 'name' },
                { data: 'sex', name: 'sex' },
                {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: false
                }
              ]
            }),


            
          ];
      
          // Event listener for deleting a patron
          $('body').on('click', '.deletePatron', function() {
            var id = $(this).data("id");
      
            // Use SweetAlert for confirmation
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
                  url: "{{ url('/deletepatron') }}/" + id, 
                  data: {
                    _token: '{{ csrf_token() }}'
                  },
                  success: function(data) {
                    for (var i = 0; i < tables.length; i++) {
                      tables[i].draw();
                    }
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

          $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#patronForm').serialize(),
                    url: "{{ route('addpatrons') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#patronForm').trigger("reset");
                        let alpineInstance = document.getElementById('ajaxModal');

                        if (alpineInstance) {
                            alpineInstance.__x.$data.showModal = false;
                        } else {
                            console.error('#ajaxModal element not found');
                        }

                        for (var i = 0; i < tables.length; i++) {
                            tables[i].draw();
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });
      
            $('body').on('click', '.editPatron', function() {
                var id = $(this).data('id');
                $.get("{{ url('/editpatron') }}/" + id, function(data) {

                    let alpineInstance = document.getElementById('ajaxModal');
                    if (alpineInstance) {
                        alpineInstance.__x.$data.showModal = true;
                    } else {
                        console.error('#ajaxModal element not found');
                    }

                    $('#modelHeading').html("Edit Patron");
                    $('#saveBtn').text('Save');
                    $('#saveBtn').val("edit-patron");

                    $('#id').val(data.id);
                    $('#patron_id').val(data.patron_id);
                    $('#school_id').val(data.school_id);
                    $('#name').val(data.name);
                    $('#course').val(data.course);
                    $('#sex').val(data.sex);
                    $('#type').val(data.type);
                });
            });
      
    
        });
      </script>

    </div>
@endsection
