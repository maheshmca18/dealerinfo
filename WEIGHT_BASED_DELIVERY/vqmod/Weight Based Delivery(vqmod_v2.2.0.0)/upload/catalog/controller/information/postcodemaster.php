<?php

class ControllerInformationPostcodemaster extends Controller {

    public function index(){

        $data=array();
//pagination valid
        $url = '';

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }


        $this->load->model('localisation/postcodemaster');

        $postcode_check=$this->model_localisation_postcodemaster->getPostcodelist(($page - 1) * 10, 10);

        $data['postcodemaster'] = array();

        foreach ($postcode_check as $postcode) {
            $data['postcodemaster'][$postcode['postcode']][] = array(
                //'postcode_id' => $postcode['postcode_id'],
                'postcode'        => $postcode['postcode'],
                'condition_type'        => $postcode['condition_type'],
                'min_weight'  => $postcode['min_weight'],
                'max_weight'  => $postcode['max_weight'],
                'shipping_charge'  => $postcode['shipping_charge']

            );
        }


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

       // $this->load->model('localisation/postcodemaster');

        $postcode_totalrecords=$this->model_localisation_postcodemaster->getTotalrecords();//count total records in db
//pagination valid
        $pagination = new Pagination();
        $pagination->total = $postcode_totalrecords;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('information/postcodemaster', 'page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($postcode_totalrecords) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($postcode_totalrecords - 10)) ? $postcode_totalrecords : ((($page - 1) * 10) + 10), $postcode_totalrecords, ceil($postcode_totalrecords / 10));



        
            $this->response->setOutput($this->load->view('information/postcodemaster_list',$data));
        



    }







}
