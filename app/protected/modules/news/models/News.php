<?php

/**
 * This is the model class for table "shippings".
 *
 * The followings are the available columns in table 'shippings':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $image_attr_title
 * @property string $image_attr_alt
 * @property string $created_ip
 * @property string $created_datetime
 * @property integer $created_user
 * @property string $created_username
 * @property string $modified_ip
 * @property string $modified_datetime
 * @property integer $modified_user
 * @property string $modified_username
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property CatalogGroup $parent
 * @property CatalogGroup[] $catalogGroups
 * @property CatalogItems[] $catalogItems
 */
class News extends BaseActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'news';
    }

    public function behaviors(){
        return array(
            'ImageBehavior' => array(
                'class' => 'ImageBehavior',
                'original_resize' => true,
                'original_resize_width' => 500,
                'original_resize_height' => false,
                'thumb' => false,
                'thumb_width' => 300,
                'thumb_height' => false,
                'original_image_filename' => 'news_' . time(),
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
                'title, body',
                'required',
            ),
            array(
                'created_user, modified_user, active',
                'numerical',
                'integerOnly' => true,
            ),
            array(
                'title, image_attr_title, image_attr_alt, created_ip, modified_ip, modified_username',
                'length',
                'max' => 300,
            ),
            array(
                'image',
                'file',
                'types' => 'jpg, gif, png',
                'maxSize' => 1048576 * 5,
                'allowEmpty' => false,
                'on' => 'insert',
            ),
            array(
                'image',
                'file',
                'types' => 'jpg, gif, png',
                'maxSize' => 1048576 * 5,
                'allowEmpty' => true,
                'on' => 'update',
            ),
            array(
                'title, created_datetime, modified_datetime',
                'safe',
            ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, title, body',
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
            'title' => 'Название',
            'body' => 'Текст',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('body',$this->title,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 50),
            'sort' => array(
                'defaultOrder' => 'id DESC',
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

}
