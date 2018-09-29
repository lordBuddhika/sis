// JavaScript Document


	var deptLists = new Array(9) 
 	deptLists["Selected"] = ["Select a Deparment"];
	deptLists["Admin"] = ["Please Select","Funds","Others"];
	deptLists["Resource Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Student Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Course Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Exam Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Finance Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Payment Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Library Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Staff Management"] = ["Please Select","Table Chairs Sold Out","Others"];
	deptLists["Student"] = ["Please Select","Table Chairs Sold Out","Others"];
	
	function deptChange(selectObj) { 
  
 			var idx = selectObj.selectedIndex; 
        	var which = selectObj.options[idx].value;
			dList = deptLists[which]; 
 			var dSelect = document.getElementById("dept_task");
 			var len=dSelect.options.length; 
 
 			while (dSelect.options.length > 0) { 
 			dSelect.remove(0); 
 			}
			
			var newOption; 

 			for (var i=0; i<dList.length; i++) { 
 				newOption = document.createElement("option"); 
 				newOption.value = dList[i];  // assumes option string and value are the same 
 				newOption.text=dList[i]; 
 
 					try { 
 							dSelect.add(newOption);  // this will fail in DOM browsers but is needed for IE 
 					} 
 					catch (e) { 
 							dSelect.appendChild(newOption); 
 					} 
 			}  
	}
	
	var deptLists1 = new Array(9) 
 	deptLists1["Selected"] = ["Select a Deparment"];
	deptLists1["Admin"] = ["Please Select","Funds","Others"];
	deptLists1["Resource Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Student Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Course Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Exam Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Finance Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Payment Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Library Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Staff Management"] = ["Please Select","Table Chairs Buy","Others"];
	deptLists1["Student"] = ["Please Select","Table Chairs Buy","Others"];
	
	function deptChange_e(selectObj) { 
  
 			var idx = selectObj.selectedIndex; 
        	var which = selectObj.options[idx].value;
			dList = deptLists1[which]; 
 			var dSelect = document.getElementById("dept_task");
 			var len=dSelect.options.length; 
 
 			while (dSelect.options.length > 0) { 
 			dSelect.remove(0); 
 			}
			
			var newOption; 

 			for (var i=0; i<dList.length; i++) { 
 				newOption = document.createElement("option"); 
 				newOption.value = dList[i];  // assumes option string and value are the same 
 				newOption.text=dList[i]; 
 
 					try { 
 							dSelect.add(newOption);  // this will fail in DOM browsers but is needed for IE 
 					} 
 					catch (e) { 
 							dSelect.appendChild(newOption); 
 					} 
 			}  
	}
	
	
	function deptOthers(selectObj){
			var idx = selectObj.selectedIndex; 
        	var which = selectObj.options[idx].value;
			var others = document.getElementById("other_desc");
			
			if(which == "Others" || which == "others"){
				others.setAttribute('type','text');
			}else{
				others.setAttribute('type','hidden');
			}
	}
	
	function selOthers(selectObj){
			var idx = selectObj.selectedIndex; 
        	var which = selectObj.options[idx].value;
			var others = document.getElementById("other_desc");
			
			
				others.setAttribute('type','hidden');
			
	}
	
	function payOthers(selectObj){
			var idx = selectObj.selectedIndex; 
        	var which = selectObj.options[idx].value;
			var others = document.getElementById("other_pay");
			
			if(which == "Others" || which == "others"){
				others.setAttribute('type','text');
			}else{
				others.setAttribute('type','hidden');
			}
	}
	
	
/*	
	function progress(){
		
		var score = 0;
		var incomeId = document.getElementById("incomeid").value;
		var catogory = document.getElementById("dept").value;
		var description = document.getElementById("dept_task").value;
		var other_desc = document.getElementById("other_desc").value;
		var pay_opt = document.getElementById("pay").value;
		var other_pay = document.getElementById("other_pay").value;
		var amount = document.getElementById("amount").value;
		var paidby_cat = document.getElementById("paidby_cat").value;
		var paidby_student = document.getElementById("paidby_student").value;
		var paidby_staff = document.getElementById("paidby_staff").value;
		var paidby_others = document.getElementById("paidby_others").value;
		
		if(incomeId != ""){score == 16;}
		if(catogory != "Selected"){score += 15;}
		if((description != "Select a Department" || description != "Please Select") && description != "Others"){score == 49;}
		if(description == "Others"){score == 40;}
		if(description == "Others" && other_desc != ""){score == 49;}
		
		if(pay_opt != "Selected" || pay_opt != "Others"){score += 18;}
		if(pay_opt == "Others"){score += 9;}
		if(pay_opt == "Others" && other_pay != ""){score += 9;}
		if(isNaN(amount) == false && amount >0 && amount != ""){score += 18;}
		if(paidby_cat != "Selected" || paidby_cat != "others"){score += 18;}
		if(paidby_cat == "Others"){score += 9;}
		if(paidby_cat == "Others" && paidby_student != "Selected"){score += 9;}
		if(paidby_cat == "Others" && paidby_staff != "Selected"){score += 9;}
		if(paidby_cat == "Others" && paidby_others != ""){score += 9;}
		
		if(score>0){
		document.getElementById("progress_bar").style.width  = score + '%';
		document.getElementById("progress_bar").innerHTML(score);
		}

	
	}
	*/
	
	function openWindow() {
    window.open("Finance_Search_Incomes.php","_blank","height=600,width=400,status=yes,toolbar=no,menubar=no,location=no"); 
  }
  
