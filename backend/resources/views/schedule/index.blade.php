<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <div class="row">
                <div class="container m-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group mb-3" role="group" aria-label="Calendar Actions">
                                <button id="exportButton" class="btn btn-success">{{ __('Export Calendar') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    var calendar;
    var booking = <?php echo json_encode($events); ?>;

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'dayGridMonth',
            events: booking,
            eventClick: function(info) {

                var bookingId = info.event.id;
                var url = '/admin/bookings/' + bookingId;
                window.location.href = url;
            }
        });

        calendar.render();
        // Exporting Function
        document.getElementById('exportButton').addEventListener('click', exportCalendar);
    });

    function exportCalendar() {
        var events = calendar.getEvents().map(function(event) {
            return {
                title: event.title,
                start: event.start ? event.start.toISOString() : null,
                end: event.end ? event.end.toISOString() : null,
                color: event.backgroundColor,
            };
        });

        console.log('Events to export:', events);

        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.json_to_sheet(events);
        XLSX.utils.book_append_sheet(wb, ws, 'Events');

        var arrayBuffer = XLSX.write(wb, {
            bookType: 'xlsx',
            type: 'array'
        });

        var blob = new Blob([arrayBuffer], {
            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        });

        var downloadLink = document.createElement('a');
        downloadLink.href = URL.createObjectURL(blob);
        downloadLink.download = 'events.xlsx';
        downloadLink.click();
    }
</script>