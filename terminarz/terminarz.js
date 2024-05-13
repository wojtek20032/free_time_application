document.addEventListener("DOMContentLoaded", function() {
    const daySelect = document.getElementById("day-select");
    const calendar = document.getElementById("calendar");

    daySelect.addEventListener("change", function() {
        const selectedDay = daySelect.value;
        renderCalendar(selectedDay);
    });

    function renderCalendar(day) {
        const hours = [
            "08:00", "09:00", "10:00", "11:00",
            "12:00", "13:00", "14:00", "15:00",
            "16:00", "17:00", "18:00", "19:00"
        ];

        let calendarHTML = "<table>";
        calendarHTML += "<tr><th colspan='2'>Godzina</th><th>Notatka</th></tr>";
        hours.forEach(hour => {
            calendarHTML += "<tr><td>" + hour + "</td><td contenteditable='true'></td></tr>";
        });
        calendarHTML += "</table>";

        calendar.innerHTML = calendarHTML;
    }

    renderCalendar("monday");
});
