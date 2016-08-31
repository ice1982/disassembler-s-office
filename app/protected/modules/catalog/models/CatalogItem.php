<?php

/**
 * This is the model class for table "catalog_items".
 *
 * The followings are the available columns in table 'catalog_items':
 * @property integer $id
 * @property integer $group_id
 * @property string $title
 * @property string $code
 * @property string $diametr
 * @property string $pressure
 * @property string $material
 * @property string $environment
 * @property string $price
 * @property integer $special
 * @property integer $special_price
 * @property integer $image
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
 * @property CatalogType1Groups $group
 */
class CatalogItem extends BaseActiveRecord
{

    public $name;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'catalog_items';
	}

    public function behaviors(){
        return array(
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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
                'group_id, title',
                'required',
            ),
			array(
                'group_id, special, special_price, image, created_user, modified_user, active',
                'numerical',
                'integerOnly' => true,
            ),
			array(
                'title, material, image_attr_title, image_attr_alt, created_ip, modified_ip, modified_username',
                'length',
                'max' => 300,
            ),
			array(
                'code',
                'length',
                'max' => 100,
            ),
			array(
                'diametr, pressure, price',
                'length',
                'max' => 10,
            ),
			array(
                'environment, created_username',
                'length',
                'max' => 200,
            ),
			array(
                'group_id, title, code, diametr, pressure, material, environment, price, special, special_price, image, image_attr_title, image_attr_alt, active, name',
                'safe',
            ),
			array(
                'id, group_id, title, code, diametr, pressure, material, environment, price, special, special_price, image, image_attr_title, image_attr_alt, created_ip, created_datetime, created_user, created_username, modified_ip, modified_datetime, modified_user, modified_username, active, name',
                'safe',
                'on' => 'search'),
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
			'group_id' => 'Группа товаров',
			'title' => 'Название',
			'code' => 'Таблица фигур',
			'diametr' => 'Диаметр (мм)',
			'pressure' => 'Давление (кгс/см2)',
			'material' => 'Материал корпуса',
			'environment' => 'Рабочая среда',
			'price' => 'Price',
			'special' => 'Special',
			'special_price' => 'Special Price',
			'image' => 'Image',
			'image_attr_title' => 'Image Attr Title',
			'image_attr_alt' => 'Image Attr Alt',
			'created_ip' => 'Created Ip',
			'created_datetime' => 'Created Date',
			'created_user' => 'Created User',
			'created_username' => 'Created Username',
			'modified_ip' => 'Modified Ip',
			'modified_datetime' => 'Modified Date',
			'modified_user' => 'Modified User',
			'modified_username' => 'Modified Username',
			'active' => 'Active',

            'name' => 'Наименование изделия',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('diametr',$this->diametr,true);
		$criteria->compare('pressure',$this->pressure,true);
		$criteria->compare('material',$this->material,true);
		$criteria->compare('environment',$this->environment,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('special',$this->special);
		$criteria->compare('special_price',$this->special_price);
		$criteria->compare('image',$this->image);
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
                'defaultOrder' => 'id',
            ),
        ));
	}

    public function frontendSearch($groups)
    {
        $criteria = new CDbCriteria;

        $criteria->condition = 'active = 1';

        if (!empty($this->group_id)) {
            $children = CatalogGroup::model()->findAllChildrenGroups($this->group_id, $groups);
            $children_array = array($this->group_id);
            foreach ($children as $child) {
                $children_array[] = $child['id'];
            }

            $criteria->addInCondition('group_id', $children_array);
        } else {
            $criteria->compare('group_id', $this->group_id);
        }

        if (!empty($this->name)) {
            $criteria->compare('title', $this->name, true);
            $criteria->compare('code', $this->name, true, 'OR');
        }

        $criteria->compare('diametr', $this->diametr,true);
        $criteria->compare('pressure', $this->pressure,true);
        $criteria->compare('material', $this->material,true);

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => 25,
            ),
        ));
    }

    public function frontendFilterSearch($group_id, $groups)
    {
        $criteria = new CDbCriteria;

        $criteria->condition = 'active = 1';

        if (!empty($group_id)) {
            $children = CatalogGroup::model()->findAllChildrenGroups($group_id, $groups);
            $children_array = array();
            $criteria->condition = 'group_id = ' . (int)$group_id;

            foreach ($children as $child) {
                $children_array[] = $child['id'];
            }

            $criteria->addInCondition('group_id', $children_array, 'OR');
        }

        $criteria->compare('title', $this->title, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('diametr', $this->diametr,true);
        $criteria->compare('pressure', $this->pressure,true);
        $criteria->compare('material', $this->material,true);

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => 25,
            ),
        ));
    }

    public function backendSearch($group_id)
    {
        $criteria = new CDbCriteria;

        if (!empty($group_id)) {
            $children = CatalogGroup::model()->findAllChildrenGroups($group_id);
            $children_array = array();
            $criteria->condition = 'group_id = ' . (int)$group_id;

            foreach ($children as $child) {
                $children_array[] = $child->id;
            }

            $criteria->addInCondition('group_id', $children_array, 'OR');
        }

        $criteria->compare('title', $this->title, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('diametr', $this->diametr,true);
        $criteria->compare('pressure', $this->pressure,true);
        $criteria->compare('material', $this->material,true);

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
    }

	public function frontendGroupGridWithSearch($group_id)
	{
		$criteria = new CDbCriteria;

		$criteria->condition = 'active = 1';
		$criteria->condition = 'group_id = :group_id';
		$criteria->params = array(':group_id' => $group_id);

		$criteria->compare('title', $this->title, true);
		$criteria->compare('code', $this->code, true);
		$criteria->compare('diametr', $this->diametr, true);
		$criteria->compare('pressure', $this->pressure, true);
		$criteria->compare('material', $this->material, true);
		$criteria->compare('environment', $this->environment, true);

        return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => array(
                'pageSize' => 25,
            ),
        ));


	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatalogType1Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getTableUrl($text, $url, $class)
    {
        $link = CHtml::link(
            $text,
            $url,
            array(
                'class' => $class,
                'data-item' => json_encode(
                    array(
                        $this->getAttributeLabel('title') => $this->title,
                        $this->getAttributeLabel('code') => $this->code,
                        $this->getAttributeLabel('diametr') => $this->diametr,
                        $this->getAttributeLabel('pressure') => $this->pressure,
                        $this->getAttributeLabel('material') => $this->material,
                        $this->getAttributeLabel('environment') => $this->environment,
                    )
                ),
                'data-item-text' => $this->title . ' ' . $this->code,
            )
        );

        return $link;
    }
}
