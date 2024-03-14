$("document").ready(function (){

    $(".status_symbol").click(function (){
        var task_id = $(this).attr("data-task-id");
        $("#t_id").val(task_id);
    });    

});