<?php

/**
 * This is the model class for table "qfa_comment".
 *
 * The followings are the available columns in table 'qfa_comment':
 * @property string $comment_id
 * @property string $item_id
 * @property string $comment_text
 * @property string $comment_user_head
 * @property string $comment_user_id
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'qfa_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, comment_text, comment_user_head, comment_user_id', 'required'),
			array('item_id, comment_user_id', 'length', 'max'=>20),
			array('comment_user_head', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('comment_id, item_id, comment_text, comment_user_head, comment_user_id', 'safe', 'on'=>'search'),
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
			'comment_id' => 'Comment',
			'item_id' => 'Item',
			'comment_text' => 'Comment Text',
			'comment_user_head' => 'Comment User Head',
			'comment_user_id' => 'Comment User',
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

		$criteria->compare('comment_id',$this->comment_id,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('comment_text',$this->comment_text,true);
		$criteria->compare('comment_user_head',$this->comment_user_head,true);
		$criteria->compare('comment_user_id',$this->comment_user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}