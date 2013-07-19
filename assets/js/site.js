function loadDatePickers() {
      $('#mainViewPicker').datepicker();
}

function mainViewCheckServiceType() {
	 //$("#id").css("display", "block");

	
	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", { "action" : "getDefaultCosts" }, 
  	   function(data){
    	
   	 	var tmp = $('#serviceType').val();
	 	if (tmp == "repair") {
			$('#serviceCostVal').val(data.repair);
			$('#partCostVal').val("");
	 	}
	 	else if (tmp == "sale") {
	 		$('#partCostVal').val(data.sale);
	 		$('#serviceCostVal').val("");
	 	}
	 	else if (tmp == "upgrade") {
	 		$('#serviceCostVal').val(data.upgrade);
	 		$('#partCostVal').val("0");
	 	}

  	  }, "json");

	 var tmp = $('#serviceType').val();
	 if(tmp == "") {
	 	//Basically we should hide all the fields!
		$('#deviceControl').hide();
		$('#serviceCost').hide();
	 	$('#partCost').hide();
		$('#nameControl').hide();
		$('#radioSearch').hide();
		$('#searchID').hide();
		$('#searchName').hide();
		$('input[name="partSelector"]').prop('checked', false);
		$('#partName option:eq(0)').prop('selected', true);
		$('#partID option:eq(0)').prop('selected', true);
	 }
	 else if (tmp == "repair" || tmp == "upgrade") {

	 	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", { "action" : "getAllDevices" },
  	    function(data){

	 	 var allDevices = data.devices;
	 	 //Populate our deviceControl with allDevices:
	 	 var options = '<option value=""></option><option value="0">New Device</option>';
		 for (var i = 0; i < allDevices.length; i++) 
				options += '<option value="' + allDevices[i] + '">' + allDevices[i] + '</option>';
 
		 // Inject the HTML options variable into the select box
  		$('#deviceSelect').html(options);

  		//Now present proper options:
  		if (tmp == "upgrade") {
	 		$('#deviceControl').show();
			$('#radioSearch').show();
			$('#serviceCost').show();
	 		$('#partCost').show();
			$('#nameControl').hide();
			$('#searchID').hide();
			$('#searchName').hide();
			$('input[name="partSelector"]').prop('checked', false);
			$('#deviceSelect option:eq(0)').prop('selected', true);
  		}
  		else if (tmp == "repair") {
	 		$('#deviceControl').show();
	 		$('#serviceCost').show();
	 		$('#partCost').hide();
			$('#nameControl').hide();
			$('#radioSearch').hide();
			$('#searchID').hide();
			$('#searchName').hide();
			$('input[name="partSelector"]').prop('checked', false);
			$('#deviceSelect option:eq(0)').prop('selected', true);
		}
  	  }, "json");

	 }

	 else if (tmp == "sale") {
	 	//Basically we should hide all the fields!
		$('#radioSearch').show();
		$('#partCost').show();
	 	$('#serviceCost').hide();
		$('#deviceControl').hide();
		$('#nameControl').hide();
		$('#searchID').hide();
		$('#searchName').hide();
		$('input[name="partSelector"]').prop('checked', false);
		$('#partName option:eq(0)').prop('selected', true);
		$('#partID option:eq(0)').prop('selected', true);
	 }
}

function mainViewCheckDeviceName() {
 var tmp = $('#deviceSelect').val();
	 if(tmp == "0") {
	 	//Basically we should hide all the fields!
		$('#nameControl').show();
	 }
	 else {
	 	$('#nameControl').hide();
	 }
}

function mainViewCheckSearchType(caller) {
	 if(caller == "Name") {
	 	//Basically we should hide all the fields!
		$('#searchName').show();
		$('#searchID').hide();
		$('#searchCategory').hide();
		$('#partID option:eq(0)').prop('selected', true);
		$('#partCategory option:eq(0)').prop('selected', true);
	 }
	 else if(caller == "Part") {
	 	//Basically we should hide all the fields!
		$('#searchName').hide();
		$('#searchID').show();
		$('#searchCategory').hide();
		$('#partName option:eq(0)').prop('selected', true);
		$('#partCategory option:eq(0)').prop('selected', true);	
	 }
	 else if(caller == "Category") {
	 	//Basically we should hide all the fields!
		$('#searchName').hide();
		$('#searchID').hide();
		$('#searchCategory').show();
		$('#partID option:eq(0)').prop('selected', true);
		$('#partName option:eq(0)').prop('selected', true);
	 }
}

function mainViewCheckPartPrice(caller) {

	var tmp = '';
	if(caller == "Name") {
	 	tmp += $('#partName').val();
	 }
	 else if(caller == "ID") {
	 	tmp += $('#partID').val();
	 }

     var postData = {
    	action: "getCostForPart",
    	partID: tmp
	 };

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){
			$('#partCostVal').val(data.cost);
  	  }, "json"); 

}

function mainViewCheckPartInfo(caller) {

	var tmp = '';
	if(caller == "Name") {
	 	tmp += $('#partName').val();
	 }
	 else if(caller == "ID") {
	 	tmp += $('#partID').val();
	 }

     var postData = {
    	action: "getInfoForPart",
    	partID: tmp
	 };

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){
  	   		//Populate all the info data:
			$('#partMain + h2').html(data.partName);
  	  		$('#partMain + p').html(data.desc);

  	  		$('#partCategory + p').html(data.part_type);

  	  }, "json"); 

}

function mainViewCheckPartCategory() {

	var tmp = $('#partCategory').val();
	 
     var postData = {
    	action: "getPartsInCategory",
    	category: tmp
	 };

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){
  	   		//Populate all the available parts for this category:
  	   		
			$('#partCostVal').val(data.cost);
  	  
  	  }, "json"); 

}


