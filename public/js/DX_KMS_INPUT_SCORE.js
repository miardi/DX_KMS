$(function(){
    // checkbox for PT
    $("#ptSwitch").on("click",function(ev){
        if($(this).is(":checked")){
            $(".pt-score").removeAttr("disabled");
        }
        else {
            $(".pt-score").attr("disabled","true");
        }
        
    })

    // checkbox for HT
    $("#htSwitch").on("click",function(ev){
        if($(this).is(":checked")){
            $(".ht-score").removeAttr("disabled");
        }
        else {
            $(".ht-score").attr("disabled","true");
        }
        
    })
    
})