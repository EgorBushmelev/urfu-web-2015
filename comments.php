<?php

error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "comment.class.php";

$comments = array();
$result = mysql_query("SELECT * FROM comments ORDER BY id ASC");

while($row = mysql_fetch_assoc($result))
{
	$comments[] = new Comment($row);
}

?>

							<div id="main">
<?php

foreach($comments as $c){
	echo $c->markup();
}

?>
								<div id="addCommentContainer">
									<form id="addCommentForm" method="post" action="#">
										<div class="col-md-12">
											<div class="col-md-4">
												<label for="name">Никнейм</label><br/>
												<input type="text" name="name" id="name" /><br/><br/>
											</div>
											<div class="col-md-4">
												<img src="captcha.php" alt="Защитный код" ><br/>
											</div>
											<div class="col-md-4">
												<label for="captcha">Введи код с картинки</label><br/>
												<input type="text" name="captcha" id="captcha" /><br/>
											</div>
										</div>
												<label for="body">Комментарий</label><br/>
												<textarea name="body" id="body" cols="20" rows="5"></textarea>
												<input class="web_hometop_more blue" type="submit" id="submit" value="Отправить" />
									</form>
								</div>
							</div>

							<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
							<script type="text/javascript" src="js/comment.js"></script>
