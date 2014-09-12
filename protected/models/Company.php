<?php

/**
 * This is the model class for table "nb_company".
 *
 * The followings are the available columns in table 'nb_company':
 * @property string $company_id
 * @property string $company_name
 * @property string $logo
 * @property string $contact_name
 * @property string $mobile
 * @property string $telephone
 * @property string $email
 * @property string $homepage
 * @property integer $create_time
 * @property integer $delete_flag
 */
class Company extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nb_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time, delete_flag', 'numerical', 'integerOnly'=>true),
			array('company_name, email', 'length', 'max'=>50),
			array('logo, homepage', 'length', 'max'=>255),
				
			array('logo',
					'file',    //定义为file类型
					'allowEmpty'=>true,
					'types'=>'jpg,png,gif',   //上传文件的类型
					'maxSize'=>1024*1024*0.5,    //上传大小限制，注意不是php.ini中的上传文件大小
					'tooLarge'=>'文件大于500k，上传失败！请上传小于500k的文件！'
			),
			array('contact_name, mobile, telephone', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('company_id, company_name, logo, contact_name, mobile, telephone, email, homepage, create_time, delete_flag', 'safe', 'on'=>'search'),
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
			'company_id' => 'Company',
			'company_name' => 'Company Name',
			'logo' => 'Logo',
			'contact_name' => 'Contact Name',
			'mobile' => 'Mobile',
			'telephone' => 'Telephone',
			'email' => 'Email',
			'homepage' => 'Homepage',
			'create_time' => 'Create Time',
			'delete_flag' => 'Delete Flag',
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

		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('homepage',$this->homepage,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('delete_flag',$this->delete_flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Company the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
