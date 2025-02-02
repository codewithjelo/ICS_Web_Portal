<link rel="stylesheet" href="../css/calendarActivity.css?v=1.0">

<!-- Modal -->
<div class="modal fade modal-xl" id="calendarActivityModal" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 700px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">CALENDAR ACTIVITY</h1>
                <button type="button" class="btn-close btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row scroll overflow-y-scroll" style="max-height: 550px;">
                    <div class="col-md-12">
                        <div id="icsCalendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding/editing event -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: var(--white);">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Event Description</label>
                        <textarea class="form-control" id="eventDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventStart" class="form-label">Event Start</label>
                        <input type="datetime-local" class="form-control" id="eventStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventEnd" class="form-label">Event End</label>
                        <input type="datetime-local" class="form-control" id="eventEnd" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: var(--maroon); color: var(--white); border: none; font-weight: bold;">Save Event</button>
                    <button type="button" id="deleteEventBtn" class="btn btn-danger" style="background-color: var(--white); color: var(--maroon); border: 1px solid var(--maroon); font-weight: bold;">Delete Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('icsCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {
                url: '../calendar/icsCalendar.php',  // URL updated to point to icsFunction.php
                method: 'GET',
                failure: function() {
                    alert('Failed to load events!');
                }
            },
            headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'today next'
                },
            eventColor: '#5e030a',
            locale: 'en',
            dateClick: function(info) {
                // Open modal for adding event when a date is clicked
                $('#eventModalLabel').text('Add Event');
                $('#eventTitle').val('');
                $('#eventDescription').val('');
                $('#eventStart').val(info.dateStr + 'T09:00'); // Default start time
                $('#eventEnd').val(info.dateStr + 'T10:00'); // Default end time
                $('#deleteEventBtn').hide();
                $('#eventModal').modal('show');
            },
            eventClick: function(info) {
                // Open modal for editing event when an event is clicked
                $('#eventModalLabel').text('Edit Event');
                $('#eventTitle').val(info.event.title);
                $('#eventDescription').val(info.event.extendedProps.description || '');
                $('#eventStart').val(info.event.start.toISOString().slice(0, 16)); // Format to datetime-local
                $('#eventEnd').val(info.event.end ? info.event.end.toISOString().slice(0, 16) : info.event.start.toISOString().slice(0, 16)); // If no end date, use start
                $('#deleteEventBtn').show();
                $('#eventModal').modal('show');

                // Store event ID for deletion
                $('#deleteEventBtn').data('eventId', info.event.id);
            },
        });

        $('#eventForm').submit(function(e) {
            e.preventDefault();

            var eventTitle = $('#eventTitle').val();
            var eventDescription = $('#eventDescription').val();
            var eventStart = $('#eventStart').val();
            var eventEnd = $('#eventEnd').val();
            var eventId = $('#deleteEventBtn').data('eventId');

            if (!eventTitle || !eventStart || !eventEnd) {
                alert('Event title, start, and end are required!');
                return;
            }

            // Update or create event via AJAX
            var eventData = {
                title: eventTitle,
                description: eventDescription,
                start: eventStart,
                end: eventEnd
            };

            if (eventId) {
                // If an event ID is set, it's an edit
                eventData.id = eventId;
                eventData.action = 'edit'; // specify action to be an edit
            } else {
                // Otherwise, it's a new event
                eventData.action = 'add';
            }

            $.ajax({
                url: '../calendar/icsFunction.php',  // Updated to point to icsFunction.php
                method: 'POST',
                data: eventData,
                success: function(response) {
                    calendar.refetchEvents(); // Reload events after saving
                    $('#eventModal').modal('hide');
                },
                error: function() {
                    alert('Failed to save event.');
                }
            });
        });

        $('#deleteEventBtn').click(function() {
            var eventId = $(this).data('eventId');

            $.ajax({
                url: '../calendar/icsFunction.php',  // Updated to point to icsFunction.php
                method: 'POST',
                data: {
                    action: 'delete',
                    id: eventId
                },
                success: function(response) {
                    calendar.refetchEvents(); // Reload events after deleting
                    $('#eventModal').modal('hide');
                },
                error: function() {
                    alert('Failed to delete event.');
                }
            });
        });

        $('#calendarActivityModal').on('shown.bs.modal', function() {
            calendar.render();
        });
    });
</script>
