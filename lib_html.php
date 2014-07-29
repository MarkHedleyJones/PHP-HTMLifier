<?php

function attrs ($attrs) {
	if ($attrs != false) {
		$out = '';
		foreach ($attrs AS $name => $val) {
			$out .= ' ' . $name . '="' . $val . '"';
		}
		return $out;
	}
	else return false;
}

function redirect($url) {
	header('Location: ' . $url);
	die();
}

function start_tag($type, $attrs = array()) {
	return '<' . $type . attrs($attrs) . '>';
}

function end_tag($type) {
	return '</' . $type . '>';
}

function block($type, $body = false, $attrs = array()) {
	return start_tag($type,$attrs) . ($body != false ? (is_object($body) ?  $body->as_string() : $body) : '') . end_tag($type);
}

function inline($type, $attrs = false) {
	return start_tag($type,$attrs);
}

function button($text, $attrs=array()) {
	return block('button',$text,$attrs);
}

function div($content, $attrs=array()) {
	return block('div', $content, $attrs);
}

function span($content, $attrs=array()) {
	return block('span', $content, $attrs);
}

function input($type, $name, $id=False, $value=False, $attrs=array()) {
        $attrs['type'] = $type;
        $attrs['name'] = $name;
        if ($id) $attrs['id'] = $id;
        else $attrs['id'] = $name;
        if ($value) $attrs['value'] = $value;
        return inline('input', $attrs);
}

function generic_tag($type, $attrs=Array()) {
	return inline($type, $attrs);
}

function radio($name, $id, $value, $attrs=array()) {
	return input('radio', $name, $id, $value, $attrs);
}

function label($id, $text, $attrs=array()) {
	$attrs['for'] = $id;
	return block('label',$text, $attrs);
}

function radioOption($name, $id, $value, $text, $attrs=Array()) {
	return radio($name, $id, $value, $attrs) . label($id, $text, $attrs);
}

function textbox($name, $id=False, $value=False, $attrs=Array()) {
	return input('text',$name, $id, $value, $attrs);
}

function checkbox($name, $checked=False, $attrs=Array()) {
	if ($checked) $attrs['checked'] = 'checked';
	return input('checkbox', $name, $name, False, $attrs);
}

function checkboxOption($name, $label, $checked, $attrs_label=Array(), $attrs_checkbox=Array()) {
	return checkbox($name, $checked, $attrs_checkbox) . label($name, $label, $attrs_label);
}

function datepicker($name, $date=False, $attrs=array(), $script=False) {
	$GLOBALS['postscript'] .= '$( "#' . $name . '").datepicker({'.$script.'});';
	return textbox($name, $date, $attrs);
}

function numberspinner($name, $value=False, $attrs=array(), $script=False) {
	$GLOBALS['postscript'] .= '$( "#' . $name . '").spinner({'.$script.'});';
	if ($value != False) $GLOBALS['postscript'] .= '$( "#' . $name . '").spinner( "value", '.$value.');';
	return textbox($name, $value, $attrs);
}

function upload($name,$attrs = array()) {
	return input('file', $name);
}

function select($name, $options, $selectedIndex = false, $attrs = array()) {
	$tmp = '';
	$attrs['id'] = $name;
	$attrs['name'] = $name;
	$tmp .= start_tag('select',$attrs);



	foreach ($options AS $key => $value) {
		$attr = array('value'=>($key+1));
		if ($selectedIndex == $key) $attr['selected'] = 'selected';
		$tmp .= block('option',$value,$attr);
	}
	$tmp .= end_tag('select');
	return $tmp;
}

function h1($text, $attrs=array()) {
	return block('h1',$text, $attrs);
}

function h2($text, $attrs=array()) {
	return block('h2',$text, $attrs);
}

function h3($text, $attrs=array()) {
	return block('h3',$text, $attrs);
}

function hr($attrs=False) {
	return start_tag('hr',$attrs);
}

