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
            eventForm.style.display = 'none';
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
            clearForm();
            document.getElementById('formTitle').textContent = 'Add Event';
            document.getElementById('action').value = 'add';
            document.getElementById('saveEventButton').style.display = 'inline-block';
            document.getElementById('modifyEventButton').style.display = 'none';
            document.getElementById('deleteEventButton').style.display = 'none';
            eventForm.style.display = 'block';
            calendarContainer.style.display = 'none';
            document.getElementById('showEventsButton').textContent = 'Show Events';
            eventsVisible = false;
        }
        formVisible = !formVisible;
    });

    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const action = document.getElementById('action').value;
        if (action === 'add') {
            addEvent();
        } else if (action === 'modify') {
            modifyEvent();
        }
    });

    document.getElementById('modifyEventButton').addEventListener('click', function() {
        const event_id = document.getElementById('event_id').value;
        document.getElementById('action').value = 'modify';
        modifyEvent();
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
                let headers = ['Name', 'Date', 'Description', 'Location', 'Note', 'Participating', 'Actions'];
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
                    let actionsCell = row.insertCell(6);
                    let editButton = document.createElement('button');
                    editButton.textContent = 'Edit';
                    editButton.classList.add('edit-button', 'styled-edit-button');
                    editButton.addEventListener('click', function() {
                        populateForm(event);
                    });
                    actionsCell.appendChild(editButton);
                    let deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.classList.add('delete-button', 'styled-delete-button');
                    deleteButton.addEventListener('click', function() {
                        deleteEvent(event.id);
                    });
                    actionsCell.appendChild(deleteButton);
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

    let formData = new FormData();
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


