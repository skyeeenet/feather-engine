
$("#selall").click(function () {
        if (!$("#selall").is(":checked")){
            $(".checkbox").prop('checked', false);
        }
        else{
            $(".checkbox").prop("checked","checked");
        }
    });

