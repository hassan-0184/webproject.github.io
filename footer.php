$("#add_team_modal").on('submit', function(e){
			e.preventDefault(); 
            var team_name = $('#add_team_name').val();
			$.ajax({
				url: 'action.php',
				method: 'POST',
				data: {team_name: team_name, action:"Add_Team"}, 
				dataType: 'json', 
				beforeSend:function()
				{
					$('#add_team_submit').val('Validating...');
					$('#add_team_submit').attr('disabled', true); 
				},
				success: function(data)
				{
                    $('#add_team_submit').val('Add Task');
					$('#add_team_submit').attr('disabled', false);
					if (data.success)
					{
						$("#add_team_modal").modal("toggle");
                        $("#team_names").load(location.href + " #team_names");
					}
					if (data.error)
					{
						if (data.error_t_team != '')
							$('#error_t_team').text(data.error_t_name); 
						else 
							$('#error_t_team').text('');
					}	
				}
			});
		});

 $("#add_project_modal").on('submit', function(e){
			e.preventDefault(); 
            var project_name = $('#add_project_name').val();
            var project_description = $('#add_project_description').val();
            var team_name = $('#project_team_name').val();
			$.ajax({
				url: 'action.php',
				method: 'POST',
				data: {project_name: project_name, team_name: team_name, project_description: project_description, action:"Add_Project"}, 
				dataType: 'json', 
				beforeSend:function()
				{
					$('#add_project_submit').val('Validating...');
					$('#add_project_submit').attr('disabled', true); 
				},
				success: function(data)
				{
                    $('#add_project_submit').val('Add Project');
					$('#add_project_submit').attr('disabled', false);
					if (data.success)
					{
						$("#add_project_modal").modal("toggle");
                        $("#project_names").load(location.href + " #project_names");
					}
					if (data.error)
					{
						if (data.error_p_name == 'Project Name is Required')
						{
                            $('#error_p_name').text(data.error_p_name); 
                        }
                        else 
							$('#error_p_name').text('');
                        if (data.error_p_description == 'Project Description is Required')
						{
                        	$('#error_p_description').text(data.error_p_description); 
                        }
                        else 
							$('#error_p_description').text('');
                        if (data.error_p_team == 'Team is Required')
						{	
                            $('#error_p_team').text(data.error_p_team); 
                        }
                        else 
							$('#error_p_team').text('');
					}	
				}
			});
		});