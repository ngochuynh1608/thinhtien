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
 * ***************************************************************************/

class Modelpaymentvnpayment extends Model {

     public function getMethod($address) {
        $this->load->language('payment/vnpayment');
        if ($this->config->get('vnpayment_status')) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int) $this->config->get('vnpayment_geo_zone_id') . "' AND country_id = '" . (int) $address['country_id'] . "' AND (zone_id = '" . (int) $address['zone_id'] . "' OR zone_id = '0')");

            if (!$this->config->get('vnpayment_geo_zone_id')) {
                $status = TRUE;
            } elseif ($query->num_rows) {
                $status = TRUE;
            } else {
                $status = FALSE;
            }
        } else {
            $status = FALSE;
        }

        $method_data = array();

        if ($status) {
            $method_data = array(
                'code' => 'vnpayment',
                'title' => $this->language->get('text_title'),
                'terms' => '',
                'sort_order' => $this->config->get('vnpayment_sort_order')
            );
        }

        return $method_data;
    }

}

?>