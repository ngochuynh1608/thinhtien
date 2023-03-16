<?php

/* * *************************************************************************
 *                                                                           *
 *            Module tích hợp thanh toán Vnpayment                           *
 * Phiên bản : 1.0                                                           *
 * Module được phát triển bởi VNPAY                                          *
 * Chức năng :                                                               *
 * - Tích hợp thanh toán qua Vnpayment cho các merchant site có đăng ký API. *
 * - Gửi thông tin thanh toán tới Vnpayment để xử lý việc thanh toán.        *
 * @author thangnh@vnpay.vn                                                  *
 * ***************************************************************************
 * Xin hãy đọc kĩ tài liệu tích hợp trên trang                               *
 * http://vnpayment.vn                                                       *
 *                                                                           *
 * *************************************************************************** */

class Controllerpaymentvnpayment extends Controller {

    public function index() {
        $this->load->language('payment/vnpayment');
        $this->load->model('checkout/order');
        $data['button_confirm'] = $this->language->get('button_confirm');
        $data['button_back'] = $this->language->get('button_back');
        return $this->load->view('thinhtien/template/payment/vnpayment.tpl', $data);
    }

    public function confirm() {
        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        $order_id = $this->session->data['order_id'];
        $total_amount = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
        $date = new DateTime(); //this returns the current date time
        $result = $date->format('Y-m-d-H-i-s');
        $today = date("Y-m-d H:i:s");
        $krr = explode('-', $result);
        $result1 = implode("", $krr);
        $this->session->data['time'] = $result1;
        $vnp_Url = $this->config->get('vnpayment_url');
        $vnp_Returnurl = $this->config->get('config_ssl') . "index.php?route=payment/vnpayment/Return_Success";
        $hashSecret = $this->config->get('vnpayment_secretkey');
        $vnp_Locale = $this->language->get('code');
        $vnp_OrderInfo = 'Thanh toan don hang Luc :' . $today;
        $vnp_OrderType = $this->config->get('vnpayment_types');
        $vnp_Merchant = $this->config->get('vnpayment_merchant');
        $vnp_CurrCode = $this->config->get('vnpayment_currency');
        $vnp_TmnCode = $this->config->get('vnpayment_access_code');
        $vnp_Amount = $total_amount * 100;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $Odarray = array(
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $result1,
            "vnp_CurrCode" => $vnp_CurrCode,
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_Merchant" => $vnp_Merchant,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $order_id,
            "vnp_Version" => "2.0.0",
        );
        ksort($Odarray);
        $query = "";
        $i = 0;
        $data = "";
        foreach ($Odarray as $key => $value) {
            if ($i == 1) {
                $data .= '&' . $key . "=" . $value;
            } else {
                $data .= $key . "=" . $value;
                $i = 1;
            }

            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url .='?';
        $vnp_Url .=$query;
        if (isset($hashSecret)) {
            $vnpSecureHash =hash('sha256', $hashSecret . $data);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        $OrdersArray = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        echo json_encode($OrdersArray);
        die;
    }

    public function IPNURL() {
        try {
            $returnData = array();
            $order_id = 0;
            $message = '';
            $hashSecret = $this->config->get('vnpayment_secretkey');
            $get = $_REQUEST;
            $data = array();
            foreach ($get as $key => $value) {
                $data[$key] = $value;
            }
            if (isset($data['vnp_TxnRef'])) {
                $order_id = $data['vnp_TxnRef'];
            } else {
                $message = '';
                $order_id = 0;
            }

            $vnp_SecureHash = $data['vnp_SecureHash'];
            $vnp_TxnResponseCode = $data['vnp_ResponseCode'];
            unset($data["vnp_SecureHashType"]);
            unset($data["vnp_SecureHash"]);
            unset($data["route"]);
            ksort($data);
            $i = 0;
            $data2 = "";
            foreach ($data as $key => $value) {
                if ($i == 1) {
                    $data2 .= '&' . $key . "=" . $value;
                } else {
                    $data2 .= $key . "=" . $value;
                    $i = 1;
                }
            }
            $secureHash = hash('sha256', $hashSecret . $data2);
            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($order_id);
            if (isset($order_info['order_id']) && $order_info['order_id'] != NULL) {
                if ($secureHash == $vnp_SecureHash) {
                    if ($order_info['order_status_id'] == '0') {
                        if ($vnp_TxnResponseCode == '00') {
                            $out = "{\"RspCode\":\"00\",\"Message\":\"Confirm Success\"}";
                            ob_start();
                            $this->model_checkout_order->addOrderHistory($order_id, $this->config->get('vnpayment_order_status_id'), $message, false);
                            ob_end_clean();
                            //$this->response->addHeader('Content-Type: application/json');
                            echo $out;
                            die;
                        } else {
                            $out = "{\"RspCode\":\"00\",\"Message\":\"Confirm Success\"}";
                            echo $out;
                            die;
                        }
                    } else {
                        $returnData['RspCode'] = '02';
                        $returnData['Message'] = 'Order already confirmed';
                    }
                } else {
                    $returnData['RspCode'] = '97';
                    $returnData['Message'] = 'Chu ky khong hop le';
                    $returnData['Signature'] = $secureHash;
                }
            } else {
                $returnData['RspCode'] = '01';
                $returnData['Message'] = 'Order not found';
            }
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($returnData));
        } catch (Exception $e) {
            $returnData = array();
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Co loi say ra';
            $this->response->addHeader('Content-Type: application/json');
            $this->response->setOutput(json_encode($returnData));
        }
    }

    public function Return_Success() {
        $order_id = 0;
        $status = '';
        $message = '';
        if (isset($this->request->get['vnp_TxnRef'])) {
            $order_id = $this->request->get['vnp_TxnRef'];
        } else {
            $message = '';
            $order_id = 0;
        }
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnp_TxnResponseCode = $this->request->get['vnp_ResponseCode'];
        $hashSecret = $this->config->get('vnpayment_secretkey');
        $get = $_GET;
        // var_dump($get);
        $data = array();
        foreach ($get as $key => $value) {
            $data[$key] = $value;
        }
        unset($data["vnp_SecureHashType"]);
        unset($data["vnp_SecureHash"]);
        unset($data["route"]);
        ksort($data);
        $i = 0;
        $data2 = "";
        foreach ($data as $key => $value) {
            if ($i == 1) {
                $data2 .= '&' . $key . "=" . $value;
            } else {
                $data2 .= $key . "=" . $value;
                $i = 1;
            }
        }
        $secureHash = hash('sha256', $hashSecret . $data2);
        if ($vnp_TxnResponseCode == '00') {
            $status = $vnp_TxnResponseCode;
        } else {
            $message = "Dữ liệu không hợp lệ !";
            $status = '';
        }
        $this->language->load('payment/vnpayment');
        $data['title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));

        if (!isset($this->request->server['HTTPS']) || ($this->request->server['HTTPS'] != 'on')) {
            $data['base'] = HTTP_SERVER;
        } else {
            $data['base'] = HTTPS_SERVER;
        }
        $data['language'] = $this->language->get('code');
        $data['direction'] = $this->language->get('direction');
        $data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
        $data['text_response'] = $this->language->get('text_response');
        $data['text_success'] = $this->language->get('text_success');
        $data['text_success_wait'] = sprintf($this->language->get('text_success_wait'), $this->url->link('checkout/success'));
        $data['text_failure'] = $this->language->get('text_failure');
        $data['text_failure_wait'] = sprintf($this->language->get('text_failure_wait'), $this->url->link('checkout/cart'));
        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($order_id);
        if (isset($order_info['order_id']) && $order_info['order_id'] != NULL) {

            if ($secureHash == $vnp_SecureHash) {
                if ($status == '00') {
                    $this->model_checkout_order->addOrderHistory($order_info['order_id'], $this->config->get('vnpayment_order_status_id'));
                    $data['continue'] = $this->url->link('checkout/success');
                    $this->response->setOutput($this->load->view('thinhtien/template/payment/vnpayment_success.tpl', $data));
                } else {
                    $this->response->setOutput($this->load->view('thinhtien/template/payment/vnpayment_fail.tpl', $data));
                }
            }
        }
    }

}

?>