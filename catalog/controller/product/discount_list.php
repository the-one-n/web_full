<?php
class ControllerProductDiscountList extends Controller {
    public function index() {

        $this->load->language('product/discount_list');

        $this->load->model('catalog/discount_list');

        $this->load->model('catalog/product');

        $this->load->model('tool/image');

        $this->document->setTitle($this->language->get('meta_title'));
        $this->document->setDescription($this->language->get('meta_description'));
        $this->document->setKeywords($this->language->get('meta_keyword'));

        if (isset($this->request->get['path'])) {
            $path = '';

            $parts = explode('_', (string)$this->request->get['path']);

            foreach ($parts as $path_id) {
                if (!$path) {
                    $path = $path_id;
                } else {
                    $path .= '_' . $path_id;
                }
            }
        }

        $products = $this->model_catalog_discount_list->getDiscountedProducts();

        foreach ($products as $product) {
//            $price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
//
//            if ($product['image']) {
//                $image = $this->model_tool_image->resize($product['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
//            } else {
//                $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
//            }
//
//            $data['products'][] = array(
//                'product_id' => $product['product_id'],
//                'thumb' => $image,
//                'name' => $product['name'],
//                'price' => $price,
//                'href' => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $product['product_id']),
//            );
        }

        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('product/discount_list', $data));
    }
}