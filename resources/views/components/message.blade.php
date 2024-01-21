{{-- @if(session()->has('status')) --}}

<div x-cloak x-data="{ showMessage: false, successMessage: '' }" x-show="showMessage" x-init="
    setTimeout(() => {
        showMessage = false;
        successMessage = '';
    }, 5000)
"
 class=" fixed m-2 bottom-0 right-0 z-20 px-4 py-3 " role="alert">
    <div class="flex">    
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-12 py-4 rounded-lg">
           <p class="text-lg font-semibold">Status</p>
           <p x-text="successMessage"></p>
      </div>
    </div>
</div>


  <div x-cloak x-data="{ showError: false, errorMessage: '' }" x-show="showError" x-init="
  setTimeout(() => {
      showError = false;
      errorMessage = '';
  }, 5000)
"
    class="fixed m-2 bottom-0 right-0 z-20 px-4 py-3" role="alert">
    <div class="flex">    
      <div class="bg-red-200 border-l-4 border-red-500 text-red-700 px-12 py-4 rounded-lg">
          <p class="text-lg font-semibold">Status</p>
          <p x-text="errorMessage"></p>
      </div>
    </div>
  </div>






{{-- class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" --}}