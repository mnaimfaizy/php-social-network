<?php 	include("includes/connection.php");
		include("includes/CheckStatus.php");
	include("includes/header.php");
?>
<style type="text/css">
		.chatroom {
			border:1x solid #cccccc;
			height: 350px;
			overflow: auto;
			padding: 5px;	
		}
		.chatroom .from_msg {
			float: right;
			width: 90%;
			margin: 5px 0px;
			padding: 6px 10px;
			border: 2px solid #ffffff;
			font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
			font-size: 15px;
			text-align: right;
			background: #A7E9DE;
			border-radius: 10px;
		}
		.chatroom .to_msg {
			float: left;
			width: 90%;
			margin: 5px 0px;
			padding: 6px 10px;
			border: 2px solid #ffffff;
			font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
			font-size: 15px;
			background: #86D8A4;
			border-radius: 10px;
		}
</style>
<?php include("includes/Navigation.php"); ?>
    <div class="content" style="min-height: 600px;">

<?php include("includes/breadLine.php"); ?>      
  
    <div class="workplace">
        <div class="row-fluid">
        	<div class="span4">
               
               <div class="chatroom">
               		<div class="from_msg">
                    	<div class="msgText">
                            <span class="msgtext">This is a test msg</span>
                            <span class="msgDate">4 min ago</span>
                        </div>
                    </div>
                    
                    <div class="to_msg">
                    	<div class="msgText">
                            <span class="msgtext">This is a test msg</span>
                            <span class="msgDate">4 min ago</span>
                        </div>
                    </div>
                    
                    <div class="from_msg">
                    	<div class="msgText">
                            <span class="msgtext">a;lksdjf;alskdjf;alksdjf;alskdjf;alskdjf;alskdjfa;sldkfjasd;kl</span>
                            <span class="msgDate">4 min ago</span>
                        </div>
                    </div>
               </div>
                         
            </div>
        </div>
            
        </div>
    </div>

<?php include("includes/chatroom.php"); ?>

<?php include("includes/footer.php"); ?>