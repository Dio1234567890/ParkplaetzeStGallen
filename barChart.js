console.log("barChart.js geladen");

$(document).ready(function() {
    let chart = null;

    // Funktion zum Laden der Daten und Erstellen des Balkendiagramms
    function loadChartData(selectedParking) {
        // Vorheriges Diagramm löschen, falls vorhanden
        if (chart) {
            chart.destroy();
        }

        // AJAX-Anfrage zum Laden der Daten für das Balkendiagramm
        $.getJSON('chartData.php', {parking: selectedParking}, function(data) {
            var times = {};
            var occupancySum = {};
            var occupancyCount = {};

            // Daten aus der Antwort extrahieren und aggregieren
            data.forEach(function(entry) {
                var time = entry.zeitpunkt.split(' ')[1].split(':')[0]; // Nur die Stunde extrahieren
                if (!times[time]) {
                    times[time] = entry.zeitpunkt;
                    occupancySum[time] = parseFloat(entry.belegung_prozent);
                    occupancyCount[time] = 1;
                } else {
                    occupancySum[time] += parseFloat(entry.belegung_prozent);
                    occupancyCount[time]++;
                }
            });

            var avgOccupancy = [];
            for (var i = 0; i < 24; i++) {
                var time = i < 10 ? '0' + i : '' + i;
                avgOccupancy.push(occupancySum[time] / occupancyCount[time]);
            }

            var chartData = {
                labels: Array.from({length: 24}, (_, i) => i), // Labels von 0 bis 23 (für Stunden)
                datasets: [{
                    label: 'Durchschnittliche Auslastung (%)',
                    backgroundColor: 'rgba(0, 122, 255, 0.2)',
                    borderColor: 'rgba(0, 122, 255, 1)',
                    borderWidth: 1,
                    data: avgOccupancy,
                }]
            };

            // Vorheriges Diagramm löschen, falls vorhanden
            if (chart) {
                chart.destroy();
            }

            // Diagramm erstellen
            var ctx = document.getElementById('barChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: '⌀ Auslastung (%)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Uhrzeit'
                            },
                            beginAtZero: true,
                            min: 0,
                            max: 23,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }).fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.log("Anfrage fehlgeschlagen: " + err);
            $('#barChartContainer').html('<p>Fehler beim Laden der Daten für das Diagramm.</p>');
        });
    }

    // Beim Laden der Seite Dropdown-Menü und Balkendiagramm initial laden
    loadChartData('');

    // Beim Ändern des Dropdown-Menüs das Balkendiagramm aktualisieren
    $('#parkingDropdown').change(function() {
        var selectedParking = $(this).val(); // Ausgewähltes Parkhaus
        console.log(selectedParking);
        loadChartData(selectedParking); // Übergabe des ausgewählten Parkhauses
    });
});
