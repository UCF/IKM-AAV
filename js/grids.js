function initFacultyData(idin){

	$.ajax({
		type: "GET",
		url: "../main/faculty_summary",
		data: { idcheck : idin },
		async: false,
		dataType: 'json',
		success: function(response) {
				$.each(response, function(index, element) {
					/*$('body').append($('<div>', {
						text: element.name
					}));
					*/
					$("#fac_name").html(element.fac_name);
					$("#fac_rank").html(element.fac_rank);
					$("#fac_tenure").html(element.fac_tenure);
					$("#fac_unit").html(element.fac_unit);
					$("#summ_journals").html(element.summ_journals);
					$("#summ_awards").html(element.summ_awards);
					$("#summ_books").html(element.summ_books);
					$("#summ_grants").html(element.grant_verbiage);
				});
		}
	});
}
function initJrnlGrid(idin,release) {
	
	var JrnlUrl = "../main/data_journal"; //location for the first data pull
	
	var JrnlSource =
		{
		    datatype: "json",
		    id: 'id',
		    url: JrnlUrl,
		    cache: false,
	        pagenum: 0,
	        data: { idcheck: idin, releasename: release  },
		    datafields: [
				{ name: 'Journal Name',type: 'string'},{ name: 'Title', type:'string'},
				{ name: 'Publication Year',type: 'number'},{ name: 'Volume',type: 'number'},
				{ name: 'Issue',type: 'number'},{ name: 'Publisher',type: 'string'},
				{ name: 'DOI',type: 'string'},{ name: 'Citations',type: 'number'},{ name: 'Conference Paper',type: 'string'},
				{ name: 'Release',type: 'string'}, { name: 'Name', type: 'string'}
		    ],
		}
	var JrnlAdapter = new $.jqx.dataAdapter(JrnlSource, { loadComplete: function () {
                $("#loading").hide();
            }
            });
		
	
	var toolTip = function(element){
	var ele = $(element).text();
	        element.jqxTooltip({ 
			position: 'top',
			//content: tips[ele],
			theme: 'metrodark',
			autoHideDelay: 0,
			width: 200
		})   			
	
	}
	
	$("#jrnlData").jqxGrid({
		    source: JrnlAdapter,
		    theme: 'energyblue',
		    pageable: false,
		    autoheight: true,
		    width: '100%',
		    columnsresize: true,
	        sortable: true,
            filterable: true,	
		    autoshowfiltericon: false,
		    enabletooltips: true,
		    enablehover: true,
			autoshowloadelement: false,
		    columns: [
			{ text: 'Name', align: 'left', datafield: 'Name', width:150,rendered: toolTip},
			{ text: 'Journal',   align: 'center', datafield: 'Journal Name',  width:450 , editable: false,filterable: false, rendered: toolTip},
			{ text: 'Title', align: 'center', datafield: 'Title', width:500, pageable: false, editable: false, rendered: toolTip},			
			{ text: 'Publication Year', align: 'center', datafield: 'Publication Year', width:110, rendered: toolTip},			
			{ text: 'Volume', align: 'center', datafield: 'Volume', width:95,rendered: toolTip},			
			{ text: 'Issue', align: 'center', datafield: 'Issue', width:95,rendered: toolTip},						
			{ text: 'Citations', align: 'center', datafield: 'Citations', width:95,rendered: toolTip},			
			{ text: 'Conference Paper ?', datafield: 'Conference Paper', width:135,rendered: toolTip },
			{ text: 'DOI', datafield: 'DOI', align: 'center',filterable:true ,width:200,rendered: toolTip},
			{ text: 'Release', datafield: 'Release', align: 'center',filterable:true ,width:200,rendered: toolTip}
		    ]
		}); 
	
}
function initGrntGrid(idin,release) {
	
	var url = "../main/data_grant"; //location for the first data pull
	
	var source =
		{
		    datatype: "json",
		    id: 'id',
		    url: url,
		    cache: false,
	            pagenum: 0,
	            data: { idcheck: idin, releasename: release  },
		    datafields: [
				{ name: 'Agency',type: 'string'},{ name: 'GrantName', type:'string'},
				{ name: 'Start Year',type: 'number'},{ name: 'End Year',type: 'number'},
				{ name: 'Total Dollars',type: 'float'}, { name: 'Release',type: 'string'}, { name: 'Name', type: 'string'}
		    ]
		}
	var Adapter = new $.jqx.dataAdapter(source, { loadComplete: function () {
                $("#loading").hide();
            }
            });
		
	
	var toolTip = function(element){
	var ele = $(element).text();
	        element.jqxTooltip({ 
			position: 'top',
			//content: tips[ele],
			theme: 'metrodark',
			autoHideDelay: 0,
			width: 200
		})   			
	
	}
	
	$("#grntData").jqxGrid({
		    source: Adapter,
		    theme: 'energyblue',
		    pageable: false,
		    autoheight: true,
		    width: '100%',
		    columnsresize: true,
	        sortable: true,
		    filterable: true,	
		    autoshowfiltericon: false,
		    enabletooltips: true,
		    enablehover: true,
			autoshowloadelement: false,
		    columns: [
			{ text: 'Name', align: 'left', datafield: 'Name', width:150,rendered: toolTip},
			{ text: 'Agency',   align: 'center', datafield: 'Agency',  width:250 , editable: false,filterable: false, rendered: toolTip},
			{ text: 'Grant Name', align: 'center', datafield: 'GrantName', width:500, pageable: false, editable: false, rendered: toolTip},			
			{ text: 'Starting Year', align: 'center', datafield: 'Start Year', width:115, rendered: toolTip},			
			{ text: 'Ending Year', align: 'center', datafield: 'End Year', width:115,rendered: toolTip},			
			{ text: 'Total Dollars', align: 'center', datafield: 'Total Dollars', cellsformat: "c", width:120 ,rendered: toolTip},
			{ text: 'Release', datafield: 'Release', align: 'center',filterable:true ,width:200,rendered: toolTip}
		    ]
		}); 
}
function initAwrdGrid(idin,release) {
	
	var awrdUrl = "../main/data_award"; //location for the first data pull
	
	var awrdSource =
		{
		    datatype: "json",
		    id: 'id',
		    url: awrdUrl,
		    cache: false,
	            pagenum: 0,
	            data: { idcheck: idin, releasename: release  },
		    datafields: [
				{ name: 'Society',type: 'string'},{ name: 'Award', type:'string'},
				{ name: 'Year',type: 'number'}, { name: 'Release',type: 'string'}, { name: 'Name', type: 'string'}
		    ]
		}
	var awrdAdapter = new $.jqx.dataAdapter(awrdSource);
		
	
	var toolTip = function(element){
	var ele = $(element).text();
	        element.jqxTooltip({ 
			position: 'top',
			//content: tips[ele],
			theme: 'metrodark',
			autoHideDelay: 0,
			width: 200
		})   			
	
	}
	
	$("#awrdData").jqxGrid({
		    source: awrdAdapter,
		    theme: 'energyblue',
		    pageable: false,
		    autoheight: true,
		    width: '100%',
		    columnsresize: true,
	        sortable: true,
		    filterable: true,	
		    autoshowfiltericon: false,
		    enabletooltips: true,
		    enablehover: true,
		    columns: [
			{ text: 'Name', align: 'left', datafield: 'Name', width:150,rendered: toolTip},
			{ text: 'Society Name',   align: 'center', datafield: 'Society',  width:250 , editable: false,filterable: false, rendered: toolTip},
			{ text: 'Award Name', align: 'center', datafield: 'Award', width:500, pageable: false, editable: false, rendered: toolTip},			
			{ text: 'Year', align: 'center', datafield: 'Year', width:115, rendered: toolTip}, 
			{ text: 'Release', datafield: 'Release', align: 'center',filterable:true ,width:200,rendered: toolTip}		
		    ]
		}); 
}
function initBookGrid(idin,release) {
	
	var bookUrl = "../main/data_book"; //location for the book json data pull
	
	var bookSource =
		{
		    datatype: "json",
		    id: 'id',
		    url: bookUrl,
		    cache: false,
	            pagenum: 0,
	            data: { idcheck: idin, releasename: release  },
		    datafields: [
				{ text: 'Name', align: 'left', datafield: 'Name', width:150,rendered: toolTip},
				{ name: 'Title',type: 'string'},{ name: 'Author', type:'string'},
				{ name: 'Publication Year',type: 'number'},{ name: 'Editor',type: 'string'},
				{ name: 'Book Type',type: 'string'},{ name: 'Member Role',type: 'string'},
				{ name: 'ISBN',type: 'string'}, { name: 'Release',type: 'string'}, { name: 'Name', type: 'string'}
		    ]
		}
	var bookAdapter = new $.jqx.dataAdapter(bookSource);
		
	
	var toolTip = function(element){
	var ele = $(element).text();
	        element.jqxTooltip({ 
			position: 'top',
			//content: tips[ele],
			theme: 'metrodark',
			autoHideDelay: 0,
			width: 200
		})   			
	
	}
	
	$("#bookData").jqxGrid({
		    source: bookAdapter,
		    theme: 'energyblue',
		    pageable: false,
		    autoheight: true,
		    width: '100%',
		    columnsresize: true,
	        sortable: true,
		    filterable: true,	
		    autoshowfiltericon: false,
		    enabletooltips: true,
		    enablehover: true,
		    columns: [
			{ text: 'Name', align: 'left', datafield: 'Name', width:150,rendered: toolTip},
			{ text: 'Title',   align: 'center', datafield: 'Title',  width:500 , editable: false,filterable: false, rendered: toolTip},
			{ text: 'Author', align: 'center', datafield: 'Author', width:200, pageable: false, editable: false, rendered: toolTip},			
			{ text: 'User as Editor?', align: 'center', datafield: 'Editor', width:125, rendered: toolTip},
			{ text: 'Publication Year', align: 'center', datafield: 'Publication Year', width:170, rendered: toolTip},
			{ text: 'Type of Book', align: 'center', datafield: 'Book Type', width:105, rendered: toolTip},
			{ text: 'User Role', align: 'center', datafield: 'Member Role', width:105, rendered: toolTip},
			{ text: 'ISBN', align: 'center', datafield: 'ISBN', width:125, rendered: toolTip},
			{ text: 'Release', datafield: 'Release', align: 'center',filterable:true ,width:200,rendered: toolTip}
		    ]
		}); 
}