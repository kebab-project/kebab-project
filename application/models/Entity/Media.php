<?php

/**
 * Model_Entity_Media
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property clob $description
 * @property string $mineType
 * @property string $fileExt
 * @property integer $fileSize
 * @property integer $imageWidth
 * @property integer $imageHeight
 * @property Model_Entity_Category $Category
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     lab2023 - Dev. Team <info@lab2023.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Model_Entity_Media extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('system_media');
        $this->hasColumn('title', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('mineType', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('fileExt', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('fileSize', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('imageWidth', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('imageHeight', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_bin');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Model_Entity_Category as Category', array(
             'local' => 'id',
             'foreign' => 'image_id'));

        $softdelete0 = new Doctrine_Template_SoftDelete();
        $blameable0 = new Doctrine_Template_Blameable();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $searchable0 = new Doctrine_Template_Searchable(array(
             'fields' => 
             array(
              0 => 'title',
             ),
             'className' => 'SystemMediaSearch',
             ));
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             'fields' => 
             array(
              0 => 'title',
             ),
             'canUpdate' => true,
             ));
        $this->actAs($softdelete0);
        $this->actAs($blameable0);
        $this->actAs($timestampable0);
        $this->actAs($searchable0);
        $this->actAs($sluggable0);
    }
}