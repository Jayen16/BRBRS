
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
    <div class="flex">
    <div class="flex ml-80 flex-col items-center">
      <p class="borrowed-icon">
        <ion-icon name="book-sharp" size="large"></ion-icon>
      </p>
      <p class="mt-2"><b>Borrowed</b></p>
      <p class="mt-2 text-xl font-sans"><b>3,257</b></p>
      
    </div>

    <div class="flex ml-80 flex-col items-center">
      <p class="returned-icon">
        <ion-icon name="checkmark-circle-sharp" size="large"></ion-icon>
      </p>
      <p class="mt-2"><b>Returned</b></p>
      <p class="mt-2 text-xl font-sans"><b>1,249</b></p>
    </div>

    <div class="flex ml-80 flex-col items-center">
      <p class="Awaiting-icon">
        <ion-icon name="alert-circle-sharp" size="large"></ion-icon>
      </p>
      <p class="mt-2"><b>Awaiting</b></p>
      <p class="mt-2 text-xl font-sans"><b>2,008</b></p>
    </div>
  </div>
    <!--  Start  percentage chart Dashboard-->
    <div class="flex mt-8 justify-center">
      <!-- Left Container for Charts -->
      <div class="flex-shrink-0 w-3/4">
        <!-- Single Card for Charts -->
        <div class="bg-white p-4 border rounded shadow text-center">
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
              <p><b>Percentage of Awaiting books</b></p>
            </div>
          </div>
        </div>
      </div>

       <!-- Right Container for Other Content -->
      <div class="ml-8 w-1/2">
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
        <div class="mt-1 p-4 border rounded shadow bg-white">
          <div class="calendar">
            <div class="month" id="month"></div>
            <div class="days" id="days"></div>
          </div>
        </div>
      </div>

    </div>
</div>


<!--  Script for icon-->
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
  
