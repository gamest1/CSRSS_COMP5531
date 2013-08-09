function loadDatePickers() {
      $('#purchaseDatePicker').datepicker();
      $('#paymentBeginPicker').datepicker();
      $('#paymentEndPicker').datepicker();
}

function check10digits() {
	if( $('#newPartID').val().length == 10 ) {
		$('#firstButton').removeAttr("disabled");                             
	}	
	else { 
		$('#firstButton').attr("disabled", "disabled");
	}	
}

function paymentViewGetPaymentsForID() {
	 var tmp = $('#employeeID').val();
	 $('#hiddenID').val(tmp);
	 if( tmp == "all" ) {
	 	$('#allEmployeesTable').show();
	 	$('#allTables').hide();
	 }
	 else {
		 $('#allEmployeesTable').hide();
		 
		 var postData = {
	    	action: "getAllPaymentsForEmployee",
    		employee: tmp
    	 };

    	 $('#ajaxLoad').show();
		 $('#alert').remove();

	 	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   	 function(data){
    	
    		$('#ajaxLoad').hide();
    		$('#allTables').show();

   	 		var resp = data.payments;

   	 		if (resp.length > 0) {
   	 			//Now we have all the payments info... build the tables:
var tableView = '<table class="table table-striped table-bordered table-hover">';
tableView += "<tr><th>Employee ID</th><th>Period Begins</th><th>Period Ends</th><th>Payment Amount</th><th>Payment Code</th><th>Date Processed</th></tr>";

var employeeID = $('#employeeID').val();

for(var i=0;i<resp.length;i++) {
                var row = "";
                var rowHash = resp[i];

                row += "<tr>";
                row += '<td id="employee' + i + '">' + employeeID ;
                row += '</td><td><input type="hidden" value="' + rowHash['period_start_on'] + '" id="periodStart' + i + '">' + rowHash['period_start_on'];
                row += '</td><td><input type="hidden" value="' + rowHash['period_finish_on'] + '" id="periodEnd' + i + '">' + rowHash['period_finish_on'];
                row += "</td><td>" + rowHash['amount'] + "</td>";

                var code = rowHash['payment_code'];
                if (code) {
                  row += "<td>" + code + "</td>";
                  row += "<td>" + rowHash['paid_on'] + "</td>";
                }
                else {
                  row += '<td><input type="text" placeholder="input 4-digit payment code here" maxlength="4" class="ctrl-textbox" id="paymentCode' + i + "\"></td>";
                  row += '<td><input type="button" id="paymentButton" onclick="sendCode(' + i + ');" value="Process Payment"></td>';
                }

                row += "</tr>";
                tableView += row;    
}

tableView += "</table>";
$('#paymentsTable').html(tableView);
$('#paymentsTable').show();

   	 		}
   	 		else {
   	 			//No payments for this employee. Show something:
$('#paymentsTable').html("No payments found for this employee!");
$('#paymentsTable').hide();

   	 		}

   	 		resp = data.unpaid;
   	 		if (resp.length > 0) {
   	 			//Now we have all the unpaid services info... build the tables:

var tableView2 = '<table class="table table-striped table-bordered table-hover">';
tableView2 += "<tr><th>Unpaid service ID</th><th>Performed on</th><th>Type of service</th><th>Amount owed to employee</th></tr>";

for( var i=0; i < resp.length ; i++) {
                var row = "";
                var rowHash = resp[i];

                row += "<tr>";
                row += "<td>" + rowHash['serviceID'] + "</td><td>" + rowHash['date'] + "</td><td>" + rowHash['type'] + "</td><td>" + rowHash['paid_to_employee'] + "</td>";
                row += "</tr>";

                tableView2 += row;    
}

tableView2 += "</table>";
$('#unpaidTable').html(tableView2);
$('#unpaidTable').show();
$('#calendars').show();

   	 		}
   	 		else {
   	 			//No unpaid services for this employee. Show something:
$('#unpaidTable').html("No unpaid services found for this employee!");
$('#unpaidTable').hide();
$('#calendars').hide();

   	 		}

	  	 }, "json");

	 }
}

