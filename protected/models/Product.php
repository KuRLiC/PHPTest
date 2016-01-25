<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $timestamp
 * @property string $image
 * @property string $imagePath
 * @property boolean $imageExists
 * @property string $imageTag
 * @property string $nameTag
 * @property string $imageUrl
 * @property string $productUrl
 * @property string $productEditUrl
 *
 * The followings are the available model relations:
 * @property ProductsTags[] $productsTags
 */
class Product extends CActiveRecord
{

  /**
   *
   * @return string
   */
  public function getImageTag($width = 0)
  {
    iF ($this->imageExists)
    {
      $style = "";
      if ($width > 0)
        $style = "style=\"width: {$width}px; height: auto;\"";
      return "<a href=\"{$this->ProductEditUrl}\"><img {$style} src=\"{$this->imageUrl}\" ></a>";
    }
    else
    {
      return "";
    }
  }

  /**
   *
   * @return string
   */
  public function getNameTag()
  {
    $htmlName = htmlentities ( $this->name );
    return "<a href=\"{$this->ProductEditUrl}\">{$htmlName}</a>";
  }

  /**
   *
   * @return boolean
   */
  public function getImageExists()
  {
    return file_exists ( $this->imagePath ) && is_file ( $this->imagePath );
  }

  /**
   *
   * @return string
   */
  public function getProductUrl()
  {
    return url ( 'product/view', array (
        'id' => $this->id 
    ) );
  }

  /**
   *
   * @return string
   */
  public function getProductEditUrl()
  {
    return url ( 'product/edit', array (
        'id' => $this->id 
    ) );
  }

  /**
   *
   * @return string
   */
  public function getImageUrl()
  {
    return url ( 'product/image', array (
        'id' => $this->id 
    ) );
  }

  /**
   *
   * @return string
   */
  public function getImagePath()
  {
    return __DIR__ . '/../data/' . $this->image;
  }

  /**
   *
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'products';
  }

  /**
   *
   * @return array validation rules for model attributes.
   */
  public function rules()
  {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array (
        array (
            'name, timestamp, image',
            'required' 
        ),
        array (
            'name',
            'unique' 
        ),
        array (
            'description, image',
            'safe' 
        ),
        // The following rule is used by search().
        // @todo Please remove those attributes that should not be searched.
        array (
            'id, name, description, timestamp, image',
            'safe',
            'on' => 'search' 
        ) 
    );
  }

  /**
   *
   * @return array relational rules.
   */
  public function relations()
  {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array (
        'productsTags' => array (
            self::HAS_MANY,
            'ProductsTags',
            'product' 
        ) 
    );
  }

  /**
   *
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels()
  {
    return array (
        'id' => 'ID',
        'name' => 'Name',
        'description' => 'Description',
        'timestamp' => 'Timestamp',
        'image' => 'Image' 
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
   *         based on the search/filter conditions.
   */
  public function search()
  {
    // @todo Please modify the following code to remove attributes that should not be searched.
    $criteria = new CDbCriteria ();
    
    $criteria->compare ( 'id', $this->id );
    $criteria->compare ( 'name', $this->name, true );
    $criteria->compare ( 'description', $this->description, true );
    $criteria->compare ( 'timestamp', $this->timestamp );
    $criteria->compare ( 'image', $this->image, true );
    
    return new CActiveDataProvider ( $this, array (
        'criteria' => $criteria 
    ) );
  }

  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   *
   * @param string $className
   *          active record class name.
   * @return Product the static model class
   */
  public static function model($className = __CLASS__)
  {
    return parent::model ( $className );
  }
}