function openWinStaff(user){
myWin = window.open("Finance_Staff_Identification.php?user="+user, "myWindow", 'resizable=0,top=300,left=500,width=500,height=600');
}
function openWin(){
myWin = window.open("popup.html", "myWindow", 'resizable=0,top=300,left=500,width=600,height=300');
}

function paidCatogory(selectObj){
	var idx = selectObj.selectedIndex; 
    var which = selectObj.options[idx].value;
	
	if(which == "Student" || which == "student"){
		document.getElementById("paidby_student").className = "form-control";
		document.getElementById("paidby_staff").className = "form-control message-hide";
		document.getElementById("paidby_others").className = "form-control message-hide";
		}
	else if(which == "Staff" || which == "staff"){
		document.getElementById("paidby_student").className = "form-control  message-hide";
		document.getElementById("paidby_staff").className = "form-control";
		document.getElementById("paidby_others").className = "form-control message-hide";
		}
	else if(which == "Others" || which == "others"){
		document.getElementById("paidby_student").className = "form-control  message-hide";
		document.getElementById("paidby_staff").className = "form-control message-hide";
		document.getElementById("paidby_others").className = "form-control";
		}
	else{
		document.getElementById("paidby_student").className = "form-control  message-hide";
		document.getElementById("paidby_staff").className = "form-control message-hide";
		document.getElementById("paidby_others").className = "form-control message-hide";
		}
	}
	
