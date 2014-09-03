<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $author
 * @property string $created
 * @property string $activated
 * @property string $title
 * @property string $announcement
 * @property string $content
 * @property string $image
 * @property integer $activity
 */
class News extends CActiveRecord
{
    /* Image upload by standard equipment */

    public $lang;
    public $illustration;
    public $attended = 'attended'; // сигнатура (имя класса) непрочитанной статьи

    /**
     * @return string the associated database table name
     */

    public function tableName()
    {
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            //array('author, activity', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max' => 75),
            //array('announcement', 'length', 'max'=>255),
            array('image', 'length', 'max' => 255),
            array('illustration', 'file', 'types' => 'jpg, jpeg, gif, png', 'allowEmpty' => true),
            array('activated, title,content', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                //array('id, author, created, activated, title, announcement, content, image, activity', 'safe', 'on'=>'search'),
                //array('title,content', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'author' => Yii::t("rec", "Author"),
            'created' => Yii::t('rec', 'Created'),
            'activated' => Yii::t('rec', 'Activated'),
            'title' => Yii::t('rec', 'Title'),
            'announcement' => Yii::t('rec', 'Announcement'),
            'content' => Yii::t('rec', 'Content'),
            'image' => Yii::t('rec', 'Image'),
            'illustration' => Yii::t('rec', 'Illustration'),
            'activity' => Yii::t('rec', 'Activity'),
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
        $criteria->compare('author', $this->author);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('activated', $this->activated, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('announcement', $this->announcement, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('activity', $this->activity);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function callAfterFind()
    {
        $this->afterFind();
    }

    protected function afterFind()
    {
        $this->activated = strtotime($this->activated);
        $this->activated = date('H:i:s d-m-Y', $this->activated);
        $this->created = strtotime($this->created);
        $this->created = date('H:i:s d-m-Y', $this->created);
        parent::afterFind();
        return true;
    }

    protected function beforeValidate()
    {
        $this->activated = strtotime($this->activated);
        $this->activated = date('Y-m-d H:i:s', $this->activated);
        $this->created = strtotime($this->created);
        $this->created = date('Y-m-d H:i:s', $this->created);
        parent::beforeValidate();
        return true;
    }

    /* resized- & /upload/ can be changed this, if you wish */

    public function getUploadImage($pathToUploadDir = '/uploads/', $resizePrefix = 'resized-', $resized = TRUE)
    {
        return ($resized) ? $pathToUploadDir . $resizePrefix . $this->image : $pathToUploadDir . $this->image;
    }

    public function getPrew()
    {
        $first = strpos($this->content, '.');
        $first += 1;
        return substr($this->content, 0, strpos($this->content, '.', $first)) . '.';
    }

    public function attendedUpdate($id) //работает с cookie. создает-дописывает json-объект с массивом прочитанных id статей
    {
        $attended = array();
        // переход от списка к единице
        if (isset(Yii::app()->request->cookies['attended']->value)) {
            $attended = Yii::app()->request->cookies['attended']->value;
            $attended = json_decode($attended, true);
            if (array_search($id, $attended) === false) {
                $attended [] = $id;
            }
        }

        $attended = json_encode($attended);
        Yii::app()->request->cookies['cookie_name'] = new CHttpCookie('attended', $attended);
    }

    public function attendedScan($models) // получает текущий id, json-объект прочитанных id статей (из cookie)
    {
        if (isset(Yii::app()->request->cookies['attended']->value)) {
            $target = json_decode(Yii::app()->request->cookies['attended']->value, true);

            foreach ($models as $model) {
                if (array_search($model->id, $target) != false) {
                    $model->attended = '';
                }
            }
        }
        return $models;
    }

}
