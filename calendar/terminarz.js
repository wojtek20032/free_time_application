document.addEventListener('DOMContentLoaded', function() {
    let eventsVisible = false;
    let formVisible = false;

    document.getElementById('showEventsButton').addEventListener('click', function() {
        const calendarContainer = document.querySelector('.calendar-container');
        const eventForm = document.querySelector('.event-form');
        const sortButton = document.getElementById('sortEventsButton');
        const sortBy = document.getElementById('sortBy');
        if (eventsVisible) {
            calendarContainer.style.display = 'none';
            sortButton.style.display = 'none';
            sortBy.style.display = 'none';
            this.textContent = 'Show Events';
        } else {
            loadEvents();
            calendarContainer.style.display = 'block';
            sortButton.style.display = 'inline-block';
            sortBy.style.display = 'inline-block';
            this.textContent = 'Hide Events';
            eventForm.style.display = 'none';
            formVisible = false;
        }
        eventsVisible = !eventsVisible;
    });

    document.getElementById('addEventButton').addEventListener('click', function() {
        const eventForm = document.querySelector('.event-form');
        const calendarContainer = document.querySelector('.calendar-container');
        const sortButton = document.getElementById('sortEventsButton');
        const sortBy = document.getElementById('sortBy');
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
            sortButton.style.display = 'none';
            sortBy.style.display = 'none';
            document.getElementById('showEventsButton').textContent = 'Show Events';
            eventsVisible = false;
        }
        formVisible = !formVisible;
    });

    document.getElementById('sortEventsButton').addEventListener('click', function() {
        const sortByValue = document.getElementById('sortBy').value;
        loadEvents(sortByValue);
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

function loadEvents(sortBy = null) {
    fetch('get_events.php')
        .then(response => response.json())
        .then(events => {
            console.log('Loaded events:', events);
            if (sortBy) {
                events.sort((a, b) => {
                    if (sortBy === 'date') {
                        return new Date(a.date) - new Date(b.date);
                    } else if (sortBy === 'name') {
                        return a.name.localeCompare(b.name);
                    } else if (sortBy === 'participating') {
                        return (a.participating === b.participating) ? 0 : a.participating ? -1 : 1;
                    }
                });
            }
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

    let currentDate = new Date();
    let selectedDate = new Date(date);
    if (selectedDate < currentDate) {
        alert("Date cannot be earlier than current date.");
        return;
    }

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

function modifyEvent() {
    let idUzytkownika = document.getElementById('idUzytkownika').value;
    let eventId = document.getElementById('event_id').value;
    let date = document.getElementById('date').value;
    let name = document.getElementById('name').value;
    let description = document.getElementById('description').value;
    let location = document.getElementById('location').value;
    let note = document.getElementById('note').value;
    let participating = document.getElementById('participating').checked ? 1 : 0;

    let currentDate = new Date();
    let selectedDate = new Date(date);
    if (selectedDate < currentDate) {
        alert("Date cannot be earlier than current date.");
        return;
    }

    let formData = new FormData();
    formData.append('idUzytkownika', idUzytkownika);
    formData.append('event_id', eventId);
    formData.append('date', date);
    formData.append('name', name);
    formData.append('description', description);
    formData.append('location', location);
    formData.append('note', note);
    formData.append('participating', participating);

    fetch('modify_event.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(message => {
        console.log('Server response:', message);
        loadEvents();
        document.querySelector('.event-form').style.display = 'none';
        formVisible = false;
    })
    .catch(error => {
        console.error('Error modifying event:', error);
        alert('Error modifying event: ' + error.message);
    });
}

function deleteEvent(eventId) {
    if (confirm('Are you sure you want to delete this event?')) {
        let formData = new FormData();
        formData.append('event_id', eventId);

        fetch('delete_event.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(message => {
            console.log('Server response:', message);
            alert(message);
            loadEvents();
        })
        .catch(error => {
            console.error('Error deleting event:', error);
            alert('Error deleting event: ' + error.message);
        });
    }
}

function populateForm(event) {
    const eventForm = document.querySelector('.event-form');
    if (eventForm.style.display === 'block') { 
        eventForm.style.display = 'none'; 
    } else {
        document.getElementById('formTitle').textContent = 'Modify Event';
        document.getElementById('action').value = 'modify';
        document.getElementById('event_id').value = event.id;
        document.getElementById('date').value = event.date;
        document.getElementById('name').value = event.name;
        document.getElementById('description').value = event.description;
        document.getElementById('location').value = event.location;
        document.getElementById('note').value = event.note;
        document.getElementById('participating').checked = event.participating ? true : false;
        eventForm.style.display = 'block';
        document.getElementById('saveEventButton').style.display = 'none';
        document.getElementById('modifyEventButton').style.display = 'inline-block';
        document.getElementById('deleteEventButton').style.display = 'none'; 
    }
}

function clearForm() {
    document.getElementById('formTitle').textContent = '';
    document.getElementById('action').value = '';
    document.getElementById('event_id').value = '';
    document.getElementById('date').value = '';
    document.getElementById('name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('location').value = '';
    document.getElementById('note').value = '';
    document.getElementById('participating').checked = false;
}
