
    function addInstructor(element){
        var tr = $(element).closest('tr');
        tr.find(".col-2").children("a").text('delete');
        $(element).attr("onclick", "deleteInstructor(this)");  
        $("#tbodyApInst").append("<tr>" + tr.html() + "</tr>"); 

        $("#tbodyAvInst").children("tr").each(function () {
            let id = $(this).find(".col-2").children("p").text();
            $(this).find(".col-2").html("appoint");
             //log every element found to console output
        });

        tr.remove(); 

        var data = { action:'add_instructor', project_id: <?php echo $_GET["id"]; ?>, instructor_id: $(element).attr('id') };

        $.ajax({
            url: "update_status.php",
            type: "POST",
            data: data,
            success: function(response) {
                if(response != ""){
                    console.log("Error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }

    function deleteInstructor(element){
        var tr = $(element).closest('tr');
        tr.find(".col-2").children("a").text('appoint');  
        $(element).attr("onclick", "addInstructor(this)");   
        $("#tbodyAvInst").append("<tr>" + tr.html() + "</tr>"); 

        $("#tbodyAvInst").children("tr").each(function () {
            let id = $(this).find(".col-2").children("p").text();
            $(this).find(".col-2").html("<a href=# id='"+ id +"' onclick='addInstructor(this)'>appoint</a>");
             //log every element found to console output
        });

        
        tr.remove(); 

        

        var data = { action:'delete_instructor', project_id: <?php echo $_GET["id"]; ?> };

        $.ajax({
            url: "update_status.php",
            type: "POST",
            data: data,
            success: function(response) {
                if(response != ""){
                    console.log("Error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }


    function addMember(element){
        var tr = $(element).closest('tr');
        tr.find(".col-2").children("a").text('delete');
        $(element).attr("onclick", "deleteMember(this)");            
        $("#tbodyApMem").append("<tr>" + tr.html() + "</tr>"); 
        tr.remove(); 

        var data = { action:'add_member', project_id: <?php echo $_GET["id"]; ?>, member_id: $(element).attr('id') };

        $.ajax({
            url: "update_status.php",
            type: "POST",
            data: data,
            success: function(response) {
                if(response != ""){
                    console.log("Error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }

    function deleteMember(element){
        var tr = $(element).closest('tr');
        tr.find(".col-2").children("a").text('add');  
        $(element).attr("onclick", "addMember(this)");   
        
        $("#tbodyAvMem").append("<tr>" + tr.html() + "</tr>"); 
        tr.remove(); 

        var data = { action:'delete_member', project_id: <?php echo $_GET["id"]; ?>, member_id: $(element).attr('id')};

        $.ajax({
            url: "update_status.php",
            type: "POST",
            data: data,
            success: function(response) {
                if(response != ""){
                    console.log("Error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    }

    function saveStatus(){
        var optionSelected = $("option:selected", $("#status")).val().toLowerCase();;
        var data = { action:'update_status', status: optionSelected, project_id: <?php echo $_GET["id"]; ?> };
        $.ajax({
            url: "update_status.php",
            type: "POST",
            data: data,
            success: function(response) {
                if(response == ""){
                    location.reload();
                }else{
                    console.log("Error: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
     }
        