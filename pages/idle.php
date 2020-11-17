<script type="text/javascript" src="../plugins/idle/jquery.idle.js"></script>
<script>
$(document).ready(function() {
	
$(document).idle({
  onIdle: function(){
	  var url      = window.location.href;
    window.location = "../../login/logout.php?url="+url;
  },
  idle: 1800000
});


localStorage.clear();
});
</script>