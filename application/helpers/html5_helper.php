<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('html5'))
{
	function html5($tag, $attributes = array(), $children = NULL)
	{
		if ($tag === 'doctype')
		{
			return '<!doctype html>';
		}

		$attribute = '';

		foreach ($attributes as $name => $value)
		{
			switch ($name)
			{
				case 'class':
					if (is_array($value))
					{
						$value = implode(' ', $value);
					}
					break;

				case 'style':
					if (is_array($value))
					{
						$style = $value;
						$value = '';

						foreach ($style as $n => $v)
						{
							$value .= "{$n}:{$v};";
						}
					}
					break;
				
				default:
					break;
			}
			$name = strtolower($name);
			$attribute .= " {$name}=\"{$value}\"";
		}

		if ($children === NULL)
		{
			return "<{$tag}{$attribute} />";
		}
		else
		{
			if (is_array($children) === FALSE)
			{
				$child = $children;
			}
			else
			{
				$child = implode('', $children);
			}

			return "<{$tag}{$attribute}>{$child}</{$tag}>";
		}
	}
}
