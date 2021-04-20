<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<div class="fixedContainer">
			<div> Пользователь: <?php echo $this->user;?></div>
			<?php if(getError()):?>
			<div class="alert alert-danger" role="alert">
				Вы ввели не двухзначное число или строку
			</div>
			<?php endif;?>
			<form action="/rand"  method="get">
				<div class="form-group">
					<label for="exampleInputName">Введите двухзначное число</label>
					<input name="number" type="number" class="form-control"  placeholder="Введите число" required>
				</div>
				<button type="submit" class="btn btn-primary">Отправить</button>
			</form>
			<div class="flexBoxForBlock">
				<div>
					<h4>История доверности Экстрасенсов:</h4>
					<?php if(!empty($this->historyArrayExtrasence)):?>
					<?php $i = 0;?>
					<?php foreach($this->historyArrayExtrasence as $value){?>
					<?php $i++;?>
						<div>Экстрасенс <?php echo $i;?>:  
							<?php if(!isset($value) AND !$value = ""):
						echo  '0';
						else: echo $value;
						endif;?>%</div>
					<?php }?>
					<?php endif;?>
				</div>
				<div>
					<h4>Догадки экстрасенсов:</h4>
				<?php if($this->answerExtrasenceArray):?>
				<?php $j = 0;?>
				<?php foreach($this->answerExtrasenceArray as $value){?>
				<?php $j++;?>
					<div> Экстрасенс <?php echo $j;?>:  <?php echo $value?></div>
				  <?php }?>
				<?php endif;?>
				</div>
			</div>
		</div>
		<h4>Числа введенные пользователем:</h4>
		<div class='flexBox'>
		<?php if($this->historyNumber):?>
		<?php $n = 1;?>
		<?php foreach($this->historyNumber as $value){?>
			<div><span> <?php echo $n;?> </span><?php echo $value['number']?></div>
			<?php $n++;?>
			<?php }?>
		<?php endif;?>
		</div>
		<?php echo $this->htmlExtrasence;?>
	</div>
</div>
<!-- Button trigger modal -->







