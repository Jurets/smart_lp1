<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserLogin extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
    public $verifyCode;
    public $role;
    public $temp_key;

    public $identity;
    
    public $activekey;
    private $_logincode = null;
    
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
            array('username, password', 'required'),
			array('username', 'email'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
/////временно отключаем            array('activekey', 'checkActivekey'),  
            array('verifyCode', 'captcha',
                // авторизованным пользователям код можно не вводить
                'allowEmpty'=>!Yii::app()->user->isGuest || !CCaptcha::checkRequirements(),
            ),
			array('password', 'authenticate'),
		);
	}

    /**
    * проверка кода логина
    * 
    * @param mixed $attribute
    * @param mixed $params
    */
    public function checkActivekey($attribute, $params) {
        //$code = Yii::app()->user->getState('checkuser');
        $logincode = $this->logincode;
        if (empty($logincode)) {
            $this->addError('activekey', UserModule::t("Login code not set"));
        } else if ($logincode != $this->activekey) {
            $this->addError('activekey', UserModule::t("Incorrect login code"));
        }
    }
    
    /**
    * получить код логина для юзера (из БД)
    * 
    */
    public function getLogincode() {
        if (!isset($this->_logincode))
            $this->_logincode = Yii::app()->db->createCommand()
                ->select('logincode')
                ->from(Yii::app()->getModule('user')->tableUsers)
                ->where('username = :username OR email = :username')
                ->queryScalar(array(':username'=>$this->username));
        return $this->_logincode;
    }
    
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>UserModule::t("Remember me next time"),
			'username'=>UserModule::t("username or email"),
			'password'=>UserModule::t("password"),
            'verifyCode' => 'Код проверки',
            'activekey' => 'Код входа',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$this->identity = new UserIdentity($this->username,$this->password);
			$this->identity->authenticate();
			switch($this->identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? Yii::app()->controller->module->rememberMeTime : 0;
					Yii::app()->user->login($this->identity,$duration);
					break;
				case UserIdentity::ERROR_EMAIL_INVALID:
					$this->addError("username",UserModule::t("Email is incorrect."));
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError("username",UserModule::t("Username is incorrect."));
					break;
				case UserIdentity::ERROR_STATUS_NOTACTIV:
					$this->addError("status",UserModule::t("You account is not activated."));
					break;
				case UserIdentity::ERROR_STATUS_BAN:
					$this->addError("status",UserModule::t("You account is blocked."));
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError("password",UserModule::t("Password is incorrect."));
					break;
			}
		}
	}
    
    /**
    * очистить код входа для юзера
    * 
    */
    public function clearLoginCode() {
        if ($user = User::model()->byusername($this->username)->find()) {
            $user->logincode = '';
            $user->save(false);
        }
    }
    
}
