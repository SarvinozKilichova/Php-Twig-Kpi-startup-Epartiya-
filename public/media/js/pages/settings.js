$(function() {

    $.urlParam = function(name){

        var results = new RegExp('[\?&]'+name+'=([^&#]*)').exec(window.location.href);

        if (results==null) {
            return null;
        } else {
            return decodeURI(results[1]);
        }
    }
 	$page = $.urlParam('page');

    if ($page) {
    	$('#verticalMenu .item.active').removeClass('active');
    	$('#verticalMenu .item[data-tab="'+$page+'"]').addClass("active");

    	$('#content .ui.tab.active').removeClass('active');
    	$('#content .ui.tab[data-tab="'+$page+'"]').addClass("active");
    }	

    $('#form_edit_password, #form-users-edit').form({
        fields: {
            newpass: {
                identifier  : 'newpass',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Янги парол киритилмаган'
                    },
                    {
                        type   : 'minLength[6]',
                        prompt : 'Янги парол камида 6 харф бўлиши лозим'
                    },
                    {
                        type   : 'maxLength[16]',
                        prompt : 'Янги парол кўпида 16 харф бўлиши лозим'
                    }
                ]
            }, 
            repass: {
                identifier  : 'repass',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Такрорий парол киритилмаган'
                    },
                    {
                        type   : 'minLength[6]',
                        prompt : 'Такрорий парол камида 6 харф бўлиши лозим'
                    },
                    {
                        type   : 'maxLength[16]',
                        prompt : 'Такрорий парол кўпида 16 харф бўлиши лозим'
                    },
                    {
                        type    : 'match[newpass]',
                        prompt : 'Янги парол билан такрорий парол бир хил бўлиши керак'
                    } 
                ]
            },  
            new_pass: {
                identifier  : 'new_pass',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Янги парол киритилмаган'
                    },
                    {
                        type   : 'minLength[6]',
                        prompt : 'Янги парол камида 6 харф бўлиши лозим'
                    },
                    {
                        type   : 'maxLength[16]',
                        prompt : 'Янги парол кўпида 16 харф бўлиши лозим'
                    }
                ]
            }, 
            re_pass: {
                identifier  : 're_pass',
                depends: "new_pass",
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Такрорий парол киритилмаган'
                    },
                    {
                        type   : 'minLength[6]',
                        prompt : 'Такрорий парол камида 6 харф бўлиши лозим'
                    },
                    {
                        type   : 'maxLength[16]',
                        prompt : 'Такрорий парол кўпида 16 харф бўлиши лозим'
                    },
                    {
                        type    : 'match[new_pass]',
                        prompt : 'Янги парол билан такрорий парол бир хил бўлиши керак'
                    } 
                ]
            }
        }
	});

	$('#form_add_users, #form-add-dis, #form-edit-dis').form({
	        fields: {
	            login: {
	                identifier  : 'login',
	                rules: [
	                    {
	                        type   : 'empty',
	                        prompt : 'Логин киритилмаган'
	                    },
	                    {
	                        type   : 'minLength[6]',
	                        prompt : 'Логин камида 6 харф бўлиши лозим'
	                    },
	                    {
	                        type   : 'maxLength[16]',
	                        prompt : 'Логин кўпида 16 харф бўлиши лозим'
	                    }
	                ]
	            }, 
	            newpass: {
	                identifier  : 'newpass',
	                rules: [
	                    {
	                        type   : 'empty',
	                        prompt : 'Янги парол киритилмаган'
	                    },
	                    {
	                        type   : 'minLength[6]',
	                        prompt : 'Янги парол камида 6 харф бўлиши лозим'
	                    },
	                    {
	                        type   : 'maxLength[16]',
	                        prompt : 'Янги парол кўпида 16 харф бўлиши лозим'
	                    }
	                ]
	            }, 
	           
	            status: {
	                identifier  : 'status',
	                rules: [
	                    {
	                        type   : 'empty',
	                        prompt : 'Статус белгиланмаган'
	                    }
	                ]
	            },
	            regions: {
	                identifier  : 'regions',
	                rules: [
	                    {
	                        type   : 'empty',
	                        prompt : 'Вилоят танланмаган'
	                    }
	                ]
	            },
	            region: {
	                identifier  : 'region',
	                rules: [
	                    {
	                        type   : 'empty',
	                        prompt : 'Вилоят танланмаган'
	                    }
	                ]
	            },
	            dis: {
	                identifier  : 'dis',
	                rules: [
	                    {
	                        type   : 'empty',
	                        prompt : 'Туман киритилмаган'
	                    }
	                ]
	            }
	        }
	        
	});

    $('#form_dl').form({
        fields: {
            method: {
                identifier  : 'method',
                depends: 'dl',
                rules: [
                    {
                        type   : 'checked',
                        prompt : 'Икки босқичли кириш турини танланмаган'
                    }
                ]
            },
            email: {
                identifier  : 'email',
                depends: 'method',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Электрон почтани киритилмаган'
                    }
                ]
            },
            telegramid: {
                identifier  : 'telegramid',
                depends: 'method',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Telegram IDни киритилмаган'
                    }
                ]
            }
        }
	});
    
    $('#form_dl').children().change(function(){
        $('#form_dl .button.save').removeClass('disabled');
    });

    $('#form_edit_password').children().change(function(){
        $('#form_edit_password .button.save').removeClass('disabled');
    });

 	$('#form_dl').ajaxForm({
        success: function(result) {
            if (result.success) {
                alertify.success(result.success);
                $('#form_dl .button.save').addClass('disabled');
            }
        }
    });

    $('#form_edit_password').ajaxForm({
        success: function(result) {
            if (result.success) {
                alertify.success(result.success);
                $('#form_edit_password :input').val('');
                $('#form_edit_password .button.save').addClass('disabled');
            }
        }
    });

    $('[name="dl"]').change(function(){
    	$('.type').toggle();
    });

	$('[name="method"]').change(function(){
		if ($(this).val() == "1")  {
			
    		$('#form_dl').form('add rule', 'email', 'empty');
    		$('#form_dl').form('remove rule', 'telegramid');
		} else {
			if ($(this).val() == "2")  {
					
    			$('#form_dl').form('add rule', 'telegramid', 'empty');
    			$('#form_dl').form('remove rule', 'email');
			}
		}
		$('.method').hide();
		$('#form_dl .method :input').val('');
		$('.method.' + $('[name="method"]:checked').val()).show();
	});

    $('.button.password').click(function(){
        var $input = $(this).data('name-input');
        if ($('.input.'+$input).prop('type')=="password"){
            $('.input.'+$input).prop('type', 'text');
            $('.icon.'+$input).removeClass('eye');
            $('.icon.'+$input).addClass('low vision');
        } else {
            $('.input.'+$input).prop('type', 'password');
            $('.icon.'+$input).removeClass('low vision');
            $('.icon.'+$input).addClass('eye');
        }
    });

    $('.button.info').click(function () {
        $('#users-more-info').find('.header').html($(this).data('kname') + ' Кенгашининг маълумотлари');
        $.each($(this).data(), function(k, v) {
            $('#'+k).html(v);
        });
        $('#users-more-info').modal('show');
    });

    $('.button.edit').click(function() {
        $('#users-edit').find('.header').html($(this).data('kname') + ' Кенгашининг паролини ўзгартириш');
        $('#users-edit').find('#usersid').val($(this).data('id'));
        $.each($(this).data(), function(k, v){
            if (k.substring(0,1) == 'i' ) {
        	    $('#users-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v);
        	}
	        $('#users-edit').modal('show');
	    });
    });     

 	$('#form-users-edit').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#users-edit').modal('hide');
                 alertify.success(result.success);
            }
        }
    });

    $('#users-edit').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-users-edit').submit();
            return false;
        },
        onHidden: function() {
            $('#form-users-edit').form('reset');
        }
    }); 

    $('#addusers').click(function(){
		$('#users-add').modal('show');
	});

    $('#form_add_users').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#users-add').modal('hide');
				window.location.reload(true);
            }
        }
    });

    $('#users-add').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form_add_users').submit();
            return false;
        },
        onHidden: function() {
            $('#form_add_users').form('reset');
        }
    });  	
       
	$('[name="kname"]').change(function(){
		if ($(this).val() == 3) {
			 $('#form_add_users')
		      	.form('add rule', 'districts', {
		        	rules: [
		          		{
	            			type   : 'empty',
	            			prompt : 'Туман белгиланмаган'
		          		}
		        	]
		      	})
			$('.dis').show();	
		}
		else if($(this).val() == 2){
			 $('#form_add_users')
		      	.form('remove fields', ['districts']);
			$('.dis').hide();
		}
		
	});


	$('[name="regions"]').change(function(){
		$id = $(this).val();
		$.ajax({
			type: "POST",
			url: "/index/dist",
			data:'code=' + $id,
			beforeSend: function() {
				$(".districts").addClass("loading");
			},
			success: function(data){
				var html = '';
				for (var i = 0; i < data.length; i++) {
					html += '<div class="item" data-value="'+ parseInt(i+1) +'">'+data[i].name+'</div>';
				}
				$('#dis_item').html(html);
				$(".districts").removeClass("loading");	
			}
		});
	});	

    $('.button.del').click(function () {
        $('#users-del').find('.header, .span').html($(this).data('kname')+' фойдаланувчини ўчириш');
        $('#users-del').find('#userid').val($(this).data('id'));
        $('#users-del').modal('show')  
    });

    $('#form-del-user').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#users-del').modal('hide');				
				window.location.reload(true);
            }
        }
    });

    $('#users-del').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-del-user').submit();
            return false;
        },
        onHidden: function() {
            $('#form-del-user').form('reset');
        }
    });   

	$('.button.dis_del').click(function () {
        $('#dis-del').find('.header, .span').html($(this).data('name')+'ни ўчириш');
        $('#dis-del').find('#disid').val($(this).data('id'));
        $('#dis-del').modal('show')  
    });

    $('#form-del-dis').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#dis-del').modal('hide');
				window.location.reload(true);
            }
        }
    });

    $('#dis-del').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-del-dis').submit();
            return false;
        },
        onHidden: function() {
            $('#form-del-dis').form('reset');
        }
    });

    $('.dis_edit').click(function () {
        $('#dis-edit').find('.header').html($(this).data('idis') +'ни таҳрирлаш');
        $('#dis-edit').find('#iddis').val($(this).data('id'));
        $.each($(this).data(), function(k, v){
            if (k.substring(0,1) == 'i' ) {
        	    $('#dis-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v);
        	}
	        $('#dis-edit').modal('show');
	    });
	});

   $('#form-edit-dis').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#dis-edit').modal('hide'); 
				window.location.reload(true);
            }
        }
    });

    $('#dis-edit').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-edit-dis').submit();
            return false;
        },
        onHidden: function() {
            $('#form-edit-dis').form('reset');
        }
    });        


	$('#adddis').click(function () {
        $('#dis-add').modal('show')  
    });

    $('#form-add-dis').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#dis-add').modal('hide');          
				window.location.reload(true);
            }
        }
    });

    $('#dis-add').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-add-dis').submit();
            return false;
        },
        onHidden: function() {
            $('#form-add-dis').form('reset');
        }
    }); 

    $('.button.generate.password').click(function(){
        $.ajax({
            type: 'POST',
            dataType:'json',
            data: { function: 'genPassword'}, 
            success: function(data){
              $('#form_add_users .input.newpass').val(data);  
            }
        });
    }); 0

    $('.change_lock').click(function(){
    	$button = $(this); 
    	$id = $(this).data('id');
        $.ajax({
            type: 'POST',
            dataType:'json',
            data: { function: 'changeStatus', id: $id }, 
            success: function(data){
	            if (data.success) {
	            	console.log(data.status);
	            	if (data.status == 1) {
	            		$('#users_table #'+$id+' td:eq(2)').html('<i class="ui green check icon">');
	            		$button.removeClass('green').addClass('red');
	            		$button.html('<i class="lock icon"></i>');
	            	} else {
	            		$('#users_table #'+$id+' td:eq(2)').html('<i class="ui red close icon">');
	            		$button.removeClass('red').addClass('green');
	            		$button.html('<i class="unlock icon"></i>');
	            	}
	            	$('#users_table #'+$id+' td:eq(3)').html('0');
	            	alertify.success(data.success);
	            } 
            }
        });
    });
