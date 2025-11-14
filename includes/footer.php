<!-- <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021 NCIP-CAR</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer> -->
  
<script src="js/hierarchy-select.min.js"></script>
<script src="js/bootstrap-toggle.js"></script>
  
<script src="js/jquery.3.6.0.min.js"></script>

<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/feather.min.js"></script>
<script src="js/dashboard.js"></script>
		
		
		
<script>
jQuery(document).ready(function($) {
	
	$('#dataTable tr td:not(:last-child)').click(function ()    {
	 location.href = $(this).parent().find('td a').attr('href');
	});	
});

</script>


<script src="js/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  
  $('body').on('shown.bs.modal', '#myModal', function () {
   $(".modal-body").html($("#print-table").html());
});
  </script>

		
		
</body>
</html>