function img($src, $alt, $attrs = array()) {
	$attrs['src'] = $src;
	$attrs['alt'] = $alt;
	return inline('img',$attrs);
}

function p($text, $attrs = false) {
	return block('p', $text, $attrs);
}

function href($text, $href, $attrs=array()) {
	$attrs['href'] = $href;
	return block('a', $text, $attrs);
}

function script_block($block, $type='text/javascript', $attrs=Array()) {
	$attrs['type'] = $type;
	return block('script', $block, $attrs);
}

function script_reference($src, $type='text/javascript', $attrs=Array()) {
	$attrs['type'] = $type;
	$attrs['src'] = $src;
	return block('script', '', $attrs);
}

function style_block($block, $type='text/css', $attrs=Array()) {
	$attrs['type'] = $type;
	return block('style', $block, $attrs);
}

function style_reference($src, $type='text/css', $attrs=Array()) {
	$attrs['type'] = $type;
	$attrs['href'] = $src;
	$attrs['rel'] = 'stylesheet';
	return inline('link', $attrs);
}

function textarea($name, $body, $placeholder=False, $attrs=array()) {
	$attrs['name'] = $name;
	$attrs['id'] = $name;
	if ($placeholder) $attrs['placeholder'] = $placeholder;
	return block('textarea', $body, $attrs);
}

function b($text, $attrs=array()) {
	return block('b', $text, $attrs);
}

function br($attrs=array()) {
	return inline('br',$attrs);
}

function table($rows, $attrs=array(), $ignoreHeaders=False) {
	$tmp = '';
	$tmp .= start_tag('table',$attrs);
	foreach($rows AS $th => $td) {
		$tmp .= start_tag('tr');
		if (!$ignoreHeaders) $tmp .= block('th',$th);
		if (is_array($td)) {
			foreach($td AS $tmp2) {
				if (is_object($tmp2)) $tmp .= block('td', $tmp2->as_string());
				else $tmp .= block('td',$tmp2);
			}
		}
		elseif (is_object($td)) {
			$tmp .= block('td', $td->as_string());
		}
		else $tmp .= block('td',$td);
		$tmp .= end_tag('tr');
	}
	$tmp .= end_tag('table');
	return $tmp;
}

function transpose($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}


function table_vertical($data, $attrs=Array(), $ignoreHeaders=False) {
	$headers = array_keys($data);
	$rows = transpose($data);
	$tmp = '';
	$tmp .= start_tag('table',$attrs);
	if ($ignoreHeaders == False) {
		$tmp .= start_tag('tr');
		foreach ($headers AS $header) {
			$tmp .= block('th',$header);
		}
		$tmp .= end_tag('tr');
	}
	foreach ($rows AS $row) {
		$tmp .= start_tag('tr');
		if (is_array($row)) {
			foreach($row AS $tmp2) {
				if (is_object($tmp2)) $tmp .= block('td', $tmp2->as_string());
				else $tmp .= block('td',$tmp2);
			}
		}
		elseif (is_object($row)) {
			$tmp .= block('td', $row->as_string());
		}
		else $tmp .= block('td',$row);
		$tmp .= end_tag('tr');
	}
	$tmp .= end_tag('table');
	return $tmp;
}


class Element {

	protected $content = array();

	public function wrap($element, $attrs = false) {
		array_unshift($this->content, start_tag($element,$attrs));
		array_push($this->content, end_tag($element));
	}

	public function append($content) {
		array_push($this->content,$content);
	}

	public function prepend($content) {
		array_unshift($this->content, $content);
	}

	public function render() {
		foreach($this->content AS $item) {
			if (is_object($item)) $item->render();
			elseif (is_string($item)) echo $item . "\n";
		}
	}

	public function as_string() {
		$out =  '';
		foreach ($this->content AS $item) {
			if (is_object($item)) $out .= $item->as_string();
			elseif (is_string($item)) $out .= $item . "\n";
		}
		return $out;
	}

