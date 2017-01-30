<?php echo $header; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5688.647450539096!2d26.04450004718616!3d44.52900375040855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b2035a5a581391%3A0xfd07081c68ee748a!2sMaster+Print+Super+Offset!5e0!3m2!1sro!2sro!4v1485262781318" width="100%" height="254" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    
    <div class="col-md-12">
        <h1 class="page-title"><?php echo $heading_title; ?></h1>        
        <hr class="divider-line-2">
    </div>
    <div class="col-md-6">
        <p>Site-ul www.e-pliante.ro este un domeniu care apartine companiei:&nbsp;</p>
        <p><br></p>
        <p>SC. STRIKE ADVERTISING SRL&nbsp;</p>
        <p>Str. Vasile Gherghel 86, sector 1 (sediul social)&nbsp;</p>
        <p>Tel: 021-224.33.11&nbsp;</p>
        <p>Mobil: 0722.306.463&nbsp;</p>
        <p><br></p>
        <p>E-mail: office@e-pliante.ro&nbsp;</p>
        <p>Persoana de contact: Razvan Nitulescu&nbsp;</p>
        <p><br></p>
        <p>Ne puteti trimite un mesaj pentru sugestii si comentarii folosind formularul de contact.</p>
    </div>
    <div class="col-md-6">
        <div id="form-messages"></div>
        <form  id="contact-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
          <fieldset>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
              <div class="col-sm-10">
                <input type="text" name="name" value="<?php echo $name; ?>" id="input-name" class="form-control" />
                <span id="name-error" class="error"></span>
                <?php if ($error_name) { ?>
                <div class="text-danger"><?php echo $error_name; ?></div>
                <?php } ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-company"><?php echo $entry_company; ?></label>
              <div class="col-sm-10">
                <input type="text" name="company" value="<?php echo $company; ?>" id="input-company" class="form-control" />
                <?php if ($error_company) { ?>
                <div class="text-danger"><?php echo $error_company; ?></div>
                <?php } ?>
              </div>
            </div>              
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
              <div class="col-sm-10">
                <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" />
                <span id="email-error" class="error"></span>
                <?php if ($error_email) { ?>
                <div class="text-danger"><?php echo $error_email; ?></div>
                <?php } ?>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-phone"><?php echo $entry_phone; ?></label>
              <div class="col-sm-10">
                <input type="text" name="phone" value="<?php echo $phone; ?>" id="input-phone" class="form-control" />
                <span id="phone-error" class="error"></span>
                <?php if ($error_phone) { ?>
                <div class="text-danger"><?php echo $error_phone; ?></div>
                <?php } ?>
              </div>
            </div> 
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-enquiry"><?php echo $entry_enquiry; ?></label>
              <div class="col-sm-10">
                <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"><?php echo $enquiry; ?></textarea>
                <span id="enquiry-error" class="error"></span>
                <?php if ($error_enquiry) { ?>
                <div class="text-danger"><?php echo $error_enquiry; ?></div>
                <?php } ?>
              </div>
            </div>
            <?php echo $captcha; ?>
          </fieldset>
          <div class="buttons">
            <div class="pull-right">
              <div id="loader" class="loader"></div>
              <input class="btn send-btn" type="submit" value="<?php echo $button_submit; ?>" />  
            </div>
          </div>
        </form>
    </div>
    <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
