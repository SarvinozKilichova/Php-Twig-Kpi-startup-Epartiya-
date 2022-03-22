$(function() {

	$(document).ready(function() {
		$('body').addClass('loaded');
	});

    $(window).bind("beforeunload", function(){
        $('body').removeClass('loaded');
    });

	$('.menu .item').tab();
	
	
	$('.sidebar.menu').sidebar('attach events', '.toc.item');
	
    $('.modal').modal({
        autofocus: false,
        transition: 'fade',
        duration: 25
    });

    $('.icon').popup({inline: true});

    $('.modal.logout')
    .modal({
        onApprove : function() {
            App.redirect('/utils/logout');
        }
    })

    
    .modal('setting', 'transition', 'scale')
    .modal('attach events', '#logout', 'show');



    $('input.adate').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: '15.02.1995',
        endDate: '-0d'
    });

    $('input.time').timepicker({
        showDuration: false,
        disableTextInput: true,
        timeFormat: 'H:i',
        minTime: '06:00',
        maxTime: '23:30'
    });

    $('input.sana').datepicker({
        format: 'dd.mm.yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: '15.02.1995',
        endDate: '-0d'
    });    


    $('input.date.message').datepicker({
        format: 'dd.mm.yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: '-0d',
        endDate: '+7d'
    });    

    $('input[name="bpt_sana"]').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years',
        autoclose: true,
        startDate: '1995',
        endDate: '-0y'
    });

    $('.ui.checkbox').checkbox();
    $('.ui.accordion').accordion();
    $('.ui.dropdown').dropdown();
    $('.ui.message .close').on('click', function() {
        $(this).closest('.message').transition('fade');
        $.ajax({
            url: 'utils/unset',
            method: 'post',
            success: function() {
            }
        });
    });
    
    var
        $body_loader = $('#body-loader1'),
        $_modal_loader = $('.modal_loader');
        
    $(document).keypress(function(e) {
        if(e.which == 13) {
            if($body_loader.hasClass('active') || $_modal_loader.hasClass('active')) {
                return false;
            }
        }
    });
    
    $.ajaxSetup({
        type: 'post',
        dataType: 'json'
    });
    
    $(document).ajaxSend(function(evt, request, settings) {
        if($('.ui.modal').is('.visible')) {
            $_modal_loader.addClass('active');
        } else {
            $body_loader.addClass('active');
        }
    });
    
    $(document).ajaxStop(function() {
        if($('.ui.modal').is('.visible')) {
            $_modal_loader.removeClass('active');
        } else {
            $body_loader.removeClass('active');
        }
    });
    
    $(document).ajaxSuccess(function(event, jqxhr, settings) {
        var result = JSON.parse(jqxhr.responseText);
        if(result.error) {
            alertify.error(result.error);
        }
    });

    $('.item.print').click(function(){
    	$target = $('#'+$(this).data('print'));
    	if ($target.length) {
    		$target.printThis({});
    	} else alertify.error('Чоп этиш учун маълумот топилмади.');
	});  

    $(".item.export").click(function(){
    	$target = $('#'+$(this).data('export'));
    	if ($target.length) {
    		$target.table2excel({
    		    filename: $(this).data('file')+".xls"
    		});
    	} else alertify.error('Экспорт учун маълумот топилмади.');
    });	 

	$('.fname').on('input', function() {
		if ($(this).val().substring($(this).val().length - 1) == "в") {
			$('#'+$(this).data('form') + ' #male').prop('checked',true);
		} else if ($(this).val().substring($(this).val().length - 2) == "ва") {
			$('#'+$(this).data('form') + ' #female').prop('checked',true);
		}
	});

    //search and pagination 
	$('[name="search"]').on('keypress',function(e) {
	    if(e.which == 13) {
	        $('#form_filter').submit();
	    }
	});

    $('#limit, #regions, #dis').dropdown({
        onChange: function() {
        	$('#page').val('1');
            $('#form_filter').submit();
        }
    });


    $('.ui.pagination.menu .item.page').click(function(){
    	$('#page').val($(this).data('id'));
    	$('#form_filter').submit();
    }); 

	$('[name="lpr"]').change(function(){
		$id = $(this).val();
		$form = $(this).data('form');
		$(".lpd .text").addClass("default").html('Туманни танланг');		
		$.ajax({
			type: "POST",
			url: "/index/dist",
			data:'id=' + $id,
			beforeSend: function() {
				$(".lpd").addClass("loading");
			},
			success: function(data){
				var html = '';
				for (var i = 0; i < data.length; i++) {
					html += '<div class="item" data-value="'+ parseInt(i+1) +'">'+data[i].name+'</div>';
				}
				$('#'+$form+' #lpd_item').html(html);
				$(".lpd").removeClass("loading");	
			}
		});
	});
	
    $(".sticky-table").freezeTable({
      'headWrapStyles': {'box-shadow': '0px 9px 10px -5px rgba(159, 159, 160, 0.8)'},
      'freezeColumn': false,
    });
});
