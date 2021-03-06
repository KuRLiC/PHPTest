<?php

class ProductController extends Controller
{

  /**
   *
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   *      using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout = '//layouts/column2';

  /**
   * Displays a particular model.
   *
   * @param integer $id
   *          the ID of the model to be displayed
   */
  public function actionView($id)
  {
    $this->render ( 'view', array (
        'model' => $this->loadModel ( $id ) 
    ) );
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
    $productTags = (isset ( $_REQUEST ['tagsArray'] ) && is_array ( $_REQUEST ['tagsArray'] )) ? $_REQUEST ['tagsArray'] : array ();
    
    $model = new Product ();
    
    // aggiorno la data di creazione ogni volta
    $now = new DateTime ();
    $model->timestamp = $now->format ( 'Y-m-d H-i-s' );
        
    if (isset ( $_POST ['Product'] ))
    {
      if (count ( $productTags ) <= 0)
        $model->addError ( '', 'At least one tag is required' );
      else
      {
        $model->attributes = $_POST ['Product'];
        $file = CUploadedFile::getInstance ( $model, 'image' );
        if ($file != null)
        {
          $model->image = uniqid ( 'product_' ) . '.' . $file->getExtensionName ();
          if ($model->save ())
          {
            $model->tagsArray = $productTags;
            $file->saveAs ( $model->imagePath );
            $this->redirect ( array (
                'view',
                'id' => $model->id 
            ) );
          }
        }
        else
        {
          $model->addError ( 'image', 'Required' );
        }
      }
    }
    
    $this->render ( 'create', array (
        'model' => $model 
    ) );
  }

  public function actionImage($id)
  {
    $model = $this->loadModel ( $id );
    readfile ( $model->imagePath );
  }

  /**
   * Edits a particular model.
   *
   * @param integer $id
   *          the ID of the model
   */
  public function actionEdit($id)
  {
    $productTags = (isset ( $_REQUEST ['tagsArray'] ) && is_array ( $_REQUEST ['tagsArray'] )) ? $_REQUEST ['tagsArray'] : array ();
    
    $model = $this->loadModel ( $id );

    // aggiorno la data di creazione ogni volta
    $now = new DateTime ();
    $model->timestamp = $now->format ( 'Y-m-d H-i-s' );
    
    if (isset ( $_POST ['Product'] ))
    {
      if (count ( $productTags ) <= 0)
        $model->addError ( '', 'At least one tag is required' );
      else
      {
        $oldImage = $model->image;
        $oldPath = $model->imagePath;
        $model->attributes = $_POST ['Product'];
        $file = CUploadedFile::getInstance ( $model, 'image' );
        if ($file != null)
        {
          $model->image = uniqid ( 'product_' ) . '.' . $file->getExtensionName ();
        }
        else
        {
          $model->image = $oldImage;
        }
        
        if ($model->save ())
        {
          $model->tagsArray = $productTags;
          if ($file != null)
          {
            $file->saveAs ( $model->imagePath );
            if (file_exists ( $oldPath ) && is_file ( $oldPath ))
            {
              unlink ( $oldPath );
            }
          }
          $this->redirect ( array (
              'view',
              'id' => $model->id 
          ) );
        }
      }
    }
    else
    {
      
      $now = new DateTime ();
      $model->timestamp = $now->format ( 'Y-m-d H-i-s' );
    }
    
    $this->render ( 'update', array (
        'model' => $model 
    ) );
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   *
   * @param integer $id
   *          the ID of the model to be deleted
   */
  public function actionDelete($id)
  {
    if (Yii::app ()->request->isPostRequest)
    {
      // we only allow deletion via POST request
      $model = $this->loadModel ( $id );
      if ($model->imageExists)
        unlink ( $model->imagePath );
      ProductTag::model ()->deleteAll ( 'product=:p', array (
          ':p' => $model->id 
      ) );
      $model->delete ();
      
      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if (! isset ( $_GET ['ajax'] ))
        $this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array (
            'admin' 
        ) );
    }
    else
      throw new CHttpException ( 400, 'Invalid request. Please do not repeat this request again.' );
  }

  /**
   * Lists all models.
   */
  public function actionIndex()
  {
    $this->redirectTo ( 'product/list', $_GET );
  }

  /**
   * Lists all models.
   */
  public function actionAdmin()
  {
    $this->redirectTo ( 'product/list', $_GET );
  }

  /**
   * Manages all models.
   */
  public function actionList()
  {
    $model = new Product ( 'search' );
    $model->unsetAttributes (); // clear any default values
    if (isset ( $_GET ['Product'] ))
      $model->attributes = $_GET ['Product'];
    
    if (isset ( $_REQUEST ['tag'] ) && ! empty ( $_REQUEST ['tag'] ))
      $model->searchTag = $_REQUEST ['tag'];
    
    $this->render ( 'admin', array (
        'model' => $model 
    ) );
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   *
   * @param
   *          integer the ID of the model to be loaded
   * @return Product
   */
  public function loadModel($id)
  {
    $model = Product::model ()->findByPk ( $id );
    if ($model === null)
      throw new CHttpException ( 404, 'The requested page does not exist.' );
    return $model;
  }

  /**
   * Performs the AJAX validation.
   *
   * @param
   *          CModel the model to be validated
   */
  protected function performAjaxValidation($model)
  {
    if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'product-form')
    {
      echo CActiveForm::validate ( $model );
      Yii::app ()->end ();
    }
  }
}
