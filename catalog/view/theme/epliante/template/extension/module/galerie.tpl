</div>
<div class="galerie">
  <?php foreach ($banners as $banner) { ?>
  <div class="col-xs-6 col-sm-4 col-md-2 img-margin">
      <a href="<?php echo $banner['image']; ?>" title="<?php echo $banner['title']; ?>"> 
          <img src="<?php echo $banner['simage']; ?>" class="img-responsive imagine-galerie" title="<?php echo $banner['title']; ?>" alt="<?php echo $banner['title']; ?>" />
      </a>
  </div>
  <?php } ?>
</div>          
<script type="text/javascript"><!--          
          $(document).ready(function() {
	$('.galerie').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
});
//--></script>