function sendCode(caller) {
   
   var elementCode;

   var tmp = $('#employeeID').val();
   var tmp1;
   var tmp2;
   var tmp3;

   if (tmp=="all") {
   	  elementCode = "#Employee" + caller;
   	  tmp = $(elementCode).text();
	  elementCode = "#PaymentCode" + caller;
      tmp1 = $(elementCode).val();
      elementCode = "#PeriodStart" + caller;
      tmp2 = $(elementCode).val();
      elementCode = "#PeriodEnd" + caller;
      tmp3 = $(elementCode).val();
   }
   else {
 	elementCode = "#paymentCode" + caller;
    tmp1 = $(elementCode).val();
    elementCode = "#periodStart" + caller;
    tmp2 = $(elementCode).val();
    elementCode = "#periodEnd" + caller;
    tmp3 = $(elementCode).val();
   }

   var postData = {
    	action: "saveCode",
    	employee: tmp,
    	code: tmp1,
    	dateBeg: tmp2,
    	dateEnd: tmp3
	 };

   	$('#ajaxLoad').show();
	$('#alert').remove();

	alert("" + tmp+ "CODE: "+ tmp1 + " " + tmp2+ tmp3);

	$.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){
    	
    	$('#ajaxLoad').hide();

   	 	var resp = data.string;

   	 	alert(resp);
   	 	if (resp == "SUCCESS") {
   	 		location.reload();
   	 	}
   	 	else {
   	 		var newdiv1 = $( "<div class='alert alert-error' id='alert'/>" );
   	 		$('#message').append(newdiv1);
   	 		$('#alert').html("We had a problem while trying to save the payment code. Please, try again!");
   	 	}

  	  }, "json");
}

