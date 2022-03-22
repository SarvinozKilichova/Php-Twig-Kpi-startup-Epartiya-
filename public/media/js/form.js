$(function() {

	$('#form-bpt-add, #form-bpt-edit, #form-bpt-return, #form-azo-edit, #form-azo-add').form({
    	fields: {
	      	bptname: {
	        	identifier  : 'bptname',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'БПТ номи киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\s]{3,100}$/,
	            		prompt : 'БПТ номи фақат кирил харфларида  сон, белги ва камида 3 дан 100 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	bpt: {
	        	identifier  : 'bpt',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'БПТ номи киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\s]{3,100}$/,
	            		prompt : 'БПТ номи фақат кирил харфларида ва  сон, белги камида 3 дан 100 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      		
	      	bptpp: {
	        	identifier  : 'bptpp',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'БПТ жойлашган жойи киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,150}$/,
	            		prompt : 'БПТ жойлашган жойи фақат кирил харфларида  сон, белги ва камида 3 дан 150 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	bptpa: {
	        	identifier  : 'bptpa',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'БПТ жойлашган манзил киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,150}$/,
	            		prompt : 'БПТ жойлашган манзил фақат кирил харфларида  сон, белги ва камида 3 дан 150 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},	 
	      	bptorg : {
	        	identifier  : 'bptorg',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'БПТ жойлашган ташкилот белгиланмаган'
	          		}
	        	]
	      	},
	      	bptdate : {
	        	identifier  : 'bptdate',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'БПТ очилган санаси киритилмаган'
	          		}
	        	]
	      	},
	      	bptgnum : {
	        	identifier  : 'bptgnum',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Гувохнома рақами  киритилмаган'
	          		},
	          		{
	            		type   : 'regExp[/^[0-9]{5}$/]',
	            		prompt : 'Гувохнома рақами  5 та сондан бўлиши лозим'
	          		}
	        	]
	      	},
	      	fname: {
	        	identifier  : 'fname',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Фамилия киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-ЯҚқЎўҒғҲҳЁё]{6,50}$/,
	            		prompt : 'Фамилия фақат кирил харфларида ва камида 6 дан 50 гача узунликда бўлиши лозим'
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
	            		value  : /^[а-яА-ЯҚқЎўҒғҲҳЁё\s]{6,50}$/,
	            		prompt : 'Отасининг исми фақат кирил харфларида ва камида 6 дан 50 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	sex: {
	        	identifier  : 'sex',
	        	rules: [
	          		
	           		{
	            		type   : 'checked',
	            		prompt : 'Жинс белгиланмаган'
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
	      	pasdate : {
	        	identifier  : 'pasdate',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Паспорт берилган санаси белгиланмаган'
	          		}
	        	]
	      	},
	      	passr : {
	        	identifier  : 'passr',
	        	rules: [
	           		{
	            		type   : 'empty',
	            		prompt : 'Паспорт серияси ва рақами киритилмаган'
	          		},	        
	           		{
	            		type   : 'regExp',
	            		value  : /^[A-Za-z]{2,}[0-9]{7,}$/,
	            		prompt : 'Паспорт серияси ва рақами нотўғри киритилган'
	          		}
	          		
	        	]
	      	},
	      	paswho : {
	        	identifier  : 'paswho',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : ' Паспорт ким томонидан берилганлиги киритилмаган'
	          		},
	          		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{5,150}$/,
	            		prompt : 'Паспорт ким томонидан берилганлиги кирил харфларида  сон, белги  ва камида 5 дан 150 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	pasdate : {
	        	identifier  : 'pasdate',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Паспорт берилган вақти белгиланмаган'
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
	      	profession : {
	        	identifier  : 'profession',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Мутассислиги белгиланмаган'
	          		}
	        	]
	      	},
	      	res : {
	        	identifier  : 'res',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Республика белгиланмаган'
	          		}
	        	]
	      	},
	      	bpr : {
	        	identifier  : 'bpr',
	        	depends: 'res',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Вилоят белгиланмаган'
	          		}
	        	]
	      	},
	      	bpi : {
	        	identifier  : 'bpi',
	        	depends: 'res',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Туғулган жойи маълумотлари киритилмаган'
	          		}
	        	]
	      	},
	      	bpt_name : {
	        	identifier  : 'bpt_name',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'БПТ белгиланмаган'
	          		}
	        	]
	      	},
	      	kname : {
	        	identifier  : 'kname',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Kенгаш номи белгиланмаган'
	          		}
	        	]
	      	},
	      	adate : {
	        	identifier  : 'adate',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Партияга аъзо бўлган санаси киритилмаган'
	          		}
	        	]
	      	},
	      	pnum : {
	        	identifier  : 'pnum',
	        	optional   : true,
	        	rules: [
	          		{
	            		type   : 'regExp[/^[0-9]{5,7}$/]',
	            		prompt : 'Партия билет рақами  камида 5 дан 7 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	sdate : {
	        	identifier  : 'sdate',
	        	optional   : true,
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Сайланган йили киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[0-9]{4,}$/,
	            		prompt : 'Сайланган йили нотўғри киритилган'
	          		}
	        	]
	      	},
	      	lpr : {
	        	identifier  : 'lpr',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Вилоят белгиланмаган'
	          		}
	        	]
	      	},
	      	lpd : {
	        	identifier  : 'lpd',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Туман белгиланмаган'
	          		}
	        	]
	      	},
	      	lpmfy : {
	        	identifier  : 'lpmfy',
	        	 optional   : true,
	        	rules: [  		
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
	            		prompt : 'МФЙ/ҚФЙ/ШФЙ кирил харфларида  сон, белги ва камида 3 дан 200 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	lpi : {
	        	identifier  : 'lpi',
	        	 optional   : true,
	        	rules: [  		
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
	            		prompt : 'Яшаш манзили кирил харфларида  сон, белги  ва камида 3 дан 200 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	tel : {
	        	identifier  : 'tel',
	        	 optional   : true, 
	        	rules: [  		
	           		{
	            		type   : 'regExp[/^[0-9]{9,}$/]',
	            		prompt : 'Телефон рақами нотўҒри киритилган'
	          		}
	        	]
	      	},
	      	email : {
	        	identifier  : 'email',
	        	optional   : true,
	        	rules: [  		
	           		{
	            		type   : 'regExp',
                        	value  : '.+@.+\..+',
	            		prompt : 'Электрон почта нотўҒри киритилган'
	          		}
	        	]
	      	},
	      	activity : {
	        	identifier  : 'activity',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Фаолият соҳаси белгиланмаган'
	          		}
	        	]
	      	},  
	      	work : {
	        	identifier  : 'work',
	        	depends    : 'activity',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Иш жой киритилмаган'
	          		},
	          		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
	            		prompt : 'Иш жойи кирил харфларида  сон, белги  ва камида 3 дан 200 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	ll: {
	        	identifier  : 'll',
	        	depends    : 'activity',
	        	rules: [	          		
	           		{
	            		type   : 'checked',
	            		prompt : 'Лавозим даражаси белгиланмаган'
	          		}
	        	]
	      	},
	      	edulevel: {
	        	identifier  : 'edulevel',
	        	depends    : 'activity',
	        	rules: [	          		
	           		{
	            		type   : 'empty',
	            		prompt : 'Ўқув босқичи белгиланмаган'
	          		}
	        	]
	      	},
	      	level : {
	        	identifier  : 'level',
	        	depends    : 'activity',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Лавозими киритилмаган'
	          		},
	          		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё\s]{3,100}$/,
	            		prompt : 'Лавозими кирил харфларида ва камида 3 дан 100 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},
	      	worktel : {
	        	identifier  : 'worktel',
	        	optional   : true,
	        	rules: [  		
	           		{
	            		type   : 'regExp[/^[0-9]{9,}$/]',
	            		prompt : 'Телефон рақами нотўҒри киритилган'
	          		}
	        	]
	      	}	      		
	    }   
	});


  	$('#form-delete-bpt').form({
	    fields: {
	        delre: {
	            identifier  : 'delre',
	            rules: [
	                {
	                    type   : 'checked',
	                    prompt : 'БПТ тугатилиш  сабаби белгиланмаган'
	                }                
	            ]
	        },  

	        newbpt : {
	        	identifier  : 'newbpt',
	        	rules: [  		
	           		{
	            		type   : 'empty',
	            		prompt : 'Янги БПТ белгиланмаган'
	          		}
	        	]
	      	},
	        ddate: {
	            identifier  : 'ddate',
	            rules: [
	                {
	                    type   : 'empty',
	                    prompt : 'БПТ тугатиш санаси киритилмаган'
	                }
	            ]
	        }                 
	    }
	});


	$('#form-bpt-change').form({
	    	fields: {
		      	newrais: {
		        	identifier  : 'newrais',
		        	rules: [
		          		{
		            		type   : 'empty',
		            		prompt : 'Янги раис танланмаган'
		          		}
		        	]
		      	}		      	
		    }
	});

	$('#form-delete-azo').form({
        fields: {
            aus: {
                identifier  : 'aus',
                rules: [
                    {
                        type   : 'checked',
                        prompt : 'Аъзоликдан ўчирилиш сабаби белгиланмаган'
                    }                
                ]
            },  
            audate: {
                identifier  : 'audate',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Аъзоликдан ўчирилган сана киритилмаган'
                    }
                ]
            }                 
        }
    }); 

    $('#form-change-azo').form({
        fields: {
            kname: {
                identifier  : 'kname',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Кенгаш номи белгиланмаган'
                    }                
                ]
            },  
            bptname: {
                identifier  : 'bptname',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'БПТ номи белгиланмаган'
                    }
                ]
            }
        }
    });        

	function Validation(metod, evt) {
	  	var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode(key);

		switch (metod){
			case 1:
				var regex = /[а-яА-ЯҚқЎўҒғҲҳЁё]|\./;
				var message_part = 'кирил ҳарфларида';
			break;
			case 2:
				var regex = /[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]|\./;
				var message_part = 'кирил ҳарфларида сон, белги ва бўш жой билан';
			break;
			case 3:
				var regex = /[A-Za-z0-9]|\./;
				var message_part = 'лотин ҳарфларида ва сон ';
			break;
			case 4:
				var regex = /[0-9-]|\./;
				var message_part = 'сон ва белги';
			break;
			case 5:
				var regex = /[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]|\./;
				var message_part = 'кирил ҳарфларида, сон, белги ва бўш жой билан';
			break;
			case 6:
				var regex = /[a-zA-Z0-9-@_.]|\./;
				var message_part = 'лотин ҳарфларида, белги ва сон';
			break;
		}
			
		if( !regex.test(key) ) {

			alertify.alert().setting({
				'title': 'Диққат!',
				'label': 'Тушундим',
				'message': 'Маълумотларни фақат ' + message_part + '  киритиш мумкин!'
			}).show();

			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();		
		}   	
    }

    $('[name="fname"], [name="mname"]').on('keypress', function(evt) {
 		Validation(1, evt);
	});

 	$('[name="lname"], [name="work"], [name="level"], [name="kname"], [name="bpt"], [name="bptname"],  [name="yun"], [name="organ"]').on('keypress', function(evt) {
 		Validation(2, evt);
	});

 	$('[name="passr"]').on('keypress', function(evt) {
 		Validation(3, evt);
	});

	$('[name="pasdate"], [name="tdate"], [name="adate"], [name="sdate"], [name="tel"], [name="worktel"], [name="bptgnum"], [name="bptdate"]').on('keypress', function(evt) {
 		Validation(4, evt);
	});	

	$('[name="bptname"], [name="bptpp"],  [name="bptpa"], [name="paswho"], [name="address"], [name="lpmfy"],[name="lpi"], [name="bpi"]').on('keypress', function(evt) {
 		Validation(5, evt);
	});

	$('[name="email"]').on('keypress', function(evt) {
 		Validation(6, evt);
	});


	$('[name = "education"]').change(function() {
		$code = ['3', '5'];
        if ($code.indexOf($(this).val()) >= 0){
        	$('[name="activity"]').val("3").change();
        	$('#worklbl').html('Ўқиш жойи');
        	$('[name = "work"]').attr("placeholder", "Ўқиш жойини киритинг");
        	$('.level').hide();
        	$('.work, .edulevel, .worktel').show();
        }
	});		

	$('[name="dep"]').change(function() {
		$('[name="ssana"]').val("");		
		$form = $(this).data('form');
		if ($(this).val() > 0) {
		    $('#' + $form)
		      	.form('add rule', 'sdate', {
		        	rules: [
		           		{
		            		type   : 'empty',
		            		prompt : 'Сайланган йили киритилмаган'
		          		},
		           		{
		            		type   : 'regExp',
		            		value  : /^[0-9]{4,}$/,
		            		prompt : 'Сайланган йили нотўғри киритилган'
		          		}	
		        	]
		      	});		
			$(".field.ssana").show();		
		} else {
		    $('#' + $form).form('remove fields', ['sdate']);			
			$(".field.ssana").hide();
		}	  
	});

	
	$('[name = "res"]').change(function() {
		$form = $(this).data('form');
		if ($(this).val()== 1) {
		    $('#' + $form)
		      	.form('add rule', 'bpr', {
		        	rules: [
		          		{
	            			type   : 'empty',
	            			prompt : 'Вилоят белгиланмаган'
		          		}
		        	]
		      	})
		      	.form('remove fields', ['bpi']);

			$('.for_uz').show();
			$('.for_other').hide();
	    } else {
		    $('#' + $form)
		      	.form('add rule', 'bpi', {
		        	rules: [
		          		{
	            			type   : 'empty',
	            			prompt : 'Туғулган жойи маълумотлари киритилмаган'
		          		},
		           		{
		            		type   : 'regExp',
		            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{5,200}$/,
		            		prompt : 'Туғулган жойи маълумотлари кирил харфларида  сон, белги ва камида 5 дан 200 гача узунликда бўлиши лозим'
		          		}		          		
		        	]
		      	})
		      	.form('remove fields', ['bpr']);
	    	$('.for_uz').hide();
			$('.for_other').show();	
		}
	});



	$('[name="dep"]').change(function() {
		$('[name="ssana"]').val("");		
		if ($(this).val() != "") {
			$(".field.ssana").show();		
		} else {
			$(".field.ssana").hide();
		}	  
	});

	$('[name = "activity"]').change(function() {
		$form = $(this).data('form');
		$('#workinfo').find('input:text').val('');
		$index = parseInt($(this).val());
		switch($index) {
			case 1:
			    $('#' + $form)
			      	.form('add rule', 'work', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Иш жой киритилмаган'
			          		},
			          		{
			            		type   : 'regExp',
			            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
			            		prompt : 'Иш жойи кирил харфларида  сон, белги ва камида 3 дан 200 гача узунликда бўлиши лозим'
			          		}
			        	]
			      	})
			      	.form('add rule', 'level', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Лавозими киритилмаган'
			          		},
			          		{
			            		type   : 'regExp',
			            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,100}$/,
			            		prompt : 'Лавозими кирил харфларида  сон, белги ва камида 3 дан 100 гача узунликда бўлиши лозим'
			          		}
			        	]
			      	})
			      	.form('remove fields', ['edulevel']);

				$('#worklbl').html('Иш жойи');
				$('[name = "work"]').attr("placeholder", "Иш жойини киритинг");
				$('[name="ll"]').attr('readonly', true);
				$('#worker').prop('checked', true);
				$('.edulevel').hide();
				$('.work, .level, .ll, .worktel').show();	
			break;
			case 2:
			    $('#' + $form)
			      	.form('add rule', 'work', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Иш жой киритилмаган'
			          		},
			          		{
			            		type   : 'regExp',
			            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
			            		prompt : 'Иш жойи кирил харфларида  сон, белги ва камида 3 дан 200 гача узунликда бўлиши лозим'
			          		}
			        	]
			      	})			      	
			      	.form('add rule', 'level', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Лавозими киритилмаган'
			          		},
			          		{
			            		type   : 'regExp',
			            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,100}$/,
			            		prompt : 'Лавозими кирил харфларида  сон, белги ва камида 3 дан 100 гача узунликда бўлиши лозим'
			          		}
			        	]
			      	})
			      	.form('remove fields', ['edulevel']);

				$('#worklbl').html('Иш жойи');
				$('[name = "work"]').attr("placeholder", "Иш жойини киритинг");
				$('[name="ll"]').attr('readonly', true);
				$('#boss').prop('checked', true);
				$('.edulevel').hide();			
				$('.work, .level, .ll, .worktel').show();
			break;
			case 3:
			    $('#' + $form)
			      	.form('add rule', 'work', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Ўқиш жойи киритилмаган'
			          		},
			          		{
			            		type   : 'regExp',
			            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
			            		prompt : 'Ўқиш жойи кирил харфларида  сон, белги ва камида 3 дан 200 гача узунликда бўлиши лозим'
			          		}
			        	]
			      	})		      	
			      	.form('add rule', 'edulevel', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Ўқув босқичи белгиланмаган'
			          		}
			        	]
			      	})
			      	.form('remove fields', ['level', 'll']);

				$('#worklbl').html('Ўқиш жойи');
				$('[name = "work"]').attr("placeholder", "Ўқиш жойини киритинг");
				$('#boss,  #worker').prop('checked', false);
				$('.level, .ll').hide();			
				$('.work, .edulevel, .worktel').show();
			break;
			case 4: case 5: case 6: case 7: case 8: case 9: case 10: case 11: case 13: case 14:

			    $('#' + $form)
			      	.form('add rule', 'work', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Иш жой киритилмаган'
			          		},
			          		{
			            		type   : 'regExp',
			            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,200}$/,
			            		prompt : 'Иш жойи кирил харфларида  сон, белги ва камида 3 дан 200 гача узунликда бўлиши лозим'
			          		}
			        	]
			      	})
			      	.form('add rule', 'll', {
			        	rules: [
			           		{
	            				type   : 'checked',
	            				prompt : 'Лавозим даражаси белгиланмаган'
			          		}
			        	]
			      	})
			      	.form('add rule', 'level', {
			        	rules: [
			           		{
			            		type   : 'empty',
			            		prompt : 'Лавозими киритилмаган'
			          		},
			          		{
			            		type   : 'regExp',
			            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\,\s]{3,100}$/,
			            		prompt : 'Лавозими кирил харфларида  сон, белги ва камида 3 дан 100 гача узунликда бўлиши лозим'
			          		}
			        	]
			      	})
			      	.form('remove fields', ['edulevel']);	
			      			
				$('#worklbl').html('Иш жойи');
				$('[name = "work"]').attr("placeholder", "Иш жойини киритинг");
				$('[name="ll"]').attr('readonly', false);
				$('[name="ll"]').prop('checked', false);
				$('.edulevel').hide();
				$('.work, .level, .ll, .worktel').show();
			break;
			case 12: case 15:
			    $('#' + $form).form('remove fields', ['work', 'll', 'level', 'edulevel', 'worktel']);			
				$('[name="ll"]').prop('checked', false);			
				$('.work, .ll, .level, .edulevel, .worktel').hide();
			break;
			default:
		}      
	});	



});