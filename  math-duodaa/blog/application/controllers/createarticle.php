<?php

class createarticle extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('article_model');
		$this->load->model('comment_model');
		$this->load->model('message_model');
		
		$this->load->library('parser');
		$this->load->helper('url');
		$this->load->helper('text');

	}

	public function index($id=null)
	{  
		
		$username = qa_get_logged_in_handle();	
		
		
		if($username=='')
		{
			exit;
		}
		
		$user = $this->user_model->get_user_config($username);
		
		if($user==null)
		{
			exit;
		}
		$userlevel = $this->user_model->get_user_level($username);
		
		$data = $this->defaultpage_model->all_items();
		
		$data = array_merge(
				$data,
				array(
						'blog_title'          =>      $user['blogtitle'],
						'blog_subtitle'       =>      $user['blogsubtitle'],
							
		
						'img_article_operation_btns1'
						=>      base_url($this->config->item('app_src').'views/theme/'.$this->config->item('theme').'/img/article_operation_btns1.gif'),
		
		
						'article_submit'      =>      site_url('action/add_article/add_single_by_post'),
						'save_posted_page'    =>      site_url('action/save_article/save_single_by_post'),
						'aritile_site_url'    =>      site_url('article/index')
		
				)
		);
		
		if($id==null)
		{
			$data['ar_saveid']='0';
			$data['ar_draft_title']='';
			$data['ar_draft_content']='';
			$data['ar_draft_tags']='';
			
		}
		else 
		{
			$artl=$this->article_model->select_single_article($id);
			if($artl!=null and ($artl['username']==$username or $userlevel['level'] >= 4))
			{
				$data['ar_saveid']=$id;
				$data['ar_draft_title']=htmlspecialchars($artl['caption'],ENT_QUOTES,'UTF-8' );
				$data['ar_draft_content']=htmlspecialchars($artl['content'],ENT_QUOTES,'UTF-8' );
				$data['ar_draft_tags']=htmlspecialchars($artl['tags'],ENT_QUOTES,'UTF-8' );
			}
			else 
			{
				echo 'no permits!';
				exit;
			}
		}
		
		
		$this->parser->parse('theme/default/templete/header',$data);
		$this->parser->parse('theme/default/templete/head',$data);
		$this->parser->parse('theme/default/templete/createarticle',$data);
		$this->parser->parse('theme/default/templete/foot',$data);
	    
		
		
		
	}

}