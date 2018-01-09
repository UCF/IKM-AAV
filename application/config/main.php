<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Main config variables for app
*

*
*/

$config['all'] = array('Admin','All');
$config['admin'] = array('Admin');

/** Default time range **/
$config['Release'] = 'AAD2016.00.788';

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
		'jrnlData' =>"<strong>Articles</strong> <p>Displayed below are published peer-reviewed articles that Academic Analytics has matched to your name using CrossRef, an association of scholarly publishers that develops shared infrastructure to support effective scholarly communications. It effects linkages through CrossRef Digital Object Identifiers (CrossRef DOI), which are tagged to article metadata supplied by the participating publishers.
					  <p><strong>Conference Proceedings</strong><p>Conference proceedings that Academic Analytics has matched to your name and article are displayed below. Proceedings that are assigned DOIs and submitted to CrossRef are included.
					  <p><strong>Citations</strong><p>Citation data are derived via DOI linkages based on the literature-cited section of published journal articles.
",
		'awrdData' => 'Displayed below are honors or awards you have received throughout your academic career. The general principle for the inclusion of an award in the database is that the award must be open to all people in a (sub-) discipline or to a large subset (i.e., age, gender) at the national and/or international level. State and local awards are not currently captured.',
		'bookData' => 'A book title is reported once per author/editor. Distinctions between authors and editors are displayed in the 4th column in the table below. Series editors are not included. Introductions, forewords, afterwords, and citations in and to books are not currently captured.',
		'grntData' => 'The Academic Analytics database captures grants data from 13 federal agencies matched to the principal investigator at the lead institution. Grants in active status are represented. Data are presented as annualized amounts based on the awarded or estimated amount of the grant divided by the number of years derived from either the start/end dates of the project or of the budget period where transactions have been reported. So, a $300,000 grant that runs from 1/1/2012-12/31/2015 would be assigned an annualized amount of $100,000.'
);

/** Tool Tips **/
$config['Tips'] = array(
		

		
);