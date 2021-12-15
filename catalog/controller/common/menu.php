<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

        $this->load->model('tool/image');

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

                $products = array();

                if (empty($children)) {
                    $products = $this->getProductsByCategory($category);
                } else {
                    foreach ($children as $child) {
                        $filter_data = array(
                            'filter_category_id'  => $child['category_id'],
                            'filter_sub_category' => true
                        );

                       $products = $this->getProductsByCategory($child);

                       $children_data[] = array(
                           'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                           'products' => $products,
                       );
                    }
                }

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
                    'products' => $products,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		return $this->load->view('common/menu', $data);
	}

    private function getProductsByCategory($category) {
        $products_in_category = $this->model_catalog_product->getProducts(
            [
                'filter_category_id' => $category['category_id']
            ]
        );

        $products = array();

        //Level 3
        foreach ($products_in_category as $product) {
            if ($product['image']) {
                $image = $this->model_tool_image->resize($product['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
            }

            $options = array();

            foreach ($this->model_catalog_product->getProductOptions($product['product_id']) as $option) {
                $product_option_value_data = array();

                foreach ($option['product_option_value'] as $option_value) {
                    if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                        if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                            $price = $this->currency->format($this->tax->calculate($option_value['price'], $product['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
                        } else {
                            $price = false;
                        }

                        $product_option_value_data[] = array(
                            'product_option_value_id' => $option_value['product_option_value_id'],
                            'option_value_id'         => $option_value['option_value_id'],
                            'name'                    => $option_value['name'],
                            'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
                            'price'                   => $price,
                            'price_prefix'            => $option_value['price_prefix']
                        );
                    }
                }

                $options[] = array(
                    'product_option_id'    => $option['product_option_id'],
                    'product_option_value' => $product_option_value_data,
                    'option_id'            => $option['option_id'],
                    'name'                 => $option['name'],
                    'type'                 => $option['type'],
                    'value'                => $option['value'],
                    'required'             => $option['required']
                );
            }

            $products[] = array(
                'id' => $product['product_id'],
                'thumb' => $image,
                'name' => $product['name'],
                'description' => html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8'),
                'options' => $options,
                'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                'price'      => $this->currency->format($product['price'], $this->config->get('config_currency')),
            );
        }

        return $products;
    }
}
