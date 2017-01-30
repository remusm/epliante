<?php
class ControllerInformationUploadform extends Controller {
	private $error = array();
        private $uploadedFile;

	public function index() {
            
                if (isset($this->request->get['id'])) $idpret = $this->request->get['id'];

                // incarcam textul comenzii
                
		$this->load->model('catalog/preturi');
                if (isset($idpret)) {
                    $info_preturi = $this->model_catalog_preturi->getPreturi($idpret);
                    $textcomanda = '';
                    if (isset($info_preturi['tiplivrare'])) $textcomanda .= "\n".'Tip livrare: '.$info_preturi['tiplivrare']."\n";
                    if (isset($info_preturi['produs'])) $textcomanda .= 'Produs: '.$info_preturi['name']."\n";
                    if (isset($info_preturi['bucati'])) $textcomanda .= 'Bucati: '.$info_preturi['bucati']."\n";
                    if (isset($info_preturi['pret'])) $textcomanda .= 'Pret: '.$info_preturi['pret']." Lei\n";
                }
		$this->load->language('information/uploadform');

		$this->document->setTitle($this->language->get('heading_title'));
                                
		$this->document->addScript('catalog/view/javascript/order-form-validation.js');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                    
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->request->post['email']);
			$mail->setSender(html_entity_decode($this->request->post['name'], ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode(sprintf('Comanda e-pliante.ro '.date("d-m-Y") .', '. date("h:i")), ENT_QUOTES, 'UTF-8'));
                        
			//$mail->setText('Nume client: '.$this->request->post['name']."\r\n".'Telefon: '.$this->request->post['phone']."\r\n".'Adresa livrare: '.$this->request->post['delivery']."\r\n".'Comanda: '.$this->request->post['order']);
			
                        if (isset($_POST['newsletter'])) $newsletter = 'da';
                        else $newsletter = 'nu';
                        $mailBody = '';
                        if ($_POST['optradio'] == 'fizica') {
                            $mailBody =
                                '<b>Data:</b> '. date("d-m-Y") .', '. date("h:i").'<br>'.
                                '<b>Nume client:</b> '.$this->request->post['name'].'<br>'.
                                '<b>Telefon:</b> '.$this->request->post['phone'].'<br>'.
                                '<b>Adresa livrare:</b> '.$this->request->post['delivery'].'<br>'.
                                '<b>Comanda:</b> '.nl2br($this->request->post['order']).'<br>'.
                                '<b>Newsletter:</b> '.$newsletter.'<br>'.
                                '<b>Fisier incarcat:</b> <a href="http://e-pliante.avantondigital.com/system/storage/upload/'.$_FILES["fisier"]["name"].'">'.$_FILES["fisier"]["name"].'</a>';
                        }
                         
                        if ($_POST['optradio'] == 'juridica') {                        
                            $mailBody =                                 
                                '<b>Data:</b> '. date("d-m-Y") .', '. date("h:i").'<br>'.    
                                '<b>Nume client:</b> '.$this->request->post['name'].'<br>'.
                                '<b>Telefon:</b> '.$this->request->post['phone'].'<br>'.
                                '<b>Adresa livrare:</b> '.$this->request->post['delivery'].'<br>'.
                                '<b>Comanda:</b> '.nl2br ($this->request->post['order']).'<br>'.
                                '<b>Denumire firma:</b> '.$this->request->post['company'].'<br>'.
                                '<b>Reg. Com.:</b> '.$this->request->post['regcom'].'<br>'.
                                '<b>CIF:</b> '.$this->request->post['cif'].'<br>'.
                                '<b>Adresa:</b> '.$this->request->post['adresafirma'].'<br>'.
                                '<b>Oras:</b> '.$this->request->post['oras'].'<br>'.
                                '<b>Judet:</b> '.$this->request->post['judet'].'<br>'.
                                '<b>IBAN:</b> '.$this->request->post['iban'].'<br>'.
                                '<b>Banca:</b> '.$this->request->post['banca'].'<br>'.
                                '<b>Newsletter:</b> '.$newsletter.'<br>'.
                                '<b>Fisier incarcat:</b> <a href="http://e-pliante.avantondigital.com/system/storage/upload/'.$_FILES["fisier"]["name"].'">'.$_FILES["fisier"]["name"].'</a>';
                        }
                        $mail->setHtml($mailBody);
                        
                        try {
                            $mail->send();
                            // Set a 200 (okay) response code.                            
                            echo 'Comanda ta a fost trimisa cu succes!';
                        }
                          //catch exception
                        catch(Exception $e) {
                            // Set a 500 (internal server error) response code.
                            http_response_code(500);
                            echo "Datorita unei erori mesajul dumneavoastra nu s-a trimis. Va rugam sa incercati mai tarziu. Va multumim.";
                            // delete the file if the email is not sent
                            if (isset($this->uploadedFile))
                                unlink(DIR_UPLOAD.$this->uploadedFile);
                        }
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/uploadform')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_location'] = $this->language->get('text_location');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_open'] = $this->language->get('text_open');
		$data['text_comment'] = $this->language->get('text_comment');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_order'] = $this->language->get('entry_order');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_delivery'] = $this->language->get('entry_delivery');
		$data['entry_order'] = $this->language->get('entry_order');
		$data['entry_company'] = $this->language->get('entry_company');
                $data['entry_regcom']  = $this->language->get('entry_regcom');
                $data['entry_cif']  = $this->language->get('entry_cif');
                $data['entry_adresafirma']  = $this->language->get('entry_adresafirma');
                $data['entry_oras']  = $this->language->get('entry_oras');
                $data['entry_judet']  = $this->language->get('entry_judet');
                $data['entry_iban']  = $this->language->get('entry_iban');
                $data['entry_banca']  = $this->language->get('entry_banca');
                $data['entry_fisier']  = $this->language->get('entry_fisier');

		$data['button_map'] = $this->language->get('button_map');

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
                
		if (isset($this->error['order'])) {
			$data['error_order'] = $this->error['order'];
		} else {
			$data['error_order'] = '';
		}
                                
		if (isset($this->error['phone'])) {
			$data['error_phone'] = $this->error['phone'];
		} else {
			$data['error_phone'] = '';
		}

		if (isset($this->error['email'])) {
			$data['error_email'] = $this->error['email'];
		} else {
			$data['error_email'] = '';
		}

		if (isset($this->error['delivery'])) {
			$data['error_delivery'] = $this->error['delivery'];
		} else {
			$data['error_delivery'] = '';
		}

		if (isset($this->error['order'])) {
			$data['error_order'] = $this->error['order'];
		} else {
			$data['error_order'] = '';
		}    
                                
		if (isset($this->error['company'])) {
			$data['error_company'] = $this->error['company'];
		} else {
			$data['error_company'] = '';
		}            
                
		if (isset($this->error['regcom'])) {
			$data['error_regcom'] = $this->error['regcom'];
		} else {
			$data['error_regcom'] = '';
		}       
                
		if (isset($this->error['cif'])) {
			$data['error_cif'] = $this->error['cif'];
		} else {
			$data['error_cif'] = '';
		}       
                
		if (isset($this->error['adresafirma'])) {
			$data['error_adresafirma'] = $this->error['adresafirma'];
		} else {
			$data['error_adresafirma'] = '';
		}    
                
		if (isset($this->error['oras'])) {
			$data['error_oras'] = $this->error['oras'];
		} else {
			$data['error_oras'] = '';
		} 
                
		if (isset($this->error['judet'])) {
			$data['error_judet'] = $this->error['judet'];
		} else {
			$data['error_judet'] = '';
		}
                
		if (isset($this->error['iban'])) {
			$data['error_iban'] = $this->error['iban'];
		} else {
			$data['error_iban'] = '';
		}
                
		if (isset($this->error['banca'])) {
			$data['error_banca'] = $this->error['banca'];
		} else {
			$data['error_banca'] = '';
		}
                
                if (isset($this->error['fisier'])) {
			$data['error_fisier'] = $this->error['fisier'];
		} else {
			$data['error_fisier'] = '';
		}

		$data['button_submit'] = $this->language->get('button_submit');

		$data['action'] = $this->url->link('information/uploadform', '', true);

		$this->load->model('tool/image');

		if ($this->config->get('config_image')) {
			$data['image'] = $this->model_tool_image->resize($this->config->get('config_image'), $this->config->get($this->config->get('config_theme') . '_image_location_width'), $this->config->get($this->config->get('config_theme') . '_image_location_height'));
		} else {
			$data['image'] = false;
		}

		$data['store'] = $this->config->get('config_name');
		$data['address'] = nl2br($this->config->get('config_address'));
		$data['geocode'] = $this->config->get('config_geocode');
		$data['geocode_hl'] = $this->config->get('config_language');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['fax'] = $this->config->get('config_fax');
		$data['open'] = nl2br($this->config->get('config_open'));
		$data['comment'] = $this->config->get('config_comment');

		$data['locations'] = array();

		$this->load->model('localisation/location');

		foreach((array)$this->config->get('config_location') as $location_id) {
			$location_info = $this->model_localisation_location->getLocation($location_id);

			if ($location_info) {
				if ($location_info['image']) {
					$image = $this->model_tool_image->resize($location_info['image'], $this->config->get($this->config->get('config_theme') . '_image_location_width'), $this->config->get($this->config->get('config_theme') . '_image_location_height'));
				} else {
					$image = false;
				}

				$data['locations'][] = array(
					'location_id' => $location_info['location_id'],
					'name'        => $location_info['name'],
					'address'     => nl2br($location_info['address']),
					'geocode'     => $location_info['geocode'],
					'telephone'   => $location_info['telephone'],
					'fax'         => $location_info['fax'],
					'image'       => $image,
					'open'        => nl2br($location_info['open']),
					'comment'     => $location_info['comment']
				);
			}
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} else {
			$data['name'] = $this->customer->getFirstName();
		}   
                
		if (isset($this->request->post['phone'])) {
			$data['phone'] = $this->request->post['phone'];
		} else {
			$data['phone'] = '';
		}           

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = $this->customer->getEmail();
		}

		if (isset($this->request->post['delivery'])) {
			$data['delivery'] = $this->request->post['delivery'];
		} else {
			$data['delivery'] = '';
		}
                
		if (isset($this->request->post['order'])) {
			$data['order'] = $this->request->post['order'];
		} else {
                    if (isset($textcomanda))
			$data['order'] = $textcomanda;
                    else $data['order'] = '';
		}  
                
		if (isset($this->request->post['company'])) {
			$data['company'] = $this->request->post['company'];
		} else {
			$data['company'] = '';
		}  
                
		if (isset($this->request->post['regcom'])) {
			$data['regcom'] = $this->request->post['regcom'];
		} else {
			$data['regcom'] = '';
		} 
                
		if (isset($this->request->post['cif'])) {
			$data['cif'] = $this->request->post['cif'];
		} else {
			$data['cif'] = '';
		} 
                
		if (isset($this->request->post['adresafirma'])) {
			$data['adresafirma'] = $this->request->post['adresafirma'];
		} else {
			$data['adresafirma'] = '';
		} 
                
		if (isset($this->request->post['oras'])) {
			$data['oras'] = $this->request->post['oras'];
		} else {
			$data['oras'] = '';
		}
                
		if (isset($this->request->post['judet'])) {
			$data['judet'] = $this->request->post['judet'];
		} else {
			$data['judet'] = '';
		}
                
		if (isset($this->request->post['iban'])) {
			$data['iban'] = $this->request->post['iban'];
		} else {
			$data['iban'] = '';
		}
		if (isset($this->request->post['banca'])) {
			$data['banca'] = $this->request->post['banca'];
		} else {
			$data['banca'] = '';
		}
                
		if (isset($this->request->post['fisier'])) {
			$data['fisier'] = $this->request->post['fisier'];
		} else {
			$data['fisier'] = '';
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
                
                if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
                    if (isset($this->error['error_name']) || isset($this->error['error_email']) || isset($this->error['error_phone']) || isset($this->error['error_delivery']) || isset($this->error['order']) || isset($this->error['error_fisier'])) {  
                        http_response_code(400);                           
                        $this->response->setOutput($this->load->view('information/uploadform', $data));
                    }
                }
                else {
                    $this->response->setOutput($this->load->view('information/uploadform', $data));
                }
	}

	protected function upload() {
            $target_dir = DIR_UPLOAD;
            $target_file = $target_dir . basename($_FILES["fisier"]["name"]);
            $uploadOk = 1;
            $fileTypes = array("CDR", "AI", "PSD", "PDF", "EPS", "TIFF", "ZIP", "RAR", "cdr", "ai", "psd", "pdf", "eps", "tiff", "zip", "rar");
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            // Check if file already exists
            /*if (file_exists($target_file)) {
                $this->error['fisier'] = "Eroare: Fisierul exista deja.";
                $uploadOk = 0;
            }*/
            
            // Check file size
            if (isset($_FILES["fisier"]["size"])) {
                if ($_FILES["fisier"]["size"] > 419430400) {
                    $this->error['fisier'] = "Eroare: Dimensiunea fisierului este prea mare, limita admisa este de 50MB";
                    $uploadOk = 0;
                }
            }
            
            // Allow certain file formats
            if (!in_array($imageFileType, $fileTypes) ) {
                $this->error['fisier'] = "Eroare: Tipurile de fisiere permise sunt: CDR, AI, PSD, PDF, EPS, TIFF, ZIP, RAR.";
                $uploadOk = 0;
            }
                        
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["fisier"]["tmp_name"], $target_file)) {
                    //$this->error['fisier'] = "Fisierul ". basename( $_FILES["fisier"]["name"]). " a fost incarcat pe serverul nostru si urmeaza sa fie verificat.";
                    $this->uploadedFile = basename( $_FILES["fisier"]["name"]);
                    return 1;
                } 
                else {
                    $this->error['fisier'] = "Eroare: Fisierul nu se poate incarca pe server. Va rugam sa incercati mai tarziu.";
                    return 0;
                }
            }        
        }
        
	protected function validate() {
            $validForm = 1;
            if(isset($this->request->post['name'])) {
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
                        $validForm = 2;
		}
            }
            if(isset($this->request->post['phone'])) {
                if($this->request->post['phone']) {
                    if ((utf8_strlen($this->request->post['phone']) < 3) || (utf8_strlen($this->request->post['phone']) > 15)) {
                            $this->error['phone'] = $this->language->get('error_phone');
                            $validForm = 3;
                    }
                }
            }
            if(isset($this->request->post['email'])) {
		if (!filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
                        $validForm = 4;
		}
            }
            if(isset($this->request->post['delivery'])) {
		if ((utf8_strlen($this->request->post['delivery']) < 10) || (utf8_strlen($this->request->post['delivery']) > 3000)) {
			$this->error['delivery'] = $this->language->get('error_delivery');
                        $validForm = 5;
		}
            }
            if(isset($this->request->post['order'])) {
		if ((utf8_strlen($this->request->post['order']) < 10) || (utf8_strlen($this->request->post['order']) > 3000)) {
			$this->error['order'] = $this->language->get('error_order');
                        $validForm = 6;
		}
            }
            if(isset($_FILES['fisier']['error'])) {
                if($_FILES['fisier']['error'] == 4) {
                    //means there is no file uploaded
                    $this->error['fisier'] = $this->language->get('error_fisier');
                    $validForm = 7;
                    }
            }
                

            $validUpload = $this->upload($_FILES['fisier']);    
            // Captcha
            if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
                    $captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

                    if ($captcha) {
                            $this->error['captcha'] = $captcha;
                    }
            }
           
            if ($validForm == 1 && $validUpload)
                return true;
            else return false;
	}

	public function success() {
		$this->load->language('information/uploadform');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/uploadform')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_message'] = $this->language->get('text_success');

		$data['button_continue'] = $this->language->get('button_continue');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/success', $data));
	}
}
