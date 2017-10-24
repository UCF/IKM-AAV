<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Main config variables for app
*

*
*/

$config['all'] = array('Admin','All');
$config['admin'] = array('Admin');

/** Default time range **/
$config['Release'] = 'AAD2015.06.703';

/** tables - make them portable incase main tables change**/
$config['tables']['plans_extended']           = 'APIM_Plans_Extended';
$config['tables']['subplans_extended']        = 'APIM_Sub_Plans_Extended';
$config['tables']['strategic_emphasis']       = 'APIM_Strategic_Emphasis';
$config['tables']['tracking']			      = 'APIM_Tracking';
$config['tables']['regional_locations']		  = 'APIM_Regional_Locations';
$config['tables']['plan_regional_link']		  = 'APIM_Plan_Regional_Link';
$config['tables']['subplan_regional_link']	  = 'APIM_Plan_SubPlan_Regional_Link';
$config['tables']['stem_cip']					= 'APIM_STEM_CIPS';

/** Tab Information Area **/
$config['Info'] = array(
		'jrnlData' => 'The 2015 comparative data includes over two million peer-reviewed articles published in 2012, 
					   2013, 2014, and 2015 matched to scholars in over 33,000 warehoused journals. Publication data are derived from CrossRef, an association of scholarly publishers that develops shared infrastructure to support more effective scholarly communications. It effects linkages through CrossRef Digital Object Identifiers (CrossRef DOI), which are tagged to article metadata supplied by the participating publishers.',
		'awrdData' => 'The 2015 database includes 5,725 honorific awards from 845 governing societies with 4,469 awards from 736 societies represented in the comparative database. The general principle for the inclusion of an award in the database is that the award must be open to all people in a (sub-) discipline or to a large subset (i.e., age, gender) at the national and/or international level. State and local awards are not currently captured by Academic Analytics. Expansion of the awards list is ongoing and largely based on feedback from client institutions.',
		'bookData' => 'The Academic Analytics data warehouse includes book publication data obtained from Baker & Taylor and The British Library. A book title is reported once per author/editor; all published works are weighted equally (distinctions between authors, editors and translators are available via a details feed if a user wants to separate them by type). Series editors are not included in the books metrics and do not appear in the data feeds from our providers. As with journal articles, co- authored/edited books duplication is removed as the data are aggregated to broader categories.
						There are over 130,000 authors, co-authors, editors, co-editors and translators of books published in 2006-2015 (inclusive) matched to 56,613 faculty members in the 2015 database. Introductions, forewords, afterwords, and citations in and to books are not currently captured. ',
		'grntData' => 'The 2015 database includes grants data from 13 federal agencies matched to the principal investigator at the lead institution. There are over 163,000 grants matched which total over $33 billion in annualized competitive grant funding. Funding is attached to individuals, so a grant received while at one institution is carried to the next institution as people move between universities. Grants in active status during the 2011-2015 calendars year based on the project or budget start/end dates as of June 2016 are represented in the comparative database. Grants data are obtained through a combination of online search engines and through Freedom of Information Act (FOIA) requests. The Departments of Air Force and Navy did not submit updates for the 2015 database.  Therefore, Air Force and Navy grants data coverage remains 2011-2014.

					   <p>Data are presented as annualized amounts based on the awarded or estimated amount of the grant divided by the number of years derived from either the start/end dates of the project or of the budget period where transactions have been reported. So, a $300,000 grant that runs from 1/1/2012-12/31/2015 would be assigned an annualized amount of $100,000. When the full history of a grant is not known, funding is calculated based on the budget start and end dates rather than the project start and end dates.'
);
/** Tool Tips **/
$config['Tips'] = array(
		
		'College' => 'Short college name where Plan is located',
		'Dept.' => 'Department where Plan is located',
		'CIP' => 'The Classification of Instructional Program (CIP) code related to the Plan and SubPlan',
		'Term Start' => 'Term/Semester when the Plan or SubPlan was implemented',
		'Plan Name' => 'Official name of the Plan or SubPlan',
		'Strat. Emphasis' => 'Is the Plan or SubPlan identified as one of strategic emphasis as defined by the Florida Board of Governors (FLBOG).',
		'Regional?' => 'Is the Plan or SubPlan offered at a regional campus.',
		'Program' => 'Official PeopleSoft program code for Plan or SubPlan.',
		'Professional' => 'Degrees that are not considered research focused, but instead prepare students for careers outside of academia.',
		'Plan' => 'Official PeopleSoft Plan code.',
		'SubPlan' => 'Official PeopleSoft SubPlan code (where applicable).',
		'Plan' => 'Official PeopleSoft code for the academic Plan.',
		'SubPlan' => 'Official PeopleSoft code for the academic SubPlan.',
		'Plan Type' => 'Is the Plan or SubPlan a track (TRK) or specialization(SPC).',
		'Degree' => 'Type of degree asociated with the Plan e.g. Pending (PND), Certificate (CER or CRT), Bachelors (BS), Master\'s (MS).',
		'Career' => 'Acadmic career of the Plan or SubPlan, Undergraduate (UGRAD), Graduate (GRAD)',
		'Level' => 'Level of Plan e.g. Bachelors',
		'Status' => 'Status of the Plan or SubPlan, Active(A), Inactive(I), Suspended(S)',
		'Susp./Inact. Date' => 'Term/semester when the Plan or SubPlan became inactive or suspended if applicable.',
		'Access' => 'Is the Plan or SubPlan restricted or unrestricted enrollment.',
		'Admission' => 'Should the Plan or SubPlan be loaded on the requisite admissions form (Grad or Undergrad).',
		'Readmit' => 'Should the Plan or SubPlan be loaded on the Readmission form.',
		'Load As' => 'Use a different Plan from CIP group allow students to admit too.',
		'FLVC Transient' => 'Is the Plan or SubPlan listed with the Florida Virtual Campus (FLVC).',
		'UCF Online' => 'Is the Plan or SubPlan a UCF Online program.',		
		'UCF STEM' => 'Is the Plan or SubPlan identified as a STEM area (Science, Technology, Engineering, and Math Education).',		
		'Program/Plan Extra' => 'Additional name for the Plan',
		'SubPlan Name Extra' => 'Additional name for the SubPlan',
		'Tot. Thesis Hrs.' => 'Total thesis hours required for Plan or SubPlan',
		'Professional' => 'Is the Plan or SubPlan part of the Professional Science Master\'s program',
		'Mrkt. Rate Tuition' => 'Is the Plan or SubPlan defined as market rate.',
		'Cost Recovery' => 'Is the Plan or SubPlan a cost recovery program.',
		'Dept. Name Extra' => 'Additional name for the Department',
		'Tot. Dissertation Hrs.' => 'Total dissertations hours required for Plan or SubPlan',
		'Tot. Non-Thesis Hrs.' => 'Total non-thesis hours required for Plan or SubPlan',
		'Tot. Dissertation Hrs.' => 'Total dissertations hours required for Plan or SubPlan',
		'Tot. Cert. Hrs.' => 'Total certificate hours for the certificate Plan or SubPlan.',
		'Tot. Dissertation Hrs.' => 'Total dissertations hours required for Plan or SubPlan',
		'Tot. Doctoral Hrs.' => 'Total doctoral hours required for Plan or SubPlan',
		'Lake Nona' => "Is the Plan or SubPlan offered at the Lake Nona Campus?",
		'Rosen' => "Is the Plan or SubPlan offered at the Rosen Campus?",
		'Orlando' => "Is the Plan or SubPlan offered at the OrlandoCampus?",
		'Altamonte Springs' => "Is the Plan or SubPlan offered at the Altamonte Springs Campus?",
		'Cocoa' => "Is the Plan or SubPlan offered at the Cocoa Beach Campus?",
		'Daytona' => "Is the Plan or SubPlan offered at the Daytona Beach Campus?",
		'Leesburg' => "Is the Plan or SubPlan offered at the Leesburg Campus?",
		'Ocala' => "Is the Plan or SubPlan offered at the Ocala Campus?",
		'Palm Bay' => "Is the Plan or SubPlan offered at the Palm Bay Campus?",
		'Sanford/LM' => "Is the Plan or SubPlan offered at the Sanford - Lake Mary Campus?",
		'South Lake' => "Is the Plan or SubPlan offered at the South Lake Campus?",
		'Valencia East' => "Is the Plan or SubPlan offered at the Valencia East Campus?",
		'Valencia Osceola' => "Is the Plan or SubPlan offered at the Valencia Osceola Campus?",
		'Valencia West' => "Is the Plan or SubPlan offered at the Valencia West Campus?"
		
);