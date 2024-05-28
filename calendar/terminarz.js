document.addEventListener('DOMContentLoaded', function() {
    let eventsVisible = false;
    let formVisible = false;

    document.getElementById('showEventsButton').addEventListener('click', function() {
        const calendarContainer = document.querySelector('.calendar-container');
        const eventForm = document.querySelector('.event-form');
        if (eventsVisible) {
            calendarContainer.style.display = 'none';
            this.textContent = 'Show Events';
        } else {
            loadEvents();
            calendarContainer.style.display = 'block';
            this.textContent = 'Hide Events';
            eventForm.style.display = 'none';  // Hide form if showing events
            formVisible = false;
        }
        eventsVisible = !eventsVisible;
    });

    document.getElementById('addEventButton').addEventListener('click', function() {
        const eventForm = document.querySelector('.event-form');
        const calendarContainer = document.querySelector('.calendar-container');
        if (formVisible) {
            eventForm.style.display = 'none';
        } else {
            eventForm.style.display = 'block';
            calendarContainer.style.display = 'none'; 
            document.getElementById('showEventsButton').textContent = 'Show Events';
            eventsVisible = false;
        }
        formVisible = !formVisible;
    });

    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        addEvent();
    });
});

function loadEvents() {
    fetch('get_events.php')
        .then(response => response.json())
        .then(events => {
            console.log('Loaded events:', events);
            let calendar = document.getElementById('calendar');
            calendar.innerHTML = ''; 
            if (events.length === 0) {
                calendar.innerHTML = '<p class="no-events">No events found.</p>';
            } else {
                let table = document.createElement('table');
                table.classList.add('events-table');
                let header = table.createTHead();
                let headerRow = header.insertRow(0);
                let headers = ['Name', 'Date', 'Description', 'Location', 'Note', 'Participating'];
                headers.forEach((headerText, index) => {
                    let cell = headerRow.insertCell(index);
                    cell.textContent = headerText;
                    cell.classList.add('bold-header');
                });

                let tbody = table.createTBody();
                events.forEach(event => {
                    let row = tbody.insertRow();
                    row.insertCell(0).textContent = event.name;
                    row.insertCell(1).textContent = event.date;
                    row.insertCell(2).textContent = event.description;
                    row.insertCell(3).textContent = event.location;
                    row.insertCell(4).textContent = event.note;
                    row.insertCell(5).textContent = event.participating ? 'Yes' : 'No';
                });

                calendar.appendChild(table);
            }
        })
        .catch(error => {
            console.error('Error loading events:', error);
            alert('Error loading events: ' + error.message);
        });
}

function addEvent() {
    let idUzytkownika = document.getElementById('idUzytkownika').value;
    let date = document.getElementById('date').value;
    let name = document.getElementById('name').value;
    let description = document.getElementById('description').value;
    let location = document.getElementById('location').value;
    let note = document.getElementById('note').value;
    let participating = document.getElementById('participating').checked ? 1 : 0;

    let formData = new URLSearchParams();
    formData.append('idUzytkownika', idUzytkownika);
    formData.append('date', date);
    formData.append('name', name);
    formData.append('description', description);
    formData.append('location', location);
    formData.append('note', note);
    formData.append('participating', participating);

    fetch('add_event.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(message => {
        console.log('Server response:', message);
        alert(message);
        loadEvents();
        document.querySelector('.event-form').style.display = 'none'; 
        formVisible = false;
    })
    .catch(error => {
        console.error('Error adding event:', error);
        alert('Error adding event: ' + error.message);
    });
}
