$(function() {

	$('#form-edit, #form-add').form({
    	fields: {
	      	fname: {
	        	identifier  : 'fname',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Фамилия киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-ЯҚқЎўҒғҲҳЁё]{3,50}$/,
	            		prompt : 'Фамилия фақат кирил харфларида ва камида 3 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	mname: {
	        	identifier  : 'mname',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Исм киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-ЯҚқЎўҒғҲҳЁё]{3,50}$/,
	            		prompt : 'Исм фақат кирил харфларида ва камида 3 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},	      	
	      	lname: {
	        	identifier  : 'lname',
	        	 optional   : true,
	        	rules: [
	          		
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-ЯҚқЎўҒғҲҳЁё\s]{3,50}$/,
	            		prompt : 'Отасининг исми фақат кирил харфларида ва камида 3 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	education : {
	        	identifier  : 'education',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Маълумоти белгиланмаган'
	          		}
	        	]
	      	},
	      	nations: {
	        	identifier  : 'nations',
	        	rules: [
	          		
	           		{
	            		type   : 'empty',
	            		prompt : 'Миллати белгиланмаган'
	          		}
	        	]
	      	},
	      	tdate : {
	        	identifier  : 'tdate',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Туғулгна санаси белгиланмаган'
	          		}
	        	]
	      	},
	      	plevel : {
	        	identifier  : 'plevel',
	        	rules: [  		
	           		{
	            		type   : 'checked',
	            		prompt : 'Партиядаги лавозими белгиланмаган'
	          		}
	        	]
	      	},
	      	work: {
	        	identifier  : 'work',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Иш жойи киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,50}$/,
	            		prompt : 'Иш жойи фақат кирил харфларида, сон, белги ва камида 3 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	level: {
	        	identifier  : 'level',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Лавозими киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,50}$/,
	            		prompt : 'Лавозими фақат кирил харфларида, сон, белги ва камида 3 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	organ: {
	        	identifier  : 'organ',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Сайланган органи киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,50}$/,
	            		prompt : 'Сайланган органи фақат кирил харфларида, сон, белги ва камида 3 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	sdate: {
	        	identifier  : 'sdate',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Сайланган санаси  белгиланмаган'
	          		}
	        	]
	      	},
	      	yun: {
	        	identifier  : 'yun',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Маъсул йўналиши киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,50}$/,
	            		prompt : 'Маъсул йўналиши фақат кирил харфларида, сон, белги ва камида 3 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	address: {
	        	identifier  : 'address',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Яшаш манзили киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
	            		prompt : 'Яшаш манзили фақат кирил харфларида, сон, белги ва камида 3 дан 200 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	tel: {
	        	identifier  : 'tel',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Телефон рақами киритилмаган'
	          		},
	           		{
	            		type   : 'regExp[/^[0-9]{9,}$/]',
	            		prompt : 'Телефон рақами нотўғри киритилган'
	          		}
	        	]
	      	},
	      	email : {
	        	identifier  : 'email',
	        	optional : true,
	        	rules: [	        	    		
	           		{
	            		type   : 'regExp',
                        	value  : '.+@.+\..+',
	            		prompt : 'Электрон почта нотўғри киритилган'
	          		}
	        	]
	      	}   	
	    }
  	});

	$('.item.add').click(function() {
		$('#modal-add').modal('show');
	});

	$('.button.edit').click(function() {
        $('#modal-edit').find('.header').html($(this).data('fullname')+'ни маълумотларини таҳрирлаш');
        $('#modal-edit').find('#id').val($(this).data('id'));       
        $.each($(this).data(), function(k, v){
            if (k.substring(0,1) == 'i' ) {
        	    $('#modal-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v);
        	}
        	else if (k.substring(0,1) == 'd' ) {
        		console.log(k);
        		$('#modal-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v).change();
        	}
        	else if (k.substring(0,1) == 'r' ) {
				$('#modal-edit').find('[name="'+k.substring(1, k.length)+'"][value='+v+']').prop('checked',true);
        	}
        });	  
        $('#modal-edit').modal('show');
    });

 	$('.button.del').click(function() {
	    $('#modal-del').find('.header, .span').html($(this).data('fullname')+'ни аьзоликдан ўчириш');
	    $('#modal-del').find('#id').val($(this).data('id'));                 
	    $('#modal-del').modal('show');
	});	


	$('.form').ajaxForm({
        success: function(result) {
            if (result.success) {                
				$('.data.modal').modal('hide');				
				window.location.reload(true);
            }
        }
    });

	$('.data.modal').modal({  	
        onApprove: function() {
            $(this).find('.form').submit();
            return false;
        },
        onHidden: function() {
            $(this).find('.form').form('reset');
        }
    });

	$('.diagram').click(function(){
		$number= $(this).data('number');
		$data = [];

		for (var i = 1; i <= parseInt($number); i++) {
			for (var x = 0; x < $('.'+i+'h').length; x++) {

				$data.push([ $('.'+i+'h')[x].innerText , 
					parseInt( $('.'+i+'d')[x].innerText) ]);
			}
			chartsetting('diagram'+i, $data);
			$data = [];
		}
    	$('#diagram-info').modal('show');
	});
      
    function chartsetting ($panel, $column) {
        Highcharts.chart($panel, {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: false,
            tooltip: {
                pointFormat: '<b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    showInLegend: true,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        distance: -24,
                        color: 'black',
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return Highcharts.numberFormat(this.percentage) + '%';
                        }         
                    }
                }
            },
            legend: {
                align: 'right',
                layout: 'vertical',
                verticalAlign: 'middle',
                itemMarginBottom: 4,
                itemMarginTop: 4,
                x: -40,
                labelFormatter: function() {
                    return this.name + ': ' + Highcharts.numberFormat(this.percentage) + '%';
                }               
            },
            series: [{
                colorByPoint: true,
                data: $column  
            }]
        });
    };
    
});