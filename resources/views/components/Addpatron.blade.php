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
                            <div class="w-1/3 px-3 mb-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Patron ID
                                </label>
                                <input
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    id="patron_id" name="patron_id" type="text" placeholder="patron id" required>
                            </div>
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    School ID
                                </label>
                                <input id="school_id" name="school_id" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    type="text" placeholder="school id" required>
                            </div>
                        </div>
                        <!-- new row -->
                        <div class="flex flex-row mb-1">
                            <div class="w-1/4 px-3 mb-2">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Name
                                </label>
                                <input id="name" name="name" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                     type="text" placeholder="name" required>
                            </div>
                            <div class="w-1/4 px-3 mb-2">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Course
                                </label>
                                <input id="course" name="course" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    type="text" placeholder="course" required>
                                <input type="hidden" id="courseHidden" name="course" value="">
                            </div>
                            <div class="w-1/4 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Sex
                                </label>
                                <select id="sex" name="sex" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    required>
                                    <option selected disabled placeholder="select sex">select
                                        sex</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="w-1/4 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Type
                                </label>
                                <select id="type" name="type" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    required>
                                    <option selected disabled placeholder="select option">select
                                        type</option>
                                    <option value="student">Student</option>
                                    <option value="faculty">Faculty</option>
                                    <option value="staff">Staff</option>
                                    <option value="guest">Guest</option>
                                </select>
                            </div>
                        </div>
                    </div>

                
                </div>
                <div class="flex flex-row justify-end gap-2 mt-2">
                    <button type="submit" id="saveBtn" value="create"
                        class="mt-4 bg-green-700 hover:bg-green-800 px-4 py-2 rounded-lg text-white font-medium">Add</button>
                    <button x-on:click="showModal = false" type="button"
                        class="mt-4 bg-red-400 hover:bg-red-500 px-4 py-2 rounded-lg text-white font-medium">Cancel</button>                
                
                </div>
            </div>

        </form>
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        </div>

    </div>
    
</div>
<script>
  const courseInput = document.getElementById("course");
  const courseHiddenInput = document.getElementById("courseHidden");
  const typeSelect = document.getElementById("type");

  typeSelect.addEventListener("change", function() {
    if (typeSelect.value === "faculty" || typeSelect.value === "staff" || typeSelect.value === "guest") {
      courseInput.value = "N/A";
      courseInput.disabled = true;
      courseHiddenInput.value = "N/A"; 
    } else {
      courseInput.disabled = false;
      courseInput.value = ""; 
    }
  });

    courseInput.addEventListener("input", function() {
    courseHiddenInput.value = courseInput.value; 
    });

</script>