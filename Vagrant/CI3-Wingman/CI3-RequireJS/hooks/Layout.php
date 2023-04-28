<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CI Layout mimic RoR/CakePHP
 *
 * Remember to $config['enable_hooks'] = TRUE in /application/config/config.php
 * @see: http://www.syahzul.com/codeigniter/codeigniter-layout-without-using-additional-library/
 */
class Layout
{
	function index()
	{
		$CI = &get_instance();
		$theme = CI::$APP->theme;
		$_layout = $theme->layout;

		// Don't load layout for CLI requests.
		if (!$CI->input->is_cli_request()) {
			global $OUT;

			// get default output generated by CI
			$output = $CI->output->get_output();

			if (isset($_layout) and !empty($_layout)) {
				if (!preg_match('/(.+).php$/', $_layout)) {
					$_layout .= '.php';
				}

				// this will be the requested layout
				$requested = APPPATH . 'views/layout/' . $_layout;

				// this is the default layout, use as fallback
				$default = APPPATH . 'views/layout/default.php';

				if (file_exists($requested)) {
					$layout = $CI->load->file($requested, true);
				} else {
					$layout = $CI->load->file($default, true);
				}

				$view = str_replace('{content}', $output, $layout);
			} else {
				$view = $output;
			}

			$OUT->_display($view);
		}
	}
}