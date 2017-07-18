<?php 

abstract class IrActiveRecord extends CActiveRecord 
{
	/**
	* Prepares create_time, create_user_id, update_time and update_user_ id attributes before performing validation.
	*/ 
	protected function beforeValidate() 
	{
		if($this->isNewRecord)
		{
			// set the create date, last updated date and the user doing the creating
			$this->create_time=$this->update_time=new CDbExpression('NOW()');
			$this->create_user_id=$this->update_user_id=Yii::app()->user->id;
			$this->UUID=new CDbExpression('UUID()');
			/*
			$sql='SELECT UUID();';
			$connection=Yii::app()->db;   // assuming you have configured a "db" connection
			// If not, you may explicitly create a connection:
			// $connection=new CDbConnection($dsn,$username,$password);
			$command=$connection->createCommand($sql);
			// if needed, the SQL statement may be updated as follows:
			// $command->text=$newSQL;
			$this->UUID=$command->queryScalar();
			*/
		}
		else
		{
			//not a new record, so just set the last updated time and last updated user id
			$this->update_time=new CDbExpression('NOW()'); 
			$this->update_user_id=Yii::app()->user->id;
		}
		
		return parent::beforeValidate();
	}
}
?>