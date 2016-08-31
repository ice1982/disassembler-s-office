<?php

/**
 * This is the model class for table "gallery_photos".
 *
 * The followings are the available columns in table 'gallery_photos':
 * @property integer $id
 * @property integer $album_id
 * @property string $image
 * @property string $image_attr_title
 * @property string $image_attr_alt
 * @property string $title
 * @property string $description
 * @property string $tags
 * @property integer $nn
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
 * @property GalleryAlbums $album
 */
class GalleryPhoto extends BaseActiveRecord
{
	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors(){
        return array(
            'ImageBehavior' => array(
                'class' => 'ImageBehavior',
                // 'image_path' => ,
                // 'image_field' => ,
                'original_resize' => true,
                'original_resize_width' => 950,
                'original_resize_height' => false,
                'thumb' => true,
                'thumb_width' => 300,
                'thumb_height' => false,
                'original_image_filename' => 'photo_' . time(),
            ),
            'BSystemInfoBehavior' => array(
                'class' => 'BSystemInfoBehavior',
            ),
        );
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gallery_photos';
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
				'album_id',
				'required',
			),
			array(
				'album_id, nn, created_user, modified_user, active',
				'numerical',
				'integerOnly' => true,
			),
			array(
				'image, created_username',
				'length',
				'max' => 200,
			),
			array(
				'image_attr_title, image_attr_alt, title, tags, created_ip, modified_ip, modified_username',
				'length',
				'max' => 300,
			),
			array(
				'description',
				'length',
				'max' => 1024,
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
				'album_id, image_attr_title, image_attr_alt, title, description, tags',
				'safe',
			),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array(
				'id, album_id, image, image_attr_title, image_attr_alt, title, description, tags, nn, created_ip, created_datetime, created_user, created_username, modified_ip, modified_datetime, modified_user, modified_username, active',
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
			'album' => array(self::BELONGS_TO, 'GalleryAlbum', 'album_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'album_id' => 'Album',
			'image' => 'Image',
			'image_attr_title' => 'Image Attr Title',
			'image_attr_alt' => 'Image Attr Alt',
			'title' => 'Title',
			'description' => 'Description',
			'tags' => 'Tags',
			'nn' => 'Nn',
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

		$criteria->compare('id', $this->id);
		$criteria->compare('album_id', $this->album_id);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('image_attr_title', $this->image_attr_title, true);
		$criteria->compare('image_attr_alt', $this->image_attr_alt, true);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('tags', $this->tags, true);
		$criteria->compare('nn', $this->nn);
		$criteria->compare('created_ip', $this->created_ip, true);
		$criteria->compare('created_datetime', $this->created_datetime, true);
		$criteria->compare('created_user', $this->created_user);
		$criteria->compare('created_username', $this->created_username, true);
		$criteria->compare('modified_ip', $this->modified_ip, true);
		$criteria->compare('modified_datetime', $this->modified_datetime, true);
		$criteria->compare('modified_user', $this->modified_user);
		$criteria->compare('modified_username', $this->modified_username, true);
		$criteria->compare('active', $this->active);

		return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 50),
            'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
        ));
	}

    public function findAllByAlbumTitle($title, $order, $limit = false)
    {
        $album_model = GalleryAlbum::model()->findByAttributes(array('title' => $title));

        if (!isset($album_model->id)) {
            return false;
        }
        $criteria = new CDbCriteria;
        $criteria->condition = 'album_id = :album_id';
        $criteria->params = array(':album_id' => $album_model->id);
        if ($limit != false) {
            $criteria->limit = $limit;
        }


        $criteria->order = $order;
        $items_model = $this->findAll($criteria);
        return $items_model;
    }

    public function saveOrder($items)
    {
        if (count($items)) {
            foreach ($items as $order => $item) {
                if ($item['item_id'] != '') {
                    $result = $this->updateByPk($item['item_id'], array('nn' => $order));
                }
            }
        }
    }

}
