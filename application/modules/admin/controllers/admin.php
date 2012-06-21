<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();

		if(! $this->hmvc_auth->is_admin()) exit('Admin degilsiniz!');
		
		$this->output->enable_profiler(TRUE);
       
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
    }
	
	private function render($view,$data=NULL){
	
		$this->layout->setLayout('/layout_view');		
	
		$data['header_view'] = $this->load->view('header_view',$data,TRUE);
		$data['footer_view'] = $this->load->view('footer_view',$data,TRUE);		
		
		$data['top_menu_view'] = $this->load->view('admin/menu_admin_view',$data,TRUE);
		
		$this->layout->view($view,$data);
	
	}

	public function index()
	{
		self::render('admin/dashboard_admin_view');
	}
	
	public function pagination()
	{
		$data['id'] = (int) $this->uri->segment(4);
		
		$data['page'] = self::create_pagination(50);
		
		self::render('admin/dashboard_admin_add_view',$data);
	}
	
	private function create_pagination($total)
	{

		$this->load->library('pagination');	
			
		$config['total_rows'] = $total;
		$this->pagination->initialize($config); 
		
	
		return $this->pagination->create_links();
	
	}
	
}
