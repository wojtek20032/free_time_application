document.addEventListener('DOMContentLoaded', function() {
    let eventsVisible = false;

    document.getElementById('showEventsButton').addEventListener('click', function() {
        const calendarContainer = document.querySelector('.calendar-container');
        if (eventsVisible) {
            calendarContainer.style.display = 'none';
            this.textContent = 'Show Events';
        } else {
            loadEvents();
            calendarContainer.style.display = 'block';
            this.textContent = 'Hide Events';
        }
        eventsVisible = !eventsVisible;
    });

    document.getElementById('addEventButton').addEventListener('click', function() {
        const eventForm = document.querySelector('.event-form');
        eventForm.style.display = eventForm.style.display === 'block' ? 'none' : 'block';
    });

    document.getElementById('eventForm').addEventListener('submit', function(e) {
        e.preventDefault();
        addEvent();
    });
});

function loadEvents() {
    fetch('get_events.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(events => {
            console.log('Loaded events:', events);
            let calendar = document.getElementById('calendar');
            calendar.innerHTML = ''; 
            events.forEach(event => {
                let eventElement = document.createElement('div');
                eventElement.classList.add('event');
                eventElement.innerHTML = `
                    <h3>${event.name}</h3>
                    <p>${event.date}</p>
                    <p>${event.description}</p>
                    <p>${event.location}</p>
                    <p>${event.note}</p>
                    <p>Participating: ${event.participating ? 'Yes' : 'No'}</p>
                `;
                calendar.appendChild(eventElement);
            });
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
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.text();
    })
    .then(message => {
        console.log('Server response:', message);
        alert(message);
        loadEvents();
        document.querySelector('.event-form').style.display = 'none'; // Hide the form after adding event
    })
    .catch(error => {
        console.error('Error adding event:', error);
        alert('Error adding event: ' + error.message);
    });
}
