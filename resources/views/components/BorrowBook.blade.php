<div x-show="showModal" x-cloak>
    <!-- borrow book modal -->
    <div x-transition x-cloak
        class="fixed inset-0 flex items-center justify-center z-20">
        <div x-cloak class="bg-gray-800 bg-opacity-75 absolute inset-0"></div>
        <div x-cloak class="bg-[#FCFCFF] p-6 rounded-lg z-10 w-1/2 h-auto">
            <h2 class="uppercase bg-green-800 rounded-lg text-lg text-white p-2 font-semibold mb-4 text-center mb-6"
            id="modal-title" x-text="sessionStorage.getItem('statusValue')">
                </h2>
                
            <div class="flex overflow-y-auto justify-center">
                <div class="md:w-1/6 lg:w-4/6 w-2/4 ">
                    <img src="{{ asset('images/scan gif.gif') }}" alt="Description of the GIF">
                </div>
            </div>

            <div class="flex justify-center">
                <form id="borrowForm" name="borrowForm" class="form-horizontal">
                    @csrf
                    <input type="password" name="borrow_book_id" id="borrow_book_id" placeholder=" Click to read RFID" class="bg-slate-100 p-2 mb-2 border rounded w-96 text-lg">

            </div>

            {{-- NAKUHA NATIN ID GALING SA bookdescription.blade.php , TAKE NOTE, YUNG :bookId ang name variable , galing yan sa <x-BorrowBook :bookId="$bookId" /> --}}
            <div>
                <input type="hidden" id="book_id" value=" {{ $bookId }}">
            </div>

            <p class="font-medium text-lg px-2 text-center text-md"><span
                    class="text-red-400 font-normal">Note: </span>Kindly scan the RFID
                Card to the
                RFID Scanner to complete the transaction.
            </p>
            <div class="mt-2">
                <div class="flex px-2">
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Borrower's Name
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_name" type="text" required disabled>
                    </div>
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Patron Type
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_type" type="text" required disabled>
                    </div>
                </div>
                <div class="flex px-2">
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Book Title
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_book" type="text" required disabled>
                    </div>
                    <div class="w-1/2 px-3 mt-4">
                        <label
                            class="block tracking-wide text-gray-700 text-md font-medium mb-1"
                            for="">
                            Current Time & Date
                        </label>
                        <input
                            class="w-full border p-2 rounded-md mb-1 focus:outline-none focus:border-green-700"
                            id="borrower_time" type="text" required disabled>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-end gap-2 mt-2">
                <button  type="submit" id="borrowBtn"
                    class="mt-4 bg-green-700 hover:bg-green-800 px-4 py-2 rounded-lg text-white font-medium"> Transact 
                
                </button>
                <button x-on:click="showModal = false" type="button" id="cancelButton"
                    class="mt-4 bg-red-400 hover:bg-red-500 px-4 py-2 rounded-lg text-white font-medium">Cancel</button>
            </div>
        </form>
        </div>
    </div>

</div>



<script>

    $(document).ready(function() {
       
        $('#borrow_book_id').off('keydown').on('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const bookId = "{{ $bookId }}";
            var rfidId = $(this).val().trim();
            
            if (rfidId !== '') {
                $.ajax({
                    url: '/patron/' + rfidId + '/' + bookId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        if(data.success){
                            lagayValueSaInputFields(data);
                        }
                                
                    },
                    error: function(xhr, status, error) {
                        clearFormFields();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'This RFID ID is not yet registered.',
                        });
                    }
                });
            } else {
                clearFormFields();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'RFID ID is empty. Cannot proceed with form submission.',
                    showConfirmButton: true
                });
            }
        }
    });


    function lagayValueSaInputFields(data) {
        var date = new Date(data.book.updated_at);
        var options = { month: 'short', day: 'numeric', year: 'numeric' };
        var formattedDate = date.toLocaleDateString('en-US', options);

        $('#borrower_name').val(data.patron.name || '');
        $('#borrower_type').val(data.patron.type || '');
        $('#borrower_book').val(data.book.title || '');
        $('#borrower_time').val(formattedDate || '');

        $('#borrow_book_id').click(function() {
           $('#borrow_book_id').val('');
        });

    }



});



    function performTransaction(transaction,bookId, rfidId) {
        $.ajax({
            url: '/description/' + transaction + '/' + bookId + '/' + rfidId,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
                    }).then((result) => {
                        if (result.isConfirmed) {
                        }
                    });
                } else if (response.error) {
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.error,
                    });
                }

            },
        });
    }

   

    $('#borrowBtn').off('click').on('click', function() {
        var status_transaction = $('#modal-title').text();
        var transaction = (status_transaction === 'Borrow Book') ? 'Borrow' : (status_transaction === 'Return Book') ? 'Return' : '';

        const bookId = "{{ $bookId }}";
        var rfidId = $('#borrow_book_id').val().trim();

        if (rfidId) {
            performTransaction(transaction,bookId, rfidId);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'RFID ID is empty. Cannot proceed with transaction.',
            });
        }
    });


    function clearFormFields() {
        $('#borrower_name').val('');
        $('#borrower_type').val('');
        $('#borrower_book').val('');
        $('#borrower_time').val('');

        setTimeout(function() {
            $('#borrow_book_id').val('');
        }, 2500);
    }


    $('#cancelButton').on('click', function() {
        clearFormFields();
    });


</script>