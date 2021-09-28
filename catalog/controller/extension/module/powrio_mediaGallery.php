<?php
class ControllerExtensionModulePowrioMediagallery extends Controller {
	public function index($setting) {
		$data['id'] = $setting['id'];
		return $this->load->view('extension/module/powrio_mediaGallery', $data);
	}
}
