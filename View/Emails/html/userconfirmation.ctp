<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<p><?php echo 'Hello '.ucfirst($data['firstname']).','; ?></p>
	<p><?php echo 'We have received your registration request. Please click or copy this link to your browser and send to confirm your registration'; ?></p>
	<p><?php echo $link; ?></p>
	<p>This email is sent as an acknowledgement of your registration request. Please do not reply this email.</p>