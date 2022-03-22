$(function() {
    
	$.getJSON('/index/chart', function(data) {
	    console.log(data);
		try {
                
    		var azolar = [];
    		$.each(data[0], function (i, el) {
                azolar.push([new Date(el.date).getTime(), parseFloat(el.count)]);
            });
    
    		var bpt = [];
    		$.each(data[1], function (i, el) {
                bpt.push([new Date(el.bptdate).getTime(), parseFloat(el.bptcount)]);
            });
    
    		var pie = [];
    		$.each(data[2], function (i, el) {
                pie.push([el.kname, parseFloat(el.count)]);
            });
    
            Highcharts.chart('count_azolarbpt', {
                title: {
                    text: null
                },
                chart: {
                    zoomType: 'x',
                    type: 'area'
                },            
                xAxis: {
                    type: 'datetime',
                     labels: {
                         format: "{value:%Y-%m-%d}" 
                     }                  
                },            
                yAxis: {
                    title: {
                        text: null
                    }
                },
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        }
                    }
                },
                series: [{
                    name: 'Аъзолар',
                    data: azolar
                }
                ,
                {
                    name: 'БПТ',
                    data: bpt
                }                   
                ],                    
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
    
    		Highcharts.chart('percent_bydist', {
    		    chart: {
    		        plotBackgroundColor: null,
    		        plotBorderWidth: null,
    		        plotShadow: false,
    		        type: 'pie'
    		    },
    		    title: {
                    text: null
                },
    		    tooltip: {
    		        pointFormat: '{data.kname} <b>{point.percentage:.1f}%</b>'
    		    },
    		    accessibility: {
    		        point: {
    		            valueSuffix: '%'
    		        }
    		    },
                legend: {
                	align: 'center',
                    itemMarginBottom: 4,
                    itemMarginTop: 4,
                    labelFormatter: function() {
                        return this.name + ': ' + Highcharts.numberFormat(this.percentage) + '%';
                    }               
                },		    
    		    plotOptions: {
    		        pie: {
    		            allowPointSelect: true,
    		            cursor: 'pointer',
    		            dataLabels: {
    		                enabled: false
    		            },
    		            showInLegend: true
    		        }
    		    },
    		    series: [{
    		        colorByPoint: true,
    		        data: pie
    		    }]
      });
		} catch (e) { 
		    return false;
		    $('#percent_bydist, #count_azolarbpt').html('');
		} 

    }).fail(function() { 
        $('#percent_bydist, #count_azolarbpt').html('');
    });
});