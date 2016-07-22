<script type="text/javascript">
	$.ajax({
	
		url : 'page.php',
		data:{variable:variable},
		type:'POST',
		dataType: "json",
		
		success: function(data){
			$('.div').html(data);
		},

		beforeSend: function(){
			$('.loader').show()
		},
		complete: function(){
		   $('.loader').hide();
		}
	});
</script>
