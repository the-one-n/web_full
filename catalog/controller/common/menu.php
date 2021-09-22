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

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

                    $products_in_category = $this->model_catalog_product->getProducts(
                        [
                            'filter_category_id' => $child['category_id']
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

                        $products[] = array(
                            'thumb' => $image,
                            'name' => $product['name'],
                            'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                            'price'      => $this->currency->format($product['price'], $this->config->get('config_currency')),
                        );
                    }

                    $children_data[] = array(
                        'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
                        'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
                        'products' => $products,
                    );
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		return $this->load->view('common/menu', $data);
	}
}
