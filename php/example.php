<?php

require_once("friendfeed.php");

$uploaded = false;
$entry = null;
if ($_POST["title"]) {
    $uploaded = true;
    $friendfeed = new FriendFeed($_POST["nickname"], $_POST["remotekey"]);
    $entry = $friendfeed->publish_link($_POST["title"], $_POST["link"]);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>FriendFeed Remote Login Form</title>
    <style type="text/css">

      body {
        background-color: white;
	margin: 25px;
      }

      body, input {
	color: #222222;
	font-family: Arial, sans-serif;
	font-size: 10pt;
      }

      h1 {
        font-size: 20pt;
	margin: 0;
      }

      h2 {
        font-size: 14pt;
	margin: 0;
	margin-top: 1em;
	margin-bottom: 0.5em;
      }

      table {
        border-collapse: collapse;
	border-spacing: 0;
	border: 0;
      }

      td {
        border: 0;
	padding: 0;
	vertical-align: middle;
      }

      a, a:visited {
        color: #1030cc;
      }

      img {
        border: 0;
      }

      table.form td {
        padding-right: 0.5em;
        padding-bottom: 0.5em;
      }

    </style>
  </head>
  <body>
    <table>
      <tr>
        <td><a href="http://friendfeed.com/" target="_blank"><img src="http://friendfeed.com/static/images/logo.png" width="256" height="55"/></a></td>
	<td style="padding-left: 1.5em">
	  <h1>API Example Application</h1>
	  <div style="font-size: 8pt; color: gray">Not affiliated with FriendFeed - a demonstration of the <a href="http://friendfeed.com/api/" style="color: #7777cc">FriendFeed API</a></div>
	</td>
      </tr>
    </table>

    <div style="margin-top: 1em; margin-bottom: 1em">
    <?php if ($uploaded) { ?>
      <?php if (!$entry) { ?>
        <div style="color: #cc0000; font-weight: bold">We could not upload your entry. Please confirm that you entered the correct FriendFeed nickname and remote key.</div>
      <?php } else { ?>
         <b>Entry published!</b> <a href="http://friendfeed.com/e/<?= $entry->id ?>">See your new FriendFeed entry</a>
      <?php } ?>
    <?php } else { ?>
      Publish an entry to FriendFeed using the FriendFeed API.
    <?php } ?>
    </div>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <h2>FriendFeed remote login</h2>
      <table class="form">
        <tr>
	  <td class="field">FriendFeed nickname or email:</td>
	  <td class="value"><input type="text" size="15" name="nickname"/></td>
	</tr>
        <tr>
	  <td class="field">Remote key [ <a href="http://friendfeed.com/remotekey" target="_blank">find your key</a> ]:</td>
	  <td class="value"><input type="password" size="15" name="remotekey"/></td>
	</tr>
      </table>

      <h2>New FriendFeed entry</h2>
      <table class="form">
        <tr>
	  <td class="field">Entry title:</td>
	  <td class="value"><input type="text" size="40" name="title"/></td>
	</tr>
        <tr>
	  <td class="field">Entry link:</td>
	  <td class="value"><input type="text" size="40" name="link"/></td>
	</tr>
      </table>

      <div style="margin-top: 2em"><input type="submit" value="Publish to FriendFeed" style="font-weight: bold; font-size: 12pt"/></div>
    </form>
  </body>
</html>
