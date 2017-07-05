<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container-fluid">
	<div class="row" style="height: 111px; padding-bottom: 37px;padding-top: 37px; background-color: #e5e5e5;">
		<div class="hidden-xs hidden-sm col-md-3 col-lg-3">
			<img src="img/letter.png" style="float: left; height: 37px;" />
			<?php $form = ActiveForm::begin(); ?>
				<?= Html::submitButton('ПОДПИСАТЬСЯ', ['style' => 'border: none; background-color: transparent; height: 37px; font-size:26px;']) ?>
		</div>
		<div class="hidden-xs hidden-sm col-md-4 col-lg-4">
				<?= $form->field($model, 'name')->label('') ?>
				<?= $form->field($model, 'email')->label('') ?>
			<?php ActiveForm::end(); ?>
		</div>
		<!-- Необходимо добавить мобильное отображение! -->
	</div>
</div>



