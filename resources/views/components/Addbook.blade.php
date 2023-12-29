<div x-show="showModal" x-cloak>
    <!-- add book modal -->
    <div x-transition x-cloak
        class="fixed inset-0 flex items-center justify-center z-20">
        <div x-cloak class="bg-white p-6 rounded-lg z-10 w-1/2 h-[75vh]">
            <h2 id="modelHeading"
                class="uppercase bg-green-800 rounded-lg text-lg text-white p-2 font-semibold mb-4 text-center mb-6">
                Add New Book</h2>
            <div class="h-[55vh] overflow-y-auto">
                <!-- new row -->
                <form id="bookForm" name="bookForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="book_number_id" id="book_number_id">
                    <div class="border border-gray-200 rounded-lg p-2 py-4">
                        <div class="flex flex-row mb-1">
                            <div class="w-1/3 px-3 mb-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    ISBN No.
                                </label>
                                <input
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700 font-bold"
                                    id="isbn" name="isbn" type="number" placeholder="ISBN #" required>
                            </div>
                        </div>
                        <!-- new row -->
                        <div class="flex flex-row mb-1">
                            <div class="w-1/4 px-3 mb-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Category
                                </label>
                                <select id="category" name="category" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    required>
                                    <option selected disabled placeholder="select option">Select category</option>
                                </select>
                            
                            </div>
                            <div class="w-1/4 px-3 mb-2">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Location Rack
                                </label>
                                <input id="location_rack" name="location_rack" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    id="" type="text" placeholder="location rack" required>
                            </div>
                            <div class="w-1/4 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Condition
                                </label>
                                <select id="condition" name="condition" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    required>
                                    <option selected disabled placeholder="select option">select
                                        condition</option>
                                    <option value="available">New</option>
                                    <option value="borrowed">Slightly used</option>
                                    <option value="missing">Old</option>
                                </select>
                            </div>
                            <div class="w-1/4 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Status
                                </label>
                                <select id="status" name="status" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    required>
                                    <option selected disabled placeholder="select option">select
                                        status</option>
                                    <option value="available">Available</option>
                                    <option value="borrowed">Borrowed</option>
                                    <option value="missing">Missing</option>
                                </select>
                            </div>
                        </div>
                        <hr class="border-1 mb-4">
                        <!-- new row -->
                        <div class="flex flex-row mb-3">
                            <div class="w-1/3 px-3">
                                <div class="">
                                    <div class="">
                                        <div class="bg-white p-[2px] rounded-md w-24 h-24 items-center border border-green-700 mb-3 ml-1">
                                            <img id="preview" class="w-full object-cover" src="#" alt="Preview Image">
                                        </div>
                                    </div>
                                    <div>
                                        <input type="file" accept="image/jpeg, image/png" id="book_image" name="book_image" value="default-bookcover.jpg" onchange="previewImage(event)" class="hidden">
                                        <label class="text-black text-sm px-3 py-1 rounded-md bg-gray-300 hover:bg-gray-400 hover:text-white" for="book_image">
                                            Upload Image
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- new row -->
                        <div class="flex flex-row mb-3">
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Title
                                </label>
                                <input id="title" name="title" 
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    type="text" placeholder="book title" required>
                            </div>
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Edition
                                </label>
                                <input id="edition" name="edition"
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                     type="text" placeholder="edition">
                            </div>
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Publisher
                                </label>
                                <input id="publisher" name="publisher"
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    type="text" placeholder="publisher" required>
                            </div>
                        </div>
                        <!-- new row -->
                        <div class="flex flex-row mb-3">
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Author/s
                                </label>
                                <input id="author" name="author"
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                      type="text" placeholder="author" required>
                            </div>
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Copyright Year
                                </label>
                                <input id="copyright_year" name="copyright_year"
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                     type="number" placeholder="year" required>
                            </div>
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Accession Number
                                </label>
                                <input id="accession_number" name="accession_number"
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                     type="text" placeholder="accession number" required>
                            </div>
                        </div>

                        <hr class="border-1 mb-4">
                        <!-- new row -->
                        <div class="flex flex-row mb-1">
                            <div class="w-full px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Description:
                                </label>
                                <textarea id="description" name="description"
                                    class="no-resize block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 pb-10 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-30 resize-none"
                                    placeholder="type description here.."></textarea>

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