	public function as_array() {
		return $this->content;
	}
}

class BaseList extends Element {

	public $type;
	public $attrs;
	public $closed;

	public function __construct($type, $attrs=array()) {
		$type = strtolower($type);
		if ($type == 'ul' || strpos($type, 'un') !== False) $this->type = 'ul';
		else $this->type = 'ol';
		$this->attrs = $attrs;
		$this->closed = False;
	}

	public function append($item, $attrs=array()) {
		if (is_object($item)) $item->wrap('li', $attrs);
		elseif (is_string($item)) $item = block('li',$item, $attrs);
		parent::append($item);
	}

	public function wrap($element, $attrs=array()) {
		$this->close();
		parent::wrap($element, $attrs);
	}

	public function close() {
		if ($this->closed == False) {
			parent::wrap($this->type, $this->attrs);
			$this->closed = True;
		}
	}

	public function as_string() {
		$this->close();
		return parent::as_string();
	}

	public function render() {
		$this->close();
		parent::render();
	}
}

class UnorderedList extends BaseList {
	public function __construct($attrs=array()) {
		parent::__construct('ul', $attrs);
	}
}

class OrderedList extends BaseList {
	public function __construct($attrs=array()) {
		parent::__construct('ol', $attrs);
	}
}

class Form extends Content {

	public $attrs = array();

	public function __construct($action, $method='POST', $attrs=array()) {
		$this->attrs = $attrs;
		$this->attrs['method'] = $method;
		$this->attrs['action'] = $action;
	}

	public function button($text, $attrs=array()) {
		$this->append(button($text,$attrs));
	}

	public function submitButton($text, $attrs=array()) {
		$attrs['type'] = 'submit';
		$this->append(button($text, $attrs));
	}

	public function textbox($name, $id=False, $value=False, $attrs=array()) {
		$this->append(textbox($name, $id, $value, $attrs));
	}

	public function hiddenField($name, $value, $attrs=array()) {
		$this->append(input('hidden', $name, $name, $value, $attrs));
	}

	public function textarea($name, $body, $placeholder=False, $attrs=array()) {
		$this->append(textarea($name, $body, $placeholder, $attrs));
	}

	public function datepicker($name, $attrs=array()) {
		$this->append(datepicker($name, $attrs));
	}

	public function numberspinner($name, $attrs=array()) {
		$this->append(numberspinner($name, $value=False));
	}

	public function checkbox($name, $attrs=array()) {
		$this->append(checkbox($name, $attrs));
	}

	public function checkboxOption($name, $label, $checked, $attrs_label=Array(), $attrs_checkbox=Array()) {
		$this->append(checkboxOption($name, $label, $checked, $attrs_label, $attrs_checkbox));
	}

	public function label($name,$text,$attrs=array()) {
		$this->append(label($name,$text,$attrs));
	}

	public function radio($name, $value, $attrs=array()) {
		$this->append(radio($name, $value, $attrs));
	}

	public function radioOption($name, $id, $value, $text, $attrs=array()) {
		$this->append(radioOption($name, $id, $value, $text, $attrs));
	}

	public function upload($name, $attrs = array()) {
		$this->append(upload($name, $attrs));
	}

	public function select($name, $options, $selectedIndex = false, $attrs = array()) {
		$this->append(select($name,$options,$selectedIndex,$attrs));
	}

	public function render() {
		$this->wrap('form',$this->attrs);
		parent::render();
	}
}

class Content extends Element {

	public $level = 0;

	public function h1($text,$attrs = array()) {
		$this->append(h1($text,$attrs));
	}

	public function h2($text,$attrs = array()) {
		$this->append(h2($text,$attrs));
	}

	public function h3($text,$attrs = array()) {
		$this->append(h3($text,$attrs));
	}

	public function hr($attrs=array()) {
		$this->append(hr($attrs));
	}

