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
 * @property string[] $tagsArray
 *
 * The followings are the available model relations:
 * @property Tag[] $tags
 * @property ProductsTags[] $productsTags
 */
class Product extends CActiveRecord
{

  public $searchTag = null;

  public function setTagsArray(array $data)
  {
    // reset dei tag per semplificare lo script
    ProductTag::model ()->deleteAll ( 'product=:p', array (
        ':p' => $this->id 
    ) );
    // data attuale
    $now = new DateTime ();
    $timestamp = $now->format ( 'Y-m-d H-i-s' );
    // ricerca dei tag e creazione dei link
    foreach ( $data as $tagName )
    {
      $tag = Tag::model ()->find ( 'name=:nm', array (
          ':nm' => $tagName 
      ) );
      /** @var Tag $tag */
      if ($tag == null)
      {
        $tag = new Tag ();
        $tag->name = $tagName;
        $tag->description = ucwords ( $tagName );
        $tag->timestamp = $timestamp;
        $tag->insert ();
      }
      $productTag = ProductTag::model ()->find ( 'product=:p AND tag=:t', array (
          ':p' => $this->id,
          ':t' => $tag->id 
      ) );
      /** @var ProductTag $productTag */
      if ($productTag == null)
      {
        $productTag = new ProductTag ();
        $productTag->product = $this->id;
        $productTag->tag = $tag->id;
        $productTag->insert ();
      }
    }
  }

  /**
   *
   * @return string[]
   */
  public function getTagsArray()
  {
    $data = array ();
    foreach ( $this->tags as $tag )
    {
      /** @var Tag $tag */
      $data [$tag->id] = $tag->name;
    }
    return $data;
  }

  /**
   *
   * @return string
   */
  public function getTagsHtml($echo = false)
  {
    $html = "";
    foreach ( $this->tags as $tag )
      $html .= print_product_tag ( $tag->name, $echo );
    return $html;
  }

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
        ),
        'tags' => array (
            self::MANY_MANY,
            'Tag',
            'products_tags(product, tag)' 
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
    
    if (! empty ( $this->searchTag ))
    {
      $criteria->with = array (
          'tags' => array (
              'alias' => 'tgs',
              'together' => true 
          ) 
      );
      
      $criteria->compare ( "tgs.name", $this->searchTag );
      // $criteria->together = true;
    }
    
    return new CActiveDataProvider ( $this, array (
        'criteria' => $criteria 
    ) );
  }

  public function __toString()
  {
    return $this->name;
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
