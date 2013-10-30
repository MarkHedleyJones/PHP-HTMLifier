<?php
$postscript = '';

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

function radio($name, $id, $value, $attrs=array()) {
	return input('radio', $name, $id, $value, $attrs);
}

function label($id, $text, $attrs=array()) {
	$attrs['for'] = $id;
	return block('label',$text, $attrs);
}

function radioOption($name, $id, $value, $text, $attrs=array()) {
	return radio($name, $id, $value, $attrs) . label($id, $text, $attrs);
}

function textbox($name, $id=False, $value=False, $attrs) {	
	return input('text',$name, $id, $value, $attrs);
}

function checkbox($name, $attrs = array()) {
	return input('checkbox', $name, False, False, $attrs);
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

	public function div($content, $attrs=array()) {
		$this->append(div($content, $attrs));
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
	protected $scriptReferences = array();
	protected $cssReferences = array();
	protected $postscripts = array();

	public function __construct($title,$description=False) {
		$this->head = new Element();
		$this->head->append(block('title',$title));
		$this->head->append(inline('meta',array('Description'=>$description)));
	}

	public function add_script_reference($path) {
		array_push($this->scriptReferences,
				block('script',
					false,
					array('type'=> 'text/javascript',
						'src' => $path)
					)
				);
	}

	public function add_css_reference($path) {
		$this->head->append(inline('link',array(
				'rel' => 'stylesheet',
				'type' => 'text/css',
				'href' => $path)));
	}

	public function add_postscript($script) {
		array_push($this->postscripts,$script);
	}


	public function render() {
		$this->wrap('div',array('id'=>'main'));
		foreach ($this->scriptReferences AS $scriptReference) {
			$this->append($scriptReference);
		}
		if (count($this->postscripts) > 0) {
			$scripts = new Content();
			foreach ($this->postscripts as $postscript) {
				$scripts->append($postscript);
			}
			$scripts->wrap('script',array('type'=>'text/javascript'));
			$this->append($scripts);
		}

		$this->wrap('body');
		$this->head->wrap('head');
		$this->prepend($this->head);
		$this->wrap('html',array('lang'=>'en'));
		$this->prepend('<!DOCTYPE HTML>');
		parent::render();
	}
}