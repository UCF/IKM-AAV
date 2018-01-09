<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token'); // allow certain headers
		header("Cache-Control: no-store, no-cache, must-revalidate");
        	header("Cache-Control: post-check=0, pre-check=0", false);
        	header("Pragma: no-cache");
        	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		parent::__construct();
		
		$this->load->model('General_model');
		$this->load->library(array('ion_auth','form_validation','corelib'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->config('main', TRUE);
	}
	public function index(){
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		
		$data['title'] = 'IKM - Faculty Validation for Academic Analytics';
		
		$this->load->view('home',$data);
	}
	public function data_main()
	{
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		} else {
			
			//uer information from authentication 
			$user = $this->ion_auth->user()->row();
			$fac_name = $user->first_name .' '. $user->last_name;
			$company = $user->company;
			$nid  = $user->username;
			$id = $user->id;
			
			$fac_choice_data = '';
			
			//get the main faculty data;
			//set IKM users to the first faculty member since they more than likely won't have a record
			if($company == 'IKM'){
				$one_data = $this->General_model->get_Faculty_All(1);
				$ret = $one_data->row();
				
				//set the nid and name of faculty member for the rest here
				$nid = $ret->OPRID;
				$fac_name = $ret->FIRST_NAME .' '. $ret->LAST_NAME;
				
				//reset to id of faculty member
				$user_data = $this->General_model->get_User($nid);
				$user_ret = $user_data->row();
				$id = $user_ret->id;
				
				//get the faculty in a set for dropdown on main page
				$fac_choice_data = $this->General_model->get_user('%');
			} 				
			
			//get the information areas
			$info = $this->config->item('Info','main');
			
			//get default release name
			$release = $this->config->item('Release','main');
		
			$faculty_data = $this->General_model->get_Faculty($nid,$release);
			
			foreach($faculty_data->result() as $key => $row){
				$emplid = $row->EMPLID;
				$title = $row->facultytitle;
				$rank = $row->ranktypename;
				$tenure = $row->Tenure_Status;
				$unit = $row->unitname;
			}
			
			
			
			//get the summarized data
			$summ_grants = 0;
			$summ_awards = 0;
			$summ_books = 0;
			$summ_journals = 0;
			
			//setting the money format
			setlocale(LC_MONETARY,'en_US.UTF-8');
			
			$summary_data = $this->General_model->get_summary($emplid,$release);
			foreach($summary_data->result() as $row){
				$summ_grants = $row->Grant_Count;
				$summ_awards = $row->Awards_Count;
				$summ_books = $row->Book_Count;
				$summ_journals = $row->Journal_Count;
				//$grant_dollars = money_format('%.0n',$row->Grant_Dollars); *not supported on windows
				$grant_dollars = $row->Grant_Dollars;
			} 
			
			//get the individual releasenames (for the dropdown);
			//$releases = $this->General_model->get_Releases();
			
			$data['title'] = 'IKM - Faculty Validation for Academic Analytics';
			$data['fac_name'] = $fac_name;
			$data['factitle'] = $title;
			$data['rank'] = $rank;
			$data['tenure'] = $tenure;
			$data['unit'] = $unit;
			$data['summ_award'] = $summ_awards;
			$data['summ_grant'] = $summ_grants;
			$data['summ_book'] = $summ_books;
			$data['summ_journal'] = $summ_journals;
			$data['grant_dollars'] = $grant_dollars;
			$data['nid'] = $id;
			$data['company'] = $company;
			$data['info'] = $info;
			$data['release'] = $release;
			$data['fac_choice'] = $fac_choice_data;
						
			$this->load->view('main', $data);
		}
	}
	 public function faculty_summary(){

		 
		 $nid_get = $this->input->get('idcheck');
		 $nid = $this->corelib->convert_id($nid_get);
		 
		 $release = $this->config->item('Release','main');

		 //for json
         $itemlist = array();
		 
		 //get the summarized data
			$summ_grants = 0;
			$summ_awards = 0;
			$summ_books = 0;
			$summ_journals = 0;
			$grant_dollars = "$0.00";
			$grant_verbiage = "0 for $0.00";
		 
		 $faculty_data = $this->General_model->get_Faculty($nid,$release);
			
		foreach($faculty_data->result() as $key => $row){
			
			$emplid = $row->EMPLID;
			$title = $row->facultytitle;
			$rank = $row->ranktypename;
			$tenure = $row->Tenure_Status;
			$unit = $row->unitname;
			$fac_name = $row->FIRST_NAME .' '. $row->LAST_NAME;
		}
 
		$summary_data = $this->General_model->get_summary($emplid,$release);
		foreach($summary_data->result() as $row){
			$summ_grants = $row->Grant_Count;
			$summ_awards = $row->Awards_Count;
			$summ_books = $row->Book_Count;
			$summ_journals = $row->Journal_Count;
			//$grant_dollars = money_format('%.0n',$row->Grant_Dollars); *not supported on windows
			$grant_dollars = $row->Grant_Dollars;
			
			if($summ_grants > 0){
				$grant_verbiage = $summ_grants . " for $" . number_format($grant_dollars,0);
			}
		}
		

		$item = array( "fac_name" => $fac_name,
                       "fac_title" => $title,
						"fac_rank" => $rank,
                        "fac_tenure" => $tenure,
						"fac_unit" => $unit,
						"summ_grants" => $summ_grants,
						"summ_awards" => $summ_awards,
						"summ_books" => $summ_books,
						"summ_journals" => $summ_journals,
						"grant_dollars" => $grant_dollars,
						"grant_verbiage" => $grant_verbiage
                     );
        $itemlist[] = $item;
		
		$result_count = count($itemlist);

		//convert to json and escape any weird chracters
		$final_data = json_encode($itemlist, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

       //clear the array from memory
       /*empty($itemlist);*/

       header('Content-Type: text/plain');
       echo  $final_data;
		
	 }
	 public function data_book(){

		$nid_get = $this->input->get('idcheck');
		$nid = $this->corelib->convert_id($nid_get);
		
		 
		 //$release = $this->input->get('releasename'); /** for possible release choice in future **/
		 $release = $this->config->item('Release','main');
         
         $book_data =  $this->General_model->get_Books($nid,$release);

         //for json
         $itemlist = array();

		//vars to set
		$editor = '';

        foreach ($book_data->result() as $key => $row){

			if($row->AA_BOOK_EDITOR != '') {
				$editor = 'Yes';
			} else { $editor = 'No'; }
						$name = $row->LAST_NAME . ", ". $row->FIRST_NAME;
						
                        $item = array( "Title" => $row->AA_BOOK_TITLE,
                                       "Editor" => $editor,
									   "Author" => $row->author,
                                       "Publication Year" => $row->AA_BOOK_PUBYEAR,
                                       "Book Type" => $row->AA_BOOK_CLASS_DESCR,
									   "Member Role" => $row->description,
									   "ISBN" => $row->isbn13,
									   "Release" => $row->releasename,
										"Name" => $name
                                );
                        $itemlist[] = $item;
                }
                        $result_count = count($itemlist);

                        //fix utf-8 issue with MSSQL
                        //$fixed = $this->corelib->utf8_converter($itemlist);

                        //convert to json and escape any weird chracters
                        $final_data = json_encode($itemlist, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

                        //clear the array from memory
                        /*empty($itemlist);*/

                        header('Content-Type: text/plain');
                        echo  $final_data;

        }

	public function data_journal(){
		
		$nid_get = $this->input->get('idcheck');
		$nid = $this->corelib->convert_id($nid_get);	
		
		//$release = $this->input->get('releasename'); /** for possible release choice in future **/
		$release = $this->config->item('Release','main');
		
		$journal_data =  $this->General_model->get_Journals($nid,$release);
		
		//for json
		$itemlist = array();

		foreach ($journal_data->result() as $key => $row){
			
			if ($row->AA_ARTICLE_CONFPAPER == 1){
				$row->AA_ARTICLE_CONFPAPER = 'Yes';
			} else { 
				$row->AA_ARTICLE_CONFPAPER = 'No'; 
			}
			
			$name = $row->LAST_NAME . ", ". $row->FIRST_NAME;

			$item = array( "Title" => $row->AA_ARTICLE_TITLE,
				    	"Journal Name" => $row->AA_ARTICLE_JRNLNAME,
						"Publication Year" => $row->AA_ARTICLE_PUBYEAR,
						"Volume" => $row->AA_ARTICLE_PUB_VOL,
						"Issue" => $row->AA_ARTICLE_PUB_ISSUE,
						"Publisher" => $row->AA_ARTICLE_PUBLISHER,
						"DOI" => $row->AA_ARTICLE_DOI,
						"Citations" => $row->AA_ARTICLE_CITATION,
						"Conference Paper" => $row->AA_ARTICLE_CONFPAPER,
						"Release" => $row->releasename,
						"Name" => $name
				);
			$itemlist[] = $item;
		}
			$result_count = count($itemlist);
		
			//fix utf-8 issue with MSSQL
			//$fixed = $this->corelib->utf8_converter($itemlist);

			//convert to json and escape any weird chracters
			$final_data = json_encode($itemlist, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	
			//clear the array from memory
			empty($itemlist);
		
			header('Content-Type: text/plain');
			echo  $final_data;
		
	}
	public function data_grant(){
		
		$nid_get = $this->input->get('idcheck');
		$nid = $this->corelib->convert_id($nid_get);
	
		 
		 //$release = $this->input->get('releasename'); /** for possible release choice in future **/
		 $release = $this->config->item('Release','main');
		
		$grant_data =  $this->General_model->get_Grants($nid,$release);
		
		//for json
		$itemlist = array();

		foreach ($grant_data->result() as $key => $row){
			
			$name = $row->LAST_NAME . ", ". $row->FIRST_NAME;

			$item = array( "Agency" => $row->AA_GRANT_AGENCY_DESCR,
							"GrantName" => $row->AA_GRANT_GRNT_NAME,
							"Start Year" => $row->AA_GRANT_STRT_YEAR,
							"End Year" => $row->AA_GRANT_END_YEAR,
							"Total Dollars" => $row->AA_GRANT_TOTAL_DOLLARS,
							"Release" => $row->releasename,
							"Name" => $name
				);
			$itemlist[] = $item;
		}
			$result_count = count($itemlist);
		
			//fix utf-8 issue with MSSQL
			//$fixed = $this->corelib->utf8_converter($itemlist);

			//convert to json and escape any weird chracters
			$final_data = json_encode($itemlist, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	
			//clear the array from memory
			empty($itemlist);
		
			header('Content-Type: text/plain');
			echo  $final_data;
		
	}
	public function data_award(){
		
		$nid_get = $this->input->get('idcheck');
		$nid = $this->corelib->convert_id($nid_get);
	
		 
		 //$release = $this->input->get('releasename'); /** for possible release choice in future **/
		 $release = $this->config->item('Release','main');
		
		$award_data =  $this->General_model->get_Awards($nid,$release);
		
		//for json
		$itemlist = array();

		foreach ($award_data->result() as $key => $row){
			
			$name = $row->LAST_NAME . ", ". $row->FIRST_NAME;
			
			$item = array( "Society" => $row->AA_AWARD_SOCIETYNAME,
							"Award" => $row->AA_AWARD_NAME,
							"Year" => $row->AA_AWARD_YEAR,
							"Release" => $row->releasename,
							"Name" => $name
				);
			$itemlist[] = $item;
		}
			$result_count = count($itemlist);
		
			//fix utf-8 issue with MSSQL
			//$fixed = $this->corelib->utf8_converter($itemlist);

			//convert to json and escape any weird chracters
			$final_data = json_encode($itemlist, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	
			//clear the array from memory
			empty($itemlist);
		
			header('Content-Type: text/plain');
			echo  $final_data;
	
      }
public function info(){
	$info = $this->config->item('Info','main');
		
	$final_data = json_encode($info, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	
	header('Content-Type: text/plain');
	echo  $final_data;
	

}
public function test(){
		phpinfo();
		$faculty_data = $this->General_model->get_Faculty('mcr');
	
			foreach($faculty_data->result() as $key => $row){
				$emplid = $row->EMPLID;
				$title = $row->facultytitle;
				$rank = $row->ranktypename;
				$tenure = $row->Tenure_Status;
				$unit = $row->unitname;
				
				echo $emplid;
			}
      }

}
