<?php

class FacilityController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filterByCounty($filterChain){
		$filterChain->run();
	}
	 
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'byCounty - create, delete, update',
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','changecapacity'),
				'roles' => array('account_admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'roles' => array('state_admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Facility;

        $this_user = User::model()->findByPk(Yii::app()->user->id);
        $model->attributes = array(
            'state' => $this_user->state,
            'county' => $this_user->county,
        );
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Facility']))
		{
			$model->attributes=$_POST['Facility'];
			if($model->save())
				$this->redirect(array('index'));
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Facility']))
		{
			$model->attributes=$_POST['Facility'];
			if($model->save())
                $this->redirect(array('index'));
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

        $model=new Facility('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Facility'])){
            $model->attributes=$_GET['Facility'];

            //$this_state = State::model()->findAll(array('condition'=>'state_code=:state_code', 'params'=>array(":state_code"=> $model->attributes['state'])));
            //$this_state = $this_state[0];
        }

        $this->render('index',array(
            'model'=>$model,
        ));

	}

	public function actionChangecapacity(){

		if(isset($_POST['Facility'])){

			$model = Facility::model()->findByPk($_POST['Facility']['id']);
			if($model===null){
				throw new CHttpException(404,'The requested page does not exist.');
			}

			$model->attributes = $_POST['Facility'];
			if($model->save()){
				echo $model->capacity;
			}
		}
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Facility the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
        $model=Facility::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Facility $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='facility-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
