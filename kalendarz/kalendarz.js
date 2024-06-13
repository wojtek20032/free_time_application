document.addEventListener('DOMContentLoaded', function() {
    const calendar = document.getElementById('calendar');
    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();
    loadCalendar(currentYear, currentMonth);

    function loadCalendar(year, month) {
        calendar.innerHTML = '';
        const monthNames = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"];
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const calendarHeader = document.createElement('div');
        calendarHeader.classList.add('calendar-header');
        const monthAndYear = document.createElement('div');
        monthAndYear.textContent = `${monthNames[month]} ${year}`;
        calendarHeader.appendChild(monthAndYear);

        const prevButton = document.createElement('button');
        prevButton.textContent = '<';
        prevButton.classList.add('btn', 'btn-nav', 'btn-left');
        prevButton.addEventListener('click', () => {
            if (month === 0) {
                year--;
                month = 11;
            } else {
                month--;
            }
            loadCalendar(year, month);
        });
        calendarHeader.appendChild(prevButton);

        const nextButton = document.createElement('button');
        nextButton.textContent = '>';
        nextButton.classList.add('btn', 'btn-nav', 'btn-right');
        nextButton.addEventListener('click', () => {
            if (month === 11) {
                year++;
                month = 0;
            } else {
                month++;
            }
            loadCalendar(year, month);
        });
        calendarHeader.appendChild(nextButton);

        calendar.appendChild(calendarHeader);

        const daysRow = document.createElement('div');
        daysRow.classList.add('days-row');
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayNames.forEach(day => {
            const dayCell = document.createElement('div');
            dayCell.classList.add('day-cell');
            dayCell.textContent = day;
            daysRow.appendChild(dayCell);
        });
        calendar.appendChild(daysRow);

        const datesRow = document.createElement('div');
        datesRow.classList.add('dates-row');
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('date-cell', 'empty-cell');
            datesRow.appendChild(emptyCell);
        }
        for (let date = 1; date <= daysInMonth; date++) {
            const dateCell = document.createElement('div');
            dateCell.classList.add('date-cell');
            dateCell.textContent = date;
            dateCell.dataset.date = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
            datesRow.appendChild(dateCell);
        }
        calendar.appendChild(datesRow);

        fetch('../event/get_events.php')
            .then(response => response.json())
            .then(events => {
                events.forEach(event => {
                    const eventDayCell = document.querySelector(`[data-date='${event.date}']`);
                    if (eventDayCell) {
                        eventDayCell.classList.add('event-day');
                        eventDayCell.addEventListener('click', () => {
                            showEventDetails(event);
                        });
                    }
                });
            })
            .catch(error => console.error('Error fetching event dates:', error));
    }

    function showEventDetails(event) {
        const modal = document.getElementById('event-modal');
        const closeModal = modal.querySelector('.close');
        const eventName = document.getElementById('event-name');
        const eventDescription = document.getElementById('event-description');
        const eventLocation = document.getElementById('event-location');
        const eventNote = document.getElementById('event-note');
        const eventParticipating = document.getElementById('event-participating');

        eventName.textContent = event.name;
        eventDescription.textContent = event.description;
        eventLocation.textContent = event.location;
        eventNote.textContent = event.note;
        eventParticipating.textContent = event.participating;

        modal.style.display = 'block';

        closeModal.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }
    }
});
