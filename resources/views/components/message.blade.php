{{-- @if(session()->has('status')) --}}

@if(session('status'))
<div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 5000)" class=" fixed m-2 bottom-0 right-0 z-20 px-4 py-3 " role="alert">
    <div class="flex">    
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-12 py-5 rounded-lg">
           <p class="text-lg font-semibold">Status</p>
           <p>{{session('message')}}{{session('updateStaffAction')}}{{session('deupdateStaffAction')}}{{session('delete')}}{{session('updateChanges')}}
          </p>
      </div>
    </div>
</div>
@endif

@if(session('error'))

  <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 5000)" class="fixed m-2 bottom-0 right-0 z-20 px-4 py-3" role="alert">
    <div class="flex">    
      <div class="bg-red-200 border-l-4 border-red-500 text-red-700 px-12 py-5 rounded-lg">
          <p class="text-lg font-semibold">Status</p>
          <p>{{session('error')}}</p>
      </div>
    </div>
  </div>

@endif
{{-- class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg" --}}