document.addEventListener('DOMContentLoaded', function() {
    var addUspButton = document.getElementById('add_usp');

    // Check if the element exists
    if (addUspButton) {
        addUspButton.addEventListener('click', function() {
            var table = document.getElementById('wcusp_table');
            var rowCount = table.getElementsByClassName('wcusp_row').length;
            var uspNumber = rowCount + 1; // Calculate the new USP number

            // Create Icon Row
            var iconRow = table.insertRow(-1); // -1 appends the row at the end of the table
            iconRow.className = 'wcusp_row flex-row';
            iconRow.setAttribute('data-usp-number', uspNumber);
            iconRow.innerHTML = 
                '<th scope="row">USP' + uspNumber + '</th>' +
                '<td>' +
                    '<input id="wcusp_settings_usps_' + uspNumber + '_icon" name="wcusp_settings[usps][' + uspNumber + '][icon]" class="regular-text" type="hidden"/>' +
                    '<div id="preview_wcusp_settings_usps_' + uspNumber + '_icon" data-target="#wcusp_settings_usps_' + uspNumber + '_icon" class="button icon-picker"></div>' +
                '</td>' +
                '<td class="full-width">' +
                    '<input id="wcusp_settings_usps_' + uspNumber + '_text" name="wcusp_settings[usps][' + uspNumber + '][text]" class="full-width-input" type="text"/>' +

                '</td>' +
                '<td>' +
                    '<button type="button" class="button wcusp_remove_usp" data-usp-number="' + uspNumber + '">X</button>' +
                '</td>';

            if (window.initializeIconPicker) {
                window.initializeIconPicker(jQuery('#preview_wcusp_settings_usps_' + uspNumber + '_icon'));
            }
        });
    }

    document.getElementById('wcusp_table').addEventListener('click', function(event) {
        if (event.target && event.target.matches('.wcusp_remove_usp')) {
            var uspNumber = event.target.getAttribute('data-usp-number');
            removeUsp(uspNumber);
        }
    });

    function removeUsp(number) {
        var rows = document.querySelectorAll(`#wcusp_table .wcusp_row[data-usp-number="${number}"]`);
        rows.forEach(function(row) {
            row.remove();
        });
    }
});