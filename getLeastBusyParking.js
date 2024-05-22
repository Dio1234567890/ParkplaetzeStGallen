$(document).ready(function() {
    // Funktion zum Laden der Daten und Anzeigen der Ergebnisse für die am wenigsten belegten Parkhäuser
    function getLeastBusyParking(selectedTime) {
        $.getJSON('getLeastBusyParking.php', { time: selectedTime }, function(data) {
            var resultContainer = $('#availabilityResult');
            resultContainer.empty(); // Vorherige Ergebnisse löschen

            // Filtern der Parkhäuser mit 0% Auslastung
            var filteredData = data.filter(function(parking) {
                return parseFloat(parking.least_busy_percent) > 0;
            });

            // Sortieren der Parkhäuser nach ihrer Belegung
            filteredData.sort(function(a, b) {
                return parseFloat(a.least_busy_percent) - parseFloat(b.least_busy_percent);
            });

            // Nur die Top fünf Parkhäuser auswählen
            var topFive = filteredData.slice(0, 5);

            if (topFive.length > 0) {
                var resultHTML = '<p>Top 5 am wenigsten belegte Parkhäuser um ' + selectedTime + ' Uhr</p>';
                $.each(topFive, function(index, parking) {
                    resultHTML += (index + 1) + '. ' + parking.phname + '<br>';
                });
                resultContainer.html(resultHTML); // Ergebnisse anzeigen
            } else {
                resultContainer.html('<p>Keine Daten verfügbar.</p>'); // Anzeigen, wenn keine Daten vorhanden sind
            }
        }).fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.log("Anfrage fehlgeschlagen: " + err);
            $('#availabilityResult').html('<p>Fehler beim Laden der Daten.</p>'); // Fehlermeldung anzeigen
        });
    }

    // Setzen des Standardwerts für das Zeit-Input-Element
    var now = new Date();
    var hours = String(now.getHours()).padStart(2, '0');
    var minutes = String(now.getMinutes()).padStart(2, '0');
    $('#timeInput').val(hours + ':' + minutes);

    // Event-Listener für den Button hinzufügen
    $('#getAvailabilityButton').on('click', function() {
        var selectedTime = $('#timeInput').val(); // Wert der eingegebenen Zeit erhalten
        getLeastBusyParking(selectedTime); // Funktion aufrufen, um die Parkhäuser zu laden
    });
});
