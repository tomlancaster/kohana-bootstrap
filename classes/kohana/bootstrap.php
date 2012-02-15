<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Bootstrap
{

	public static function input($name, $value, $errors, array $attributes = NULL)
	{
		$form_element = Form::input($name, $value, $attributes);
		return Bootstrap::wrap($name, $form_element, $errors);
	}
	
	public static function password($name, $value, $errors, array $attributes = NULL)
	{
		$form_element = Form::password($name, $value, $attributes);
		return Bootstrap::wrap($name, $form_element, $errors);
	}
	
	public static function textarea($name, $value, $errors, array $attributes = NULL)
	{
		$form_element = Form::textarea($name, $value, $attributes);
		return Bootstrap::wrap($name, $form_element, $errors);
	}
	
	public static function select($name, array $options, $selected, $errors, array $attributes = NULL)
	{
		$form_element = Form::select($name, $options, $selected, $attributes);
		return Bootstrap::wrap($name, $form_element, $errors);
	}
	
	public static function wrap($name, $form_element, $errors)
	{
		$isError = Arr::get($errors, $name) != NULL;
		
		$errorClass = $isError ? ' error' : '';
	
		$out = '';
		$out.= '<div class="control-group'.$errorClass.'">';
		$out.= '<label for="'.__($name).'" class="control-label">'.__($name).'</label>';
		$out.= '<div class="controls">';
        $out.= 	$form_element;
        if($isError) $out.= '<p class="help-block">'.Arr::get($errors, $name).'</p>';
        $out.= '</div>';
        $out.= '</div>';

		return $out;
	}
	
}
