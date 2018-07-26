<script>
    /*jslint  browser: true, white: true, plusplus: true */
    /*global $, countries */

    $(function () {
        'use strict';

        var countriesArray = $.map(@json($fuentes), function (value, key) { return { value: value, data: key }; });

        // Setup jQuery ajax mock:
        $.ajax({
            url: '#',
            responseTime: 2000,
            response: function (settings) {
                var query = settings.data.query,
                    queryLowerCase = query.toLowerCase(),
                    re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi'),
                    suggestions = $.grep(countriesArray, function (country) {
                        // return country.value.toLowerCase().indexOf(queryLowerCase) === 0;
                        return re.test(country.value);
                    }),
                    response = {
                        query: query,
                        suggestions: suggestions
                    };

                this.responseText = JSON.stringify(response);
            }
        });

        // Initialize ajax autocomplete:
        $('#autocomplete-fuente').autocomplete({
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#fuente').val(suggestion.data);
            },
            onHint: function (hint) {
                $('#autocomplete-fuente-x').val(hint);
            },
            onInvalidateSelection: function() {
                $('#selction-ajax').html('You selected: none');
            }
        });
    });
</script>