	public function img($src, $alt, $attrs = array()) {
		$this->append(img($src, $alt, $attrs));
	}

	public function href($text, $href, $attrs = array()) {
		$this->append(href($text, $href, $attrs));
	}

	public function a($text, $href, $attrs=array()) {
		//Alias function for href
		$this->append(href($text, $href, $attrs));
	}

	public function p($text,$attrs = array()) {
		$this->append(p($text, $attrs));
	}

	public function span($text, $attrs=array()) {
		$this->append(span($text, $attrs));
	}

	public function br($attrs = array()) {
		$this->append(br($attrs));
	}

	public function b($text, $attrs=array()) {
		$this->append(b($text, $attrs));
	}

	public function table($rows, $attrs=array(), $ignoreHeaders=False) {
		$this->append(table($rows,$attrs, $ignoreHeaders));
	}

	public function table_vertical($data, $attrs=Array(), $ignoreHeaders=False) {
		$this->append(table_vertical($data, $attrs, $ignoreHeaders));
	}

	public function div($content, $attrs=array()) {
		$this->append(div($content, $attrs));
	}

	public function script_block($block, $type='text/javascript', $attrs=Array()) {
		$this->append(script_block($block, $type, $attrs));
	}

	public function block($type, $body = false, $attrs = array()) {
		return block($type, $body, $attrs);
	}


	public function div_open($attrs=array()) {
		++$this->level;
		$this->append(start_tag('div', $attrs));
	}

	public function div_close() {
		--$this->level;
		$this->append(end_tag('div'));
	}

	public function __destruct() {
		while ($this->level > 0) div_close();
	}
}

class Page extends Content {

	protected $head;
	//protected $scriptReferences = Array();
	protected $head_entries = Array();
	protected $postscripts = Array();
	protected $prescripts = Array();
	protected $onready_js = Array();

	public function __construct($title,$description=False) {
		$this->head = new Element();
		$this->head->append(block('title',$title));
		$this->head->append(inline('meta',array('Description'=>$description)));
	}

	public function script_block($block, $head=False, $type='text/javascript', $attrs=Array()) {
		if ($head) array_push($this->prescripts, script_block($block, $type, $attrs));
		else array_push($this->postscripts, script_block($block, $type, $attrs));
	}

	public function readyScript($code) {
		array_push($this->onready_js, $code);
	}

	public function generic_tag($type, $attrs=Array()) {
		array_push($this->head_entries, generic_tag($type, $attrs));
	}

	public function script_reference($src, $head=False, $type='text/javascript', $attrs=Array()) {
		if ($head) array_push($this->prescripts, script_reference($src, $type, $attrs));
		else array_push($this->postscripts, script_reference($src, $type, $attrs));
	}

	public function style_block($block, $type='text/css', $attrs=Array()) {
		array_push($this->head_entries, style_block($block, $type, $attrs));
	}

	public function style_reference($src, $type='text/css', $attrs=Array()) {
		array_push($this->head_entries, style_reference($src, $type, $attrs));
	}

	public function render() {
		$this->wrap('div',array('id'=>'main'));
		foreach ($this->postscripts AS $postscript) {
			$this->append($postscript);
		}
		if (count($this->onready_js) > 0) {
			$tmp = '';
			foreach ($this->onready_js AS $js) {
				$tmp .= $js;
			}
			$out = '<script type="text/javascript">$(document).ready(function(){';
			$out .= $tmp;
			$out .= '});</script>';
			$this->append($out);
		}
		$this->wrap('body');
		foreach ($this->head_entries AS $stylesheet) {
			$this->head->append($stylesheet);
		}
		foreach ($this->prescripts AS $prescript) {
			$this->head->append($prescript);
		}
		$this->head->wrap('head');
		$this->prepend($this->head);
		$this->wrap('html',array('lang'=>'en'));
		$this->prepend('<!DOCTYPE HTML>');
		parent::render();
	}
}