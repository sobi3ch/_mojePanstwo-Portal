$(document).ready(function() {

    var data = _chartImpEksData;
    var categories = [];
    var series;
    var seriesImportData = [];
    var seriesExportData = [];
    var seriesImport2014Data = [];
    var seriesExport2014Data = [];
    var apiHost = 'http://mojepanstwo.pl:4444/';

    for(var i = 0; i < data.length; i++) {
        $('#selectYear').append('<option value="' + data[i].rocznik + '">' + data[i].rocznik + '</option>');
        categories.push(parseInt(data[i].rocznik));
        if(parseInt(data[i].rocznik) === 2014 || parseInt(data[i].rocznik) === 2013) {
            seriesImport2014Data.push(parseInt(data[i].import_pln));
            seriesExport2014Data.push(parseInt(data[i].eksport_pln));
            if(parseInt(data[i].rocznik) === 2013) {
                seriesImportData.push(parseInt(data[i].import_pln));
                seriesExportData.push(parseInt(data[i].eksport_pln));
            }
            continue;
        }
        seriesImport2014Data.push(null);
        seriesExport2014Data.push(null);
        seriesImportData.push(parseInt(data[i].import_pln));
        seriesExportData.push(parseInt(data[i].eksport_pln));
    }

    series = [
        {
            name: 'Import',
            data: seriesImportData
        },
        {
            name: 'Eksport',
            data: seriesExportData
        },
        {
            name: 'Import (dane wstępne)',
            dashStyle: 'shortdot',
            data: seriesImport2014Data,
            color: '#7cb5ec',
            showInLegend: false
        },
        {
            name: 'Export (dane wstępne)',
            dashStyle: 'shortdot',
            data: seriesExport2014Data,
            color: '#434348',
            showInLegend: false
        }
    ];

    $('#highchartImportExport').highcharts({
        title: {
            text: 'Import i Eksport'
        },
        xAxis: {
            categories: categories
        },
        yAxis: {
            title: {
                text: 'Wartość (zł)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            min: 0,
            labels: {
                formatter: function() {
                    return pl_currency_format(this.value, true);
                }
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            valueSuffix: ' zł'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        chart: {
	        backgroundColor: 'rgba(255, 255, 255, 0)'
        },
        series: series
    });

    $('#selectYear').change(function() {
        var year = $(this).find("option:selected").text();
        tree.setYear(year);
        _year = year;
    });

    $('#selectYear').val(_year);

    function pl_currency_format(n, cut) {
        var str = '';
        var mld = 0;
        var mln = 0;
        var tys = 0;

        if(n > 1000000000) {
            if(cut === true) {
                return (n / 1000000000).toFixed(2) + ' mld';
            }
            mld = Math.floor(n / 1000000000);
            n -= mld * 1000000000;
        }

        if(n > 1000000) {
            if(cut === true) {
                return (n / 1000000).toFixed(2) + ' mln';
            }
            mln = Math.floor(n / 1000000);
            n -= mln * 1000000;
        }

        if(n > 1000) {
            if(cut === true) {
                return (n / 1000).toFixed(2) + ' tys';
            }
            tys = Math.floor(n / 1000);
            n -= tys * 1000;
        }

        if(mld > 0)
            str += mld + ' mld ';
        if(mln  > 0)
            str += mln + ' mln ';
        if(tys > 0 && mld === 0)
            str += tys + ' tys';

        if(mld === 0 && mln === 0 && tys === 0)
            str += number_format(n);

        return str.trim();
    };

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '')
                .length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1)
                .join('0');
        }
        return s.join(dec);
    }

    var tree = {

        $import: $('#import'),
        import_data: [],
        countries_import_data: [],

        $export: $('#export'),
        export_data: [],
        countries_export_data: [],

        symbol_id: 0,
        year: 0,

        setYear: function(year) {
            this.year = parseInt(year);
            var k = this.year;
            var t = this;
            if(t.countries_import_data[k] === undefined) {
                t.getCountries(t.year, 'import', function(data) {
                    t.countries_import_data[k] = data;
                    t.getCountries(t.year, 'eksport', function(data) {
                        t.countries_export_data[k] = data;
                        t.update();
                    });
                });
            } else {
                t.update();
            }
        },

        update: function() {
            var k = this.year;
            this.$import.html('');
            for(var i = 0; i < this.countries_import_data[k].length; i++) {
                var row = this.countries_import_data[k][i];
                this.$import.append(
                    this.templateCountry(row)
                );
            }
            this.$export.html('');
            for(var i = 0; i < this.countries_export_data[k].length; i++) {
                var row = this.countries_export_data[k][i];
                this.$export.append(
                    this.templateCountry(row)
                );
            }

            var t = this;

            $('#import li').click(function() {
                if($(this).hasClass('open')) {
                    $(this).removeClass('open');
                    $(this).find('ul').remove();
                    return false;
                }
                $(this).addClass('open');
                var country_id = parseInt($(this).attr('id'));
                var k = t.year + '_' + country_id;
                if(t.import_data[k] === undefined) {
                    t.get(t.year, 'import', country_id, function(data) {
                        t.import_data[k] = data;
                        t.update_childs('import', country_id);
                    });
                } else {
                    t.update_childs('import', country_id);
                }
            });

            $('#export li').click(function() {
                if($(this).hasClass('open')) {
                    $(this).removeClass('open');
                    $(this).find('ul').remove();
                    return false;
                }
                $(this).addClass('open');
                var country_id = parseInt($(this).attr('id'));
                var k = t.year + '_' + country_id;
                if(t.export_data[k] === undefined) {
                    t.get(t.year, 'export', country_id, function(data) {
                        t.export_data[k] = data;
                        t.update_childs('export', country_id);
                    });
                } else {
                    t.update_childs('export', country_id);
                }
            });
        },

        update_childs: function(type, country_id) {
            var k = this.year + '_' + country_id;
            switch(type) {
                default: // import
                    var t = this;
                    $('#import #' + country_id).find('ul').remove();
                    if(this.import_data[k].length === 0) {
                        $('#import #' + country_id).append('<ul class="notfound"><li>Brak wyników</li></ul>');
                        return false;
                    }
                    $('#import #' + country_id).append('<ul></ul>');
                    for(var i = 0; i < this.import_data[k].length; i++) {
                        var row = this.import_data[k][i];
                        $('#import #' + country_id + ' ul').append(this.template(row));
                    }
                break;

                case 'export':
                    var t = this;
                    $('#export #' + country_id).find('ul').remove();
                    if(this.export_data[k].length === 0) {
                        $('#export #' + country_id).append('<ul class="notfound"><li>Brak wyników</li></ul>');
                        return false;
                    }
                    $('#export #' + country_id).append('<ul></ul>');
                    for(var i = 0; i < this.export_data[k].length; i++) {
                        var row = this.export_data[k][i];
                        $('#export #' + country_id + ' ul').append(this.template(row));
                    }
                    break;
            }
        },

        template: function(row) {
            return '<li id="' + row.id + '"><span class="currency">' + pl_currency_format(row.wartosc_pln) + ' zł</span><p>' + row.nazwa + ' <a href="/dane/handel_zagraniczny_towary/' + row.id + '" title="Zobacz szczegóły dotyczące tego towaru">więcej</a></p></li>';
        },

        templateCountry: function(row) {
            return '<li class="c" id="' + row.id + '">' +
                '<span class="currency">' +
                    pl_currency_format(row.wartosc_pln) +
                ' zł</span><p>' +
                '<img src="/img/flags/' + row.symbol + '.png" onerror="if (this.src != \'/img/flags/_unknown.png\') this.src = \'/img/flags/_unknown.png\';" />' +
                    row.nazwa +
                '<a href="/dane/panstwa/' + row.id + '" title="Zobacz szczegóły dotyczące tego państwa">więcej</a></p></li>';
        },

        get: function(year, type, country_id, done_function, parent_id) {
            if(parent_id === undefined)
                parent_id = this.symbol_id;
            $.getJSON(
                apiHost + 'handel_zagraniczny/stats/getSymbols.json' +
                '?parent_id=' + parent_id +
                '&year=' + year +
                '&type=' + type +
                '&country_id=' + country_id +
                '&limit=9999',
                done_function
            );
        },

        getCountries: function(year, type, done_function) {
            $.getJSON(
                apiHost + 'handel_zagraniczny/stats/panstwa.json' +
                '?symbol_id=' + this.symbol_id +
                '&rocznik=' + year +
                '&order=' + type +
                '&limit=false',
                done_function
            );
        }
    };

    tree.symbol_id = parseInt(_objectData.id);
    tree.setYear(_year);

});
