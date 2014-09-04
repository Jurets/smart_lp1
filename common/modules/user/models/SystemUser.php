<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property integer $superuser
 * @property integer $roles
 * @property integer $status
 * @property string $create_at
 * @property string $lastvisit_at
 * @property string $logincode
 * @property string $tariff_id
 * @property integer $refer_id
 * @property integer $inviter_id
 * @property integer $invite_num
 * @property string $busy_date
 * @property string $club_date
 * @property double $balance
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property integer $city_id
 * @property integer $gmt_id
 * @property string $phone
 * @property string $skype
 * @property string $photo
 * @property string $purse
 * @property integer $income
 * @property integer $transfer_fund
 * @property integer $active
 * @property string $activated
 * @property string $sys_lang
 * @property integer $country_access
 * @property integer $city_access
 * @property integer $skype_access
 * @property integer $email_access
 * @property string $new_email
 */
class SystemUser extends CActiveRecord
{
        public function getTTT(){
            return '1234567890';
        }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('create_at, active', 'required'),
                        array('username, email', 'required'),
			array('superuser, roles, status, refer_id, inviter_id, invite_num, city_id, gmt_id, income, transfer_fund, active, country_access, city_access, skype_access, email_access', 'numerical', 'integerOnly'=>true),
			array('balance', 'numerical'),
			array('username, phone', 'length', 'max'=>20),
			array('password, email, activkey, logincode', 'length', 'max'=>128),
			array('tariff_id', 'length', 'max'=>11),
			array('first_name, last_name, skype, photo, purse', 'length', 'max'=>255),
			array('sys_lang', 'length', 'max'=>2),
			array('new_email', 'length', 'max'=>150),
			array('lastvisit_at, busy_date, club_date, dob, activated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, activkey, superuser, roles, status, create_at, lastvisit_at, logincode, tariff_id, refer_id, inviter_id, invite_num, busy_date, club_date, balance, first_name, last_name, dob, city_id, gmt_id, phone, skype, photo, purse, income, transfer_fund, active, activated, sys_lang, country_access, city_access, skype_access, email_access, new_email', 'safe', 'on'=>'search'),
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
                        'username' => BaseModule::t('rec','username'),
                        'password' => BaseModule::t('rec','password'),
			'first_name' => BaseModule::t('rec','First Name'),
			'last_name' => BaseModule::t('rec','Last Name'),
                        'email' => BaseModule::t('rec','Email'),
                        'status' => BaseModule::t('rec','Status'),
                        'roles' => BaseModule::t('rec','Roles'),
		);
	}
        public function systemUsrCriteria(){
            $criteria=new CDbCriteria;
                $criteria->addCondition('superuser = 1');
                return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SystemUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /* Добавочный для отрисовки статуса и роли */
        public function getStatusAndRole(){
            $resource = array();
            $resource[] = ($this->status == 1) ? UserModule::t('Active') : UserModule::t('Not active');
            switch($this->roles){
                case '1':
                    $resource[] = UserModule::t('Superadmin');
                    break;
                case '2':
                    $resource[] = UserModule::t('Admin');
                    break;
                case '3':
                    $resource[] = UserModule::t('Moderator');
                    break;
                default:
                    $resource[] = UserModule::t('Without Role');
                    break;
            }
            return $resource;
        }
        /* разбиваем прежидущую на два вызова для грида */
        public function getStatus(){
            return ($this->status == 1) ? UserModule::t('Active') : UserModule::t('Not active');
        }
        public function getRole(){
            switch($this->roles){
                case '1':
                    return UserModule::t('Superadmin');
                    break;
                case '2':
                    return UserModule::t('Admin');
                    break;
                case '3':
                    return UserModule::t('Moderator');
                    break;
                default:
                    return UserModule::t('Without Role');
                    break;
            }
        }
}
