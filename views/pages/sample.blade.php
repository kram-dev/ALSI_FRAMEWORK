<form action="{{ app['url'] }}sample/send_mail" method="post" enctype="multipart/form-data">
	@csrf
	<input type="text" name="name"/><br><br>
	<input type="email" name="email"/><br><br>
	<input type="text" name="subject"/><br><br>
	<textarea name="message" rows="5" cols="21"></textarea><br><br>
	<input name="userfile" type="file"/><br><br>
	<button type="submit">Submit</button>
</form>