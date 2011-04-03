<?php

if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
/**
 * Kebab Framework
 *
 * LICENSE
 *
 * This source file is subject to the  Dual Licensing Model that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.kebab-project.com/licensing
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@lab2023.com so we can send you a copy immediately.
 *
 * @category   Kebab (kebab-reloaded)
 * @package    Authentication
 * @subpackage Controllers
 * @author     lab2023 Dev Team
 * @copyright  Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license    http://www.kebab-project.com/licensing
 * @version    1.5.0
 */

/**
 * Session controller manage to login, logout and other operation over session
 *
 * @category   Kebab (kebab-reloaded)
 * @package    Password
 * @subpackage Controllers
 * @author     lab2023 Dev Team
 * @copyright  Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license    http://www.kebab-project.com/licensing
 * @version    1.5.0
 */

class User_PasswordController extends Kebab_Rest_Controller
{
    /**
     * @return void
     */
    public function putAction()
    {
        // Params
        $params = $this->_helper->param();
        $userSessionId = Zend_Auth::getInstance()->getIdentity()->id;

        // Validation
        $oldPassword = Doctrine_Core::getTable('User_Model_User')->find($userSessionId)->password;
        if ($oldPassword != md5($params['oldPassword'])) {
            $this->_helper->response()->addError('oldPassword', 'Eski şifrenizi kontrol ediniz!')->getResponse();
        }

        // Params
        $userPassword = $params['newPassword'];
        $userPasswordConfirm = $params['newPasswordConfirm'];

        // Filter
        $userPassword = is_null($userPassword) ? null : md5($userPassword);
        $userPasswordConfirm = is_null($userPasswordConfirm)
                             ? null
                             : md5($userPasswordConfirm);

        if (!is_null($userPassword)
            && !is_null($userPasswordConfirm)
            && $userPasswordConfirm == $userPassword
        ) {
            // Doctrine
            $user = new User_Model_User();
            $user->assignIdentifier($userSessionId);
            $user->password = $userPassword;
            $user->save();
            $this->_helper->response()
                ->setSuccess(true)
                ->addNotification('INFO', 'Password successfully changed.')
                ->getResponse();
        } else {
            $this->_helper->response()
                ->addNotification('ERR', 'Could not change password.')
                ->getResponse();
        }
    }
}