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
        <div id="form-messages"></div>
    </div>

    <form  id="order-form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

        <div class="col-md-12">
            <p>Incercam sa facem totul cat mai simplu pentru dumneavoastra, de aceea va rugam sa completati cu atentie datele de mai jos:</p><br>
        </div>
        <fieldset id="persoana-fizica" class="col-md-6">
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
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div class="checkbox">
                    <label><input type="checkbox" value="" name="newsletter" checked>Doresc sa ma abonez la newsletter</label> 
                </div>
            </div>               
        </div>
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div class="radio" style="float: left; margin-right: 20px;">
                    <label><input type="radio" name="optradio" onclick="javascript:hideCompanyInfo();" checked value="fizica">Persoana fizica</label>
                </div>
                <div class="radio" style="float: left;">
                    <label><input type="radio" name="optradio" onclick="javascript:showCompanyInfo();" value="juridica">Persoana juridica</label>
                </div>
            </div>
        </div>    
            <script type="text/javascript">
                function showCompanyInfo() {                        
                    document.getElementById("companie").style.display = "inline";
                }
                function hideCompanyInfo() {                        
                    document.getElementById("companie").style.display = "none";
                }
            </script>

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
          <label class="col-sm-2 control-label" for="input-delivery"><?php echo $entry_delivery; ?></label>
          <div class="col-sm-10">
            <textarea name="delivery" rows="5" id="input-delivery" class="form-control"><?php echo $delivery; ?></textarea>
            <span id="delivery-error" class="error"></span>
            <?php if ($error_delivery) { ?>
            <div class="text-danger"><?php echo $error_delivery; ?></div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group required">
          <label class="col-sm-2 control-label" for="input-order"><?php echo $entry_order; ?></label>
          <div class="col-sm-10">
            <textarea name="order" rows="10" id="input-order" class="form-control"><?php echo $order; ?></textarea>
            <span id="order-error" class="error"></span>
            <?php if ($error_order) { ?>
            <div class="text-danger"><?php echo $error_order; ?></div>
            <?php } ?>
          </div>
        </div>   
        <div class="form-group required">    
            <label class="col-sm-2 control-label" for="input-order">Incarcati un fisier</label>            
            <div class="col-sm-10">                
                <input type="file" name="fisier" id="uploadFile" value="" style="border:none" data="Fisier invalid!">
                <span id="fisier-error" class="error"></span>
                <?php if ($error_fisier) { ?>
                <div class="text-danger"><?php echo $error_fisier; ?></div>
                <?php } ?>
            </div>
        </div>      
        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo $button_submit; ?>" />
            </div>
        </div>
        <?php echo $captcha; ?>
      </fieldset>
        <fieldset id="companie" class="col-md-6">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-company"><?php echo $entry_company; ?></label>
            <div class="col-sm-10">
                <input type="text" name="company" value="<?php echo $company; ?>" id="input-company" class="form-control" />
                <span id="company-error" class="error"></span>
                <?php if ($error_company) { ?>
                <div class="text-danger"><?php echo $error_company; ?></div>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-regcom"><?php echo $entry_regcom; ?></label>
            <div class="col-sm-10">
                <input type="text" name="regcom" value="<?php echo $regcom; ?>" id="input-regcom" class="form-control" />
                <span id="regcom-error" class="error"></span>
                <?php if ($error_regcom) { ?>
                <div class="text-danger"><?php echo $error_regcom; ?></div>
                <?php } ?>
            </div>
        </div>       
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-cif"><?php echo $entry_cif; ?></label>
            <div class="col-sm-10">
                <input type="text" name="cif" value="<?php echo $cif; ?>" id="input-cif" class="form-control" />
                <span id="cif-error" class="error"></span>
                <?php if ($error_cif) { ?>
                <div class="text-danger"><?php echo $error_cif; ?></div>
                <?php } ?>
            </div>
        </div>           
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-adresafirma"><?php echo $entry_adresafirma; ?></label>
            <div class="col-sm-10">
                <input type="text" name="adresafirma" value="<?php echo $adresafirma; ?>" id="input-adresafirma" class="form-control" />
                <span id="adresafirma-error" class="error"></span>
                <?php if ($error_adresafirma) { ?>
                <div class="text-danger"><?php echo $error_adresafirma; ?></div>
                <?php } ?>
            </div>
        </div>          
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-oras"><?php echo $entry_oras; ?></label>
            <div class="col-sm-10">
                <input type="text" name="oras" value="<?php echo $oras; ?>" id="input-oras" class="form-control" />
                <span id="oras-error" class="error"></span>
                <?php if ($error_oras) { ?>
                <div class="text-danger"><?php echo $error_oras; ?></div>
                <?php } ?>
            </div>
        </div>  
        <div class="form-group">
            <label class="col-sm-2 control-label steluta">Judet</label>
            <div class="col-sm-10">
                <select name="judet" class="form-control">
                    <option value="0"> - </option>
                    <option value="sector1">Bucuresti - Sector 1</option>
                    <option value="sector2">Bucuresti - Sector 2</option>
                    <option value="sector3">Bucuresti - Sector 3</option>
                    <option value="sector4">Bucuresti - Sector 4</option>
                    <option value="sector5">Bucuresti - Sector 5</option>
                    <option value="sector6">Bucuresti - Sector 6</option>
                    <option value="alba">Alba</option>
                    <option value="arad">Arad</option>
                    <option value="arges">Arges</option>
                    <option value="bacau">Bacau</option>
                    <option value="bihor">Bihor</option>
                    <option value="bistrita">Bistrita-Nasaud</option>
                    <option value="botosani">Botosani</option>
                    <option value="braila">Braila</option>
                    <option value="brasov">Brasov</option>
                    <option value="buzau">Buzau</option>
                    <option value="calarasi">Calarasi</option>
                    <option value="caras">Caras-Severin</option>
                    <option value="cluj">Cluj</option>
                    <option value="const">Constanta</option>
                    <option value="covasna">Covasna</option>
                    <option value="dambovita">Dambovita</option>
                    <option value="dolj">Dolj</option>
                    <option value="galati">Galati</option>
                    <option value="giurgiu">Giurgiu</option>
                    <option value="gorj">Gorj</option>
                    <option value="harghita">Harghita</option>
                    <option value="hunedoara">Hunedoara</option>
                    <option value="ialomita">Ialomita</option>
                    <option value="iasi">Iasi</option>
                    <option value="ilfov">Ilfov</option>
                    <option value="maramures">Maramures</option>
                    <option value="mehedinti">Mehedinti</option>
                    <option value="mures">Mures</option>
                    <option value="neamt">Neamt</option>
                    <option value="olt">Olt</option>
                    <option value="prahova">Prahova</option>
                    <option value="salaj">Salaj</option>
                    <option value="satumare">Satu Mare</option>
                    <option value="sibiu">Sibiu</option>
                    <option value="suceava">Suceava</option>
                    <option value="teleorman">Teleorman</option>
                    <option value="timis">Timis</option>
                    <option value="tulcea">Tulcea</option>
                    <option value="valcea">Valcea</option>
                    <option value="vaslui">Vaslui</option>
                    <option value="vrancea">Vrancea</option>
                </select>
            </div>
        </div>                
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-iban"><?php echo $entry_iban; ?></label>
            <div class="col-sm-10">
                <input type="text" name="iban" value="<?php echo $iban; ?>" id="input-iban" class="form-control" />
                <span id="iban-error" class="error"></span>
                <?php if ($error_iban) { ?>
                <div class="text-danger"><?php echo $error_iban; ?></div>
                <?php } ?>
            </div>
        </div>  
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-banca"><?php echo $entry_banca; ?></label>
            <div class="col-sm-10">
                <input type="text" name="banca" value="<?php echo $banca; ?>" id="input-banca" class="form-control" />
                <span id="banca-error" class="error"></span>
                <?php if ($error_banca) { ?>
                <div class="text-danger"><?php echo $error_banca; ?></div>
                <?php } ?>                
            </div>
        </div>
        <?php echo $captcha; ?>
      </fieldset>            
      <div class="col-md-12">          
        <p>Cerinte tehnice pentru fisierele uploadate de dvs:</p><p><br></p><p>- Fisierele trimise de dvs nu trebuie sa depaseasca 50 Mb. Daca aveti fisiere mai mari va rugam sa ne contactati sau sa trimiteti comanda printr-un site de file transfer.</p><p>- Doar urmatoarele formate sunt acceptate pentru upload: CDR, AI, PSD, PDF, EPS, TIFF, ZIP, RAR. Nu incercati alte formate gen JPG, DOC, PPS, etc pentru ca nu le veti putea trimite.</p><p>- Rezolutia minima: 300 dpi.</p><p>- Layout-ul trebuie sa contina un BLEED de 3mm pe contur fata de formatul finit dorit.</p><p>- Textele si pozele folosite in layout sa fie convertite la CMYK.</p><p>- De asemenea, fonturile trebuiesc convertite la curbe.</p><p><br></p>

        <p>ATENTIE!</p><p>Tiparim exact fisierul pe care ni-l trimiteti! De aceea va rugam sa verificati cerintele tehnice de mai sus inainte de a ne trimite fisierele.&nbsp;</p><p>Multumim pentru intelegere.</p>

      </div>
    </form>
   
    <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
