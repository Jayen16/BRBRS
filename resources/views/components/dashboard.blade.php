
<style>
  .borrowed-icon, .returned-icon, .Awaiting-icon{
    width: 100px;
    height: 100px;
    background: #018f3a;
    color: rgb(255, 255, 255); 
    display: inline-flex;
    align-items: center;
    justify-content: center;  
    border-radius: 25%;
    margin-top: 0.5cm;
  }

  .calendar {
    font-family: 'Helvetica', sans-serif;
    text-align: center;
    color: #333;
  }

  .month {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 16px;
    color: black;
  }

  .days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
    
  }

  .day {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e0e0e0; 
    border-radius: 8px; 
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .current-day {
    background-color: #018f3a;
    color: #fff;
    font-weight: bold;
    border-color: #018f3a; 
  }
  .day:hover {
    background-color: #f0f0f0; 
  }

  /* Additional Styles for Days */
  .day-name {
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    color: black;
  }
</style>


<div class="min-h-screen w-full bg-[#F6FFF1]">

  <!--  Start total chart Dashboard-->
  <div class="mb-12 grid gap-y-10 gap-x-16 grid-cols-3 md:grid-cols-3 px-96 mt-12">

    <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md h-[10rem]">
      <div
        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-700 to-green-500 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-books" width="24" height="24"
          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
          <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
          <path d="M5 8h4" />
          <path d="M9 16h4" />
          <path
            d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" />
          <path d="M14 9l4 -1" />
          <path d="M16 16l3.923 -.98" />
        </svg>
      </div>
      <div class="flex justify-between">
        <div class="text- ml-24 mt-2">
          <p class="block antialiased font-sans text-2xl leading-normal font-bold text-green-700">
            Borrowed</p>
        </div>
        <div class="p-4 text-right">
          <h4 class="block antialiased tracking-normal font-sans text-2xl font-bold leading-snug text-blue-gray-900" id="borrow">
            0 </h4>
          <p class="block antialiased font-sans text-sm leading-normal font-semibold text-blue-gray-600">
            borrowed today</p>
        </div>
      </div>
      <div class="flex justify-center border-t border-blue-gray-50 p-2">
        <p class="block antialiased font-sans text-lg leading-relaxed font-normal text-blue-gray-600" >
          <strong class="text-green-500 font-bold text-2xl" id="total_borrowed">0</strong>&nbsp;total books borrowed
        </p>
      </div>
    </div>

    <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md h-[10rem]">
      <div
        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-700 to-green-500 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24"
          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M7 12l5 5l10 -10" />
          <path d="M2 12l5 5m5 -5l5 -5" />
        </svg>
      </div>
      <div class="flex justify-between">
        <div class="text- ml-24 mt-2">
          <p class="block antialiased font-sans text-2xl leading-normal font-bold text-green-700">
            Returned</p>
        </div>
        <div class="p-4 text-right">
          <h4 class="block antialiased tracking-normal font-sans text-2xl font-bold leading-snug text-blue-gray-900" id="returned">
            0 <span class="font-medium">book/s</span></h4>
          <p class="block antialiased font-sans text-sm leading-normal font-semibold text-blue-gray-600">
            returned today</p>
        </div>
      </div>
      <div class="flex justify-center items-center border-t border-blue-gray-50 p-2">
        <p class="block antialiased font-sans text-lg leading-relaxed font-normal text-blue-gray-600 mt-1" >
          <strong class="text-green-500 font-bold text-2xl" id="total_returned">0</strong>&nbsp;total books returned
        </p>
      </div>
    </div>

    <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md h-[10rem]">
      <div
        class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-700 to-green-500 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9.75h4.875a2.625 2.625 0 0 1 0 5.25H12M8.25 9.75 10.5 7.5M8.25 9.75 10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185Z" />
        </svg>
        
      </div>
      <div class="flex justify-between">
        <div class="text- ml-24 mt-2">
          <p class="block antialiased font-sans text-2xl leading-normal font-bold text-green-700">
            Awaiting</p>
        </div>
        <div class="p-4 text-right">
          <h4 class="block antialiased tracking-normal font-sans text-2xl font-bold leading-snug text-blue-gray-900" id="awaiting">
            0 <span class="font-medium">book/s</span></h4>
          <p class="block antialiased font-sans text-sm leading-normal font-semibold text-blue-gray-600">
            pending today</p>
        </div>
      </div>
      <div class="flex justify-center border-t border-blue-gray-50 p-2">
        <p class="block antialiased font-sans text-lg leading-relaxed font-normal text-blue-gray-600 mt-1" >
          <strong class="text-green-500 font-bold text-2xl" id="total_awaiting">0</strong>&nbsp;total pending return of book 
        </p>
      </div>
    </div>
  </div>

  <!--  Start  percentage chart Dashboard-->
  <div class="flex mt-8 mx-64 justify-center">
    <!-- Left Container for Charts -->
    <div class="flex-shrink-0 w-3/4">
      <!-- Single Card for Charts -->
      <div class="bg-white p-4 border rounded shadow text-center">
        <div class="text-left mb-4">
          <p class="font-bold text-2xl text-green-700">Monthly Transaction Report</p>
        </div>
        <!-- First Percentage Chart -->
        <div class="flex items-center justify-center mb-4">
          <div class="w-40 h-40 flex-shrink-0">
            <canvas id="percentageChart1"></canvas>
          </div>
          <div class="ml-2">
            <p><b>Percentage of borrowed books</b></p>
          </div>
        </div>

        <!-- Second Percentage Chart -->
        <div class="flex items-center justify-center mb-4">
          <div class="w-40 h-40 flex-shrink-0">
            <canvas id="percentageChart2"></canvas>
          </div>
          <div class="ml-2">
            <p><b>Percentage of returned books</b></p>
          </div>
        </div>

        <!-- Third Percentage Chart -->
        <div class="flex items-center justify-center">
          <div class="w-40 h-40 flex-shrink-0">
            <canvas id="percentageChart3"></canvas>
          </div>
          <div class="ml-2">
            <p><b>Percentage of awaiting books</b></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Container for Other Content -->
    <div class="ml-6 w-1/2">
      <!-- Card for Auto Slideshow -->
      <div x-data="{ activeSlide: 0, slides: [
        '{{ asset('images/pic1.jpg') }}',
        '{{ asset('images/pic2.jpg') }}',
        '{{ asset('images/pic3.jpg') }}'
        ] }"
        x-init="() => { setInterval(() => { activeSlide = (activeSlide + 1) % slides.length; }, 3000); }"
        class="relative bg-white p-4 border rounded shadow overflow-hidden">
      <!-- Slideshow Content -->
      <img x-bind:src="slides[activeSlide]" alt="Slide Image" class="w-full h-auto rounded">

      <!-- Queue Dots -->
      <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
          <div x-on:click="activeSlide = index"
            class="w-4 h-4 rounded-full cursor-pointer transition duration-300 transform hover:scale-125 hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500"
            :class="{ 'bg-blue-500': activeSlide === index, 'bg-gray-300': activeSlide !== index }"></div>
        </template>
      </div>
    </div>

      <!-- Card for Mini Calendar -->
      <div class="mt-8 p-4 border rounded shadow bg-white">
        <div class="calendar">
          <div class="month bg-green-700 p-2 text-white rounded-sm" id="month"></div>
          <div class="days" id="days"></div>
        </div>
      </div>
    </div>
  </div>


  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
    // Sample data for the percentage charts
    const dataPercentage1 = {
      labels: ["Borrowed", "Remaining"],
      datasets: [
        {
          data: [75, 25],
          backgroundColor: ["#3498db", "#ecf0f1"],
        },
      ],
    };
  
    const configPercentage1 = {
      type: "doughnut",
      data: dataPercentage1,
      options: {},
    };
  
    var chartPercentage1 = new Chart(document.getElementById("percentageChart1"), configPercentage1);
  
    // Repeat the same structure for the other two charts (chartPercentage2 and chartPercentage3)
  
    // Sample data for the second percentage chart
    const dataPercentage2 = {
      labels: ["Returned", "Remaining"],
      datasets: [
        {
          data: [50, 50],
          backgroundColor: ["#2ecc71", "#ecf0f1"],
        },
      ],
    };
  
    const configPercentage2 = {
      type: "doughnut",
      data: dataPercentage2,
      options: {},
    };
  
    var chartPercentage2 = new Chart(document.getElementById("percentageChart2"), configPercentage2);
  
    // Sample data for the third percentage chart
    const dataPercentage3 = {
      labels: ["Awaiting", "Remaining"],
      datasets: [
        {
          data: [30, 70],
          backgroundColor: ["#e74c3c", "#ecf0f1"],
        },
      ],
    };
  
    const configPercentage3 = {
      type: "doughnut",
      data: dataPercentage3,
      options: {},
    };
  
    var chartPercentage3 = new Chart(document.getElementById("percentageChart3"), configPercentage3);
    
    $(document).ready(function() {
        $.ajax({
        url: "{{ route('dashboard.content') }}",
        type: 'GET',
        success: function (data) {
  
  
            chartPercentage1.data.datasets[0].data = [data.borrowed_books_count, data.awaiting_books_count];
            chartPercentage1.update();
  
            chartPercentage2.data.datasets[0].data = [data.returned_books_count, data.borrowed_books_count];
            chartPercentage2.update();
  
            
            chartPercentage3.data.datasets[0].data = [data.awaiting_books_count, data.returned_books_count];
            chartPercentage3.update();
  
            $('#borrow').text(data.borrowed_books_count + ' book/s');
            $('#returned').text(data.returned_books_count + ' book/s');
            $('#awaiting').text(data.awaiting_books_count + ' book/s');
            $('#total_borrowed').text(data.total_borrowed_count);
            $('#total_returned').text(data.total_returned_count);
            $('#total_awaiting').text(data.total_awaiting_count);

        }
        });
    });
  </script>
  
  <!-- Script for Mini Calendar -->
  <script>
    function generateMiniCalendar() {
      const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  
      const today = new Date();
      const currentMonth = today.getMonth();
      const currentYear = today.getFullYear();
  
      const monthElement = document.getElementById('month');
      const daysElement = document.getElementById('days');
  
      // Display current month
      monthElement.textContent = months[currentMonth] + ' ' + currentYear;
  
      // Get the first day of the month
      const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
      const startingDay = firstDayOfMonth.getDay();
  
      // Get the last day of the month
      const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
      const totalDays = lastDayOfMonth.getDate();
  
      // Generate days of the month
      daysElement.innerHTML = '';
  
      // Add day names
      const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      dayNames.forEach(dayName => {
        const dayNameElement = document.createElement('div');
        dayNameElement.classList.add('day-name');
        dayNameElement.textContent = dayName;
        daysElement.appendChild(dayNameElement);
      });
  
      // Add empty days before the 1st day of the month
      for (let i = 0; i < startingDay; i++) {
        const emptyDay = document.createElement('div');
        daysElement.appendChild(emptyDay);
      }
  
      // Add days of the month
      for (let day = 1; day <= totalDays; day++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = day;
        dayElement.className = 'day';
        if (today.getDate() === day && today.getMonth() === currentMonth && today.getFullYear() === currentYear) {
          dayElement.classList.add('current-day');
        }
        daysElement.appendChild(dayElement);
      }
    }
  
    // Call the function to generate the mini calendar
    generateMiniCalendar();
  </script>
  