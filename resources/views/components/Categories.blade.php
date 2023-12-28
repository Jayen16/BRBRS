<div x-show="showCategoryModal" x-cloak>
    <!-- add book modal -->
    <div x-transition x-cloak
        class="fixed inset-0 flex items-center justify-center z-20">
        <div x-cloak class="bg-white p-6 rounded-lg z-10 w-1/2 h-[75vh]">
            <h2 id="modelHeading"
                class="uppercase bg-green-800 rounded-lg text-lg text-white p-2 font-semibold mb-4 text-center mb-6">
                Add Category</h2>
            <div class="h-[55vh] overflow-y-auto">
                <!-- new row -->
                <form id="categoryForm" name="categoryForm">
             
                    <input type="hidden" name="book_id" id="book_id">
                    <div class="border border-gray-200 rounded-lg p-2 py-4">
                        <!-- new row -->
                        <div class="flex flex-row mb-3">
                           
                                <br>
                                <div id="categoryListContainer" class="w-1/3 px-3"> </div>
                                @csrf
                            <div class="w-1/3 px-3">
                                <label
                                    class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                                    for="">
                                    Insert new category
                                </label>
                                <input id="category_name" name="category_name"
                                    class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                                    type="text" placeholder="category" required>                       
                            </div>  
                            <div>
                                <button type="submit" id="addCategoryBtn" value="create"
                                class="mt-4 bg-green-700 hover:bg-green-800 px-4 py-2 rounded-lg text-white font-medium">Insert</button>
                            </div>
                        </div>
                    </div>          
                </div>
            </form>

                <div class="flex flex-row justify-end gap-2 mt-2">
                    
                    <button x-on:click="showCategoryModal = false" type="button"
                        class="mt-4 bg-red-400 hover:bg-red-500 px-4 py-2 rounded-lg text-white font-medium">Cancel</button>                
                
                </div>
            </div>

        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        </div>

    </div>
    
</div>

