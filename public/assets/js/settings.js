
	jQuery(document).ready(function($) {
		$('.day-number').on('click',function() {
			$(this).parent().toggleClass('holiday_selected');
			var theDte=$(this).attr('dte');
			var curVal=$('#holidays').val();
			
			if(curVal=='')
			{
				$('#holidays').val(theDte+',');
			}
			else
			{
				if(curVal.indexOf(theDte)<0)
				{
					if(curVal.charAt(curVal.length-1)!=',') { curVal+=','; }
					$('#holidays').val(curVal+theDte+',');
				}
				else
				{
					$('#holidays').val(curVal.replace(theDte+',',''));
				}
			}
		});
		
		$('.selectAllChk').on('click',function() {
			var idd=$(this).attr('id');
			
			if($(this).hasClass('selectAllClicked'))
			{
				$('.'+idd).each(function() {
				
					if($(this).parent().hasClass('holiday_selected'))
					{
						$(this).trigger('click');
					}
					
				});
			}
			else
			{
				$('.'+idd).each(function() {
				
					if(!$(this).parent().hasClass('holiday_selected') && !$(this).parent().hasClass('is_sunday'))
					{
						$(this).click();
					}
					
				});
			}	
			$(this).toggleClass('selectAllClicked');
		});
	});
