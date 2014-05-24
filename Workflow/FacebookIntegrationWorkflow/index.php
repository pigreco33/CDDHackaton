<?php
include 'check_auth.php';
include_once 'init.php';
include_once  'utils.php';

setlocale(LC_ALL, 'it_IT');
$votazioni = $db->votazioni;

$cursor = $votazioni->find()->sort(array('data'=>-1));
// foreach ( $cursor as $id => $value )
// {
// 	echo "$id"."\n";
// }




?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Facebook Integration WorkFlow</title>
<link href="css/footable.core.css" rel="stylesheet" type="text/css" />
<link href="css/footable.metro.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="js/footable.js" type="text/javascript"></script>
<script src="js/footable.paginate.js" type="text/javascript"></script></head>
<script src="js/footable.sort.js" type="text/javascript"></script></head>
<script src="js/footable.filter.js" type="text/javascript"></script></head>
<body>
<script type="text/javascript">


function ritira(id, element)
{
	$.ajax({
		  type: 'POST',
		  url: 'action.php',
		  data: "do=ritira&id="+id,
		  success: function(data){
				alert('Id: '+id + ' ritirato dalla pubblicazione');
				element.parent().parent().replaceWith(data);
//				$('#'+id+'>td.action').val('<a href="#" onclick="approva("'+id+'")">Approva</a>');
//				location.reload();
				
			    // on success use return data here
		  },
		  error: function(xhr, type, exception) { 
		    // if ajax fails display error alert
		    alert("ajax error response type "+type);
		  }
		});
	return false;
}

function pubblica()
{
	$.ajax({

		  dataType:'text',
		  type: 'GET',
		  url: 'http://tomcat.area19.net/CDDHackathonWeb/publish',
		  success: function(data){
				if (data!='')
				{
					alert('pubblicazione effettuata!');
				}
				else
				{
					alert('nessun articolo da pubblicare!');
				}
				location.reload();
		  },
		  error: function(xhr, type, exception) { 
		    // if ajax fails display error alert
		    alert("ajax error response type "+type);
		  }
		});
	return false;
}

function approva(id, element)
{
	$.ajax({
		  type: 'POST',
		  url: 'action.php',
		  data: "do=approva&id="+id,
		  success: function(data){
				alert('Id: '+id + ' approvato per pubblicazione');
				element.parent().parent().replaceWith(data);
				//				$('#'+id+'>td.action').val('<a href="#" onclick="ritira("'+id+'")">Ritira</a>');
//				location.reload();
				
			    // on success use return data here
		  },
		  error: function(xhr, type, exception) { 
		    // if ajax fails display error alert
		    alert("ajax error response type "+type);
		  }
		});
	return false;
	
}





$(function () {

    $('.footable').footable();

});
</script>



<h2 class="fiwf">Facebook Realtime Integration Workflow</h2>
<div style="width:500px; margin-right: 20px; margin-bottom: 20px; float: right">
dati aggiornati al: <?php print_r(strftime("%c", getLastInsertionDate()))?> <a href="https://www.facebook.com/CDDHackathon2014" target="_blank">(Facebook page)</a>
</div>
<h3>VOTAZIONI </h3>

<div style="width:50px; margin-right: 20px; float: right">
<form action="/logout.php">
    <input type="submit" value="Logout">
</form>
</div>	
<div style="width:50px; margin-right: 100px; margin-bottom: 20px; float: right">
<form action="#">
    <input style="background-color:red; color: white;" type="submit" onclick="return pubblica();" value="Pubblica approvati">
</form>
</div>	
<div> <label for="filter">Cerca:</label><input type="text" id ="filter" /></div>
	<table class="footable" data-filter="#filter" data-page-size="15">
		<thead>
		<tr>
			<th width="100px" data-toggle="true">
			Titolo
			</th>
			<th width="70px">
			votanti
			</th>
			<th width="70px">
			fav.
			</th>
			<th width="70px">
			cont.
			</th>
			<th width="80px">
			ast.
			</th>
			<th width="80px" data-sort-initial="descending">
			data
			</th>
			<th  >
			Descrizione
			</th>
			<th>
			stato
			</th>
			<th data-sort-ignore="true">
			azione
			</th>
			</tr>
		</thead>
		<tbody style="font-size:12px">
			<?php 
			$counter=0;
			foreach ( $cursor as $id => $value )
			{
				echo formatRow($id, $value);

			}
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9">
					<div class="pagination pagination-centered"></div>
				</td>
			</tr>
		</tfoot>
		
	</table>

	<div style="width:50px; margin-right: 20px; float: right">
		<form action="/logout.php">
		    <input type="submit" value="Logout">
		</form>
		</div>	
		<div margin-top: 20px; >
		<div style="width:50px; margin-right: 100px; float: right">
		<form action="#">
		    <input style="background-color:red; color: white;" type="submit" value="Pubblica approvati">
		</form>
		</div>
		</div>	
	
	

</body></html>