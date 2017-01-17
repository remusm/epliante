<?php echo $header; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5700.428044055025!2d26.121251159682945!3d44.408253767757685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xda4af20ea594b00b!2sRestaurant+Odeon!5e0!3m2!1sro!2sro!4v1484592078086" width="100%" height="254" frameborder="0" style="border:0" allowfullscreen></iframe>
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
    <div class="col-md-12">
        <p>Incercam sa facem totul cat mai simplu pentru dumneavoastra, de aceea va rugam sa completati cu atentie datele de mai jos:</p><br>
    </div>

        <div id="form-messages"></div>
        <form  id="contact-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <fieldset class="col-md-6">
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
            <fieldset class="col-md-6">
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
          <div class="col-md-12 buttons">
            <div>
              <input class="btn btn-primary" type="submit" value="<?php echo $button_submit; ?>" />
            </div><br>            
            <p>Cerinte tehnice pentru fisierele uploadate de dvs:</p><p><br></p><p>- Fisierele trimise de dvs nu trebuie sa depaseasca 50 Mb. Daca aveti fisiere mai mari va rugam sa ne contactati sau sa trimiteti comanda printr-un site de file transfer.</p><p>- Doar urmatoarele formate sunt acceptate pentru upload: CDR, AI, PSD, PDF, EPS, TIFF, ZIP, RAR. Nu incercati alte formate gen JPG, DOC, PPS, etc pentru ca nu le veti putea trimite.</p><p>- Rezolutia minima: 300 dpi.</p><p>- Layout-ul trebuie sa contina un BLEED de 3mm pe contur fata de formatul finit dorit.</p><p>- Textele si pozele folosite in layout sa fie convertite la CMYK.</p><p>- De asemenea, fonturile trebuiesc convertite la curbe.</p><p><br></p>
    
            <p>ATENTIE!</p><p>Tiparim exact fisierul pe care ni-l trimiteti! De aceea va rugam sa verificati cerintele tehnice de mai sus inainte de a ne trimite fisierele.&nbsp;</p><p>Multumim pentru intelegere.</p>

          </div>
        </form>
   
    <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
