<?php

/**
 * This is the model class for table "faq". 
 * 
 * The followings are the available columns in table 'faq': 
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property string $created
 * @property integer $id_user
 * @property string $category
 *
 * $param string $text;
 * $param string $purified_text;

 */
class Faq extends CActiveRecord
{

    /**
     * @return string the associated database table name 
     */
    public function tableName()
    {
        return 'faq';
    }

    /**
     * @return array validation rules for model attributes. 
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that 
        // will receive user inputs. 
        return array(
            array('id_user', 'numerical', 'integerOnly' => true),
            array('category', 'length', 'max' => 64),
            array('question, answer, created, category', 'safe'),
            // The following rule is used by search(). 
            // @todo Please remove those attributes that should not be searched. 
            array('id, question, answer, created, id_user, category', 'safe', 'on' => 'search'),
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
            'question' => Yii::t('common', 'Question'),
            'answer' => Yii::t('common', 'Answer'),
            'created' => Yii::t('common', 'Created'),
            'id_user' => Yii::t('common', 'Id User'),
            'category' => Yii::t('common', 'Category'),
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
        $criteria->compare('question', $this->question, true);
        $criteria->compare('answer', $this->answer, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('id_user', $this->id_user);
        $criteria->compare('category', $this->category, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class. 
     * Please note that you should have this exact method in all your CActiveRecord descendants! 
     * @param string $className active record class name. 
     * @return Faq the static model class 
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function showAllFaq()
    {
        $arrFaq = $this->model()->findAll();
        $arrSortCategoryFaq = array();
        foreach ($arrFaq as $faq) {
            if ($faq['category'] == 'finance') {
                $arrCategoryFaqFinance['question'] = $faq['question'];
                $arrCategoryFaqFinance['answer'] = $faq['answer'];
                $arrCategoryFaqFinance['category'] = $faq['category'];
                $arrFinance[] = $arrCategoryFaqFinance;
                $arrSortCategoryFaq['finance'] = $arrFinance;
            } elseif ($faq['category'] == 'site') {
                $arrCategoryFaqSite['question'] = $faq['question'];
                $arrCategoryFaqSite['answer'] = $faq['answer'];
                $arrCategoryFaqSite['category'] = $faq['category'];
                $arrSite[] = $arrCategoryFaqSite;
                $arrSortCategoryFaq['site'] = $arrSite;
            } else {
                $arrCategoryFaqOffer['question'] = $faq['question'];
                $arrCategoryFaqOffer['answer'] = $faq['answer'];
                $arrCategoryFaqOffer['category'] = $faq['category'];
                $arrOffer[] = $arrCategoryFaqOffer;
                $arrSortCategoryFaq['offer'] = $arrOffer;
            }
        }
        return $arrSortCategoryFaq;
    }

//    public function getTypeOfCategories(){
//        return array('finance' => 'финансы', 'offer' => 'предложения', 'site' => 'работа сайта');
//    }

}
