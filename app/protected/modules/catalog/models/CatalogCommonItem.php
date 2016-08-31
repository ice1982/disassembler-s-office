<?php

class CatalogCommonItem extends BaseActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'catalog_common_items';
    }

    public function behaviors()
    {
        return array(
            'ImageBehavior' => array(
                'class' => 'ImageBehavior',
                'image_path' => 'uploads/catalog',
                // 'image_field' => ,
                'original_resize' => true,
                'original_resize_width' => 300,
                'original_resize_height' => false,
                'thumb' => false,
                'thumb_width' => 300,
                'thumb_height' => false,
                'original_image_filename' => 'catalog_common_item_' . time(),
            ),
            'BSystemInfoBehavior' => array(
                'class' => 'BSystemInfoBehavior',
            ),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array(
                'alias, title',
                'required',
            ),
            array(
                'group_id, created_user, modified_user, active',
                'numerical',
                'integerOnly' => true,
            ),
            array(
                'alias, title, image_attr_title, image_attr_alt, created_ip, modified_ip, modified_username',
                'length',
                'max' => 300,
            ),
            array(
                'image, created_username',
                'length',
                'max' => 200,
            ),
            array(
                'description',
                'length',
                'max' => 1024,
            ),
            array(
                'title, created_datetime, modified_datetime',
                'safe',
            ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, group_id, alias, title, description, image, image_attr_title, image_attr_alt, created_ip, created_datetime, created_user, created_username, modified_ip, modified_datetime, modified_user, modified_username, active',
                'safe',
                'on' => 'search',
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'group' => array(self::BELONGS_TO, 'CatalogGroup', 'group_id'),
            'modifiedUser' => array(self::BELONGS_TO, 'User', 'modified_user'),
            'createdUser' => array(self::BELONGS_TO, 'User', 'created_user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'group_id' => 'Родительская группа',
            'alias' => 'Алиас',
            'title' => 'Название',
            'description' => 'Описание',
            'body' => 'Содержимое',
            'image' => 'Изображение',
            'image_attr_title' => 'Аттрибут изображения: Title',
            'image_attr_alt' => 'Аттрибут изображения: Alt',
            'created_ip' => 'Created Ip',
            'created_datetime' => 'Created Date',
            'created_user' => 'Created User',
            'created_username' => 'Created Username',
            'modified_ip' => 'Modified Ip',
            'modified_datetime' => 'Modified Date',
            'modified_user' => 'Modified User',
            'modified_username' => 'Modified Username',
            'active' => 'Active',
        );
    }



    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('group_id',$this->parent_id);
        $criteria->compare('alias',$this->alias,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('description',$this->title,true);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('image_attr_title',$this->image_attr_title,true);
        $criteria->compare('image_attr_alt',$this->image_attr_alt,true);
        $criteria->compare('created_ip',$this->created_ip,true);
        $criteria->compare('created_datetime',$this->created_datetime,true);
        $criteria->compare('created_user',$this->created_user);
        $criteria->compare('created_username',$this->created_username,true);
        $criteria->compare('modified_ip',$this->modified_ip,true);
        $criteria->compare('modified_datetime',$this->modified_datetime,true);
        $criteria->compare('modified_user',$this->modified_user);
        $criteria->compare('modified_username',$this->modified_username,true);
        $criteria->compare('active',$this->active);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 50),
            'sort' => array(
                'defaultOrder' => 'title',
            ),
        ));
    }

    public function scopes()
    {
        return array(
            'active' => array(
                'condition' => 'active = 1'
            )
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CatalogGroup the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public function setBreadcrumbs($groups, $group_id = false)
    {
        $breadcrumbs = array();

        $breadcrumbs[0] = array('route' => Yii::app()->createUrl('catalog/default/index'), 'title' => 'Каталог трубопроводной арматуры');

        $i = 1;

        foreach ($groups as $key => $group) {

            if ($group_id == $group['id']) {
                $breadcrumbs[$i] = array('route' => false, 'title' => $group['title']);
            } else {
                $breadcrumbs[$i] = array('route' => Yii::app()->createUrl('catalog/default/index', array('group' => $group['id'])), 'title' => $group['title']);
            }

            $i++;
        }

        return $breadcrumbs;
    }

    public function setPageTitle()
    {
        $title = $this->title . ' | ' .  Yii::app()->name;

        return $title;
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('catalog/default/view', array('id' => $this->id));
    }

    public function getGroupTitle()
    {
        if (isset($this->group->title)) {
            return $this->group->title;
        }
    }

    public function getGroupUrl()
    {
        if (isset($this->group->id)) {
            return Yii::app()->createUrl('catalog/default/index', array('group' => $this->group->id));
        }
    }

}
