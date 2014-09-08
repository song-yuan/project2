<?php
class UserForm extends CFormModel
{
	public $id ;
	public $username ;
	public $password_old ;
	public $password ;
	public $company_id ;
	public $mobile ;
	public $staff_no ;
	public $email ;
	
	public function rules()
	{
		return array(
				// username and password are required
				array('username, password , mobile', 'required'),
				array('username' , 'length' , 'min' => 5 , 'max' => 20),
				array('password' , 'length' , 'min' => 6 , 'max' => 16),
				array('company_id' , 'numerical'),
				array('id , staff_no , email , password_old' , 'safe'),
		);
	}
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'username' => '用户名',
				'password' => '密码',
				'company_id'=>'公司名称',
				'mobile' => '手机号',
				'staff_no' => '员工号',
				'email' => 'email',
		);
	}
	public function find($condition , $params) {
		$model = User::model()->find($condition , $params) ;
		$this->attributes = $model->attributes;
		$this->password = $this->password_old = $model->password_hash ;
	}
	public function save() {
		if($this->id) {
			$model = User::model()->find('id=:id' , array(':id' => $this->id));
		} else {
			$model = new User() ;
		}
		$model->attributes = $this->attributes;
		if($this->password_old != $this->password) {
			$model->password_hash = Helper::genPassword($this->password) ;
		}
		return $model->save();
	}
	
}