function incomeValidation(){
	
	var incomeId = document.getElementById("incomeid").value;
	
	if(incomeId == ""){
		
		document.getElementById("income_id_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message1").innerHTML = " Warning! ";
		document.getElementById("soft_message1").innerHTML = " System did not generated an income id";		
		return false;
	}
	
	var catogory = document.getElementById("dept").value;
	
	if(catogory == "Selected" || catogory == "selected"){
		document.getElementById("catogory_alert").className = "alert alert-danger alert-dismissible fade show";
		document.getElementById("strong_message2").innerHTML = " Oh snap! ";
		document.getElementById("soft_message2").innerHTML = " Select a Department and try submitting again.";
		return false;
	}
	else{
		document.getElementById("catogory_alert").className = "message-hide";
	}
	
	var description = document.getElementById("dept_task").value;
	var other_desc = document.getElementById("other_desc").value;
	
	if(description == "Select a Deparment" || description == "Please Select"){
		document.getElementById("dept_task_alert").className = "alert alert-danger alert-dismissible fade show";
		document.getElementById("strong_message3").innerHTML = " Oh snap! ";
		document.getElementById("soft_message3").innerHTML = " Select a Income way of the Department and try submitting again.";
		return false;
	}else if((description == "others" || description == "Others") && other_desc == ""){
		document.getElementById("dept_task_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message3").innerHTML = " Warning! ";
		document.getElementById("soft_message3").innerHTML = " Fill the other income source and try submitting again.";
		return false;
	}
	else{
		document.getElementById("dept_task_alert").className = "message-hide";
	}
	
	if((description == "others" || description == "Others") && other_desc == ""){
		document.getElementById("dept_task_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message3").innerHTML = " Warning! ";
		document.getElementById("soft_message3").innerHTML = " Fill the other income source and try submitting again.";
		return false;
	}else{
		document.getElementById("dept_task_alert").className = "message-hide";
	}
	
	var pay_opt = document.getElementById("pay").value;
	var other_pay = document.getElementById("other_pay").value;
	
	if(pay_opt == "Selected" || pay_opt == "selected"){
		document.getElementById("payment_alert").className = "alert alert-danger alert-dismissible fade show";
		document.getElementById("strong_message4").innerHTML = " Oh snap! ";
		document.getElementById("soft_message4").innerHTML = " Select a the Payment Method and try submitting again.";
		return false;
	}else if((pay_opt == "others" || pay_opt == "Others") && other_desc == ""){
		document.getElementById("payment_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message4").innerHTML = " Warning! ";
		document.getElementById("soft_message4").innerHTML = " Fill the other Payment option and try submitting again.";
		return false;
	} 
	else{
		document.getElementById("payment_alert").className = "message-hide";
	}
	
	if((pay_opt == "others" || pay_opt == "Others") && other_desc == ""){
		document.getElementById("payment_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message4").innerHTML = " Warning! ";
		document.getElementById("soft_message4").innerHTML = " Fill the other Payment option and try submitting again.";
		return false;
	}else{
		document.getElementById("payment_alert").className = "message-hide";
	}
	
	var amount = document.getElementById("amount").value;
	
	if(amount == ""){
		document.getElementById("amount_alert").className = "alert alert-danger alert-dismissible fade show";
		document.getElementById("strong_message5").innerHTML = " Oh snap! ";
		document.getElementById("soft_message5").innerHTML = " Fill an amount and try submitting again.";
		return false;
	}
	else{
		document.getElementById("amount_alert").className = "message-hide";
	} 
	
	if(isNaN(amount)){
		document.getElementById("amount_alert").className = "alert alert-danger alert-dismissible fade show";
		document.getElementById("strong_message5").innerHTML = " Oh snap! ";
		document.getElementById("soft_message5").innerHTML = " Enter numbers only and try submitting again.";
		return false;
	}
	else{
		document.getElementById("amount_alert").className = "message-hide";
	} 
	
	
	if(amount<=0){
		document.getElementById("amount_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message5").innerHTML = " Warning! ";
		document.getElementById("soft_message5").innerHTML = " Enter valid numbers only and try submitting again.";
		return false;
	}
	else{
		document.getElementById("amount_alert").className = "message-hide";
	}
	
	var paidby_cat = document.getElementById("paidby_cat").value;
	var paidby_student = document.getElementById("paidby_student").value;
	var paidby_staff = document.getElementById("paidby_staff").value;
	var paidby_others = document.getElementById("paidby_others").value;	
	
	if(paidby_cat == "Selected" || paidby_cat == "selected"){
		document.getElementById("paidby_alert").className = "alert alert-danger alert-dismissible fade show";
		document.getElementById("strong_message6").innerHTML = " Oh snap! ";
		document.getElementById("soft_message6").innerHTML = " Select a Paid Person Catogory and try submitting again.";
		return false;
	}
	else{
		document.getElementById("paidby_alert").className = "message-hide";
	}
	
	if((paidby_cat == "Student" || paidby_cat == "student") && (paidby_student == "selected" || paidby_student == "Selected")){
		document.getElementById("paidby_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message6").innerHTML = " Oh snap! ";
		document.getElementById("soft_message6").innerHTML = " Select a Student and try submitting again.";
		return false;
	}
	else{
		document.getElementById("paidby_alert").className = "message-hide";
	}
	
	if((paidby_cat == "Staff" || paidby_cat == "staff") && (paidby_staff == "selected" || paidby_staff == "Selected")){
		document.getElementById("paidby_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message6").innerHTML = " Oh snap! ";
		document.getElementById("soft_message6").innerHTML = " Select a Staff and try submitting again.";
		return false;
	}
	else{
		document.getElementById("paidby_alert").className = "message-hide";
	}
	
	if((paidby_cat == "Others" || paidby_cat == "others") && paidby_others == ""){
		document.getElementById("paidby_alert").className = "alert alert-warning alert-dismissible fade show";
		document.getElementById("strong_message6").innerHTML = " Oh snap! ";
		document.getElementById("soft_message6").innerHTML = " Fill an other Person and try submitting again.";
		return false;
	}
	else{
		document.getElementById("paidby_alert").className = "message-hide";
	}
	
	return true;
	
	}

function deleteModal(placementid,id){
var html;
html+='<div class="modal fade" id="modalWindow" aria-hidden="true">';
html+='<div class="modal-dialog" role="document">';
html+='<div class="modal-content">';
html+='<div class="modal-header">';
html+='<h5 class="modal-title" id="exampleModal">Delete Income</h5>';
html+='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
html+='<span aria-hidden="true">&times;</span>';
html+='</button>';
html+='</div>';
html+='<div class="modal-body">';
html+='Are you sure you want to delete this income INC'+id+' ?';
html+='</div>';
html+='<div class="modal-footer">';
html+='<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
html+='<form action="" method="post">';
html+='<input type="text" value="'+id+'" name="income_id">';
html+='<input type="submit" value=" Delete " name="delete" class="btn btn-danger">';
html+='</form>';
html+='</div>';
html+='</div>';
html+='</div>';
html+='</div>';
$("#"+placementId).html(html);
    $("#modalWindow").modal();
}

function search(){
	
	if(document.getElementById("search"))
	{
		alert("Search Text is Empty!...");
		return false;
	}
	return true;
}