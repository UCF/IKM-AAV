<?php
	$this->load->view("header");
?>




	<div id="page_title">Welcome</div>
	
	<div id="page_summary">
	<p>Welcome to the Academic Analytics Faculty validation tool.
    <p>This tool will allow users to view their own scholarly activity collected by Academic Analytics for the following key metrics: articles, citations, books, conference proceedings, grants, and awards. You can access your data by clicking the "Data" link on the navigation bar above. 
	Once in, further information on each metric is available once you have clicked on the tab with the specified metric. If the message "No data to display" is shown, it simply means that Academic Analytics does not have information on you for the specified area. This data is refreshed annually around December, which means that new works you may have published since this release will not populate into the tool until the next annual refresh. 

	<p>For questions, please contact <a href="mailto:AcademicAnalytics@ucf.edu">AcademicAnalytics@ucf.edu</a>
	<hr />
	<p><strong>Academic Analytics Is:</strong>
	<p>Academic Analytics is an independent company offering business intelligence data to over 385 universities across the country and abroad. By accessing public databases, the tool is able to identify employee matches on key metrics of scholarly activity: articles, citations, books, conference proceedings, grants, honors, and awards. Reports and visualizations provide scholarly activity summaries for departments and Ph.D. programs. Scholarly productivity can also be viewed on a comparative scale based on national benchmarks for the discipline.
	<p><strong>Academic Analytics Is Not:</strong>
		<ul>
		<li>Public ranking tool</li>
		<li>Replacement for a CV</li>
		<li>Score for individual faculty members</li>
		<li>Not used for faculty evaluation</li>
		</ul>
	<p><strong>Who is included in the dataset?</strong>
		<ul>
		<li>Snapshot of November 1 HR database from 2012 to 2016
		<li>Tenured and tenure-track faculty
		<li>Faculty who are not tenured or tenure-track, but who are expected to produce research
		<li>Departments – All faculty meeting the requirements above who are paid out of the department
		<li>Programs – All faculty meeting the requirements above who are involved in the PhD program
		</ul>
	<p><strong>What is measured?</strong>
		<ul>
		<li>Citations – to journal articles and conference proceedings, not books
		<li>Books – does not include book chapters
		<li>Articles – only peer-reviewed
		<li>Honors and awards – only nationally competitive
		<li>Grants – from 13 federal agencies and 2 non-federal
		<li>Conference proceedings – only peer-reviewed
		</ul>
	<table>
		<tr>
			<td>
				<p><strong>Limitations</strong>
				<ul>
				<li>Does not capture local awards
				<li>Does not capture institutional funding
				<li>Cannot measure impact
				<li>Does not capture federal sub-awards
				<li>Does not capture patents
				<li>Does not capture creative works
				<li>Liberal arts colleges are not included
				</ul>
			</td>
			<td>
				<p><strong>Intended Uses</strong>
				<ul>
				<li>Award nomination
				<li>Program/Department reviews
				<li>Find funding/grants
				<li>Identify peers resembling your unit
				<li>Strategic hiring
				<li>Find areas of interdisciplinary strength
				<li>Determine high-exposure journals
				</ul>
			</td>
		</tr>
	</table>
	<p>
	<strong>Resources</strong>
	
	<p>
	<strong>Additional Information on Metrics from Academic Analytics </strong>
	</p>
	
	<p>
	<a href="<?= site_url('/files')?>/Grants.pdf" target="_blank">Grants(pdf)</a>
	</p>
	<p>
	<a href="<?= site_url('/files')?>/Awards.pdf" target="_blank">Awards(pdf)</a>
	</p>
	<p>
	<a href="<?= site_url('/files')?>/Publications.pdf" target="_blank">Publications(pdf)</a>
	</p>
	
	<p>
	<strong>Other Resources</strong>
	</p>
	<p>
	IKM Website: <a href="http://ikm.ucf.edu/analytics/faculty-analytics/">http://ikm.ucf.edu/analytics/faculty-analytics/</a>
	<br />
	UCF Email: <a href="mailto:AcademicAnalytics@ucf.edu">AcademicAnalytics@ucf.edu</a>
	<br />
	Academic Analytics Website: <a href="https://www.academicanalytics.com/">https://www.academicanalytics.com/</a>
	</div>
	
	
<?php
	$this->load->view("footer");
?>
