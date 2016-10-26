<?php
class ControllerLocalisationHolidaymaster extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('localisation/holidaymaster');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/holidaymaster');

        $this->getList();

       	}

    //weekdaymaster start
public function weekdays(){

    $this->load->language('localisation/holidaymaster');

    $this->document->setTitle($this->language->get('heading_title_week'));

    $this->load->model('setting/setting');

    $this->data['arraycheckboxvalue']=array();

    if($this->config->get('weekdays_weekdayslist') != ''){
        $this->data['arraycheckboxvalue']=explode(",",$this->config->get('weekdays_weekdayslist'));//value take to checkbox checked or nt using convert array values
    }

    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

        $array=$this->request->post['weekdays'];

        $weekdaysconvert = implode(",",$array);

        $this->model_setting_setting->editSetting('weekdays', array('weekdays_weekdayslist'=>$weekdaysconvert));

        $this->session->data['success'] = $this->language->get('text_success_week');

        $this->redirect($this->url->link('localisation/holidaymaster/weekdays', 'token=' . $this->session->data['token'], 'SSL'));
    }

    $this->data['heading_title_week'] = $this->language->get('heading_title_week');

    $this->data['text_addweekdays_week'] = $this->language->get('text_addweekdays_week');
    $this->data['text_home_week'] = $this->language->get('text_home_week');
    $this->data['text_success_week'] = $this->language->get('text_success_week');

    $this->data['entry_admin'] = $this->language->get('entry_admin');
    $this->data['entry_status'] = $this->language->get('entry_status');

    $this->data['button_save'] = $this->language->get('button_save');
    $this->data['button_cancel'] = $this->language->get('button_cancel');

    if (isset($this->error['warning'])) {
        $this->data['error_warning'] = $this->error['warning'];
    } else {
        $this->data['error_warning'] = '';
    }

    $this->data['breadcrumbs'] = array();

    $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('text_home_week'),
        'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => false
    );

    $this->data['breadcrumbs'][] = array(
        'text' => $this->language->get('heading_title_week'),
        'href' => $this->url->link('localisation/holidaymaster/weekdays', 'token=' . $this->session->data['token'], 'SSL'),
        'separator' => '::'
    );

    $this->data['action'] = $this->url->link('localisation/holidaymaster/weekdays', 'token=' . $this->session->data['token'], 'SSL');

    $this->data['cancel'] = $this->url->link('localisation/holidaymaster/weekdays', 'token=' . $this->session->data['token'], 'SSL');

    if (isset($this->request->post)) {
        $this->data['weekdays'] = $this->request->post;
    } else {
        $this->data['weekdays'] = $this->config->get;

    }




    /*$this->data['header'] = $this->load->controller('common/header');
    $this->data['column_left'] = $this->load->controller('common/column_left');
    $this->data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('localisation/weekdaymaster_form.tpl', $data));*/

    $this->template = 'localisation/weekdaymaster_form.tpl';
    $this->children = array(
        'common/header',
        'common/footer',
    );
    $this->response->setOutput($this->render());



    //weekdaymaster end

}

        public function add() {

		$this->load->language('localisation/holidaymaster');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/holidaymaster');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_localisation_holidaymaster->addHoliday($this->request->post);

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

			$this->redirect($this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/holidaymaster');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/holidaymaster');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_holidaymaster->editHoliday($this->request->get['holiday_id'], $this->request->post);

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

			$this->redirect($this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/holidaymaster');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/holidaymaster');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $holiday_id) {
				$this->model_localisation_holidaymaster->deleteHoliday($holiday_id);
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

			$this->redirect($this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => '::'
		);

		$this->data['add'] = $this->url->link('localisation/holidaymaster/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('localisation/holidaymaster/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['holidaymaster'] = array();

		$filter_data = array(
			'holiday_name'  => $sort,
			'holiday_date' => $order,
			'is_recursive' => ($page - 1) * $this->config->get('config_limit_admin')

		);

        $records_total = $this->model_localisation_holidaymaster->getTotalrecords();
        //print_r($language_total);exit;

            $results = $this->model_localisation_holidaymaster->getHolidays($filter_data);

            foreach ($results as $result) {
			$this->data['holidaymaster'][] = array(
                $date = str_replace('/', '-',$result['holiday_date']),
                $datevaluechange = date('d-m-Y', strtotime($date)),
				'holiday_id' => $result['holiday_id'],
				'holiday_name'        => $result['holiday_name'] . (($result['holiday_date'] == $this->config->get('config_language')) ? $this->language->get('text_default') : null),
				'holiday_date'        => $datevaluechange,
				'is_recursive'  => $result['is_recursive'],
				'created_on'  => $result['created_on'],
				'last_edited_on'  => $result['last_edited_on'],
				'edit'        => $this->url->link('localisation/holidaymaster/edit', 'token=' . $this->session->data['token'] . '&holiday_id=' . $result['holiday_id'] . $url, 'SSL')
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_list'] = $this->language->get('text_list');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_confirm'] = $this->language->get('text_confirm');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_code'] = $this->language->get('column_code');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');
        $this->data['text_addholidaymaster'] = $this->language->get('text_addholidaymaster');
        $this->data['text_holidayname'] = $this->language->get('text_holidayname');
        $this->data['text_holidaydate'] = $this->language->get('text_holidaydate');
        $this->data['text_isrecursive'] = $this->language->get('text_isrecursive');
        $this->data['text_createdon'] = $this->language->get('text_createdon');
        $this->data['text_lasteditedon'] = $this->language->get('text_lasteditedon');

		$this->data['button_add'] = $this->language->get('button_add');
		$this->data['button_edit'] = $this->language->get('button_edit');
		$this->data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$this->data['selected'] = (array)$this->request->post['selected'];
		} else {
			$this->data['selected'] = array();
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

		$this->data['sort_name'] = $this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_code'] = $this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $records_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		//$this->data['results'] = sprintf($this->language->get('text_pagination'), ($records_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($records_total - $this->config->get('config_limit_admin'))) ? $records_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $records_total, ceil($records_total / $this->config->get('config_limit_admin')));

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
       /* $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/holidaymaster_list.tpl', $data));*/

        $this->template = 'localisation/holidaymaster_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());

    }

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_form'] = !isset($this->request->get['language_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_addholidaymaster'] = $this->language->get('text_addholidaymaster');

        $this->data['text_holidayname'] = $this->language->get('text_holidayname');
        $this->data['text_holidaydate'] = $this->language->get('text_holidaydate');
        $this->data['text_isrecursive'] = $this->language->get('text_isrecursive');
        $this->data['text_createdon'] = $this->language->get('text_createdon');
        $this->data['text_lasteditedon'] = $this->language->get('text_lasteditedon');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_code'] = $this->language->get('entry_code');
		$this->data['entry_locale'] = $this->language->get('entry_locale');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_directory'] = $this->language->get('entry_directory');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');

		$this->data['help_code'] = $this->language->get('help_code');
		$this->data['help_locale'] = $this->language->get('help_locale');
		$this->data['help_image'] = $this->language->get('help_image');
		$this->data['help_directory'] = $this->language->get('help_directory');
		$this->data['help_status'] = $this->language->get('help_status');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}

        if (isset($this->error['date'])) {
            $this->data['error_date'] = $this->error['date'];
        } else {
            $this->data['error_date'] = '';
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

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => '::'
		);

		if (!isset($this->request->get['holiday_id'])) {
			$this->data['action'] = $this->url->link('localisation/holidaymaster/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('localisation/holidaymaster/edit', 'token=' . $this->session->data['token'] . '&holiday_id=' . $this->request->get['holiday_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('localisation/holidaymaster', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['holiday_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$holiday_info = $this->model_localisation_holidaymaster->getHoliday($this->request->get['holiday_id']);
		}

		if (isset($this->request->post['holiday_name'])) {
			$this->data['holiday_name'] = $this->request->post['holiday_name'];
		} elseif (!empty($holiday_info)) {
			$this->data['holiday_name'] = $holiday_info['holiday_name'];
		} else {
			$this->data['holiday_name'] = '';
		}


        if (isset($this->request->post['holiday_date'])) {
            $this->data['holiday_date'] = $this->request->post['holiday_date'];
        } elseif (!empty($holiday_info)) {

            $date = str_replace('/', '-',$holiday_info['holiday_date']);
            $datevaluechange = date('d-m-Y', strtotime($date));

            $this->data['holiday_date'] = $datevaluechange;
        } else {
            $this->data['holiday_date'] = '';
        }

        if (isset($this->request->post['is_recursive'])) {
            $this->data['is_recursive'] = $this->request->post['is_recursive'];
        } elseif (!empty($holiday_info)) {
            $this->data['is_recursive'] = $holiday_info['is_recursive'];
        } else {
            $this->data['is_recursive'] = '';
        }

		/*$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/holidaymaster_form.tpl', $data));*/


        $this->template = 'localisation/holidaymaster_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer',
        );
        $this->response->setOutput($this->render());

    }

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/holidaymaster')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		 if ($this->request->post['holiday_name']=="") {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ($this->request->post['holiday_date']=="") {
			$this->error['date'] = $this->language->get('error_date');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/holidaymaster')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/store');
		$this->load->model('sale/order');

		return !$this->error;
	}
    //weekdays master valid start

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'localisation/holidaymaster')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    //weekdays master valid end
}
