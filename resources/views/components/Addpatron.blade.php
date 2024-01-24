<div x-show="showModal" x-cloak>
    <!-- add book modal -->
    <div x-show="open" x-transition x-cloak
        class="fixed inset-0 flex items-center justify-center z-20">
        <div x-cloak class="bg-white p-6 rounded-lg z-10 w-1/2 h-[75vh]">
            <h2 id="modelHeading"
                class="uppercase bg-green-800 rounded-lg text-lg text-white p-2 font-semibold mb-4 text-center mb-6">
                Create Patron</h2>
            <div class="h-[55vh] overflow-y-auto">
                <!-- new row -->
                <form id="patronForm" name="patronForm" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="border border-gray-200 rounded-lg p-2 py-4">
                        <div class="flex flex-row mb-1">
                          <div class="w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                              School / Employee Number<span style="color: red;">*</span>
                            </label>
                            <input
                              class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700 font-semibold"
                              id="school_id" name="school_id" type="text" placeholder="number id" required>
                              <p id="school_id_error"> </p>
                          </div>
                          <div class="w-1/2 px-3 mb-3">
                            <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                              Patron ID<span style="color: red;">*</span>
                            </label>
                            <input
                              class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700 font-semibold"
                              id="patron_id" name="patron_id"  type="number" placeholder="Student No./Employee No." maxlength="10"
                              oninput="javascript: if (this.value.length > this.maxLength) this.value =
                            this.value.slice(0, this.maxLength);" required>
                            <p id="patron_id_error"> </p>
                          </div>
                        </div>
                        <hr class="border-1 mb-4">
                        <!-- new row -->
                        <div class="flex flex-row mb-1">
                          <div class="w-1/3 px-3 mb-2">
                            <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                              Last Name<span style="color: red;">*</span>
                            </label>
                            <input
                              class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                              id="last_name" name="last_name"  type="text" placeholder="
                              " required>
                              <p id="first_name_error"> </p>
                          </div>
                          <div class="w-1/3 px-3 mb-2">
                            <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                              First Name<span style="color: red;">*</span>
                            </label>
                            <input
                              class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                              id="first_name" name="first_name" type="text" placeholder="
                              " required>
                              <p id="last_name_error"> </p>
                          </div>
                          <div class="w-1/3 px-3 mb-2">
                            <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                              Middle Name
                            </label>
                            <input
                              class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                              id="middle_name" name="middle_name"  type="text" placeholder="
                              " >
                          </div>
                        </div>
  
                        <!-- new row -->
  
                        
                        <div class="flex flex-row mb-1 mt-2">
                            <div class="w-1/3 px-3 mb-3">
                                <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                                  Patron Type<span style="color: red;">*</span>
                                </label>
                                <select id="type" name="type"
                                  class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                  required>
                                  <option selected disabled placeholder="select option">select
                                    patron type</option>
                                  <option value="Student">Student</option>
                                  <option value="Employee">Employee</option>
                                  <option value="Library Staff">Library Staff</option>
                                </select>
                                <p id="type_error"> </p>
                              </div>

                            <div id="programContainer" class="w-2/3 px-3" style="display: none;">
                                <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                                  Program<span style="color: red;">*</span>
                                </label>
                                <select id="program" name="program"
                                  class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                  required>
                                  <option selected disabled placeholder="select option">select program
                                    </option>
                                    <option value="BA English Language Studies">BA English Language Studies</option>
                                    <option value="BA Journalism">BA Journalism</option>
                                    <option value="BA Political Science">BA Political Science</option>
                                    <option value="BS Applied Mathematics">BS Applied Mathematics</option>
                                    <option value="BS Biology">BS Biology</option>
                                    <option value="BS Psychology">BS Psychology</option>

                                    <option value="BS Social Work">BS Social Work</option>
                                    <option value="BS Criminology">BS Criminology</option>

                                    <option value="BS Industrial Security Management">BS Industrial Security Management</option>
                                    <option value="BS Accountancy">BS Accountancy</option>
                                    <option value="BS Business Management">BS Business Management</option>
                                    <option value="BS Development Management">BS Development Management</option>
                                    <option value="BS Economics">BS Economics</option>
                                    <option value="BS International Studies">BS International Studies</option>

                                    <option value="Bachelor of Early Childhood Education">Bachelor of Early Childhood Education</option>
                                    <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                                    <option value="Bachelor of Secondary Education">Bachelor of Secondary Education</option>
                                    <option value="Bachelor of Special Needs Education">Bachelor of Special Needs Education</option>
                                    <option value="Bachelor of Technology and Livelihood Education">Bachelor of Technology and Livelihood Education</option>
                                   
                                    <option value="BS Hospitality Management">BS Hospitality Management</option>
                                    <option value="BS Tourism Management">BS Tourism Management</option>
                                    <option value="Teacher Certificate Program">Teacher Certificate Program</option>
                                    <option value="Science High School">Science High School</option>
                                    <option value="Elementary Education">Elementary Education</option>
                                    <option value="Pre-Elementary Education">Pre-Elementary Education</option>

                                    <option value="BS Agricultural and Biosystems Engineering ">BS Agricultural and Biosystems Engineering </option>
                                    <option value="BS Architecture">BS Architecture</option>
                                    <option value="BS Civil Engineering">BS Civil Engineering</option>
                                    <option value="BS Computer Engineering">BS Computer Engineering</option>
                                    <option value="BS Computer Science">BS Computer Science</option>
                                    <option value="BS Electrical Engineering">BS Electrical Engineering</option>
                                    <option value="BS Electronics Engineering">BS Electronics Engineering</option>
                                    <option value="BS Industrial Engineering">BS Industrial Engineering</option>
                                    
                                    <option value="BS Industrial Technology - Automative Technology">BS Industrial Technology - Automative Technology</option>
                                    <option value="BS Industrial Technology - Electrical Technology">BS Industrial Technology - Electrical Technology</option>
                                    <option value="BS Industrial Technology - Electronics Technology">BS Industrial Technology - Electronics Technology</option>
                                    <option value="BS Information Technology">BS Information Technology</option>
                                    <option value="BS Office Administration">BS Office Administration</option>

                                    <option value="BS Medical Technology">BS Medical Technology</option>
                                    <option value="BS Midwifery">BS Midwifery</option>
                                    <option value="BS Nursing">BS Nursing</option>
                                    <option value="Diploma in Midwifery">Diploma in Midwifery</option>
                                    <option value="Bachelor of Physical Education">Bachelor of Physical Education</option>
                                    <option value="Bachelor of Exercise and Sports Sciences">Bachelor of Exercise and Sports Sciences</option>
                                    <option value="Doctor of Veterinary Medicine">Doctor of Veterinary Medicine</option>

                                </select>
                            </div>
                        </div>

                        <div class="flex flex-row mb-1 mt-3">
                          <div class="w-1/3 px-3">
                            <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                              Sex
                            </label>
                            <select id="sex" name="sex"
                              class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                              required>
                              <option selected disabled placeholder="select option">select sex
                                </option>
                              <option value="Female">Female</option>
                              <option value="Male">Male</option>
                            </select>
                          </div>
                          <div class="w-1/3 px-3">
                            <label class="block tracking-wide text-gray-700 text-md font-medium mb-1" for="">
                              Registration Status<span style="color: red;">*</span>
                            </label>
                            <select id="registration_status" name="registration_status"
                              class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                              required>
                              <option selected disabled placeholder="select option">select
                                status</option>
                              <option value="Registered">Registered</option>
                              <option value="Not Registered">Not Registered</option>
                            </select>
                            <p id="registration_status_error"> </p>
                          </div>
                        </div>
                      </div>    
                {{-- </div> --}}



                <div class="flex flex-row justify-end gap-2 mt-2">
                    <button type="submit" id="saveBtn" value="create"
                        class="mt-4 bg-green-700 hover:bg-green-800 px-4 py-2 rounded-lg text-white font-medium">Add</button>
                    <button x-on:click="showModal = false" type="button" id="cancelBtn" 
                        class="mt-4 bg-red-400 hover:bg-red-500 px-4 py-2 rounded-lg text-white font-medium">Cancel</button>                
                      </div>
                </div>
            </div>
  
        </form>
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        </div>
  
    </div>
    
  </div>
  <script>

    
    var typeSelect = document.getElementById('type');
    var programContainer = document.getElementById('programContainer');
    var programSelect = document.getElementById('program');

    typeSelect.addEventListener('change', function () {
        if (typeSelect.value === 'Student') {
            programContainer.style.display = 'block';

        } else {

          programContainer.style.display = 'none';
        }
    });


    $('#cancelBtn').click(function (e) {
    e.preventDefault();

    // Reset form elements
    $('#modelHeading').html('Add Patron');
    $('#saveBtn').text('Save').val('create');
    $('#school_id').prop('disabled', false);

    $('#id, #patron_id, #school_id, #first_name, #middle_name, #last_name, #program, #sex, #type, #registration_status').val('');
});

  </script>