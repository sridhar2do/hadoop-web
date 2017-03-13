<?php

    include '../connection/hadoopqaconnection.php';

    $sql = "select * from " . $tblCategory;
    $resCategory = mysql_query( $sql );

?>
<html>
<head>
    <script type="text/javascript" src="../plugins/jquery.js"></script>
    <script type="text/javascript" src="../plugins/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">

    $(document).ready(function(){

        tinymce.init({
            mode : "specific_textareas",
            editor_selector : "mceEditor",
            height: 400,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code','textcolor', 'hr','save'
            ],
            toolbar: ' save | insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',

            save_enablewhendirty: true,
            save_onsavecallback: function () { saveDetails(); }
        });

        function saveDetails(){

            var moduleName = $('#module-name').val();
            var recordId = $('#recordId').val();

            if(moduleName=='All')
            {
                alert('Select Module');
                return false;
            }
            var question = $('#question').val();
            var answer = tinyMCE.activeEditor.getContent();
            var dataString = undefined;

            dataString = 'moduleName=' + moduleName +'&question=' + question+'&answer='+answer;
            if( recordId.length > 0 ) dataString = dataString + '&recordId=' + recordId;
    //		console.log(dataString);

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
                    console.log( obj.recordId );
                    alert(obj.success);
    //                $('#recordId').val( obj.recordId );
                    location.reload();
                }
            });

        }

        $('.edit').click(function() {

            var dataString;

    //		var _moduleName = $('#module-name').val();
            var _moduleName = $(this).data('question-id');
            $('#recordId').val( _moduleName );


    //		dataString = dataString+'&_modulename=' +_moduleName;
            dataString = 'question_id='+_moduleName;

    //		alert(dataString);
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
                    console.log( obj.question );

                    $("#question").val( obj.question );
    //                tinymce.activeEditor.execCommand('mceInsertContent', true, obj.answer);
                    tinyMCE.activeEditor.setContent( obj.answer );


                    $("#question").focus();
                    // alert(obj.success);
                    //location.reload();
    //				$("#login_status").html('');
                }
            });
        });

        $('.delete').click(function(){

            var dataString;

            var _moduleName = $(this).data('question-id');
            dataString = 'question_id='+_moduleName;

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
                    console.log( obj.success );

                    window.location.href = "HadoopQAPage.php";
                }
            });
        });

        $('.add').click(function(){

            window.location.href = "HadoopQAPage.php";

        });
    });
</script>
</head>
<body>

<?php // include 'NavigationMenu.php'; ?>

<form action='HadoopQAPage.php' method="POST">
    <?php
        if(isset($_POST['module-name']))
            $modulename =  $_POST["module-name"];
        else
            echo "";
    ?>
    <div id="content">

        <h1>Interview Question & Answers</h1>

        Module:
        <select name="module-name" id="module-name" onchange='this.form.submit()'>
            <option value="All">All</option>
            <?php while ( $rowCategory = mysql_fetch_array( $resCategory ) ) { ?>
                <option value="<?=$rowCategory['id']; ?>"<?php echo ($rowCategory['id'] == $_POST['module-name'])?' selected="selected"':''; ?>><?=$rowCategory['name']; ?></option>
            <?php } ?>
        </select>

        <table>
            <tr>
                <td>Question</td>
                <td>
                    <textarea id="question" cols="80" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Answer</td>
                <td>
                    <textarea id="answer" cols="80" rows="10" class="mceEditor"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="button" class="add" value="Add New Question">
                </td>
            </tr>
        </table>

        <?php
            $sql = ( isset($_POST["module-name"]) )?"SELECT * FROM " . $tableName . " where category_id = " . $_POST["module-name"]  . " order by id":"SELECT * FROM " . $tableName . " order by id";
            $data = mysql_query($sql);

            if(mysql_num_rows($data) == 0) {
                echo "<h2>Record not found</h2>";
            } else {
        ?>
        <!--<table border cellpadding='3' style="margin-left: -224px; margin-right: 0px;">-->
        <table border cellpadding='3'>
            <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Question</th>
<!--                <th>Answer</th>-->
                <th>Options</th>
            </tr>
            <?php while ($info = mysql_fetch_array($data)) { ?>
            <tr>
                <td><?=$info['id']; ?></td>
                <td>
                    <?php
                        $sqlCategory = "select * from " . $tblCategory . " where id =" . $info['category_id'];
                        $resCategory = mysql_query( $sqlCategory );
                        $dataCategory  = mysql_fetch_assoc($resCategory);

                        echo $dataCategory['name'];
                    ?>
                </td>
                <td><?=$info['question']; ?></td>
<!--                <td>--><?//=$info['answer']; ?><!--</td>-->
                <td>
                    <input type='button' class='edit' data-question-id='<?=$info['id'] ?>' value='Edit' />
                    <input type='button' class='delete' data-question-id='<?=$info['id'] ?>' value='Delete' />
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } ?>
        <input type="hidden" name="recordId" id="recordId">
    </div>
</form>
</body>
</html>