//------ Message --------

    $('#form_add_message').form({
        fields: {
            ken: {
                identifier  : 'ken',
                rules: [
                    {
                        type   : 'checked',
                        prompt : 'Хабарни кўрўвчилар белгиланмаган'
                    }
                ]
            },
            type: {
                identifier  : 'type',
                rules: [
                    {
                        type   : 'checked',
                        prompt : 'Хабар тури белгиланмаган'
                    }
                ]
            },
            durdate: {
                identifier  : 'durdate',
                depends: 'one',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Амал қилиш санаси белгиланмаган'
                    }
                ]
            },
            durtime: {
                identifier  : 'durtime',
                depends: 'one',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Амал қилиш вақти белгиланмаган'
                    }
                ]
            },
	      	text: {
	        	identifier  : 'text',
	        	rules: [
	          		{
	            		type   : 'empty',
	            		prompt : 'Хабар матни киритилмаган'
	          		},
	           		{
	            		type   : 'regExp',
	            		value  : /^[а-яА-Я0-9ҚқЎўҒғҲҳЁё'"-\.\s]{3,300}$/,
	            		prompt : 'Хабар матни фақат кирил харфларида ва камида 3 дан 100 гача узунликда бўлиши лозим'
	          		}
	        	]
	      	},           
        }
	});

	$('#form_add_message').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#message-add').modal('hide');
				window.location.reload(true);
            }
        }
    });

    $('#message-add').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form_add_message').submit();
            return false;
        },
        onHidden: function() {
            $('#form_add_message').form('reset');
        }
    });

    $('#addmes').click(function(){
		$('#message-add').modal('show');
	});

  	$('#one').on("click",function() {
    	$(".duration").toggle(this.checked);
  	});	

	$('.button.mes_del').click(function () {
        $('#mes-del').find('#mesid').val($(this).data('id'));
        $('#mes-del').modal('show')  
    });

    $('#form-del-mes').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#mes-del').modal('hide'); 
				window.location.reload(true);
            }
        }
    });

    $('#mes-del').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-del-mes').submit();
            return false;
        },
        onHidden: function() {
            $('#form-del-mes').form('reset');
        }
    });

    $("#verticalMenu .item").click(function(){
    	window.history.replaceState(null, null, "?page=" + $("#verticalMenu .item.active").data("tab"));
    	$(".small.message.close").hide();
    });

});