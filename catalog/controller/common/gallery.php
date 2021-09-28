<?php

class ControllerCommonGallery extends Controller {
    public function index() {
        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');
        $data['content_top'] = $this->load->controller('common/content_top');

        $this->response->setOutput($this->load->view('common/gallery', $data));
    }
}