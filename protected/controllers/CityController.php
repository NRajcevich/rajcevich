<?php

class CityController extends Controller
{
    public function actionDynamiccities() {	
        
		$criteria = new CDbCriteria();
		$criteria->condition = "state_code =:code";
		$criteria->params = array(':code' => $_POST['state_code']);
		$criteria->order = 'county';
		$model = City::model()->findAll($criteria);

        $data = CHtml::listData($model,'county','county');
		
        if(count($data)>0){
            $counties = array();
            foreach($data as $value=>$name){

                if(!in_array ($name, $counties) && $name != '') {
                    echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
                }
                $counties[$value] = $name;
            }
        }else{
            echo CHtml::tag('option', array('value'=>''),'None',true);
        }
		
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}