<script type="text/javascript" src="plugins/idle/jquery.idle.js"></script>
<script>
$(document).ready(function() {
	
$(document).idle({
  onIdle: function(){
    var url      = window.location.href;
    window.location = "../login/logout.php?url="+url;
  },
  idle: 1800000
});

localStorage.clear();
});
</script>
<script language="javascript">
	jQuery(document).ready(function($){

$('.live-search-list li').each(function(){
$(this).attr('data-search-term', $(this).text().toLowerCase());
});

$('.live-search-box').on('keyup', function(){

var searchTerm = $(this).val().toLowerCase();

    $('.live-search-list li').each(function(){

        if ($(this).filter('[data-search-term *= ' + searchTerm + ']').length > 0 || searchTerm.length < 1) {
            $(this).show();
			$(this).parent().addClass('menu-open');
			$(this).parent().css('display','block');
			$(this).parent().parent().addClass('active');
        } else {
			$('li.treeview').removeClass('active');
			$('ul.treeview-menu.menu-open').removeClass('menu-open');
			$('ul.treeview-menu.menu-open').css('display','none');
            $(this).hide();
        }

    });

});

});
</script>