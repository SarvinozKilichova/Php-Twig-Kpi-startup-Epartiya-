$(function() {

	
	$('#bptadd').click(function(){
		$('#bpt-add').modal('show');
	});

	$('.bptedit').click(function(){
		$('#bpt-edit').find('.header').html($(this).data('ibpt')+'ни маълумотларини таҳрирлаш');
        $('#bpt-edit').find('#bptid').val($(this).data('id'));
		 $.each($(this).data(), function(k, v){
		 	console.log(k + v);
            if (k.substring(0,1) == 'i' ) {
        	    $('#bpt-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v);
        	} else if (k.substring(0,1) == 'd' ) {
        		$('#bpt-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v).change();
        	}        	
        });
		$('#bpt-edit').modal('show');
	});

	$('#form-bpt-edit').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#bpt-edit').modal('hide');
				window.location.reload(true);                 
               
            }
        }
    });

    $('#bpt-edit').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form-bpt-edit').submit();
            return false;
        },
        onHidden: function() {
            $('#form-bpt-edit').form('reset');
        }
    });

	$('.bptchange').click(function(){
		$id = $(this).data('bptid');
		$.ajax({
			type: "POST",
			url: "/bpt/getazolar",
			data:'bptid=' + $id,
			success: function(data){
				var html = '';
				$('#bpt-change #rais_fullname').val(data[0].fullname);
				for (var i = 1; i < data.length; i++) {
					html += '<div class="item" data-value="'+ data[i].id +'">'+data[i].fullname+'</div>';
				}
				$('#bpt-change #azolar_fullname').html(html);
				$('#bpt-change [name="bptid"]').val($id);
				$('#bpt-change').modal('show');	
			}
		});
	});
	
	$('.return').click(function(){
	$('#bpt-return').find('.header').html($(this).data('bptname')+'га раис қўшиш');
    $('#bpt-return').find('#bptid').val($(this).data('id'));
	$('#bpt-return').modal('show');
    });


    $('#form-bpt-return').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#bpt-return').modal('hide');
				window.location.reload(true);
            }
        }
    });


    $('#bpt-return').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form-bpt-return').submit();
            return false;
        },
        onHidden: function() {
            $('#form-bpt-return').form('reset');
        }
    });


	$('.del').click(function(){
		$id = $(this).data('id');
		$.ajax({
			type: "GET",
			url: "/bpt/getbpt",
			data:'id=' + $id,
			success: function(data){
				var html = '';
				for (var i = 0; i < data.length; i++) {
					html += '<div class="item" data-value="'+ data[i].id +'">'+data[i].bptname+'</div>';
				}
				$('#new_bpt').html(html);		
			}
		});

	$('#bpt-del').find('.header').html($(this).data('bptname')+'ни тугатиш');
    $('#bpt-del').find('#bptid').val($(this).data('id'));
	$('#bpt-del').modal('show');
    });

	$('#form-delete-bpt').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#bpt-del').modal('hide');
				window.location.reload(true);
            }
        }
    });

    $('#bpt-del').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form-delete-bpt').submit();
            return false;
        },
        onHidden: function() {
            $('#form-delete-bpt').form('reset');
        }
    });



	$('#form-bpt-add').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#bpt-add').modal('hide'); 
				window.location.reload(true);                
               
            }
        }
    });

	$('#bpt-add').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form-bpt-add').submit();
            return false;
        },
        onHidden: function() {
            $('#form-bpt-add').form('reset');
        }
    });

	$('#form-bpt-change').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#bpt-change').modal('hide');  
				window.location.reload(true);             
               
            }
        }
    });

	$('#bpt-change').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form-bpt-change').submit();
            return false;
        },
        onHidden: function() {
            $('#form-bpt-change').form('reset');
        }
    });


	if ($('.negative.message').length > 0) {
		alertify.alert().setting({
			'title': 'Диққат!',
			'label': 'Тушундим',
			'message': 'Таркибида аъзолар сони 3 нафардан кам бўлган БПТ мавжуд. Илтимос ушбу БПТ ҳисобига аъзолар қушинг.'
		}).show();	  	
	}    

});