<?php

/**
 * This is the model class for table "nb_user".
 *
 * The followings are the available columns in table 'nb_user':
 * @property string $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $staff_no
 * @property string $company_id
 * @property string $email
 * @property string $auth_key
 * @property string $role
 * @property string $status
 * @property string $create_at
 * @property string $update_at
 */
class User extends CActiveRecord
{
	const POWER_ADMIN = 1;
	const ADMIN = 2;
	const WAITER = 3;
	const USER = 4;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nb_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username ,mobile,mobile,role,password_hash', 'required'),
			array('username', 'length', 'max'=>50),
			array('username' , 'unique' , 'message'=>'用户名已经存在'),
			array('mobile', 'length', 'max'=>20),
			array('password_hash', 'length','min'=>6, 'max'=>60),
			array('password_reset_token, email, auth_key', 'length', 'max'=>255),
			array('staff_no', 'length', 'max'=>20),
			array('company_id, role, status, create_at', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password_hash, password_reset_token, staff_no, company_id, email, auth_key, role, status, create_at, update_at', 'safe', 'on'=>'search'),
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
				'company' => array(self::BELONGS_TO , 'Company' , 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '用户名',
			'mobile' => '手机',
			'password_hash' => '密码',
			'password_reset_token' => 'Password Reset Token',
			'staff_no' => '员工号',
			'company_id' => '公司',
			'email' => '电子邮箱',
			'auth_key' => 'Auth Key',
			'role' => '管理员类型',
			'status' => '状态',
			'create_at' => '创建时间',
			'update_at' => '修改时间',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password_hash',$this->password_hash,true);
		$criteria->compare('password_reset_token',$this->password_reset_token,true);
		$criteria->compare('staff_no',$this->staff_no,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('auth_key',$this->auth_key,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
