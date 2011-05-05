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
 * @package    System
 * @subpackage Controllers
 * @author     lab2023 Dev Team
 * @copyright  Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license    http://www.kebab-project.com/licensing
 * @version    1.5.0
 */


/**
 * User_RoleManager
 *
 * @category   Kebab (kebab-reloaded)
 * @package    Administration
 * @subpackage Controllers
 * @author     lab2023 Dev Team
 * @copyright  Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license    http://www.kebab-project.com/licensing
 * @version    1.5.0
 */
class User_RoleManagerController extends Kebab_Rest_Controller
{
    public function indexAction()
    {
        Doctrine_Manager::connection()->beginTransaction();
        try {
            $roles = Role_Model_Role::getAllRoles()->execute();
            Doctrine_Manager::connection()->commit();
            $responseData = array();
            if (is_object($roles)) {
                $responseData = $roles->toArray();
            }

            $this->getResponse()
                    ->setHttpResponseCode(200)
                    ->appendBody(
                $this->_helper->response()
                        ->setSuccess(true)
                        ->addData($responseData)
                        ->getResponse()
            );
        } catch (Zend_Exception $e) {
            throw $e;
        } catch (Doctrine_Exception $e) {
            Doctrine_Manager::connection()->rollback();
            throw $e;
        }
    }

    public function putAction()
    {
        // Getting parameters
        $params = $this->_helper->param();
        $userId = $params['id'];
        $rolesId = $params['roles'];

        Doctrine_Manager::connection()->beginTransaction();
        try {
            // Doctrine
            Doctrine_Query::create()
                    ->delete('Model_Entity_UserRole userRole')
                    ->where('userRole.user_id = ?', $userId)
                    ->execute();

            foreach ($rolesId as $role) {
                $userRole = new Model_Entity_UserRole();
                $userRole->user_id = $userId;
                $userRole->role_id = $role;
                $userRole->save();
            }
            Doctrine_Manager::connection()->commit();
            unset($userRole);
        } catch (Zend_Exception $e) {
            throw $e;
        } catch (Doctrine_Exception $e) {
            Doctrine_Manager::connection()->rollback();
            throw $e;
        }
    }
}