<?php
class General_model extends CI_Model
{
	public $tables = array();
	
	function __construct(){
		parent::__construct();
		
		//load configuration
		$this->load->config('main', TRUE);
		
		//setup the tables array from above
		//$this->tables  = $this->config->item('tables', 'main');

	}
	function get_user_frid($id){
		$query = $this->db->query("SELECT * FROM AUTH_users WHERE id LIKE '" . $id . "'");
		return $query;
	}
	function get_user($nid){
		$query = $this->db->query("SELECT * FROM AUTH_users WHERE username LIKE '" . $nid . "' ORDER BY last_name ASC");
		return $query;
	}
	function get_Faculty_All($limit=''){
		if($limit != ''){
			$limit = "top " . $limit;
		}
		$query = $this->db->query("Select " . $limit . "* FROM AA_FACULTY LEFT JOIN AA_FACULTY_DATA on AA_FACULTY.EMPLID = AA_FACULTY_DATA.EMPLID ORDER BY AA_FACULTY.LAST_NAME ASC");
		return $query;
	}
	function get_Releases(){
		$query = $this->db->query("Select distinct releasename from AA_JOURNALS ORDER BY releasename DESC");
		return $query;
	}
	function get_Faculty($nid){

		$query = $this->db->query("Select AA_FACULTY.*, AA_FACULTY_DATA.unitname, AA_FACULTY_DATA.facultytitle, AA_FACULTY_DATA.ranktypename, AA_FACULTY_DATA.Tenure_Status FROM AA_FACULTY LEFT JOIN AA_FACULTY_DATA on AA_FACULTY.EMPLID = AA_FACULTY_DATA.EMPLID WHERE AA_FACULTY.OPRID LIKE '" . $nid . "'");
		return $query;
	}
	function get_Journals($nid,$release){
		$query = $this->db->query("Select AA_JOURNALS.*, AA_FACULTY.* FROM  AA_JOURNALS LEFT JOIN AA_FACULTY  ON AA_FACULTY.EMPLID = AA_JOURNALS.EMPLID WHERE AA_FACULTY.OPRID LIKE '" . $nid . "' AND AA_JOURNALS.releasename LIKE '" . $release . "'  ORDER BY AA_JOURNALS.AA_ARTICLE_PUBYEAR DESC");
		return $query;	
	}
	function get_Books($nid,$release){
                $query = $this->db->query("Select AA_BOOKS.*, AA_FACULTY.* FROM  AA_BOOKS LEFT JOIN AA_FACULTY  ON AA_FACULTY.EMPLID = AA_BOOKS.EMPLID WHERE AA_FACULTY.OPRID LIKE '" . $nid . "' AND AA_BOOKS.releasename LIKE '" . $release . "' ORDER BY AA_BOOKS.AA_BOOK_PUBYEAR DESC");
                return $query;
        }
	function get_Grants($nid,$release){
		$query = $this->db->query("Select AA_GRANTS.*, AA_FACULTY.* FROM  AA_GRANTS LEFT JOIN AA_FACULTY  ON AA_FACULTY.EMPLID = AA_GRANTS.EMPLID WHERE AA_FACULTY.OPRID LIKE '" . $nid . "' AND AA_GRANTS.releasename LIKE '" . $release . "' ORDER BY AA_GRANTS.AA_GRANT_STRT_YEAR DESC");
		return $query;	
	}

	function get_Awards($nid,$release){
		$query = $this->db->query("Select AA_AWARDS.*, AA_FACULTY.* FROM  AA_AWARDS LEFT JOIN AA_FACULTY  ON AA_FACULTY.EMPLID = AA_AWARDS.EMPLID WHERE AA_FACULTY.OPRID LIKE '" . $nid . "' AND AA_AWARDS.releasename LIKE '" . $release . "' ORDER BY AA_AWARDS.AA_AWARD_YEAR DESC");
		return $query;	
	}
	
	function get_Summary($emplid, $release){
		$query = $this->db->query("Select *,(Select Count(*) from AA_JOURNALS where AA_JOURNALS.EMPLID = ". $emplid ." AND AA_JOURNALS.releasename LIKE '" . $release . "') as Journal_Count,
											(Select Count(*) from AA_BOOKS where AA_BOOKS.EMPLID = ". $emplid ." AND AA_BOOKS.releasename LIKE '" . $release . "') as Book_Count,
											(Select SUM(AA_GRANT_TOTAL_DOLLARS) from AA_GRANTS where AA_GRANTS.EMPLID = ". $emplid ." AND AA_GRANTS.releasename LIKE '" . $release . "') as Grant_Dollars,
											(Select Count(*) from AA_GRANTS where AA_GRANTS.EMPLID = ". $emplid ." AND AA_GRANTS.releasename LIKE '" . $release . "') as Grant_Count,
											(Select Count(*) from AA_AWARDS where AA_AWARDS.EMPLID = ". $emplid ." AND AA_AWARDS.releasename LIKE '" . $release . "') AS Awards_Count 
											FROM AA_FACULTY where AA_FACULTY.EMPLID = ". $emplid);

		return $query;	
	}
}
?>
