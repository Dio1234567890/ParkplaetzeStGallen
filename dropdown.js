$(document).ready(function() {
    $.getJSON('https://661231-1.web.fhgr.ch/getParkhouses.php', function(data) {
        var dropdown = $('#parkingDropdown');
        dropdown.empty(); // Bestehende Einträge im Dropdown löschen
        dropdown.append('<option value="">Alle</option>'); // Standardoption hinzufügen
        var addedParkhouses = {}; // Objekt zum Speichern der hinzugefügten Parkhäuser
        $.each(data, function(key, entry) {
            // Überprüfen, ob das Parkhaus bereits hinzugefügt wurde
            if (!addedParkhouses[entry.phid]) {
                dropdown.append($('<option></option>').attr('value', entry.phid).text(entry.phname));
                addedParkhouses[entry.phid] = true; // Markiere das Parkhaus als hinzugefügt
            }
        });
    }).fail(function(jqxhr, textStatus, error) {
        var err = textStatus + ", " + error;
        console.log("Anfrage fehlgeschlagen: " + err);
        $('#parkingDropdown').append('<option value="">Fehler beim Laden</option>');
        // Benachrichtigung für den Benutzer über den Fehler
        alert('Fehler beim Laden der Parkhäuser: ' + err);
    });
});
