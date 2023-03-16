<?php

/* * ***************************************************************************
 *                                                                             *
 *            Module tích hợp thanh toán qua VNPAYMENT                         *
 * Phiên bản : 1.0                                                             *
 * Module được phát triển bởi IT VNPAY                                         *
 * Chức năng :                                                                 *
 * - Tích hợp thanh toán qua vnpayment.vn cho các merchant site có đăng ký API.*
 * - Gửi thông tin thanh toán tới vnpayment.vn để xử lý việc thanh toán.       *
 * @author thangnh                                                             *
 * ******************************************************************************
 * Xin hãy đọc kĩ tài liệu tích hợp trên trang                                 *
 * http://vnpayment.vn/                                                        *
 *                                                                             *
 * *************************************************************************** */

class Controllerpaymentvnpayment extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('payment/vnpayment');

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

            $this->model_setting_setting->editSetting('vnpayment', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
        }
        $this->document->setTitle($this->language->get('heading_title'));
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_payment'] = $this->language->get('text_payment');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['heading_title'] = $this->language->get('heading_title');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['entry_access_code'] = $this->language->get('entry_access_code');
        $data['entry_url'] = $this->language->get('entry_url');
        $data['entry_types'] = $this->language->get('entry_types');
        $data['entry_currency'] = $this->language->get('entry_currency');
        $data['entry_secretkey'] = $this->language->get('entry_secretkey');
        $data['entry_merchant'] = $this->language->get('entry_merchant');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/vnpayment', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('payment/vnpayment', 'token=' . $this->session->data['token'], true);
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if (isset($this->error['access_code'])) {
            $data['error_access_code'] = $this->error['access_code'];
        } else {
            $data['error_access_code'] = '';
        }
        if (isset($this->error['url'])) {
            $data['error_url'] = $this->error['url'];
        } else {
            $data['error_url'] = '';
        }
        if (isset($this->error['types'])) {
            $data['error_types'] = $this->error['types'];
        } else {
            $data['error_types'] = '';
        }
        if (isset($this->error['currency'])) {
            $data['error_currency'] = $this->error['currency'];
        } else {
            $data['error_currency'] = '';
        }
        if (isset($this->error['secretkey'])) {
            $data['error_secretkey'] = $this->error['secretkey'];
        } else {
            $data['error_secretkey'] = '';
        }
        if (isset($this->error['merchant'])) {
            $data['error_merchant'] = $this->error['merchant'];
        } else {
            $data['error_merchant'] = '';
        }
        if (isset($this->request->post['vnpayment_order_status_id'])) {
            $data['vnpayment_order_status_id'] = $this->request->post['vnpayment_order_status_id'];
        } else {
            $data['vnpayment_order_status_id'] = $this->config->get('vnpayment_order_status_id');
        }
        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        if (isset($this->request->post['vnpayment_status'])) {
            $data['vnpayment_status'] = $this->request->post['vnpayment_status'];
        } else {
            $data['vnpayment_status'] = $this->config->get('vnpayment_status');
        }
        if (isset($this->request->post['vnpayment_sort_order'])) {
            $data['vnpayment_sort_order'] = $this->request->post['vnpayment_sort_order'];
        } else {
            $data['vnpayment_sort_order'] = $this->config->get('vnpayment_sort_order');
        }
        if (isset($this->request->post['vnpayment_access_code'])) {
            $data['vnpayment_access_code'] = $this->request->post['vnpayment_access_code'];
        } else {
            $data['vnpayment_access_code'] = $this->config->get('vnpayment_access_code');
        }
        if (isset($this->request->post['vnpayment_url'])) {
            $data['vnpayment_url'] = $this->request->post['vnpayment_url'];
        } else {
            $data['vnpayment_url'] = $this->config->get('vnpayment_url');
        }
        if (isset($this->request->post['vnpayment_types'])) {
            $data['vnpayment_types'] = $this->request->post['vnpayment_types'];
        } else {
            $data['vnpayment_types'] = $this->config->get('vnpayment_types');
        }
        if (isset($this->request->post['vnpayment_currency'])) {
            $data['vnpayment_currency'] = $this->request->post['vnpayment_currency'];
        } else {
            $data['vnpayment_currency'] = $this->config->get('vnpayment_currency');
        }
        if (isset($this->request->post['vnpayment_secretkey'])) {
            $data['vnpayment_secretkey'] = $this->request->post['vnpayment_secretkey'];
        } else {
            $data['vnpayment_secretkey'] = $this->config->get('vnpayment_secretkey');
        }
        if (isset($this->request->post['vnpayment_merchant'])) {
            $data['vnpayment_merchant'] = $this->request->post['vnpayment_merchant'];
        } else {
            $data['vnpayment_merchant'] = $this->config->get('vnpayment_merchant');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->template = 'payment/vnpayment.tpl';
        $this->response->setOutput($this->load->view('payment/vnpayment.tpl', $data));
    }

    private function validate() {

        if (!$this->user->hasPermission('modify', 'payment/vnpayment')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (!$this->request->post['vnpayment_access_code']) {
            $this->error['access_code'] = $this->language->get('error_access_code');
        }
        if (!$this->request->post['vnpayment_url']) {
            $this->error['url'] = $this->language->get('error_url');
        }

        if (!$this->request->post['vnpayment_types']) {
            $this->error['types'] = $this->language->get('error_types');
        }
        if (!$this->request->post['vnpayment_currency']) {
            $this->error['currency'] = $this->language->get('error_currency');
        }
        if (!$this->request->post['vnpayment_secretkey']) {
            $this->error['secretkey'] = $this->language->get('error_secretkey');
        }
        if (!$this->request->post['vnpayment_merchant']) {
            $this->error['merchant'] = $this->language->get('error_merchant');
        }
        return !$this->error;
    }

}

?>