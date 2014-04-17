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

    public function actionUpload()
    {
//         require('UploadHandler.php');
//         $options = array(
//                 'script_url' => 'http://justmoney-admin.smart/',
//                 'upload_url' => 'http://justmoney-admin.smart/files/',
//                 'upload_dir' => '/home/servbat/smart_lp1/backend/www/files/',
//                 'param_name' => 'files'
//         );
//         $upload_handler = new UploadHandler($options);

        if ($_FILES['files']){
            $ext = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
            $filename = 'news-origin-'.substr(md5(uniqid()), 0, 8) . "." . $ext;
            //$file_path = Yii::getPathOfAlias('news.uploads').DIRECTORY_SEPARATOR.$filename;
            $file_path = Yii::app()->getBasePath() . $this->module->uploadDir . $filename;
            $file_url = $this->module->uploadUrl . $filename;
            $file_url_resized = $this->module->uploadUrl .'resized-'. $filename;
            $result = move_uploaded_file($_FILES['files']['tmp_name'][0],  $file_path);
            //$resized = ImageHelper::makeNewsThumb(Yii::getPathOfAlias('news.uploads').DIRECTORY_SEPARATOR.$filename);
            $resized = ImageHelper::makeNewsThumb($file_path);
            //$resized = $file_path;
            //unlink($file_path);
            $json = array(
                    "files"=>array(
                            array(
                                    "name"=>$filename,
                                    //"original"=>$resized,
                                    "original"=>$file_url,
                                    "resized"=>$file_url_resized,
                                    //"url"=> Yii::getPathOfAlias('news.uploads') . DIRECTORY_SEPARATOR . $filename,
                                    //"url"=>$file_url,
                            )));
        
            if ($result)
                echo json_encode($json);
            else
                echo  json_encode(array("error"=>"error"));
        }
        
        
        
        
        
    }
    
}