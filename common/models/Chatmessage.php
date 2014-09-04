 <?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $text
 * @property integer $created
 */
class Chatmessage extends CActiveRecord
{
    public $filterDate;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'yiichat_post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('text, data, created, is_alert', 'required'),
            //array('created', 'numerical', 'integerOnly'=>true),
            //array('title, image', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, chat_id, post_identity, owner, text, data, created, is_alert, filterDate', 'safe', 'on'=>'search'),
            array('text, data, created, is_alert', 'safe'),
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
            'id' => BaseModule::t('dic', 'ID'),
            'text' => BaseModule::t('dic', 'Text'),
            'created' => BaseModule::t('dic', 'Created'),
            'owner' => BaseModule::t('dic', 'Author'),
            'post_identity' => BaseModule::t('dic', 'User ID'),
            'is_alert' => BaseModule::t('dic', 'Importance'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('text',$this->text,true);
        if (!empty($this->filterDate)) {
            /*$begDate = date_create_from_format('Y-m-d', $this->filterDate);
            $begDate->setTime(0, 0, 0);           //время в ноль, а то ставится текущее
            $endDate = date_create_from_format('Y-m-d', $this->filterDate);
            $endDate->setTime(0, 0, 0);
            $interval = new DateInterval('P1D');  //интервал = 1 день
            $endDate->add($interval);     //прибавляем этот интервал 

            $begDate = strtotime($begDate->date); //($this->filterDate);
            $endDate = strtotime($endDate->date); //($this->filterDate);
            */
            $begDate = strtotime($this->filterDate);
            $endDate = $begDate + 24 * 60 * 60;
            $criteria->addBetweenCondition('created', $begDate, $endDate);
        }
        $criteria->compare('owner', $this->owner);
        $criteria->compare('is_alert', $this->is_alert);
        $criteria->compare('post_identity', $this->post_identity);
        $criteria->order = 'created DESC';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),        
        ));
    }
    
    public function scopes()
    {
        return array(
            'sort'=>array(
                'order'=>'created DESC',
            ),
        );
    }
    
    protected function afterFind ()
    {
        $this->created = date ('Y-m-d H:i:s', $this->created); // convert to display format
        parent::afterFind();
    }

    protected function beforeValidate ()
    {
        $this->created = strtotime($this->created); // convert to storage format
        return parent::beforeValidate();
    }    
} 