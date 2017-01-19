<?php
class ControllerCatalogPreturi extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/preturi');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/preturi');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/preturi');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/preturi');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_preturi->addPreturi($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/preturi');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/preturi');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_preturi->editPreturi($this->request->get['preturi_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/preturi');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/preturi');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $preturi_id) {
				$this->model_catalog_preturi->deletePreturi($preturi_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('catalog/preturi/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('catalog/preturi/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['listapreturi'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$preturi_total = $this->model_catalog_preturi->getTotalListapreturi();

		$results = $this->model_catalog_preturi->getListapreturi($filter_data);

		foreach ($results as $result) {
			$data['listapreturi'][] = array(
				'preturi_id' => $result['preturi_id'],
				'name'            => $result['name'],
				'sort_order'      => $result['sort_order'],
				'edit'            => $this->url->link('catalog/preturi/edit', 'token=' . $this->session->data['token'] . '&preturi_id=' . $result['preturi_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_sort_order'] = $this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $preturi_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($preturi_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($preturi_total - $this->config->get('config_limit_admin'))) ? $preturi_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $preturi_total, ceil($preturi_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/preturi_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['preturi_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_tiplivrare'] = $this->language->get('tiplivrare');
		$data['entry_textcomanda'] = $this->language->get('textcomanda');
		$data['entry_produs'] = $this->language->get('produs');
		$data['entry_bucati'] = $this->language->get('bucati');
		$data['entry_pret'] = $this->language->get('pret');
		/*$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_image'] = $this->language->get('entry_image');*/
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');

		//$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_tiplivrare'] = $this->language->get('help_tiplivrare');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
                /*
		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}
                */
                 
		if (isset($this->error['tiplivrare'])) {
			$data['error_tiplivrare'] = $this->error['tiplivrare'];
		} else {
			$data['error_tiplivrare'] = '';
		}
                
		if (isset($this->error['textcomanda'])) {
			$data['error_textcomanda'] = $this->error['textcomanda'];
		} else {
			$data['error_textcomanda'] = '';
		}
                
		if (isset($this->error['produs'])) {
			$data['error_produs'] = $this->error['produs'];
		} else {
			$data['error_produs'] = '';
		}
                
		if (isset($this->error['bucati'])) {
			$data['error_bucati'] = $this->error['bucati'];
		} else {
			$data['error_bucati'] = '';
		}
                
		if (isset($this->error['pret'])) {
			$data['error_pret'] = $this->error['pret'];
		} else {
			$data['error_pret'] = '';
		}
                
                
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['preturi_id'])) {
			$data['action'] = $this->url->link('catalog/preturi/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('catalog/preturi/edit', 'token=' . $this->session->data['token'] . '&preturi_id=' . $this->request->get['preturi_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('catalog/preturi', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['preturi_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$preturi_info = $this->model_catalog_preturi->getPreturi($this->request->get['preturi_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($preturi_info)) {
			$data['name'] = $preturi_info['name'];
		} else {
			$data['name'] = '';
		}
                /*
		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['preturi_store'])) {
			$data['preturi_store'] = $this->request->post['preturi_store'];
		} elseif (isset($this->request->get['preturi_id'])) {
			$data['preturi_store'] = $this->model_catalog_preturi->getPreturiStores($this->request->get['preturi_id']);
		} else {
			$data['preturi_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($preturi_info)) {
			$data['keyword'] = $preturi_info['keyword'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($preturi_info)) {
			$data['image'] = $preturi_info['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($preturi_info) && is_file(DIR_IMAGE . $preturi_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($preturi_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
                */
                
                               
		if (isset($this->request->post['tiplivrare'])) {
			$data['tiplivrare'] = $this->request->post['tiplivrare'];
		} elseif (!empty($preturi_info)) {
			$data['tiplivrare'] = $preturi_info['tiplivrare'];
		} else {
			$data['tiplivrare'] = '';
		}
                                 
		if (isset($this->request->post['textcomanda'])) {
			$data['textcomanda'] = $this->request->post['textcomanda'];
		} elseif (!empty($preturi_info)) {
			$data['textcomanda'] = $preturi_info['textcomanda'];
		} else {
			$data['textcomanda'] = '';
		}
                
		if (isset($this->request->post['produs'])) {
			$data['produs'] = $this->request->post['produs'];
		} elseif (!empty($preturi_info)) {
			$data['produs'] = $preturi_info['produs'];
		} else {
			$data['produs'] = '';
		}
                
		if (isset($this->request->post['bucati'])) {
			$data['bucati'] = $this->request->post['bucati'];
		} elseif (!empty($preturi_info)) {
			$data['bucati'] = $preturi_info['bucati'];
		} else {
			$data['bucati'] = '';
		}
                
		if (isset($this->request->post['pret'])) {
			$data['pret'] = $this->request->post['pret'];
		} elseif (!empty($preturi_info)) {
			$data['pret'] = $preturi_info['pret'];
		} else {
			$data['pret'] = '';
		}
                
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($preturi_info)) {
			$data['sort_order'] = $preturi_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/preturi_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/preturi')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
                /*
		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['preturi_id']) && $url_alias_info['query'] != 'preturi_id=' . $this->request->get['preturi_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['preturi_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}
                */
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/preturi')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/*$this->load->model('catalog/product');

		foreach ($this->request->post['selected'] as $manufacturer_id) {
			$product_total = $this->model_catalog_product->getTotalProductsByManufacturerId($manufacturer_id);

			if ($product_total) {
				$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
			}
		}*/

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/preturi');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_preturi->getListapreturi($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'preturi_id' => $result['preturi_id'],
					'name'            => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}