<?php
/**
 * EController class
 *
 * Has some useful methods for your Controllers
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class EController extends CController
{
	public $meta_keywords = array();
	public $meta_description = array();
    public $breadcrumbs;
	public $menu;

    public $layout='//layouts/column2';

	/**
	 * Gets a param
	 * @param $name
	 * @param null $defaultValue
	 * @return mixed
	 */
	public function getActionParam($name, $defaultValue = null)
	{
		return Yii::app()->request->getParam($name, $defaultValue );
	}

	/**
	 * Loads the requested data model.
	 * @param string the model class name
	 * @param integer the model ID
	 * @param array additional search criteria
	 * @param boolean whether to throw exception if the model is not found. Defaults to true.
	 * @return CActiveRecord the model instance.
	 * @throws CHttpException if the model cannot be found
	 */
//	protected function loadModel($class, $id, $criteria = array(), $exceptionOnNull = true)
//	{
//		if (empty($criteria))
//			$model = CActiveRecord::model($class)->findByPk($id);
//		else
//		{
//			$finder = CActiveRecord::model($class);
//			$c = new CDbCriteria($criteria);
//			$c->mergeWith(array(
//				'condition' => $finder->tableSchema->primaryKey . '=:id',
//				'params' => array(':id' => $id),
//			));
//			$model = $finder->find($c);
//		}
//		if (isset($model))
//			return $model;
//		else if ($exceptionOnNull)
//			throw new CHttpException(404, 'Unable to find the requested object.');
//	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === $model->formId)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Outputs (echo) json representation of $data, prints html on debug mode.
	 * NOTE: json_encode exists in PHP > 5.2, so it's safe to use it directly without checking
	 * @param array $data the data (PHP array) to be encoded into json array
	 * @param int $opts Bitmask consisting of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_FORCE_OBJECT.
	 */
	public function renderJson($data, $opts=null)
	{
		if(YII_DEBUG && isset($_GET['debug']) && is_array($data))
		{
			foreach($data as $type => $v)
				printf('<h1>%s</h1>%s', $type, is_array($v) ? json_encode($v, $opts) : $v);
		}
		else
		{
			header('Content-Type: application/json; charset=UTF-8');
			echo json_encode($data, $opts);
		}
	}

	/**
	 * Utility function to ensure the base url.
	 * @param $url
	 * @return string
	 */
	public function baseUrl( $url = '' )
	{
		static $baseUrl;
		if ($baseUrl === null)
			$baseUrl = Yii::app()->request->baseUrl;
		return $baseUrl . '/' . ltrim($url, '/');
	}

    /**
    * AJAX-действие: сформировать список городов страны
    * 
    */
    public function actionDynamiccities() {
        //$country_id = $_POST['Participant']['country_id'];
        $country_id = Yii::app()->request->getParam('country_id');
        $data = Cities::getCitiesListByCountry($country_id);
        ViewHelper::selectOptions($data, ViewHelper::getPrompt('select city'));
    }

    //
    protected function getSmilesArray($path = '/images/smiles/') {
        $smileys_dir = getcwd() . $path;
        $pngs = glob($smileys_dir . "*.png");
        $ret_val = array();
        $count = 0;
        foreach($pngs as $png) { //print each file name
            if ($count++ < 80)
                $ret_val[] = str_replace($smileys_dir, '', $png);
        }
        return $ret_val;
        //return json_encode($ret_val);
    }

    protected function getSmileNamesSet($path = '/images/smiles/') {
        $ret_val = $this->getSmilesArray($path);
        return json_encode($ret_val);
    }
    
}