function mainViewCheckServiceType() {
	 //$("#id").css("display", "block");

	 $('#ajaxLoad').show();

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", { "action" : "getDefaultCosts" }, 
  	   function(data){
    	
    	$('#ajaxLoad').hide();

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

		$('#ajaxLoad').show();

	 	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", { "action" : "getAllDevices" },
  	    function(data){

  	    $('#ajaxLoad').hide();

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

function updateViewFirstCheck(caller) {

	 $('#inventoryInfo').hide();
	 $('#partInfo').hide();				
	 $('#computerInfo').hide();
	 $('#desktopInfo').hide();
	 $('#laptopInfo').hide();
	 $('#newButton').hide();
	 $('#updateButton').hide();
	 
	if($("#alert").get(0)) {
		$('#alert').remove();
	}
	else {
	       $('#partName').val('');
           $('#description').val('');
           $('#cost').val('');
           $('#installationCost').val('');
           $('#numberSold').val('');
           $('#numberAvailable').val('');
           $('#wholePrice').val('');

           		$('#processor').val('');
    			$('#os').val('');
      			$('#antivirus').val('');
      			$('#ram').val('');
      			$('#memory_specs').val('');
      			$('#gb').val('');
      			$('#storage_specs').val('');
      			$('#otherInfo').val('');

				$('#enclosure').val('');
      			$('#power_unit').val('');
     			$('#mother_board').val('');
      			$('#monitor').val('');
      			$('#mouse').val('');
      			$('#keyboard').val('');

      			$('#screen_size').val('');
        		$('#battery_life').val('');
        		$('#battery_specs').val('');
     }   		

	 if(caller == "new") {
		$('#newPartIDDIV').show();
		$('#partIDDIV').hide();
		$('#partID option:eq(0)').prop('selected', true);
		$('#firstButton').show();
	 }
	 else if(caller == "update") {
	 	$('#newPartID').val('');
		$('#newPartIDDIV').hide();
		$('#partCategoryDIV').hide();
		$('#partIDDIV').show();
		$('#partCategory option:eq(0)').prop('selected', true);
		$('#firstButton').hide();
	}

}

function updateViewFetchAll() {

     var tmp = $('#partID').val();
	 var postData = {
    	action: "getAllInfoForPart",
    	partID: tmp
	 };

     $('#ajaxLoad').show();

		   $('#partName').val('');
           $('#description').val('');
           $('#cost').val('');
           $('#installationCost').val('');
           $('#numberSold').val('');
           $('#numberAvailable').val('');
           $('#wholePrice').val('');

           		$('#processor').val('');
    			$('#os').val('');
      			$('#antivirus').val('');
      			$('#ram').val('');
      			$('#memory_specs').val('');
      			$('#gb').val('');
      			$('#storage_specs').val('');
      			$('#otherInfo').val('');

				$('#enclosure').val('');
      			$('#power_unit').val('');
     			$('#mother_board').val('');
      			$('#monitor').val('');
      			$('#mouse').val('');
      			$('#keyboard').val('');

      			$('#screen_size').val('');
        		$('#battery_life').val('');
        		$('#battery_specs').val('');


	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){

	  	   	$('#ajaxLoad').hide();

			$('#inventoryInfo').show();
			$('#partInfo').show();

            var submitType = $('input:radio[name=partSelector]:checked').val();
            if(submitType == "new") {
				$('#newButton').show();
				$('#updateButton').hide();
				$('#typeForUpdate').hide();
            }
            else if(submitType == "update") {
				$('#newButton').hide();
				$('#updateButton').show();
				$('#typeForUpdate').show();
            } 

			var part_type = data.part_type;
			$('#hiddenType').val(part_type);

			if(part_type == "desktop" || part_type == "laptop") {

				$('#processor').val(data.processor);
    			$('#os').val(data.os);
      			$('#antivirus').val(data.antivirus);
      			$('#ram').val(data.RAM_in_MB);
      			$('#memory_specs').val(data.memory_specs);
      			$('#gb').val(data.GB);
      			$('#storage_specs').val(data.storage_specs);
      			$('#otherInfo').val(data.otherInfo);


			if (part_type == "desktop") {
				$('#computerInfo').show();
				$('#desktopInfo').show();
				$('#laptopInfo').hide();

				$('#enclosure').val(data.enclosure);
      			$('#power_unit').val(data.power_unit);
     			$('#mother_board').val(data.mother_board);
      			$('#monitor').val(data.monitor);
      			$('#mouse').val(data.mouse);
      			$('#keyboard').val(data.keyboard);

			}
			else if (part_type == "laptop") {
				$('#computerInfo').show();
				$('#laptopInfo').show();
				$('#desktopInfo').hide();

		        $('#screen_size').val(data.screen_size);
        		$('#battery_life').val(data.battery_life);
        		$('#battery_specs').val(data.battery_specs);
			}

			}
			else {
				$('#computerInfo').hide();
				$('#laptopInfo').hide();
				$('#desktopInfo').hide();	
			}

	  	   	//Now that you have all the info, populate all the fields:
           $('#partName').val(data.partName);
           $('#description').val(data.desc);
           $('#cost').val(data.cost);
           $('#installationCost').val(data.installation_cost);
           $('#numberSold').val(data.numberSold);
           $('#numberAvailable').val(data.numberAvailable);
           $('#wholePrice').val(data.whole_price);



  	  }, "json"); 


}

function createNewPartID() {
	$('#partCategoryDIV').show();
	$('#firstButton').hide();
}


function createNewPartShowAll() {
	//Display all boxes:
	var submitType = $('input:radio[name=partSelector]:checked').val();
            if(submitType == "new") {
				$('#newButton').show();
				$('#updateButton').hide();
            }
            else if(submitType == "update") {
				$('#newButton').hide();
				$('#updateButton').show();
            } 

	var type = $('#partCategory').val();
    
	 $('#inventoryInfo').show();
	 $('#partInfo').show();				


    if( type == "desktop") {
	 	$('#computerInfo').show();
	 	$('#desktopInfo').show();
	    $('#laptopInfo').hide();
    }
    else if( type == "laptop") {
    	$('#computerInfo').show();
	 	$('#desktopInfo').hide();
	    $('#laptopInfo').show();
    } 
    else {
	    $('#computerInfo').hide();
	 	$('#desktopInfo').hide();
	    $('#laptopInfo').hide();	
    }

}

function mainViewCheckSearchType(caller) {

    $('#partMain').find('h2').first().html('');
  	$('#partMain').find('p').first().html('');
  	$('#partPrice').find('h3').first().html('');
  	$('#partInfo1').find('h2').first().html('');
  	$('#partInfo1').find('p').first().html('');

  	$('#partMain').hide();
  	$('#partPrice').hide();
  	$('#partInfo1').hide();
  	$('#partInfo2').hide();


    $('#partCostVal').val('');


	 if(caller == "Name") {
	 	//Basically we should hide all the fields!
		$('#searchName').show();
		$('#searchID').hide();
		$('#partID option:eq(0)').prop('selected', true);
	 }
	 else if(caller == "Part") {
	 	//Basically we should hide all the fields!
		$('#searchName').hide();
		$('#searchID').show();
		$('#partName option:eq(0)').prop('selected', true);
	 }
	 // else if(caller == "Category") {
	 // 	//Basically we should hide all the fields!
		// $('#searchName').hide();
		// $('#searchID').hide();
		// $('#searchCategory').show();
		// $('#partID option:eq(0)').prop('selected', true);
		// $('#partName option:eq(0)').prop('selected', true);
	 // }
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

     $('#ajaxLoad').show();

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){

	  	   	$('#ajaxLoad').hide();
			$('#partCostVal').val(data.cost);
  	  }, "json"); 

}

