<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
     
	 </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <?php echo include_resource('js/bootstrap.js', 2); ?>

  </body>
  	 <script>
		$(document).click(function(){
			var has = $("#cur_column").hasClass("open");
			if(has != true){
				$("#cur_column").addClass("open");
			}
		});
	 </script>
</html>