    // autocomplet : this function will be executed every time we change the text
    var error_messages = [];
    function validate_tanknumber() {
    	var part_one = document.getElementById('tank_number');        
        var valueOfCharacters = [];
        valueOfCharacters["A"] = 10;
        valueOfCharacters["B"] =  12;
        valueOfCharacters["C"] =  13;
        valueOfCharacters["D"] =  14;
        valueOfCharacters["E"] =  15;
        valueOfCharacters["F"] =  16;
        valueOfCharacters["G"] =  17;
        valueOfCharacters["H"] =  18;
        valueOfCharacters["I"] =  19;
        valueOfCharacters["J"] =  20;
        valueOfCharacters["K"] =  21;
        valueOfCharacters["L"] =  23;
        valueOfCharacters["M"] =  24;
        valueOfCharacters["N"] =  25;
        valueOfCharacters["O"] =  26;
        valueOfCharacters["P"] =  27;
        valueOfCharacters["Q"] =  28;
        valueOfCharacters["R"] =  29;
        valueOfCharacters["S"] =  30;
        valueOfCharacters["T"] =  31;
        valueOfCharacters["U"] =  32;
        valueOfCharacters["V"] =  34;
        valueOfCharacters["W"] =  35;
        valueOfCharacters["X"] =  36;
        valueOfCharacters["Y"] =  37;
        valueOfCharacters["Z"] =  38;
        
        var tankNumber = part_one.value;
        var alphabets = tankNumber.substr(0, 4);
        var numbers = tankNumber.substr(4, 9);
        //alert("test ->"+alphabets);
        //alert("alpha ->"+alphabets+"numbers ->"+numbers);
        var last_digit = tankNumber.substr(10, 10);
        var encode_value_for_alphabits = [];
        var encode_value_for_tank_number = [];
        for (var i = 0; i <= 3; i++) {
            encode_value_for_alphabits[i] = valueOfCharacters[alphabets[i]];
            encode_value_for_tank_number[i] = valueOfCharacters[alphabets[i]];
        }
        var j = 0;
	for (var i = 4; i <= 9; i++) {       		
            encode_value_for_tank_number[i] = numbers[j];
            j = j+1;		
        }
        var sum_of_step_one = 0;    
        var two_power_values = [];
        var step_one = [];
        //alert("Sum of Step One ->"+Math.pow(2, 2));
        for (var i = 0; i <= 9; i++) {
            two_power_values[i] = Math.pow(2, i);
            step_one[i] = encode_value_for_tank_number[i]*two_power_values[i];
            sum_of_step_one = sum_of_step_one+step_one[i];   // A
        }
        // alert(two_power_values[0]+"-"+two_power_values[1]+"-"+two_power_values[2]+"-"+two_power_values[3]+"-"+two_power_values[4]+"-"+two_power_values[5]+"-"+two_power_values[6]);
        //alert(encode_value_for_tank_number[0]+"-"+encode_value_for_tank_number[1]+"-"+encode_value_for_tank_number[2]+"-"+encode_value_for_tank_number[3]+"-"+encode_value_for_tank_number[4]+"-"+encode_value_for_tank_number[5]+"-"+encode_value_for_tank_number[6]+"-"+encode_value_for_tank_number[7]+"-"+encode_value_for_tank_number[8]+"-"+encode_value_for_tank_number[9]);
        //alert(step_one[0]+"-"+step_one[1]+"-"+step_one[2]+"-"+step_one[3]+"-"+step_one[4]+"-"+step_one[5]+"-"+step_one[6]+"-"+step_one[7]+"-"+step_one[8]+"-"+step_one[9]);
        var step_two = sum_of_step_one/11;  // B
        //alert("cought->"+part_one.value+"-"+part_two.value+"-"+part_three.value);
        //alert("Step two ->"+step_two);
	var step_three = parseInt(step_two); // C 
	
	var step_four = step_three*11; // D
        
        var step_five = sum_of_step_one-step_four;  // E
        
        if(step_five == last_digit) {
            $("#error_message").html('');
             $("#tank_number").css("border-color", "");
             delete error_messages['1'];
             var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);
            //	return "Tank Number is Currect";
            //alert("Tank Number is currect");
            //document.getElementsByName("check_already_in").submit();
            //$("form[name='check_already_in']").submit();
        } else {
            //$('input[name="tank_number"]').focus();
            //document.getElementById("tank_number").focus();
            //$("#error_message").html('Incorrect Tank Number');            
            $("#tank_number").css("border-color", "red");
            $("#tank_number").focus();
            error_messages['1'] = 'Incorrect Tank Number';
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);  
            //alert("Incorrect Tank Number");
            //document.getElementById("tank_number").css("background-color", "red");
        }
    }
    
    function validateDateIn() {
        var date_in = document.getElementById('date_in');    
        if(date_in.value == '') {
            //$("#error_message").html('Date In should be selected');
            $("#date_in").focus();
            $("#date_in").css("border-color", "red");
            
            error_messages['2'] = 'Date In should be selected';
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);  
        } else {
           // $("#error_message").html('');
            delete error_messages['2'];
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);              
            $("#date_in").css("border-color", "");
        }
    }
    
    function validateInTime() {
        var in_time = document.getElementById('in_time');    
        if(in_time.value == '') {
            //$("#error_message").html('Date In should be selected');
            $("#in_time").focus();
            $("#in_time").css("border-color", "red");
            
            error_messages['3'] = 'Time In should be entered';
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);  
        } else if(in_time.value != '') {
            var in_time_value = in_time.value;
            var result = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/.test(in_time_value);
            console.log("pattern result ->"+result);
            if(!result) {
                $("#in_time").css("border-color", "red");
                error_messages['3'] = 'Invalid Time given';
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            } else {
                $("#in_time").css("border-color", "");
                delete error_messages['3'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);  
            }            
        } else {
           // $("#error_message").html('');
            delete error_messages['3'];
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);  
            $("#in_time").focus();
            $("#in_time").css("border-color", "");
        }
    }
    
    function validateCleaningStartDate() {
        var cleaning_start_date = document.getElementById('cleaning_start_date');    
        var date_in = document.getElementById('date_in');   
        if(cleaning_start_date.value != '') {
            //$("#error_message").html('Date In should be selected');
            var csd_array = (cleaning_start_date.value).split("/");
            var din_array = (date_in.value).split("/");
            
            
            var cleaning_start_date_string = csd_array[2]+'-'+csd_array[1]+'-'+csd_array[0];
            var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
            
            console.log("csd->"+cleaning_start_date_string);
            console.log("din->"+date_in_string);
            
            var cs_date = Date.parse(cleaning_start_date_string);
            var din_date = Date.parse(date_in_string);
            
            if(cs_date < din_date) {
                error_messages['4'] = 'Cleaning Start Date cannot be less than Date In';
                $("#cleaning_start_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);  
            } else {
                $("#cleaning_start_date").css("border-color", "");
                delete error_messages['4'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);       
            }         
        } else {
           // $("#error_message").html('');
           $("#cleaning_start_date").css("border-color", "");
            delete error_messages['4'];
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            console.log("testing--");
            $("#error_message").html(error_messages_string);              
        }
    }
    
    
    function validateCleaningEndDate() {
        var cleaning_start_date = document.getElementById('cleaning_start_date');
        var cleaning_end_date = document.getElementById('cleaning_end_date');    
        var date_in = document.getElementById('date_in');   
        if(cleaning_end_date.value != '') {
            //$("#error_message").html('Date In should be selected');            
            if(cleaning_start_date.value == '') {
                error_messages['5.1'] = 'Cleaning Start Date Should be selected';
                $("#cleaning_start_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);    
            } else {
                var ced_array = (cleaning_end_date.value).split("/");
                var din_array = (date_in.value).split("/");
                var cleaning_end_date_string = ced_array[2]+'-'+ced_array[1]+'-'+ced_array[0];
                var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
                
                var csd_array = (cleaning_start_date.value).split("/");
                var cleaning_start_date_string = csd_array[2]+'-'+csd_array[1]+'-'+csd_array[0];
                $("#cleaning_start_date").css("border-color", "");
                delete error_messages['5.1'];
                            
                var cs_date = Date.parse(cleaning_start_date_string);
                var ce_date = Date.parse(cleaning_end_date_string);
                var din_date = Date.parse(date_in_string);
                
                if(ce_date < cs_date) {
                    error_messages['5'] = 'Cleaning End Date cannot be less than Cleaning Start Date';
                    $("#cleaning_end_date").css("border-color", "red");
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);  
                } else {
                    $("#cleaning_end_date").css("border-color", "");
                    delete error_messages['5'];
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);       
                }
            }      
        } 
    }
    
    
    function validateCleaningStatus() {
        var cleaning_start_date = document.getElementById('cleaning_start_date');
        var cleaning_end_date = document.getElementById('cleaning_end_date');    
        var cleaning_status = document.getElementById('cleaning_status');   
        
        var cleaning_status_value = cleaning_status.value;
        
        if(cleaning_start_date.value != '' && cleaning_end_date.value != '') {
            if((cleaning_status_value != 'Cleaned - Awaiting Survey') && (cleaning_status_value != 'Cleaned - Surveyor Approved')) {
                error_messages['6.1'] = 'Invalid Cleaning Status, it should be selected as \'Cleaned - Awaiting Survey\' or \'Cleaned - Surveyor Approved\' ';
                $("#cleaning_status").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
            } else {
                $("#cleaning_status").css("border-color", "");
                delete error_messages['6.1'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            }
        }
    }
    
    
    function validateEstimateSentDate() {
        var estimate_sent_date = document.getElementById('estimate_sent_date');    
        var date_in = document.getElementById('date_in');   
        if(estimate_sent_date.value != '') {
            //$("#error_message").html('Date In should be selected');
            var esd_array = (estimate_sent_date.value).split("/");
            var din_array = (date_in.value).split("/");
                        
            var estimate_sent_date_string = esd_array[2]+'-'+esd_array[1]+'-'+esd_array[0];
            var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
                                    
            var es_date = Date.parse(estimate_sent_date_string);
            var din_date = Date.parse(date_in_string);
            
            if(es_date < din_date) {
                error_messages['7'] = 'Estimate Sent Date cannot be less than Date In';
                $("#estimate_sent_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);  
            } else {
                $("#estimate_sent_date").css("border-color", "");
                delete error_messages['7'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);       
            }
        } else {
            // $("#error_message").html('');
            $("#estimate_sent_date").css("border-color", "");
            delete error_messages['7'];
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);              
        }
    }
    
    
    function validateEstimateApprovedDate() {
        var estimate_sent_date = document.getElementById('estimate_sent_date');
        var estimate_approved_date = document.getElementById('estimate_approved_date');    
        var date_in = document.getElementById('date_in');   
        if(estimate_approved_date.value != '') {
            //$("#error_message").html('Date In should be selected');            
            if(estimate_sent_date.value == '') {
                error_messages['8.1'] = 'Estimate Sent Date Should be selected';
                $("#estimate_sent_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);    
            } else {
                var din_array = (date_in.value).split("/");
                var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
                
                var eapd_array = (estimate_approved_date.value).split("/");
                var estimate_approved_date_string = eapd_array[2]+'-'+eapd_array[1]+'-'+eapd_array[0];                
                
                var esd_array = (estimate_sent_date.value).split("/");
                var estimate_sent_date_string = esd_array[2]+'-'+esd_array[1]+'-'+esd_array[0];
                
                $("#estimate_sent_date").css("border-color", "");
                delete error_messages['8.1'];
				var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
                            
                var es_date = Date.parse(estimate_sent_date_string);
                var eap_date = Date.parse(estimate_approved_date_string);
                var din_date = Date.parse(date_in_string);
                
                if(eap_date < es_date) {					
                    error_messages['8'] = 'Estimate Approved Date cannot be less than Estimate Sent Date';
                    $("#estimate_approved_date").css("border-color", "red");
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);  
                } else {
                    $("#estimate_approved_date").css("border-color", "");
                    delete error_messages['8'];
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);       
                }
            }      
        } 
    }
    
    
    function validateRepairStartDate() {
        var repair_start_date = document.getElementById('repair_start_date');    
        var date_in = document.getElementById('date_in');  
        var cleaning_end_date = document.getElementById('cleaning_end_date');    
        if(repair_start_date.value != '') {            
            
            //$("#error_message").html('Date In should be selected');
            var rsd_array = (repair_start_date.value).split("/");
            var din_array = (date_in.value).split("/");
            var ced_array = (cleaning_end_date.value).split("/");
            
            var repair_start_date_string = rsd_array[2]+'-'+rsd_array[1]+'-'+rsd_array[0];
            var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
            var cleaning_end_date_string = ced_array[2]+'-'+ced_array[1]+'-'+ced_array[0];
               
            var rs_date = Date.parse(repair_start_date_string);
            var din_date = Date.parse(date_in_string);
            var ced_date = Date.parse(cleaning_end_date_string);
            
            var date_to_compare = '';
            
            if(cleaning_end_date.value != '') {
                date_to_compare = ced_date;
            } else {
                date_to_compare = din_date;
            }
            
            if(rs_date < date_to_compare) {
                error_messages['11'] = 'Repair Start Date cannot be less than Date In and Cleaning End Date';
                $("#repair_start_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);  
            } else {
                $("#repair_start_date").css("border-color", "");
                delete error_messages['11'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);       
            }         
        } else {
           // $("#error_message").html('');
           console.log("repair start date empty");
           $("#repair_start_date").css("border-color", "");
            delete error_messages['11'];
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);              
        }
    }
    
    
    function validateRepairEndDate() {
        var repair_start_date = document.getElementById('repair_start_date');
        var repair_end_date = document.getElementById('repair_end_date');    
        var date_in = document.getElementById('date_in');   
        if(repair_end_date.value != '') {
            //$("#error_message").html('Date In should be selected');            
            if(repair_start_date.value == '') {
                error_messages['12.1'] = 'Repair Start Date Should be selected';
                $("repair_start_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);    
            } else {
                var red_array = (repair_end_date.value).split("/");                
                var repair_end_date_string = red_array[2]+'-'+red_array[1]+'-'+red_array[0];
                                                
                var rsd_array = (repair_start_date.value).split("/");
                var repair_start_date_string = rsd_array[2]+'-'+rsd_array[1]+'-'+rsd_array[0];
                
                $("#repair_end_date").css("border-color", "");
                delete error_messages['12.1'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);   
                
                var rs_date = Date.parse(repair_start_date_string);
                var re_date = Date.parse(repair_end_date_string);
                
                
                if(re_date < rs_date) {
                    error_messages['12'] = 'Repair End Date cannot be less than Repair Start Date';
                    $("#repair_end_date").css("border-color", "red");
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);  
                } else {
                    $("#repair_end_date").css("border-color", "");
                    delete error_messages['12'];
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);       
                }
            }      
        } 
    }
    
    function validateTestType() {
        var test_type = document.getElementById('test_type');
        var is_test_due = document.getElementById('is_test_due');
        if(test_type.value != '') {
            if(is_test_due.value == 'No') {
                error_messages['13'] = 'Is Test Due to be selected as \'Yes\' ';
                $("#test_type").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
            } else {
                $("#test_type").css("border-color", "");
                delete error_messages['13'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            }
        }
    }
    
        
    function validateTestDate() {
        
        var date_in = document.getElementById('date_in');
        var repair_start_date = document.getElementById('repair_start_date');
        var repair_end_date = document.getElementById('repair_end_date');
        var cleaning_end_date = document.getElementById('cleaning_end_date'); 
        var test_type = document.getElementById('test_type'); 
        
        var test_date = document.getElementById('test_date');  
        if(test_date.value != '') {
            if(repair_end_date.value != '') {
                var rsd_array = (repair_start_date.value).split("/");
                var repair_start_date_string = rsd_array[2]+'-'+rsd_array[1]+'-'+rsd_array[0];
                var rs_date = Date.parse(repair_start_date_string);
                
                var red_array = (repair_end_date.value).split("/");
                var repair_end_date_string = red_array[2]+'-'+red_array[1]+'-'+red_array[0];
                var re_date = Date.parse(repair_end_date_string);   
                
                var ted_array = (test_date.value).split("/");
                var test_date_string = ted_array[2]+'-'+ted_array[1]+'-'+ted_array[0];
                var te_date = Date.parse(test_date_string);  
                
                if((te_date >= rs_date) && (te_date <= re_date)) {
                    error_messages['14.1'] = 'Test Date cannot be between repair start date and repair end date';
                    $("#test_date").css("border-color", "red");
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);   
                } else {
                    $("#test_date").css("border-color", "");
                    delete error_messages['14.1'];
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);       
                }
            }			
			if(cleaning_end_date.value != '') {
                var ced_array = (cleaning_end_date.value).split("/");
                var cleaning_end_date_string = ced_array[2]+'-'+ced_array[1]+'-'+ced_array[0];
                var ce_date = Date.parse(cleaning_end_date_string);
                
                var ted_array = (test_date.value).split("/");
                var test_date_string = ted_array[2]+'-'+ted_array[1]+'-'+ted_array[0];
                var te_date = Date.parse(test_date_string);  
                
                if(ce_date >= te_date) {
                    error_messages['14.2'] = 'Test Date cannot be less than or same as cleaning end date';
                    $("#test_date").css("border-color", "red");
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);   
                } else {
					if( error_messages['14.1'] === undefined ) {
						 $("#test_date").css("border-color", "");
					}                   
                    delete error_messages['14.2'];
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);       
                }
            } else if(date_in.value != '') {
                var din_array = (date_in.value).split("/");
                var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
                var date_in = Date.parse(date_in_string);
                
                var ted_array = (test_date.value).split("/");
                var test_date_string = ted_array[2]+'-'+ted_array[1]+'-'+ted_array[0];
                var te_date = Date.parse(test_date_string);  
                
                if(date_in > te_date) {
                    error_messages['14.4'] = 'Test Date cannot be less than Date In';
                    $("#test_date").css("border-color", "red");
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);   
                } else {
                    if( error_messages['14.1'] === undefined ) {
						 $("#test_date").css("border-color", "");
					} 
                    delete error_messages['14.4'];
                    var error_messages_string = '';
                    for(var key in error_messages) {
                        error_messages_string += error_messages[key] + "<br />";
                    }
                    $("#error_message").html(error_messages_string);       
                }
            } else if(test_type.value == '') {
                error_messages['14.3'] = 'Test Type should be selected';
                $("#test_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);   
            } else {
                if( error_messages['14.1'] === undefined ) {
					$("#test_date").css("border-color", "");
			    } 
                delete error_messages['14.3'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);       
            }
        } 
    }
    
    
    function validateAvailableDate() {
        var test_date = document.getElementById('test_date'); 
        var repair_end_date = document.getElementById('repair_end_date');
        var cleaning_end_date = document.getElementById('cleaning_end_date');
        var date_in = document.getElementById('date_in');
        
        var available_date = document.getElementById('available_date');
        var avd_array = (available_date.value).split("/");
        var available_date_string = avd_array[2]+'-'+avd_array[1]+'-'+avd_array[0];
        var av_date = Date.parse(available_date_string);
        
        if(test_date.value != '') {
            var ted_array = (test_date.value).split("/");
            var test_date_string = ted_array[2]+'-'+ted_array[1]+'-'+ted_array[0];
            var te_date = Date.parse(test_date_string); 
            console.log("av date ->"+av_date+" te date ->"+te_date);
            if(av_date < te_date) {
                error_messages['16.1'] = 'Available Date cannot be less than Test Date';
                $("#available_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            } else {
                $("#available_date").css("border-color", "");
                delete error_messages['16.1'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
            }
        } else if(repair_end_date.value != '') {
            var red_array = (repair_end_date.value).split("/");
            var repair_end_date_string = red_array[2]+'-'+red_array[1]+'-'+red_array[0];
            var re_date = Date.parse(repair_end_date_string); 
            if(av_date < re_date) {
                error_messages['16.2'] = 'Available Date cannot be less than Repair End Date';
                $("#available_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            } else {
                $("#available_date").css("border-color", "");
                delete error_messages['16.2'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
            }
        } else if(cleaning_end_date.value != '') {
            var ced_array = (cleaning_end_date.value).split("/");
            var cleaning_end_date_string = ced_array[2]+'-'+ced_array[1]+'-'+ced_array[0];
            var ce_date = Date.parse(cleaning_end_date_string); 
            if(av_date < ce_date) {
                error_messages['16.3'] = 'Available Date cannot be less than Cleaning End Date';
                $("#available_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            } else {
                $("#available_date").css("border-color", "");
                delete error_messages['16.3'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
            }
        } else if(date_in.value != '') {
            var din_array = (date_in.value).split("/");
            var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
            var din_date = Date.parse(date_in_string); 
            if(av_date < din_date) {
                error_messages['16.4'] = 'Available Date cannot be less than Date In';
                $("#available_date").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            } else {
                $("#available_date").css("border-color", "");
                delete error_messages['16.4'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
            }
        }
    }
    
    
    function validateDateout() {
        var test_date = document.getElementById('test_date'); 
        var repair_end_date = document.getElementById('repair_end_date');
        var cleaning_end_date = document.getElementById('cleaning_end_date');
        var date_in = document.getElementById('date_in');        
        var available_date = document.getElementById('available_date');
        var date_out = document.getElementById('date_out');
        
        var tank_status = document.getElementById('tank_status');
        
        var avd_array = (available_date.value).split("/");
        var available_date_string = avd_array[2]+'-'+avd_array[1]+'-'+avd_array[0];
        var av_date = Date.parse(available_date_string);
        
        var dod_array = (date_out.value).split("/");
        var date_out_date_string = dod_array[2]+'-'+dod_array[1]+'-'+dod_array[0];
        var do_date = Date.parse(date_out_date_string);
        
        if(date_out.value != '') {
			$("#date_out").css("border-color", "");
            delete error_messages['17.7'];
            var error_messages_string = '';
            for(var key in error_messages) {
                error_messages_string += error_messages[key] + "<br />";
            }
            $("#error_message").html(error_messages_string);
            if(tank_status.value == '29') {
                $("#date_out").css("border-color", "");
                delete error_messages['17.5'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
                if(available_date.value == '') {
                    if(test_date.value != '') {
                        var ted_array = (test_date.value).split("/");
                        var test_date_string = ted_array[2]+'-'+ted_array[1]+'-'+ted_array[0];
                        var te_date = Date.parse(test_date_string); 

                        if(do_date < te_date) {
                            error_messages['17.1'] = 'Date Out cannot be less than Test Date';
                            $("#date_out").css("border-color", "red");
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string); 
                        } else {
                            $("#date_out").css("border-color", "");
                            delete error_messages['17.1'];
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string);
                        }
                    } else if(repair_end_date.value != '') {
                        var red_array = (repair_end_date.value).split("/");
                        var repair_end_date_string = red_array[2]+'-'+red_array[1]+'-'+red_array[0];
                        var re_date = Date.parse(repair_end_date_string); 
                        if(do_date < re_date) {
                            error_messages['17.2'] = 'Date Out cannot be less than Repair End Date';
                            $("#test_date").css("border-color", "red");
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string); 
                        } else {
                            $("#date_out").css("border-color", "");
                            delete error_messages['17.2'];
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string);
                        }
                    } else if(cleaning_end_date.value != '') {
                        var ced_array = (cleaning_end_date.value).split("/");
                        var cleaning_end_date_string = ced_array[2]+'-'+ced_array[1]+'-'+ced_array[0];
                        var ce_date = Date.parse(cleaning_end_date_string); 
                        if(do_date < ce_date) {
                            error_messages['17.3'] = 'Date Out cannot be less than Cleaning End Date';
                            $("#date_out").css("border-color", "red");
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string); 
                        } else {
                            $("#date_out").css("border-color", "");
                            delete error_messages['17.3'];
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string);
                        }
                    } else if(date_in.value != '') {
                        var din_array = (date_in.value).split("/");
                        var date_in_string = din_array[2]+'-'+din_array[1]+'-'+din_array[0];
                        var din_date = Date.parse(date_in_string); 
                        if(do_date < din_date) {
                            error_messages['17.4'] = 'Date Out cannot be less than Date In';
                            $("#date_out").css("border-color", "red");
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string); 
                        } else {
                            $("#date_out").css("border-color", "");
                            delete error_messages['17.4'];
                            var error_messages_string = '';
                            for(var key in error_messages) {
                                error_messages_string += error_messages[key] + "<br />";
                            }
                            $("#error_message").html(error_messages_string);
                        }
                    }
                } else {
                    if(do_date < av_date) {
                        error_messages['17.6'] = 'Date Out cannot be less than Available Date';
                        $("#date_out").css("border-color", "red");
                        var error_messages_string = '';
                        for(var key in error_messages) {
                            error_messages_string += error_messages[key] + "<br />";
                        }
                        $("#error_message").html(error_messages_string); 
                    } else {
                        $("#date_out").css("border-color", "");
                        delete error_messages['17.6'];
                        var error_messages_string = '';
                        for(var key in error_messages) {
                            error_messages_string += error_messages[key] + "<br />";
                        }
                        $("#error_message").html(error_messages_string);
                    }
                }                
            } else {
                error_messages['17.5'] = 'Tank Status should be selected \'Tank Out \'';
                $("#date_out").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            }
        } else {
            if(tank_status.value == '29') {
                error_messages['17.7'] = 'Date Out cannot be empty if Tank Status is \'Tank Out \' ';
                $("#date_out").css("border-color", "red");
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string); 
            } else {
                $("#date_out").css("border-color", "");
                delete error_messages['17.7'];
                var error_messages_string = '';
                for(var key in error_messages) {
                    error_messages_string += error_messages[key] + "<br />";
                }
                $("#error_message").html(error_messages_string);
            }
        }
    }
    
    
    function validateForm() {
        
		retainDropDownValues();
        $count = 0;
        for(var key in error_messages) {
            console.log("value ->"+error_messages[key]);
            $count = $count+1;
        }
        if($count > 0) {            
            console.log("validate form sending false");
            return false;
        } else {
            console.log("validate form sending true");
            return true;
        }
    }
    
  function retainDropDownValues() {
        var cleaning_status = document.getElementById('cleaning_status'); 
        console.log("cleaning status ->"+cleaning_status.value);
    }