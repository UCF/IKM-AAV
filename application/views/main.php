<?php
	$this->load->view("header");
?>
<style>
	#jqxWidget { padding-top: 10px; }
	.jqx-widget-content { font-size: 11px;}
	
	.jqx-tooltip-text { text-align: left; } 

	.green:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .green:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
            color: black;
            background-color: #b6ff00;
        }
        .yellow:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .yellow:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
            color: black;
            background-color: #FFE566;
        }
        .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
            color: black;
            background-color: #FF7979;
        }
		
	#csvExport {
		cursor: pointer;
	}
	#xlsExport {
		cursor: pointer;
	}
	#clearfilterbutton {
		cursor: pointer;
	}
	.jqx-fill-state-hover { background: #FAFAD2; } /*highlighter*/

</style>



	<div id="page_title">Welcome</div>
	
	<div id="page_summary">Welcome to the Academic Analytics Faculty validation tool.
	<P>This tool will allow users to view their own scholarly activity collected by Academic Analytics for the following key metrics: articles, citations, books, conference proceedings, grants, and awards.  The data for each metric can be
	seen by clicking on the tabs below.  If the message "No data to display" is shown, it simply means that academic analytics does not have information on you for the specfied area.

	</div>
	
	<div id="option_area_2">
		Most recent release file: <strong><?php echo $release; ?></strong>
	</div>
	<!--<div id="option_area_2">
				<label>Release Version:</label>
				<select id="release" name="release" class="styled-select">
				<?php
					/*$s = '';
					foreach ($release->result() as $release_key => $release_row){
						if ($release_row->releasename == $default){ $s = 'selected'; }					
							echo "\t<option value=\"$release_row->releasename\" $s>$release_row->releasename </option>\n";
					$s = '';
					}*/
					
				?>
				</select>
	</div>-->
	<?php 
			if($company == 'IKM'){
	?>
	<div id="option_area_2">
	
				<select id="facultychoice" name="facultychoice" class="styled-select">
				<?php
					$s = '';
					foreach ($fac_choice->result() as $release_key => $release_row){
						//if ($release_row->id == $default){ $s = 'selected'; }					
							echo "\t<option value=\"$release_row->id\" $s>$release_row->last_name, $release_row->first_name  </option>\n";
						$s = '';
					}
					
				?>
				</select>
	
	</div>
	<?php
		}
	?>
   	<div id="option_area">
		
	<div id="area1">
		<fieldset>   
		<legend>General Information</legend>
		 <div class="divTable">
                        <div class="divTableBody">
                                <div class="divTableRow">
                                        <div class="divTableCell">Name:</div>
                                        <div class="divTableCell" id="fac_name"></div>
                                </div>
                                <div class="divTableRow">
                                        <div class="divTableCell">Department:</div>
                                        <div class="divTableCell" id="fac_unit"></div>
                                </div>
                                <div class="divTableRow">
                                        <div class="divTableCell">Rank:</div>
                                        <div class="divTableCell" id="fac_rank"></div>
                                </div>
                                <div class="divTableRow">
                                        <div class="divTableCell">Tenure:</div>
                                        <div class="divTableCell" id="fac_tenure"></div>
                                </div>
                        </div>
                </div>
		</fieldset>
	</div>

	<div id="area2">
		<fieldset>   
		<legend>Artifact Summary</legend>
		<div class="divTable">
			<div class="divTableBody">
				<div class="divTableRow">
					<div class="divTableCell">Articles or Conference Papers:</div>
					<div class="divTableCell" id="summ_journals"></div>
				</div>
				<div class="divTableRow">
					<div class="divTableCell">Books Authored or Associated With:</div>
					<div class="divTableCell" id="summ_books"></div>
				</div>
				<div class="divTableRow">
					<div class="divTableCell">Grants and Total Dollars:</div>
					<div class="divTableCell" id="summ_grants"></div>
				</div>
				<div class="divTableRow">
					<div class="divTableCell">Awards Received:</div>
					<div class="divTableCell" id="summ_awards"></div>
				</div>
			</div>
		</div>
		</fieldset>
	</div>
	<fieldset class="tabinfo">
		<legend id="info_title"></legend>
		<div id="info_area"></div>
	</fieldset>
</div>		
	
	<div >
		Export table: 
		<!-- <a title="Excel" id="xlsExport"><img align="top" src="../img/page_excel.png"></a> -->
		<a title="CSV" id="csvExport"><img align="top" src="../img/page_white_text.png"></a>		
	</div>
	
<div class="container">	
	<div id="loading" class="modal"></div>
	<div id="jqxWidget">
		<div id="jqxTabs">
			<ul style='margin-left: 20px;'>
				<li>Articles</li>
				<li>Books</li>
				<li>Grants</li>
				<li>Awards</li>
			</ul>
	
			<div><div id="jrnlData"></div></div>
			<div><div id="bookData"></div></div>
			<div><div id="grntData"></div></div>
			<div><div id="awrdData"></div></div>
		</div>
 	</div>
</div>

<script type="text/javascript"> 
$(document).ready(function () {
		//get the tooltips for later
		var info = <?php echo json_encode($info, JSON_PRETTY_PRINT); ?>;
				
		//get the active tab upon selection
		var tabclicked = 0; //set on zero because every entry defaults to tab 0
		tabInfo = tabdiv(tabclicked);
		$('#info_area').empty();
		$('#info_area').html(info[tabInfo]);
		
		$('#jqxTabs').on('tabclick', function (event) {
			 tabclicked = event.args.item;
			 tabInfo = tabdiv(tabclicked);
			 
			 $('#info_area').empty();
			 $('#info_area').html(info[tabInfo]);
			 
		 });
		 
		 
		function tabdiv(tabNumber){
			switch (tabNumber){
					case 0:
						tabid = 'jrnlData';
						$('#info_title').empty();
						$('#info_title').text('Journal Information');
						break;
					case 1:
						tabid = 'bookData';
						$('#info_title').empty();
						$('#info_title').text('Book Information');
						break;
					case 2:
						tabid = 'grntData';
						$('#info_title').empty();
						$('#info_title').html('Grant Information');
						break;
					case 3:
						tabid = 'awrdData';
						$('#info_title').empty();
						$('#info_title').text('Award Information');
						break;
				 }
			return tabid;
		}
		$("#csvExport").click(function () {
			tabid = tabdiv(tabclicked);
			
		    exportinfo = $('#'+tabid+'').jqxGrid('exportdata', 'csv');
		    var now = new Date()
			download(exportinfo, 'APIM_Exported_Data.csv', 'text/csv');
		});
		
		//get the initial releasename values
		releasename = $('#release').val();
		
		//set grids for home tabs
	 	var initWidgets = function (tab) {
			
				if(typeof($('#facultychoice').val()) != "undefined"){
					id = $('#facultychoice').val();
				} else {
					id = '<?php echo trim($nid); ?>';
				}
				
				/*initJrnlGrid(id,releasename);
				initBookGrid(id,releasename);
				initGrntGrid(id,releasename);
				initAwrdGrid(id,releasename);*/
				
				initFacultyData(id);
				
                switch (tab) {
                    case 0:
                        initJrnlGrid(id,releasename);
                        break;
					case 1:
						initBookGrid(id,releasename);
						break;
					case 2:
						initGrntGrid(id,releasename);
						break;
					case 3:
						initAwrdGrid(id,releasename);
					break;
                }
            }
	    // Create jqxTabs.
            
			console.log(JSON.stringify(info))
			$('#jqxTabs').jqxTabs({ width: '100%' , height: '50%', position: 'top', initTabContent: initWidgets});
			var elements = $("#jqxTabs").find('ul:first').children();
	
            $.each(elements, function(index, value)
            {
                //alert($(this).text());
				//$(this).jqxTooltip({content: info[$(this).text()]});
            });
			
			//change releasename
			$("#facultychoice").change(function(){
				cid = $('#facultychoice').val();
				
	
				$("#loading").show();
				
				initJrnlGrid(cid,releasename);
				initBookGrid(cid,releasename);
				initGrntGrid(cid,releasename);
				initAwrdGrid(cid,releasename);
				
				initFacultyData(cid);

			});
        });
</script>	
<?php
	$this->load->view("footer");
?>
