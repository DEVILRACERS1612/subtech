 <!-- Javascript -->
    <script src="<?=BASE_PATH?>js/bootstrap.min.js"></script>
    <script src="<?=BASE_PATH?>js/jquery.min.js"></script>
    <script src="<?=BASE_PATH?>js/swiper-bundle.min.js"></script>
    <script src="<?=BASE_PATH?>js/carousel.js"></script>
    <script src="<?=BASE_PATH?>js/bootstrap-select.min.js"></script>
    <script src="<?=BASE_PATH?>js/lazysize.min.js"></script>
    <script src="<?=BASE_PATH?>js/count-down.js"></script>
    <script src="<?=BASE_PATH?>js/wow.min.js"></script>
    <script src="<?=BASE_PATH?><?=BASE_PATH?>js/multiple-modal.js"></script>
    <script src="<?=BASE_PATH?>js/infinityslide.js"></script>
    <script src="<?=BASE_PATH?>js/main.js"></script>
    <script>
    $(document).ready(function(){
       
        $("#subsform").on("submit",function(e){
    		e.preventDefault();
    		$("#sbtn").html('Wait...');
    		$.ajax({
    			url:'<?php echo BASE_PATH;?>Controller/Master/',
    			type:'post',
    			data:new FormData(this),
    			contentType: false,       
    			cache: false,            
    			processData:false,
    			success:function(data){
    			    //alert(data);
    				//$('#preloader').hide();

    				var response=(JSON.parse(data));
    				$("#smsg").html(response.message);
    				if(response.type=="success")
    				{
    					setTimeout(function(){$("#subsform").trigger("reset");},1500);
    				}else{
    				    setTimeout(function(){$("#smsg").html("");},1500);
    				}
    				
    			}
    			
    		});
    	} );
    });
 </script> 
    <script>
        window.REQUIRED_CODE_ERROR_MESSAGE = 'Please choose a country code';
        window.LOCALE = 'en';
        window.EMAIL_INVALID_MESSAGE = window.SMS_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";

        window.REQUIRED_ERROR_MESSAGE = "This field cannot be left blank. ";

        window.GENERIC_INVALID_MESSAGE = "The information provided is invalid. Please review the field format and try again.";

        window.translation = {
            common: {
                selectedList: '{quantity} list selected',
                selectedLists: '{quantity} lists selected'
            }
        };

        var AUTOHIDE = Boolean(0);
    </script>