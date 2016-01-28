$(document).ready(function(){
	var working = false;
	$('#addCommentForm').submit(function(e){

 		e.preventDefault();
		if(working) return false;
		
		working = true;
		$('#submit').val('Записываю...');
		$('span.error').remove();

		$.post('submit.php',$(this).serialize(),function(msg){

			working = false;
			$('#submit').val('Отправить');
			
			if(msg.status){

				$(msg.html).hide().insertBefore('#addCommentContainer').slideDown();
				$('#body').val('');
			}
			else {
				
				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').append(' <span class="redtext">'+v+'</span>');
				});
			}
		},'json');

	});
	
});