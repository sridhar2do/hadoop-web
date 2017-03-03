<html>
<head>
<style type="text/css">

</style>
<script type="text/javascript" src="../../files/js/jquery.js"></script>
<script type="text/javascript" src="../../files/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

	tinymce.init({
		mode : "specific_textareas",
		editor_selector : "mceEditor",
		height: 400,
		plugins: [
		'advlist autolink lists link image charmap print preview anchor',
		'searchreplace visualblocks code fullscreen',
		'insertdatetime media table contextmenu paste code','textcolor', 'hr','save',
		],
		toolbar: ' save | insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',

		save_enablewhendirty: true,
		save_onsavecallback: function () { saveDetails(); }
	});

	function saveDetails(){
	
		var moduleName = $('#module-name').val();
		if(moduleName=='All')
		{
			alert('Select Module');
			return false;
		}
		var question = $('#question').val();
		//var answer=$('#answer').val();
		var answer = tinyMCE.activeEditor.getContent();
		var dataString = undefined;
		
		dataString = 'moduleName=' + moduleName +'&question=' + question+'&answer='+answer;
		console.log(dataString);
		$.ajax({
			type: "POST",
			url: "HadoopQAInsert.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				//$("#login_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="files/images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var obj = JSON.parse(response);
				alert(obj.success);
				location.reload();
			}
		});
		
	}
	
	
	
	$('.update').click(function() {
	

		var questionNo=0;
		var question=1;
		var answer=2;
		
		var dataString;
			
		var _questionNo=$(this).parent().parent().find('td:eq('+questionNo+')').html().trim();
		dataString = '_questionNo=' + _questionNo;
		
		
		var _question=$(this).parent().parent().find('td:eq('+question+')').find('#question').val();
		dataString=dataString+'&_question=' +_question;
		
		var _answer=$(this).parent().parent().find('td:eq('+answer+')').find('#answer').val();
		dataString=dataString+'&_answer=' +_answer;
		
		var _moduleName = $('#module-name').val();
		dataString=dataString+'&_modulename=' +_moduleName;
		alert(dataString);
		$.ajax({
			type: "POST",
			url: "HadoopQAUpdate.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#login_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="files/images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var obj = JSON.parse(response);
				alert(obj.success);
				//location.reload();
				$("#login_status").html('');
			}
		});
	});

	$('.delete').click(function(){
	
		var dataString;
		var _questionNo=$(this).parent().parent().find('td:eq(0)').html().trim();
		dataString = '_questionNo=' + _questionNo
		
		$.ajax({
			type: "POST",
			url: "HadoopQADelete.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				//$("#login_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="files/images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var obj = JSON.parse(response);
				alert(obj.success);
				//location.reload();
				//$("#login_status").html('');
			}
		});
	});
})
</script>
</head>
<body>
<?php
	include 'NavigationMenu.php';
	include 'connection/hadoopqaconnection.php';
?>
<form action='HadoopQAPage.php' method="POST" >
<?php 
	if(isset($_POST['module-name'])) 
	{ 
		$modulename =  $_POST["module-name"]; 
		
	} 
	else 
	{ 
		echo ""; 
	} 
?>
<div id="content">

<h1> Hadoop Interview Question & Answers</h1>


Module: 
<select name='module-name' id='module-name' onchange='this.form.submit()'> 
    <option value="All">All</option> 
    <option value="HadoopCore" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "HadoopCore")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Hadoop Core
	</option> 
	
    <option value="YARN" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "YARN")
				{
		?> selected
		<?php 
				}
			}
		?>
	>YARN
	</option> 

	<option value="MapReduce" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "MapReduce")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Map Reduce Programming
	</option>
	
	<option value="AdvanceMapReduce" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "AdvanceMapReduce")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Advance MapReduce Programming 
	</option>
	
	<option value="Hive" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "Hive")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Hive and HiveQL
	</option>
	
	<option value="AdvanceHive" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "AdvanceHive")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Advance Hive
	</option>
	
	<option value="PigLatin" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "PigLatin")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Pig Latin
	</option>
	
	<option value="HBase" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "HBase")
				{
		?> selected
		<?php 
				}
			}
		?>
	>No SQL and HBase
	</option>
		
	<option value="Sqoop" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "Sqoop")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Sqoop
	</option>
	
		
	<option value="Misc" 
		<?php
			if(isset($_POST['module-name'])) 
			{
				if($_POST['module-name'] == "Misc")
				{
		?> selected
		<?php 
				}
			}
		?>
	>Pig
	</option>
</select>

<table>
	<tr>
		<td>
			Question
		</td>
		<td>
			<textarea id="question" cols="80" rows="5"> </textarea>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Answer</td>
		<td>
			<textarea id='answer' cols="80" rows="10" class="mceEditor"></textarea>
		</td>
	</tr>
</table>


<?php
if(isset($_POST["module-name"])) 
{ 
$sql="SELECT questionid,question,answer FROM $tableName where modulename='". $_POST["module-name"] ."' order by questionid  ";
}	
else
{
	$sql="SELECT questionid,question,answer FROM $tableName order by questionid";
}
	$data=mysql_query($sql);
?>
<table border cellpadding='3' style="margin-left: -224px; margin-right: 0px;">
	<tr>
		<th>Id</th>
		<th>Question</th>
		<th>Answer</th> 
	</tr>
<?php
	while ($info = mysql_fetch_array($data)) 
	{
?>
	<tr>
		<td>
			<?php echo $info['questionid'] ?> 
		</td>
		<td>
<textarea id='question' cols="60" rows="3">
<?php echo $info['question']; ?>
</textarea>
		</td>
		<td>
<textarea id='answer' cols="80" rows="10">
<?php echo $info['answer']; ?>
</textarea>
		</td>
		<td>
			<input type='button' class='update' value='Update' />
			<input type='button' class='delete' value='Delete' />
		</td>
	</tr> 
<?php
}
?>
</table>

</div>
</form>
</body>
</html>

	