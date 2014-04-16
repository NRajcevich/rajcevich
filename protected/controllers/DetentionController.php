<?php

class DetentionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
    public function accessRules()
    {
        return array(
            
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index', 'createSecure','createAlternative','update','submited'),
                'roles' => array('account_user'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('index', 'createSecure','createAlternative','update','submited'),
                'roles' => array('account_admin'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index', 'createSecure','createAlternative','update','submited', 'unsubmited', 'delete'),
                'roles' => array('state_admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionUnsubmited($id){
        $model = $this->loadModel($id);
        $model->setAttribute('submited', 0);
        if($model->save())
            $this->redirect(array('update','id'=>$id));
    }


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

    public function actionSubmited($id){
        $model = $this->Formatting($id);
        $this_user = User::model()->findByPk(Yii::app()->user->id);

        if(isset($_POST['DetentionAF']))
        {
            $model->attributes=$_POST['DetentionAF'];
        }
        else if(isset($_POST['DetentionSF']))
        {
            $model->attributes=$_POST['DetentionSF'];
        }
        $model->setAttributes(array('updated_date' => date('Y-m-d H:i:s')));
        $model->setAttributes(array('updated_user' => $this_user->id));
        if(empty($_POST['time_referred']))
            $model->setAttributes(array('time_referred' => null));
        $model->setAttribute('submited', 1);

        if($model->validate()){
            $model -> save();
            $this->redirect(array('update','id'=>$model->id));
        }

        $model->setAttribute('submited', 0);
        $this->render('update',array(
            'model'=>$model,
        ));
    }


    public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateSecure()
	{
		$model=new DetentionSF;
        $this_user = User::model()->findByPk(Yii::app()->user->id);

        $model->attributes = array(
            'detention_type' => 'Secure',
            'residence_county' => $this_user->county,
        );

		if(isset($_POST['DetentionSF']))
		{
			$model->attributes=$_POST['DetentionSF'];
            $model->setAttributes(array('created_date' => date('Y-m-d H:i:s')));
            $model->setAttributes(array('updated_date' => date('Y-m-d H:i:s')));
            $model->setAttributes(array('updated_user' => $this_user->id));
            if($model->save()){
                $this->redirect(array('update','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionCreateAlternative()
    {
        $model=new DetentionAF;
        $this_user = User::model()->findByPk(Yii::app()->user->id);

        $model->attributes = array(
            'detention_type' => 'Alternative',
            'residence_county' => $this_user->county,
        );

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['DetentionAF']))
        {
            $model->attributes=$_POST['DetentionAF'];
            $model->setAttributes(array('created_date' => date('Y-m-d H:i:s')));
            $model->setAttributes(array('updated_date' => date('Y-m-d H:i:s')));
            $model->setAttributes(array('updated_user' => $this_user->id));
            if($model->save()){
                $this->redirect(array('update','id'=>$model->id));
            }

        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */


    public function Formatting($id){

        $model=$this->loadModel($id);
        $model_columns = array();
        if($model->attributes['detention_type'] == 'Alternative') {
            $model=$this->loadModelAF($id);
            $model_columns = DetentionAF::model()->metadata->tableSchema->columns;
        }
        if($model->attributes['detention_type'] == 'Secure') {
            $model=$this->loadModelSF($id);
            $model_columns = DetentionSF::model()->metadata->tableSchema->columns;
        }

        if(count($model_columns) > 0) foreach ($model_columns as $columnName => $column) {
            if ($column->dbType == 'date') {
                $date = new DateTime($model->$columnName);
                if($model->$columnName != '1900-01-01') {
                    $model->$columnName = $date->format('m/d/Y');
                }else{
                    $model->$columnName = '';
                }
            }
            if ($column->dbType == 'time') {
                $time = new DateTime($model->$columnName);
                if($model->$columnName) $model->$columnName = $time->format('h:i');
            }
        }

        return $model;

    }


	public function actionUpdate($id)
	{
        $model = $this->Formatting($id);
        $this_user = User::model()->findByPk(Yii::app()->user->id);

		if(isset($_POST['DetentionAF']))
		{
			$model->attributes=$_POST['DetentionAF'];
            $model->setAttributes(array('updated_date' => date('Y-m-d H:i:s')));
            $model->setAttributes(array('updated_user' => $this_user->id));
            if(empty($_POST['time_referred']))
                $model->setAttributes(array('time_referred' => null));

			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}
        if(isset($_POST['DetentionSF']))
        {
            $model->attributes=$_POST['DetentionSF'];
            $model->setAttributes(array('updated_date' => date('Y-m-d H:i:s')));
            $model->setAttributes(array('updated_user' => $this_user->id));
            if(empty($_POST['time_referred']))
                $model->setAttributes(array('time_referred' => null));

            if($model->save())
                $this->redirect(array('update','id'=>$model->id));
        }

		$this->render('update',array(
			'model'=>$model,
		));
	}

    /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{

        // Delete checked rows
        if(isset($_POST['delete_checked']) && isset($_POST['checked'])){
            if(count($_POST['checked']) > 0) {
                foreach($_POST['checked'] as $id){
                    $this->loadModel($id)->delete();
                }
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        }

        if(!Yii::app()->user->isGuest) {

            $model=new Detention('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Detention'])){
                $model->attributes=$_GET['Detention'];
            }


            $this->render('index',array(
                'model'=>$model,
            ));

        }else{

            $model=new LoginForm;

            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if(isset($_POST['LoginForm'])){
                $model->attributes=$_POST['LoginForm'];
                if($model->validate() && $model->login())
                    $this->redirect('/');
            }

            $this->render('login',array(
                'model'=>$model,
            ));
        }

	}

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect('/');
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Detention the loaded model
	 * @throws CHttpException
	 */
    public function loadModel($id)
    {
        $model=Detention::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    public function loadModelSF($id)
	{
		$model=DetentionSF::model()->findByPk($id);

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    public function loadModelAF($id)
    {
        $model=DetentionAF::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

	/**
	 * Performs the AJAX validation.
	 * @param Detention $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='detention-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
