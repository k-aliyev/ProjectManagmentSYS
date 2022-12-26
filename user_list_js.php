
  $(document).ready(function(){
    $("#deleteInput").on("input", function() {
        if($(this).val() == "DELETE"){
          $('#deleteBtn').attr("disabled", false);
        }
    });
  });

  function prepareDelete(element) {
    var id = $(element).data('id');
    $('#deleteBtn').attr('data-id', id);
  }

  function deleteProject(){
        var data = { action:'delete_project', project_id: $('#deleteBtn').attr('data-id')};

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

        location.reload();
    }