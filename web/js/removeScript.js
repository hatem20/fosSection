/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function removeme(x){
    bootbox.confirm({
        size: 'small',
        message: "Do you want to remove yourself from this section?", 
        callback: function(result){
            if (result === true){   
                window.location.href = "DeleteStudent?secId="+x+"";
            }
        }
    });
}

function enroll(addSec,num){
    //Student is enrolled in another section
    var msg = "Are You sure you want to enroll in this section?";
    if(num > 20){
        bootbox.alert("Maximum No Of Students");
    }
    //console.log(isEnrolled());
    else{
    bootbox.confirm({ 
        size: 'small',
        message: msg, 
        callback: function(result){
            if(result == true){
                $.post("EnrollStudent",{sectionid: addSec},function(result){
                    if(result == "0"){
                        window.location.href = "./";
                    }
                    else if(result == "1"){
                        bootbox.confirm({ 
                            size: 'small',
                            message: "if ok you will be removed from the other ?", 
                            callback: function(result){
                                if(result == true){
                                    $.post("EnrollStudent",{granted: "confirmed",sectionid: addSec},function(result){
                                        location.reload();
                                    });
                                }
                            }
                        });
                    }
                    else{
                        bootbox.alert("Maximum No Of Students");
                    }
                });
            }
        }
    });
}}