<?php

/**
 * Model_Base_Application
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $title
 * @property clob $description
 * @property string $version
 * @property string $url
 * @property enum $status
 * @property Doctrine_Collection $StoryApplication
 * @property Doctrine_Collection $Feedback
 * @property Doctrine_Collection $Application
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     lab2023 - Dev. Team <info@lab2023.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Model_Base_Application extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('application');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'length' => '255',
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('version', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('status', 'enum', 7, array(
             'type' => 'enum',
             'length' => 7,
             'values' => 
             array(
              0 => 'active',
              1 => 'passive',
             ),
             'default' => 'active',
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_bin');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Model_StoryApplication as StoryApplication', array(
             'local' => 'id',
             'foreign' => 'application_id'));

        $this->hasMany('Model_Feedback as Feedback', array(
             'local' => 'id',
             'foreign' => 'application_id'));

        $this->hasMany('Model_Story as Application', array(
             'refClass' => 'Model_StoryApplication',
             'local' => 'application_id',
             'foreign' => 'story_id'));

        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'title',
              1 => 'description',
             ),
             'className' => 'ApplicationTranslation',
             'length' => 5,
             ));
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $this->actAs($i18n0);
        $this->actAs($softdelete0);
    }
}