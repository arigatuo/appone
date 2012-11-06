<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'photo'); ?>
        <?php echo $form->textField($model,'photo',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'photo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'category_id'); ?>
        <?php //echo $form->textField($model,'category_id',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo CHtml::dropDownList('Item[category_id]', $model->category_id, CHtml::listData(Category::model()->findAll(), 'category_id', 'category_name') ); ?>
        <?php echo $form->error($model,'category_id'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'is_top'); ?>
        <?php //echo $form->textField($model,'is_top'); ?>
        <?php echo CHtml::dropDownList('Item[is_top]', $model->is_top, array('1'=>'是', '0'=>'否') ); ?>
        <?php echo $form->error($model,'is_top'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'special_price'); ?>
		<?php echo $form->textField($model,'special_price'); ?>
		<?php echo $form->error($model,'special_price'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'endtime'); ?>
		<?php /*echo $form->textField($model,'endtime',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'endtime'); */ ?>
        <?php
            $this->widget('application.extentions.timepicker.timepicker', array(
                'model'=>$model,
                'name'=>'endtime',
            ));
        ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_free'); ?>
		<?php echo $form->textField($model,'is_free',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_free'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'pieces'); ?>
		<?php echo $form->textField($model,'pieces',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pieces'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'share_time'); ?>
		<?php echo $form->textField($model,'share_time',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'share_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fav_time'); ?>
		<?php echo $form->textField($model,'fav_time',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'fav_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'already_buy'); ?>
		<?php echo $form->textField($model,'already_buy',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'already_buy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->