<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <link rel="icon" type="image/x-icon" href="assects/images/logo2.png">
    <style>
        input{
            border-radius: 20px;
            border: 1px solid black;
        }
        .calendar-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header button,
        .calendar-header select {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .calendar-header button:hover {
            background: #218838;
        }

        .calendar-header select {
            font-size: 16px;
            padding: 8px;
            cursor: pointer;
        }

        .calendar-header h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #28a745;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #ddd;
        }

        .calendar-grid .day,
        .calendar-grid .date {
            padding: 15px;
            text-align: center;
            background: white;
        }

        .calendar-grid .day {
            font-weight: bold;
            background: #28a745;
            color: white;
        }

        .calendar-grid .holiday {
            background: #ffeb3b;
            font-weight: bold;
        }

        .calendar-grid .date:hover {
            background: #e8e8e8;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include("includes/header.php") ?>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-blue-600">Nepali Calender</h1>
                <p class="text-sm md:text-base lg:w-2/3 mx-auto leading-relaxed text-base">Dear students, 📅 Please find attached the Nepali calendar for your reference regarding traditional festivals. It is advisable to consult official notices for accurate information on holidays and time off. 📌
                </p>
            </div>
        </div>   
    </section>
    <div class="mt-5 mb-0 mx-5">


    <div class="container px-5 py-10">
        <div class="calendar-header">
            <button onclick="prevMonth()">Précédent</button>
            <h1 id="calendar-title"></h1>
            <select id="year-select" onchange="changeYear()"></select>
            <button onclick="nextMonth()">Suivant</button>
        </div>
        <div class="calendar-grid" id="calendar-grid">
            <!-- Days and dates will be dynamically generated -->
        </div>
    </div>


    </div>



  


    <?php include("includes/footer.php") ?>
</body>
<script>
    
        const daysOfWeek = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
        let currentDate = new Date();

        function populateYearSelect() {
            const yearSelect = document.getElementById('year-select');
            const currentYear = currentDate.getFullYear();

            for (let i = currentYear - 50; i <= currentYear + 50; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                if (i === currentYear) {
                    option.selected = true;
                }
                yearSelect.appendChild(option);
            }
        }

        function renderCalendar(date) {
            const grid = document.getElementById('calendar-grid');
            const title = document.getElementById('calendar-title');
            const yearSelect = document.getElementById('year-select');

            grid.innerHTML = ''; // Clear existing calendar
            title.textContent = `${date.toLocaleString('default', { month: 'long' })} ${date.getFullYear()}`;
            yearSelect.value = date.getFullYear();

            // Add days of the week
            daysOfWeek.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.textContent = day;
                grid.appendChild(dayElement);
            });

            // Get the first day of the month
            const firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
            const lastDate = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

            // Add empty cells for days before the start of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                emptyCell.classList.add('date');
                grid.appendChild(emptyCell);
            }

            // Add dates of the month
            for (let i = 1; i <= lastDate; i++) {
                const dateCell = document.createElement('div');
                dateCell.classList.add('date');
                dateCell.textContent = i;

                // Highlight holidays (example: 1st and 15th for demonstration)
                if (i === 1 || i === 15) {
                    dateCell.classList.add('holiday');
                }

                grid.appendChild(dateCell);
            }
        }

        function prevMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar(currentDate);
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar(currentDate);
        }

        function changeYear() {
            const yearSelect = document.getElementById('year-select');
            const selectedYear = parseInt(yearSelect.value, 10);
            currentDate.setFullYear(selectedYear);
            renderCalendar(currentDate);
        }

        // Initialize calendar
        populateYearSelect();
        renderCalendar(currentDate);

console.clear();
</script>

</html>