function mainViewCheckPartInfo(caller) {

	$('#partMain').find('h2').first().html('');
  	$('#partMain').find('p').first().html('');
  	$('#partPrice').find('h3').first().html('');
  	$('#partInfo1').find('h2').first().html('');
  	$('#partInfo1').find('p').first().html('');

  	$('#partMain').hide();
  	$('#partPrice').hide();
  	$('#partInfo1').hide();
  	$('#partInfo2').hide();

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

     $('#ajaxLoad').show();

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){
  	   		//Populate all the info data:

            $('#ajaxLoad').hide();

			$('#partMain').find('h2').first().html(data.partName);
  	  		$('#partMain').find('p').first().html(data.desc);
  	  		$('#partPrice').find('h3').first().html("PRICE: $" + data.cost);
 

            if(data.installation_cost == 0) {
				$('#partInfo1').find('h4').first().html("No installation cost!");
  	  			$('#partInfo1').find('p').first().html('');
            }
            else {
  	  			$('#partInfo1').find('h4').first().html("Installation: $" + data.installation_cost);
  	  			$('#partInfo1').find('p').first().html("This item has the default installation cost shown above!");
  	  		}
  	  		//Show the fields:

  	  		$('#partMain').show();
  	  		$('#partPrice').show();
  	  		$('#partInfo1').show();
  	  		$('#partInfo2').show();

  	  }, "json"); 

}

function mainViewCheckPartCategory() {

    //Hide and empty everything:
     $('#partPrice').hide();
     $('#partMain').hide();
     $('#searchName').hide();
     $('#searchID').hide();
     $('#partInfo1').hide();
     $('#partInfo2').hide();
     // //Reset the options to none:
     $('#partID').html('');
	 $('#partName').html('');

	 $('input[name="partSelector"]').prop('checked', false);
	 $('#radioSearch').hide();


	var tmp = $('#partCategory').val();
	 
     var postData = {
    	action: "getPartsInCategory",
    	category: tmp
	 };

	 $('#ajaxLoad').show();

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){
  	   
  	     //Populate all the available parts for this category:
  	     //Find a way to populate select options: 
 		$('#ajaxLoad').hide();
  	    
  	    var partNames = '<option value=""></option>';
 		var partIds = '<option value=""></option>';

        var lim = data.ides.length;

		for(var i=0; i < lim; i++) {
 		  partNames += '<option value="' + data.ides[i] + '">' + data.names[i] + '</option>' + "\n";
          partIds += '<option value="' + data.ides[i] + '">' + data.ides[i] + '</option>' + "\n";
		}

		$('#partID').html(partIds);
		$('#partName').html(partNames);
		$('#radioSearch').show();	
  	  
  	  }, "json"); 

}

function deviceHistoryViewGetHistory() {

	 var tmp = $('#deviceSelect').val();
	 $('#historyTable').html('');
	 $('#deviceMain').find('h2').first().html('');
	 $('#deviceMain').find('h4').first().html('');
	 $('#deviceMain').find('p').first().html('');

     var postData = {
    	action: "getHistoryForDevice",
    	deviceName: escape(tmp)
	 };

     $('#ajaxLoad').show();

	 $.post("https://clipper.encs.concordia.ca/~kxc55311/models/ajax.php", postData,
  	   function(data){

	  	   	$('#ajaxLoad').hide();

	  	   	//Assamble the table:

	  	   	var lim = 0;
			if(data !== undefined && data.serviceList !== undefined)
	  	   		var lim = data.serviceList.length;

	  	   	if(lim > 0) {
            
                        $('#deviceMain').find('h2').first().html(data.deviceName);
	 					$('#deviceMain').find('h4').first().html("Owned by: " + data.deviceOwner);
	 					$('#deviceMain').find('p').first().html(data.deviceDesc);
            	
            	var resp = "<table class=\"table table-striped table-bordered table-hover\"><tr><th>Service ID</th><th>Type</th><th>Date</th><th>Performed by</th><th>Details</th></tr>";

            	for(var i=0; i<lim; i++) {
            		var row = "";
            		var hash=data.serviceList[i];
            		row += "<tr>";
            		row += "<td>" + hash['serviceID'] + "</td><td>" + hash['type'] + "</td>";
            		row += "<td>" + hash['date'] + "</td><td>" + hash['employeeID'] + "</td>";
            		row += "<td>" + hash['details'] + "</td>";
            		row += "</tr>";
            		resp += row; 
           		 }

            	resp += "</table>";
        	}
        	else {
        		resp = "<h4>There are no service instances for the selected device!</h4>";
        	}

            $('#historyTable').html(resp);


  	  }, "json"); 

}

