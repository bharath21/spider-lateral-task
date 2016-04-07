<!--footer-->
<footer class="text-center" style=" background-color: #2d2d30;color: #f5f5f5;
      padding: 32px">
	<div class="row">
		<div class="col-sm-6 text-center">
			<p>LIKE US ON FB</p>
			<a href="#"><span class="glyphicon glyphicon-thumbs-up"></span></a>
		</div>
		<div class="col-sm-6">
			<p>FOLLOW US ON TWITTER</p>
			<a href="#"><span class="glyphicon glyphicon-camera"></span></a>
		</div>
	</div>
	<a class="up-arrow" href="#mypage" data-toggle="tooltip" title="TO TOP">
		<span class="glyphicon glyphicon-chevron-up"></span>
    </a>
	<div text-center>
		<p>follow our <a href="">feeds</a></p>
		<p>your <a href="">feedback</a></p>
	</div>
</footer>
	   
	 
	   
		
			

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".up-arrow footer a[href='#mypage']").on('click', function(event) {

    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){
   
      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
    });
  });
})

</script>

</body>
</html>