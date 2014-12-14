<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Bootstrap {
	/**
	 * Creates a form input. If no type is specified, a "text" type input will
	 * be returned.
	 *
	 *     echo Bootstrap::input('username', $username);
	 *
	 * @param   string|array  input label
	 * @param   string  input name
	 * @param   string  input value
	 * @param   array   errors
	 * @param   array   html attributes
	 * @return  string
	 */
	public static function input($label, $name, $value, $errors = NULL, array $attributes = NULL, $additional_content = NULL)
	{
		if (! Arr::get($attributes,'id'))
		{
			$attributes['id'] = $name;
		}
		
		return Bootstrap::group($label, $name, Form::input($name, $value, self::attributes($attributes)), $errors, $additional_content);
	}
	
	public static function checkbox($label, $name, $value, $checked = false, $errors = NULL,  array $attributes = NULL, $additional_content = NULL)
	{
		return Bootstrap::group($label, $name, Form::checkbox($name, $value, $checked, self::attributes($attributes)), $errors, $additional_content);
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
		return Bootstrap::group($label, $name, Form::password($name, $value, self::attributes($attributes)), $errors, $additional_content);
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
	public static function textarea($label, $name, $value, $errors = NULL, array $attributes = NULL, $double_encode = TRUE, $additional_content = NULL)
	{
		if (!Arr::get($attributes,'id'))
		{
			$attributes['id'] = $name;
		}
		return Bootstrap::group($label, $name, Form::textarea($name, $value, self::attributes($attributes), $double_encode), $errors, $additional_content);
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
	public static function select($label, $name, array $options, $selected = NULL, $errors = NULL, array $attributes = NULL, $additional_content = NULL)
	{
		if (!Arr::get($attributes,'id'))
		{
			$attributes['id'] = $name;
		}
		return Bootstrap::group($label, $name, Form::select($name, $options, $selected, self::attributes($attributes)), $errors, $additional_content);
	}
	
	/**
	 * Creates a Boostrap form group with error validation
	 *
	 *     echo Bootstrap::select('country', $countries, $country);
	 *
	 * @param   string   form item name
	 * @param   string   html form element
	 * @param   array    errors
	 * @return  string
	 */
	public static function group($label, $name, $form_element, $errors = NULL, $additional_content = NULL)
	{
		$label = (! is_array($label)) ? array('label' => $label, 'class' => '') : $label;
		$has_error = (Arr::get($errors, $name) != NULL) ? 'has-error' : '';
		$error_msg = $has_error ? '<span class="help-block">'.Arr::get($errors, $name).'</span>' : '';
		
		return <<<HTML
		    <div class="form-group {$has_error}">
		    	<label class="control-label {$label['class']}" for="{$name}">{$label['label']}</label>
		    	{$form_element}{$error_msg}
		    	{$additional_content}
		    </div>
HTML;
	}
	
	/**
	 * Adds Boostrap form-control class to attributes
	 *
	 * @param   array  form control attributes
	 * @return  array
	 */
	
	private static function attributes($attributes)
	{
		$attributes['class'] = (Arr::get($attributes,'class')) ? 'form-control '.$attributes['class'] : 'form-control';

		return $attributes;
	}
}
