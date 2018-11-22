<?php

class ViewNav
{
	public static function step2()
	{
		ob_start();
?>
<div class="current">
	<a>
		<div class="step_number"><span>1</span></div>
		<div class="step_name">Select</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>2</span></div>
		<div class="step_name">Add Extras</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>3</span></div>
		<div class="step_name">Your Information</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>4</span></div>
		<div class="step_name">Payment</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>5</span></div>
		<div class="step_name">Confirmation</div>
	</a>
</div>
<?php
		return ob_get_clean();
	}

	public static function step3()
	{
		ob_start();
?>
<div class="done">
	<a href="step1.php">
		<div class="step_number"><span><!-- <i class="fa fa-check"></i> --> 1</div>
		<div class="step_name">Select</div>
	</a>
</div>
<div class="current">
	<a>
		<div class="step_number"><span>2</span></div>
		<div class="step_name">Add Extras</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>3</span></div>
		<div class="step_name">Your Information</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>4</span></div>
		<div class="step_name">Payment</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>5</span></div>
		<div class="step_name">Confirmation</div>
	</a>
</div>
<?php
		return ob_get_clean();
	}
	
	public static function step4()
	{
		ob_start();
?>
<div class="done">
	<a href="step1.php">
		<div class="step_number"><span>1</div>
		<div class="step_name">Select</div>
	</a>
</div>
<div class="done">
	<a href="step2.php">
		<div class="step_number"><span>2</div>
		<div class="step_name">Add Extras</div>
	</a>
</div>
<div class="current">
	<a>
		<div class="step_number"><span>3</span></div>
		<div class="step_name">Your Information</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>4</span></div>
		<div class="step_name">Payment</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>5</span></div>
		<div class="step_name">Confirmation</div>
	</a>
</div>
<?php
		return ob_get_clean();
	}
	
	public static function step5()
	{
		ob_start();
?>
<div class="done">
	<a href="step1.php">
		<div class="step_number"><span>1</div>
		<div class="step_name">Select</div>
	</a>
</div>
<div class="done">
	<a href="step2.php">
		<div class="step_number"><span>2</div>
		<div class="step_name">Add Extras</div>
	</a>
</div>
<div class="done">
	<a href="step3.php">
		<div class="step_number"><span>3</div>
		<div class="step_name">Your Information</div>
	</a>
</div>
<div class="current">
	<a>
		<div class="step_number"><span>4</span></div>
		<div class="step_name">Payment</div>
	</a>
</div>
<div>
	<a>
		<div class="step_number"><span>5</span></div>
		<div class="step_name">Confirmation</div>
	</a>
</div>
<?php
		return ob_get_clean();
	}

	public static function step6()
	{
		ob_start();
?>
<div class="done">
	<a>
		<div class="step_number"><span>1</div>
		<div class="step_name">Select</div>
	</a>
</div>
<div class="done">
	<a>
		<div class="step_number"><span>2</div>
		<div class="step_name">Add Extras</div>
	</a>
</div>
<div class="done">
	<a>
		<div class="step_number"><span>3</div>
		<div class="step_name">Your Information</div>
	</a>
</div>
<div class="done">
	<a>
		<div class="step_number"><span>4</div>
		<div class="step_name">Payment</div>
	</a>
</div>
<div class="current">
	<a>
		<div class="step_number"><span>5</span></div>
		<div class="step_name">Confirmation</div>
	</a>
</div>
<?php
		return ob_get_clean();
	}

}
