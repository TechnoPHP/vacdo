<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<meta name="viewport" content="width=width-device, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title_for_layout; ?></title>
	<style type="text/css">
	body {
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
		font-family:Arial, Helvetica, sans-serif;
		font-size:14px;
		color:#333;
	}
	a {	color:#000;	}
	table {
		background-color:#F0F0F0;
		border-collapse:separate;
		padding:10px 20px;
	}
	table tr td {
		padding:8px 0px;
	}
	table tr td p{
		margin: 0px;
		padding:0px 0px 6px 0px;
	}
	img {
	  -ms-interpolation-mode: bicubic;
	}
	</style>
</head>
<body>
	<table>
		<tr>
			<td style="border-bottom:1px solid #999;font-weight:bold;"><?php echo $contenttitle; ?></td>
		</tr>
		<tr>
			<td>
			<?php echo $this->fetch('content'); ?>
			</td>
		</td>
		<tr>
			<td style="border-bottom:1px solid #999;">
				Thanks and regards, <br> <?php echo $sender; ?>
			</td>
		</tr>
	</table>
</body>
</html>