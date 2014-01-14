<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Bootstrap
{
	/**
	 * Creates a form input. If no type is specified, a "text" type input will
	 * be returned.
	 *
	 *     echo Bootstrap::input('username', $username);
	 *
	 * @param   string  input name
	 * @param   string  input value
	 * @param   array   errors
	 * @param   array   html attributes
	 * @return  string
	 */
	public static function input($label, $name, $value, $errors = NULL, array $attributes = NULL)
	{
		if (!Arr::get($attributes,'id'))
		{
			$attributes['id'] = $name;
		}
		return Bootstrap::wrap($label, $name, Form::input($name, $value, $attributes), $errors);
	}
	
	public static function checkbox($label, $name, $value, $checked = false, $errors = NULL,  array $attributes = NULL)
	{
		return Bootstrap::wrap($label, $name, Form::checkbox($name, $value, $checked,  $attributes), $errors);
	}
	
	/**
	 * Creates a password form input.
	 *
	 *     echo Bootstrap::password('password');
	 *
	 * @param   string  input name
	 * @param   string  input value
	 * @param   array   errors
	 * @param   array   html attributes
	 * @return  string
	 */
	public static function password($label, $name, $value, $errors = NULL, array $attributes = NULL, $additional_content = NULL)
	{
		if (!Arr::get($attributes,'id'))
		{
			$attributes['id'] = $name;
		}
		return Bootstrap::wrap($label, $name, Form::password($name, $value, $attributes), $errors, $additional_content);
	}
	
	/**
	 * Creates a textarea form input.
	 *
	 *     echo Bootstrap::textarea('about', $about);
	 *
	 * @param   string   textarea name
	 * @param   string   textarea body
	 * @param   array    errors
	 * @param   array    html attributes
	 * @param   boolean  encode existing HTML characters
	 * @return  string
	 */
	public static function textarea($label, $name, $value, $errors = NULL, array $attributes = NULL, $double_encode = TRUE)
	{
		if (!Arr::get($attributes,'id'))
		{
			$attributes['id'] = $name;
		}
		return Bootstrap::wrap($label, $name, Form::textarea($name, $value, $attributes, $double_encode), $errors);
	}
	
	/**
	 * Creates a select form input.
	 *
	 *     echo Bootstrap::select('country', $countries, $country);
	 *
	 * @param   string   input name
	 * @param   array    available options
	 * @param   mixed    selected option string, or an array of selected options
	 * @param   array    errors
	 * @param   array    html attributes
	 * @return  string
	 */
	public static function select($label, $name, array $options, $selected, $errors = NULL, array $attributes = NULL)
	{
		if (!Arr::get($attributes,'id'))
		{
			$attributes['id'] = $name;
		}
		return Bootstrap::wrap($label, $name, Form::select($name, $options, $selected, $attributes), $errors);
	}
	
	/**
	 * Wraps a form element with Boostrap specific HTML.
	 *
	 *     echo Bootstrap::select('country', $countries, $country);
	 *
	 * @param   string   form item name
	 * @param   string   html form element
	 * @param   array    errors
	 * @return  string
	 */
	public static function wrap($label, $name, $form_element, $errors = NULL, $additional_content = NULL)
	{
		$is_error = ($errors != NULL) && (Arr::get($errors, $name) != NULL);
		$error_class = $is_error ? ' error' : '';
		$error_html = $is_error ? '<p class="help-block">'.Arr::get($errors, $name).'</p>' : '';
		$out = <<<OUT
<div class="control-group{$error_class}">
	<label for="{$name}" class="control-label">{$label}</label>
	<div class="controls">
		{$form_element}{$error_html}
		{$additional_content}
	</div>
</div>
OUT;
		
		return $out;
	}
}
