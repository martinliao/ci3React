<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller contains the general home site pages.
 *
 */
class Javascript extends BackendController
{

	protected $data = array();

	public function __construct()
	{
		parent::__construct();
		//$filterQueryString = filterQueryString($_SERVER['QUERY_STRING']);
		//$slashargument = min_get_slash_argument();
		#$this->load->helper('configonlylib');
		#$this->load->helper('jslib');
		#$this->load->library(['core/minify']);
	}


	/**
	 * Site Default Landing Page.
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{		
debugBreak();
		#$tmp= $this->input->get('x');
		#$tmp= $this->input->get();

		$this->load->view('/general/index', $data);
	}

	public function get($id = null, $path, $scriptfile) {
		$uri = current_url(true);
		# $path = $this->request->getPath(); # not working
		#$product_id = $this->uri->segment(3, 0);
//debugBreak();
		$param_offset=0;
		$segment= $params = $this->uri->segment_array();
		$rsegment= $params = $this->uri->rsegment_array();
		$params = array_slice($this->uri->rsegment_array(), $param_offset);
		var_dump($params);
		$slashargument= $id.'/'.$path.'/'.$scriptfile;
		$slashargument = ltrim($slashargument, '/');
    	if (substr_count($slashargument, '/') < 1) {
			header('HTTP/1.0 404 not found');
			die('Slash argument must contain both a revision and a file path');
		}
debugBreak();
		// image must be last because it may contain "/"
		list($rev, $file) = explode('/', $slashargument, 2);
		$rev  = min_clean_param($rev, 'INT');
		$file = '/'.min_clean_param($file, 'SAFEPATH');
		$jsfiles = array();
		$files = explode(',', $file);
		foreach ($files as $fsfile) {
			$tmp= APPPATH.$fsfile;
			$jsfile = realpath(ASSETSPATH.$fsfile);
		}

		#$tmp= parse_str($_SERVER['QUERY_STRING'], $_GET); 

		$this->load->view('/general/index', $data);
	}


	/**
	 *
	 * Example of using another layout and view template for your view if needed
	 *
	 * @access public
	 * @return void
	 *
	*/
	public function highlight(){
		$this->set_page_title('Example of another page');
		$this->set_meta_description('Example of another page Meta Description.');

		// Set another layout
		$this->layout = 'highlight';

		// Do something here...
		// $foo = 'bar';

		// Assign your data to an array
		$data = array(
			//'baz' => $foo
		);

		// Load another view and pass the data
		$this->load->view('/example/index', $data);
	}
}