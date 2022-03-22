$(function() {

	$('#addazo').click(function(){
		$('#azolar-add').modal('show');
	});

    $('.button.info').click(function () {
        $('#azolar-more-info').find('.header').html($(this).data('fullname') + 'нинг маълумотлари');
        $.each($(this).data(), function(k, v) {
            $('#'+k).html(v);
        });
        $('#azolar-more-info').modal('show');
    }); 

    $('.button.edit').click(function() {
    	$info = $(this);
		$.ajax({
			type: "POST",
			url: "/azolar/getbpt",
			data:'id=' + $info.data('id'),
			success: function(data){
				if (data != null) {
					var html = '';
					for (var i = 0; i < data.length; i++) {
						html += '<div class="item" data-value="'+ data[i].idinsert +'">'+data[i].bptname+'</div>';
					}
					$('#azolar-edit #bpt_item').html(html);
			    }
				
			},
    		complete:function(){
				 	$('#azolar-edit').find('.header').html($info.data('fullname')+'ни маълумотларини таҳрирлаш');
			        $('#azolar-edit').find('#azoid').val($info.data('id'));
			        $('#azolar-edit').find('#bptken').html($info.data('bptname'));			         
			        $.each($info.data(), function(k, v){
			            if (k.substring(0,1) == 'i' ) {
			        	    $('#azolar-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v);
			        	}
			        	else if (k.substring(0,1) == 'd' ) {
			        		$('#azolar-edit').find('[name="'+k.substring(1, k.length)+'"]').val(v).change();
			        	}
			        	else if (k.substring(0,1) == 'r' ) {
							$('#azolar-edit').find('[name="'+k.substring(1, k.length)+'"][value='+v+']').prop('checked',true);
			        	}
			        });

			        $('.lpd .text').removeClass('default').html($info.data('lpd'));
			        $('#azolar-edit').modal('show');
    		},
			async: false
		});
    });

    $('.button.del').click(function () {
        $('#azolar-del').find('.header').html($(this).data('fullname')+'ни аъзоликдан ўчириш');
        $('#azolar-del').find('#azoid').val($(this).data('id'));
        $('#azolar-del').modal('show')  
    });

    $('.button.change').click(function () {
        $('#azolar-change').find('.header').html($(this).data('fullname')+'ни бошқа Кенгашга ўтқазиш');
        $('#azolar-change').find('#azoid').val($(this).data('id'));
        $('#azolar-change').modal('show')  
    });    

	

    $('#form-azo-add').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#azolar-add').modal('hide');
				window.location.reload(true);	            
            }
        }
    });

    $('#azolar-add').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form-azo-add').submit();
            return false;
        },
        onHidden: function() {
            $('#form-azo-add').form('reset');
        }
    });

 	$('#form-azo-edit').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#azolar-edit').modal('hide');	
				window.location.reload(true);
            }
        }
    });

    $('#azolar-edit').modal({
        observeChanges: true,
        duration: 100,
        closable: false,    	
        onApprove: function() {
            $('#form-azo-edit').submit();
            return false;
        },
        onHidden: function() {
            $('#form-azo-edit').form('reset');
        }
    });  

   
    $('#form-delete-azo').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#azolar-del').modal('hide');   
				window.location.reload(true); 
            }
        }
    });

    $('#azolar-del').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-delete-azo').submit();
            return false;
        },
        onHidden: function() {
            $('#form-delete-azo').form('reset');
        }
    });



    $('#form-change-azo [name="kname"]').change(function(){
    	$id = $(this).val();
		$.ajax({
			type: "POST",
			url: "/index/bpt",
			data:'id=' + $id,
			beforeSend: function() {
				$("#form-change-azo  .bptname").addClass("loading");
			},
			success: function(data){
				$('#bpt_item').html('');
				$("#form-change-azo  .bptname").removeClass("loading");
				if (data.length == 0) {
					alertify.error('Ушбу туман Кенгашида БПТ топилмади.')
				} else {
					var html = '';
					for (var i = 0; i < data.length; i++) {
						html += '<div class="item" data-value="'+ data[i].id +'">'+data[i].bptname+'</div>';
					}
					$('#bpt_item').html(html);	
				}
			}
		});
    });

    $('#form-change-azo').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#azolar-change').modal('hide');
				window.location.reload(true);
            }
        }
    });

    $('#azolar-change').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-change-azo').submit();
            return false;
        },
        onHidden: function() {
            $('#form-change-azo').form('reset');
        }
    }); 

    $('.return').click(function () {
        $('#azolar-return').find('.header, .span').html($(this).data('fullname')+'ни аъзоликка қайтариш');
        $('#azolar-return').find('#azoid').val($(this).data('id'));
        $('#azolar-return').modal('show');
    });

    $('#form-return-azo').ajaxForm({
        success: function(result) {
            if (result.success) {
				$('#azolar-return').modal('hide');
				window.location.reload(true);      
            }
        }
    });

    $('#azolar-return').modal({
        observeChanges: true,
        duration: 100,
        closable: false,
        onApprove: function() {
            $('#form-return-azo').submit();
            return false;
        },
        onHidden: function() {
            $('#form-return-azo').form('reset');
        }
    });
});