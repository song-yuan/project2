<?php

/**
 * This is the model class for table "nb_site".
 *
 * The followings are the available columns in table 'nb_site':
 * @property string $site_id
 * @property string $serial
 * @property integer $type_id
 * @property string $site_level
 * @property string $company_id
 */
class Site extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nb_site';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('serial , type_id , company_id , site_level' , 'required'),
			array('serial', 'length', 'max'=>50),
			array('company_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('site_id, serial, company_id', 'safe', 'on'=>'search'),
		);
	}
	public function validate(){
		
		$valid = parent::validate();
		if(!$this->company_id){
			return false;
		}
		$site = Site::model()->find('site_id<>:siteId and type_id=:typeId and company_id=:companyId and serial=:serial and delete_flag=0' , array(':serial'=>$this->serial,':siteId'=>$this->site_id?$this->site_id:'',':typeId'=>$this->type_id,':companyId'=>$this->company_id));
		if($site) {
			$this->addError('serial', '座位号已经存在');
			return false;
		}
		return true;
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'isfree' => array(self::HAS_ONE , 'SiteNo' , 'site_id' , 'on' => 'isfree.delete_flag=0'),
				'siteType' => array(self::BELONGS_TO , 'SiteType' ,'type_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'site_id' => 'Site',
			'serial' => '座位编号',
			'type_id'  => '座位类型',
			'site_level' => '座位等级',
			'company_id' => '公司名称',
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

		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('serial',$this->serial,true);
		$criteria->compare('type_id',$this->serial,true);
		$criteria->compare('company_id',$this->company_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Site the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
