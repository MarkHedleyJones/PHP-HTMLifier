<?php
/*****************************************************************************/
/** STANDARD HTML ENTITIES ***************************************************/
/*****************************************************************************/


/**
 * Define "a hyperlink, the named target destination for a hyperlink, or both."
 * (MDN 2014). See the href function for specific creation of a hyperlink.
 * @param  String $text  Text to appear inside the anchor
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function a($text, $attrs=array()) {
	return block('a', $text, $attrs);
}


/**
 * Make text stylistically different from normal text, without conveying
 * any special importance or relevance. (MDN 2014)
 * @param  String $text  [description]
 * @param  Array  $attrs (Optional) attributes to insert in the opening tag
 * @return String
 */
function b($text, $attrs=array()) {
	return block('b', $text, $attrs);
}


/**
 * Produce a line break in text. (MDN 2014)
 * @param  Array  $attrs (Optional) attributes to insert in the opening tag
 * @return String
 */
function br($attrs=array()) {
	return inline('br',$attrs);
}


/**
 * Wrap content with div tags
 * @param  Mixed  $body   PHP-HTMLifier Content object or String to wrap
 * @param  Array  $attrs  (Optional) attributes to give the created element
 * @return String
 */
function div($body, $attrs=array()) {
	return block('div', $body, $attrs);
}


/**
 * Marks text that has stress emphasis. (MDN 2014)
 * @param  String $text  Text to wrap in stress tags.
 * @param  Array  $attrs (Optional) attributes to insert in the opening tag
 * @return String
 */
function em($text, $attrs=array()) {
	return block('em', $text, $attrs);
}


/**
 * Represent highlighted text. (MDN 2014)
 * @param  String $text  Text to apply markup to
 * @param  Array  $attrs (Optional) attributes to insert into opening tag
 * @return String
 */
function mark($text, $attrs=array()) {
	return block('mark', $text, $attrs);
}


/**
 * Give "text strong importance, typically displayed in bold." (MDN 2014)
 * @param  String $text  Text to apply markup to
 * @param  Array  $attrs (Optional) attributes to insert into opening tag
 * @return String
 */
function strong($text, $attrs=array()) {
	return block('strong', $text, $attrs);
}


/**
 * Wrap content in "a generic inline container for phrasing content" (MDN 2014)
 * @param  Mixed  $content - PHP-HTMLifier Content object or String to wrap
 * @param  Array  $attrs   (Optional) attributes to give the created element
 * @return String
 */
function span($content, $attrs=array()) {
	return block('span', $content, $attrs);
}


/**
 * Create a level 1 heading element
 * @param  String $text  Text to appear in the heading
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function h1($text, $attrs=array()) {
	return block('h1',$text, $attrs);
}


/**
 * Create a level 2 heading element
 * @param  String $text  Text to appear in the heading
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function h2($text, $attrs=array()) {
	return block('h2',$text, $attrs);
}


/**
 * Create a level 3 heading element
 * @param  String $text  Text to appear in the heading
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function h3($text, $attrs=array()) {
	return block('h3',$text, $attrs);
}


/**
 * Create a level 4 heading element
 * @param  String $text  Text to appear in the heading
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function h4($text, $attrs=array()) {
	return block('h4',$text, $attrs);
}


/**
 * Create a level 5 heading element
 * @param  String $text  Text to appear in the heading
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function h5($text, $attrs=array()) {
	return block('h5',$text, $attrs);
}


/**
 * Create a level 6 heading element
 * @param  String $text  Text to appear in the heading
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function h6($text, $attrs=array()) {
	return block('h6',$text, $attrs);
}


/**
 * Create "a thematic break between paragraph-level elements" (MDN 2014)
 * @param  Array  $attrs (Optional) Attributes to give the created element
 * @return String
 */
function hr($attrs=False) {
	return start_tag('hr',$attrs);
}


/**
 * Create "a hyperlink, the named target destination for a hyperlink, or both."
 * (MDN 2014).
 * @param  String $href  Href target of the hyperlink
 * @param  String $text  Text to appear inside the anchor
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function href($href, $text, $attrs=array()) {
	$attrs['href'] = $href;
	return block('a', $text, $attrs);
}


/**
 * Insert an image element
 * @param  String $src   Source URL for the image
 * @param  String $alt   (Optional) Textual description of the image
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function img($src, $alt=False, $attrs=array()) {
	$attrs['src'] = $src;
	if ($alt) $attrs['alt'] = $alt;
	return inline('img',$attrs);
}


/**
 * Create a paragraph of text
 * @param  String  $text  Paragraph of text
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function p($text, $attrs=array()) {
	return block('p', $text, $attrs);
}


/**
 * Create a script block suitable for insertion into the document.
 * This function wraps code in <script> tags for inline insertion.
 * @param  String  $block Script contents (e.g. javascript code)
 * @param  String  $type  (Optional) Type of code (default = 'text/javascript')
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function script_block($block, $type='text/javascript', $attrs=array()) {
	$attrs['type'] = $type;
	return block('script', $block, $attrs);
}


/**
 * Create a script reference suitable for insertion into a document.
 * This function creates a tag that refers to a script to be fetched and
 * executed by the browser.
 * @param  String  $src   Source URL for the script
 * @param  String  $type  (Optional) Type of code (default = 'text/javascript')
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function script_reference($src, $type='text/javascript', $attrs=array()) {
	$attrs['type'] = $type;
	$attrs['src'] = $src;
	return block('script', '', $attrs);
}


/**
 * Create a stylesheet block suitable for insertion into the document head.
 * This function wraps code in <style> tags for inline insertion.
 * @param  String  $block Stylesheet contents (e.g. css directives)
 * @param  String  $type  (Optional) Type of code (default = 'text/css')
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function style_block($block, $type='text/css', $attrs=array()) {
	$attrs['type'] = $type;
	return block('style', $block, $attrs);
}


/**
 * Create a stylesheet reference suitable for insertion into the document head.
 * This function creates a tag that refers to a stylesheet to be fetched and
 * executed by the browser.
 * @param  String  $src   Source URL for the script
 * @param  String  $type  (Optional) Type of code (default = 'text/css')
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function style_reference($src, $type='text/css', $attrs=array()) {
	$attrs['type'] = $type;
	$attrs['href'] = $src;
	$attrs['rel'] = 'stylesheet';
	return inline('link', $attrs);
}


/*****************************************************************************/
/** TABLES *******************************************************************/
/*****************************************************************************/


/**
 * Create a table of data from an array. This function will convert a passed
 * array into tabular format with the keys as headings and the contents as
 * cells. See table_horizontal for creation of horizontal table.
 * @param  Array   $cols          Columns of the table
 * @param  Array   $attrs         (Optional) attributes to give the table
 * @param  Boolean $ignoreHeaders (Optional) skip adding the header row
 * @return String
 */
function table($cols, $attrs=array(), $ignoreHeaders=False) {
	$headers = array_keys($cols);
	$rows = transpose($cols);
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


/**
 * Create a table of data from an array. This function will convert a passed
 * array into tabular format with the keys as headings and the contents as
 * cells. See table for creation of vertical table.
 * @param  Array   $rows          Rows of the table
 * @param  Array   $attrs         (Optional) attributes to give the table
 * @param  Boolean $ignoreHeaders (Optional) skip adding the header row
 * @return String
 */
function table_horizontal($rows, $attrs=array(), $ignoreHeaders=False) {
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


/**
 * Used by table function to turn the given array into columns.
 * Credit for this goes to Han Lin Yap (stackoverflow:Codler) for providing
 * this code as found on stackoverflow.
 * stackoverflow.com/questions/797251/transposing-multidimensional-arrays-in-php#3423692
 * @param  Array $array - input array to be transposed
 * @return Array
 */
function transpose($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}


/*****************************************************************************/
/** CONVIENIENCE FUNCTIONS ***************************************************/
/*****************************************************************************/


/**
 * Redirect the client to the given url. Inhibits page rendering.
 * @param  String $url - destination
 * @return None
 */
function redirect($url) {
	header('Location: ' . $url);
	die();
}


/**
 * Create a generic tag - alias of inline
 * @param  String  $type  - Name of the tag (e.g. 'meta', 'img')
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function generic_tag($type, $attrs=array()) {
	return inline($type, $attrs);
}


/*****************************************************************************/
/** BASE FUNCTIONS ***********************************************************/
/*****************************************************************************/


/**
 * Create a start tag string of the given type
 * @param  String $type  - name of tag (e.g. 'a', 'href', 'div')
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String        - opening tag string
 */
function start_tag($type, $attrs=array()) {
	return '<' . $type . attrs($attrs) . '>';
}


/**
 * Create an end tag string of the given type
 * @param  String $type - name of tag (e.g. 'a', 'div', 'span')
 * @return String
 */
function end_tag($type) {
	return '</' . $type . '>';
}


/**
 * Wrap a given string or PHP-HTMLifier object in tags of the given type
 * @param  String  $type  - name of tag to wrap (e.g. 'div', 'span')
 * @param  String  $body  (Optional) - content to place within the tags
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function block($type, $body=False, $attrs=array()) {
	if (is_object($body)) $body = $body->as_string();
	return start_tag($type,$attrs) . $body . end_tag($type);
}


/**
 * Create an inline element such as img. Inline refers to the element
 * not having a closing tag. It does not refer to the created element
 * being displayed inline.
 * @param  String  $type  - name of tag (e.g. 'img', 'meta')
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function inline($type, $attrs=array()) {
	return start_tag($type,$attrs);
}


/**
 * Convert an array containing HTML attributes into HTML syntax
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return string
 */
function attrs($attrs) {
	if ($attrs != False) {
		$out = '';
		foreach ($attrs AS $name => $val) {
			$out .= ' ' . $name . '="' . $val . '"';
		}
		return $out;
	}
	else return False;
}


/*****************************************************************************/
/** FORM ELEMENTS ************************************************************/
/*****************************************************************************/


/**
 * Create a clickable button
 * @param  String $text  Text to appear in the button
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String 
 */
function button($text, $attrs=array()) {
	return block('button',$text, $attrs);
}


/**
 * Create a checkbox
 * @param  String  $name    Name of the checkbox variable
 * @param  Boolean $checked (Optional[False]) Set the checkbox to checked
 * @param  Array   $attrs (Optional) attributes to give the checkbox
 * @return String
 */
function checkbox($name, $checked=False, $attrs=Array()) {
	if ($checked) $attrs['checked'] = 'checked';
	return input('checkbox', $name, $name, False, $attrs);
}


/**
 * Create a checkbox and label together. Equivalent to using the checkbox and
 * label functions together. Handles matching the id field between the two.
 * @param  String  $name            Name of the checkbox variable
 * @param  String  $label           Text to appear in the label
 * @param  Boolean $checked         (Optional) Set the checkbox to checked
 * @param  Array   $attrs_label     (Optional) attributes to give the label
 * @param  Array   $attrs_checkbox  (Optional) attributes to give the radio
 * @return String
 */
function checkboxOption($name,
                        $label,
                        $checked=False,
                        $attrs_label=array(),
                        $attrs_checkbox=array()) {

	return checkbox($name,
	                $checked,
	                $attrs_checkbox) . label($name, 
	                					     $label,
	                					     $attrs_label);
}


/**
 * Create an input element suitable for insertion into a form
 * @param  String  $type  - Type of input (e.g. 'button', 'checkbox')
 * @param  String  $name  - Name attribute
 * @param  String  $id    (Optional) id attribute
 * @param  String  $value (Optional) value attribute
 * @param  Array   $attrs (Optional) attributes to give the created element
 * @return String
 */
function input($type, $name, $id=False, $value=False, $attrs=array()) {
        $attrs['type'] = $type;
        $attrs['name'] = $name;
        if ($id) $attrs['id'] = $id;
        else $attrs['id'] = $name;
        if ($value) $attrs['value'] = $value;
        return inline('input', $attrs);
}


/**
 * Create a label field for a form element sharing the same id
 * @param  String $id    id of the form element to which the label belongs
 * @param  String $text  Text to appear in the label
 * @param  Array  $attrs (Optional) attributes to give the label
 * @return [type]        [description]
 */
function label($id, $text, $attrs=array()) {
	$attrs['for'] = $id;
	return block('label',$text, $attrs);
}


/**
 * Create a radio input element. Use radioOption to combine the creation
 * of a radio button with a label.
 * @param  String $name  Name of the radio element variable
 * @param  String $id    Id of the element
 * @param  String $value Value given to the element
 * @param  Array  $attrs (Optional) attributes to give the created element
 * @return String
 */
function radio($name, $id, $value, $attrs=array()) {
	return input('radio', $name, $id, $value, $attrs);
}


/**
 * Create a radio button and label together. Equivalent to using the 
 * radio and label functions together. Handles matching the id field.
 * @param  String $name        Name of the radio button variable
 * @param  String $id          id to pair the button with the label
 * @param  String $value       Value of the radio button
 * @param  String $text        Text to appear in the label
 * @param  Array  $attrs_label (Optional) attributes to give the label
 * @param  Array  $attrs_radio (Optional) attributes to give the radio
 * @return String
 */
function radioOption($name,
                     $id,
                     $value,
                     $text,
                     $attrs_label=array(),
                     $attrs_radio=array()) {

	return radio($name,
	             $id,
	             $value,
	             $attrs_radio) . label($id,
	                                   $text,
	                                   $attrs_label);
}


/**
 * Create a drop-down select box from an array of options.
 * @param  String  $name          Name given to the selected variable
 * @param  Array   $options       Items to appear in the select box.
 *                                key => value, where 'key' is the value of the
 *                                given option and 'value' is the text
 *                                displayed as the option
 * @param  Boolean $selectedIndex (Opiional) Index of the item to be selected
 * @param  Array   $attrs         (Optional) attributes to give the select box
 * @return String
 */
function select($name, $options, $selectedIndex=False, $attrs=array()) {
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


/**
 * Create a multi-line plain-text editing control (MDN 2014)
 * @param  String  $name        Name given to the variable of the textarea
 * @param  String  $body        Text to be placed into the textarea
 * @param  Boolean $placeholder (Optional) Text to appear when empty
 * @param  Array   $attrs       (Optional) attributes to give the textarea
 * @return String
 */
function textarea($name, $body, $placeholder=False, $attrs=array()) {
	$attrs['name'] = $name;
	$attrs['id'] = $name;
	if ($placeholder) $attrs['placeholder'] = $placeholder;
	return block('textarea', $body, $attrs);
}


/**
 * Create a textbox suitable for insertion into a form
 * @param  String  $name  Name of the textbox variable
 * @param  String  $id    (Optional) id attribute of the textbox
 * @param  String  $value (Optional) initial text to appear in the textbox
 * @param  Array   $attrs (Optional) attributes to give the textbox
 * @return String
 */
function textbox($name, $id=False, $value=False, $attrs=Array()) {
	return input('text',$name, $id, $value, $attrs);
}


/**
 * Create a file upload element suitable for insertion into a Form object
 * @param  String $name  Name of the file upload variable
 * @param  Array   $attrs (Optional) attributes to give the element
 * @return String
 */
function upload($name, $attrs = array()) {
	return input('file', $name);
}


/*****************************************************************************/
/** CLASSES ******************************************************************/
/*****************************************************************************/


// Not intended to be used directly. See UnorderedList and OrderedList classes
// below.
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


/**
 * Create an unordered (bullet) list for insertion into a Page object.
 * Once created, items are added to the list using the append command.
 * E.g. $mylist->append("cars");
 * @param  Array $attrs (Optional) - attributes to give the list
 */
class UnorderedList extends BaseList {
	public function __construct($attrs=array()) {
		parent::__construct('ul', $attrs);
	}
}


/**
 * Create an ordered list for insertion into a Page object.
 * Once created, items are added to the list using the append command.
 * E.g. $mylist->append("bikes");
 * @param  Array $attrs (Optional) - attributes to give the list
 */
class OrderedList extends BaseList {
	public function __construct($attrs=array()) {
		parent::__construct('ol', $attrs);
	}
}


class Content extends Element {

	public $level = 0;


	/**
	 * Insert "a hyperlink, the named target destination for a hyperlink, or
	 * both." (MDN 2014). See the href function for specific creation of a
	 * hyperlink.
	 * @param  String $text  Text to appear inside the anchor
	 * @param  Array  $attrs (Optional) attributes to give the created element
	 */
	public function a($href, $text, $attrs=array()) {
		$this->append(a($href, $text, $attrs));
	}


	/**
	 * Insert stylistically different text, without conveying
	 * any special importance or relevance. (MDN 2014)
	 * @param  String $text  Text to insert
	 * @param  Array  $attrs (Optional) attributes to insert in the opening tag
	 */
	public function b($text, $attrs=array()) {
		$this->append(b($text, $attrs));
	}


	/**
	 * Insert a line break.
	 * @param  Array  $attrs (Optional) attributes to insert in the opening tag
	 */
	public function br($attrs = array()) {
		$this->append(br($attrs));
	}


	/**
	 * Insert content and surround within div tags
	 * @param  String $body   Contents of the created div element
	 * @param  Array  $attrs  (Optional) attributes to give the created element
	 */
	public function div($content, $attrs=array()) {
		$this->append(div($content, $attrs));
	}


	/**
	 * Insert "text that has stress emphasis". (MDN 2014)
	 * @param  String $text  Text to insert
	 * @param  Array  $attrs (Optional) attributes to insert in the opening tag
	 */
	public function em($text, $attrs=array()) {
		$this->insert(em($text, $attrs));
	}


	/**
	 * Insert highlighted text. (MDN 2014)
	 * @param  String $text  Text to insert with highlight
	 * @param  Array  $attrs (Optional) attributes to insert into opening tag
	 */
	public function mark($text, $attrs=array()) {
		$this->append(mark($text, $attrs));
	}


	/**
	 * Insert text with "strong importance, typically displayed in bold."
	 * (MDN 2014)
	 * @param  String $text  Text to apply markup to
	 * @param  Array  $attrs (Optional) attributes to insert into opening tag
	 */
	public function strong($text, $attrs=array()) {
		$this->append(strong($text, $attrs));
	}


	/**
	 * Insert content wrapped in "a generic inline container for phrasing
	 * content" (MDN 2014)
	 * @param  Mixed  $content Content to be wrapped in span tags
	 * @param  Array  $attrs   (Optional) Attributes to give the created span
	 */
	public function span($content, $attrs=array()) {
		$this->append(span($content, $attrs));
	}


	/**
	 * Insert a level 1 heading element
	 * @param  String $text  Text to appear in the heading
	 * @param  Array  $attrs (Optional) Attributes to give the created heading
	 */
	public function h1($text,$attrs = array()) {
		$this->append(h1($text,$attrs));
	}


	/**
	 * Insert a level 2 heading element
	 * @param  String $text  Text to appear in the heading
	 * @param  Array  $attrs (Optional) Attributes to give the created heading
	 */
	public function h2($text,$attrs = array()) {
		$this->append(h2($text,$attrs));
	}


	/**
	 * Insert a level 3 heading element
	 * @param  String $text  Text to appear in the heading
	 * @param  Array  $attrs (Optional) Attributes to give the created heading
	 */
	public function h3($text,$attrs = array()) {
		$this->append(h3($text,$attrs));
	}


	/**
	 * Insert a level 4 heading element
	 * @param  String $text  Text to appear in the heading
	 * @param  Array  $attrs (Optional) Attributes to give the created heading
	 */
	public function h4($text,$attrs = array()) {
		$this->append(h4($text,$attrs));
	}


	/**
	 * Insert a level 5 heading element
	 * @param  String $text  Text to appear in the heading
	 * @param  Array  $attrs (Optional) Attributes to give the created heading
	 */
	public function h5($text,$attrs = array()) {
		$this->append(h5($text,$attrs));
	}


	/**
	 * Insert a level 6 heading element
	 * @param  String $text  Text to appear in the heading
	 * @param  Array  $attrs (Optional) Attributes to give the created heading
	 */
	public function h6($text,$attrs = array()) {
		$this->append(h6($text,$attrs));
	}


	/**
	 * Insert "a thematic break between paragraph-level elements" (MDN 2014)
	 * @param  Array  $attrs (Optional) Attributes to give the created element
	 */
	public function hr($attrs=array()) {
		$this->append(hr($attrs));
	}


	/**
	 * Insert "a hyperlink, the named target destination for a hyperlink, or
	 * both." (MDN 2014).
	 * @param  String $href  Href target of the hyperlink
	 * @param  String $text  Text to appear inside the anchor
	 * @param  Array  $attrs (Optional) Attributes to give the created element
	 */
	public function href($href, $text, $attrs=array()) {
		$this->append(href($href, $text, $attrs));
	}

	
	/**
	 * Insert an image element
	 * @param  String $src   Source URL for the image
	 * @param  String $alt   (Optional) Textual description of the image
	 * @param  Array  $attrs (Optional) Attributes to give the created element
	 */
	public function img($src, $alt=False, $attrs = array()) {
		$this->append(img($src, $alt, $attrs));
	}


	/**
	 * Insert a paragraph of text
	 * @param  String  $text  Paragraph of text
	 * @param  Array   $attrs (Optional) attributes to give the created element
	 */
	public function p($text,$attrs = array()) {
		$this->append(p($text, $attrs));
	}


	/**
	 * Insert a script block into the document. This function wraps code in
	 * <script> tags for inline insertion.
	 * @param  String  $block Script contents (e.g. javascript code)
	 * @param  String  $type  (Optional['text/javascript']) Type of code
	 * @param  Array   $attrs (Optional) attributes to give the created element
	 */
	public function script_block($block,
	                             $type='text/javascript',
	                             $attrs=array()) {

		$this->append(script_block($block, $type, $attrs));
	}


	/**
	 * Create and insert a table of data from an array.
	 * This function will convert a passed array into tabular format with the
	 * keys as headings and the contents as cells. See table_horizontal for
	 * creation of horizontal table.
	 * @param  Array   $cols          Columns of the table
	 * @param  Array   $attrs         (Optional) attributes to give the table
	 * @param  Boolean $ignoreHeaders (Optional) skip adding the header row
	 */
	public function table($cols,
	                      $attrs=array(),
	                      $ignoreHeaders=False) {

		$this->append(table($cols, $attrs, $ignoreHeaders));
	}


	/**
	 * Create and insert a table of data from an array.
	 * This function will convert a passed array into tabular format with the
	 * keys as headings and the contents as cells. See table for creation of
	 * vertical table.
	 * @param  Array   $rows          Rows of the table
	 * @param  Array   $attrs         (Optional) attributes to give the table
	 * @param  Boolean $ignoreHeaders (Optional) skip adding the header row
	 */
	public function table_horizontal($rows,
	                                 $attrs=array(),
	                                 $ignoreHeaders=False) {

		$this->append(table_horizontal($rows, $attrs, $ignoreHeaders));
	}


	/**
	 * Insert content wrapped in a block given by the type variable.
	 * @param  String  $type  Name of tag to surround content with
	 * @param  String  $body  (Optional) Content to be wrapped
	 * @param  Array   $attrs (Optional) attributes to give the block
	 */
	public function block($type, $body=False, $attrs=array()) {
		return block($type, $body, $attrs);
	}


	/**
	 * Open a div tag. This should be closed again using the div_close() 
	 * function. Content added after this will appear inside the opened
	 * div.
	 * If the div is not closed, closing tags will be added
	 * automatically when the content is destructed.
	 * @param  Array   $attrs (Optional) attributes to give the div
	 */
	public function div_open($attrs=array()) {
		++$this->level;
		$this->append(start_tag('div', $attrs));
	}

	/**
	 * Close a div. This is designed to be used with the div_open() function.
	 * A closing div tag will be inserted - even if no div was opened!
	 */
	public function div_close() {
		--$this->level;
		$this->append(end_tag('div'));
	}


	public function __destruct() {
		while ($this->level > 0) div_close();
	}
}


/**
 * A form class for building forms ready for insertion into the Page class.
 * This class has access to all elements available to the Content class as
 * well as those specific to form creation.
 * An instantiated Form object will render itself when the render() method is
 * called. This is done by the page class when it destructs.
 */
class Form extends Content {

	public $attrs = array();

	/**
	 * Create a Form object to which form and page elements can be added.
	 * This class contains all the regular page elements found in the Content
	 * class as well as form only elements, e.g. textbox etc.
	 * @param  String $action - URL to the page to submit the form to
	 * @param  String $method (Optional['POST']) - Either 'POST' or 'GET'
	 * @param  Array  $attrs  (Optional) - attributes to give the form
	 */
	public function __construct($action, $method='POST', $attrs=array()) {
		$this->attrs = $attrs;
		$this->attrs['method'] = $method;
		$this->attrs['action'] = $action;
	}


	/**
	 * Insert a clickable button into the form
	 * @param  String $text  Text to appear in the button
	 * @param  Array  $attrs (Optional) attributes to give the created element
	 * @return NULL
	 */
	public function button($text, $attrs=array()) {
		$this->append(button($text,$attrs));
	}


	/**
	 * Insert a checkbox into the form
	 * @param  String  $name    Name of the checkbox variable
	 * @param  Boolean $checked (Optional[False]) Set the checkbox to checked
	 * @param  Array   $attrs (Optional) attributes to give the checkbox
	 * @return NULL
	 */
	public function checkbox($name, $checked=False, $attrs=array()) {
		$this->append(checkbox($name, $checked, $attrs));
	}


	/**
	 * Insert a checkbox and label into the form together. This is equivalent
	 * to using the checkbox and label methods together.
	 * Handles matching the id field between the two.
	 * @param  String  $name            Name of the checkbox variable
	 * @param  String  $label           Text to appear in the label
	 * @param  Boolean $checked         (Optional) Set the checkbox to checked
	 * @param  Array   $attrs_label     (Optional) attributes to give the label
	 * @param  Array   $attrs_checkbox  (Optional) attributes to give the radio
	 * @return NULL
	 */
	public function checkboxOption($name,
	                               $label,
	                               $checked,
	                               $attrs_label=array(),
	                               $attrs_checkbox=array()) {
		$this->append(checkboxOption($name,
		              				 $label,
		              				 $checked,
		              				 $attrs_label,
		              				 $attrs_checkbox));
	}


	/**
	 * Insert a hidden variable into the form. Useful for passing data to
	 * a server without displaying it to the user.
	 * @param  String $name  Name of the variable to hold the contents
	 * @param  String $value Value of the variable
	 * @param  Array  $attrs (Optional) attributes to give the hidden element
	 * @return NULL
	 */
	public function hiddenField($name, $value, $attrs=array()) {
		$this->append(input('hidden', $name, $name, $value, $attrs));
	}


	/**
	 * Insert a generic input element into the form.
	 * @param  String  $type  - Type of input (e.g. 'button', 'checkbox')
	 * @param  String  $name  - Name attribute
	 * @param  String  $id    (Optional) id attribute
	 * @param  String  $value (Optional) value attribute
	 * @param  Array   $attrs (Optional) attributes to give the created element
	 * @return NULL
	 */
	public function input($type,
	                      $name,
	                      $id=False,
	                      $value=False,
	                      $attrs=array()) {
		$this->append(input($type, $name, $id, $value, $attrs));
	}


	/**
	 * Insert a label field into the form.
	 * @param  String $id    id of the form element to which the label belongs
	 * @param  String $text  Text to appear in the label
	 * @param  Array  $attrs (Optional) attributes to give the label
	 * @return NULL
	 */
	public function label($name, $text, $attrs=array()) {
		$this->append(label($name, $text, $attrs));
	}


	/**
	 * Insert a radio input element into the form.
	 * Use radioOption to combine the creation of a radio button with a label.
	 * @param  String $name  Name of the radio element variable
	 * @param  String $id    Id of the element
	 * @param  String $value Value given to the element
	 * @param  Array  $attrs (Optional) attributes to give the created element
	 * @return NULL
	 */
	public function radio($name, $id, $value, $attrs=array()) {
		$this->append(radio($name, $id, $value, $attrs));
	}


	/**
	 * Insert a radio button and label into the form together. This is
	 * equivalent to using the radio and label methods together.
	 * Handles matching the id field.
	 * @param  String $name        Name of the radio button variable
	 * @param  String $id          id to pair the button with the label
	 * @param  String $value       Value of the radio button
	 * @param  String $text        Text to appear in the label
	 * @param  Array  $attrs_label (Optional) attributes to give the label
	 * @param  Array  $attrs_radio (Optional) attributes to give the radio
	 * @return NULL
	 */
	public function radioOption($name,
	                            $id,
	                            $value,
	                            $text,
	                            $attrs_label=array(),
	                            $attrs_radio=array()) {
		$this->append(radioOption($name,
		              			  $id,
		              			  $value,
		              			  $text,
		              			  $attrs_label,
		              			  $attrs_radio));
	}


	/**
	 * Insert a drop-down select box from an array of options into the form.
	 * @param  String  $name          Name given to the selected variable
	 * @param  Array   $options       Items to appear in the select box.
	 *                                key => value, where 'key' is the value of
	 *                                the given option and 'value' is the text
	 *                                displayed as the option
	 * @param  Boolean $selectedIndex (Optional) Index of the item to display
	 * @param  Array   $attrs         (Optional) attributes to insert
	 * @return NULL
	 */
	public function select($name,
	                       $options,
	                       $selectedIndex=False,
	                       $attrs=array()) {
		$this->append(select($name, $options, $selectedIndex, $attrs));
	}


	/**
	 * Insert "a multi-line plain-text editing control" (MDN 2014)
	 * @param  String  $name        Name given to the variable of the textarea
	 * @param  String  $body        Text to be placed into the textarea
	 * @param  Boolean $placeholder (Optional) Text to appear when empty
	 * @param  Array   $attrs       (Optional) attributes to give the textarea
	 * @return NULL
	 */
	public function textarea($name,
	                         $body,
	                         $placeholder=False,
	                         $attrs=array()) {
		$this->append(textarea($name, $body, $placeholder, $attrs));
	}


	/**
	 * Insert a textbox into the form
	 * @param  String  $name  Name of the textbox variable
	 * @param  String  $id    (Optional) id attribute of the textbox
	 * @param  String  $value (Optional) initial text to appear in the textbox
	 * @param  Array   $attrs (Optional) attributes to give the textbox
	 * @return NULL
	 */
	public function textbox($name, $id=False, $value=False, $attrs=array()) {
		$this->append(textbox($name, $id, $value, $attrs));
	}


	/**
	 * Insert a file upload element into the form
	 * @param  String $name  Name of the file upload variable
	 * @param  Array   $attrs (Optional) attributes to give the element
	 * @return NULL
	 */
	public function upload($name, $attrs = array()) {
		$this->append(upload($name, $attrs));
	}


	/**
	 * Insert a submit button into the form
	 * @param  String $text  Text to appear in the button
	 * @param  Array  $attrs (Optional) attributes to give the created element
	 * @return NULL 
	 */
	public function submitButton($text, $attrs=array()) {
		$attrs['type'] = 'submit';
		$this->append(button($text, $attrs));
	}


	/**
	 * Causes the form to render as HTML.
	 * This causes the the instantiated form element to echo out itself
	 * and everything contained within it.
	 * @return NULL
	 */
	public function render() {
		$this->wrap('form',$this->attrs);
		parent::render();
	}
}


/**
 * Page class that holds the page content controls page rendering.
 * This class can be extended in order to create a custom reusable page
 * layout.
 * Items can be added at any point and will render in the most appropriate
 * location when the page is rendered.
 */
class Page extends Content {

	public $title = False;
	public $description = False;
	protected $head;

	protected $head_entries = Array();
	protected $postscripts = Array();
	protected $prescripts = Array();
	protected $onready_js = Array();


	/**
	 * Create a page object to which content can be added.
	 * @param String $title       (Optional) Title of the page (in head)
	 * @param String $description (Optional) Text to appear in the description
	 *                            meta tag of the head.
	 */
	public function __construct($title=False, $description=False) {
		$this->head = new Element();
		if ($title != False) $this->title = $title;
		if ($description != False) $this->description = $description;
	}


	/**
	 * Add a script block to the page. Scripts added here will be placed at the
	 * end of the body tag to decrease page rendering time, or inside the head
	 * if $head is set to True.
	 * @param  String  $block Code block to be added
	 * @param  Boolean $head  (Optional[False]) Place script in the head
	 * @param  String  $type  (Optional['text/javascript']) Type of script
	 * @param  Array   $attrs (Optional) Attribute array to apply to the block
	 */
	public function script_block($block,
	                             $head=False,
	                             $type="text/javascript",
	                             $attrs=array()) {
		if ($head) {
			array_push($this->prescripts, script_block($block, $type, $attrs));
		}
		else {
			array_push($this->postscripts,script_block($block, $type, $attrs));
		}
	}


	/**
	 * Add code to be executed when the page has finished rendering, via the 
	 * document.ready() function. Multiple scripts can be added and will 
	 * be executed in the order they have been added.
	 * NOTE: This feature requires jQuery to work.
	 * @param  String $code Code to be executed on page load.
	 */
	public function readyScript($code) {
		array_push($this->onready_js, $code);
	}


	/**
	 * Add a generic tag to the head. Useful for meta tags.
	 * @param  String $type  Type of tag to add (e.g. 'meta')
	 * @param  Array  $attrs (Optional) Attribute array to apply to the block
	 */
	public function generic_tag($type, $attrs=array()) {
		array_push($this->head_entries, generic_tag($type, $attrs));
	}


	/**
	 * Add a script reference to the page. 
	 * @param  String  $src   URL of the target script
	 * @param  Boolean $head  (Optional[False]) Place the reference inside head
	 * @param  String  $type  (Optional['text/javascript']) Type of script
	 * @param  Array   $attrs (Optional) Attribute array to apply to the block
	 */
	public function script_reference($src,
	                                 $head=False,
	                                 $type='text/javascript',
	                                 $attrs=array()) {
		if ($head) {
			array_push($this->prescripts,
			           script_reference($src,
			                            $type,
			                            $attrs));
		}
		else {
			array_push($this->postscripts,
			           script_reference($src,
			                            $type,
			                            $attrs));
		}
	}


	/**
	 * Embed a stylesheet block (read: CSS) into the page.
	 * @param  String $block Style directives (CSS) to embed in the page
	 * @param  String $type  (Optional['text/css']) type of style block
	 * @param  Array   $attrs (Optional) Attribute array to apply to the block
	 */
	public function style_block($block, $type='text/css', $attrs=array()) {
		array_push($this->head_entries, style_block($block, $type, $attrs));
	}


	/**
	 * Insert a stylesheet reference to the page.
	 * @param  String $src   URL of the target stylesheet
	 * @param  String $type  (Optional['text/css']) type of stylesheet
	 * @param  Array   $attrs (Optional) Attribute array to apply to the block
	 */
	public function style_reference($src, $type='text/css', $attrs=array()) {
		array_push($this->head_entries, style_reference($src, $type, $attrs));
	}


	/**
	 * Trigger an avalanche of recursive rendering calls to cause all page
	 * content (including content objects) to render. Rendering will echo all
	 * content.
	 */
	public function render() {

		$this->head->prepend(inline('meta',
		                     		array('name'=>'description',
		                     		      'content'=>$this->description)));
		$this->head->prepend(block('title',$this->title));

		$this->wrap('div',array('id'=>'main'));
		foreach ($this->postscripts AS $postscript) {
			$this->append($postscript);
		}
		if (count($this->onready_js) > 0) {
			$tmp = '';
			foreach ($this->onready_js AS $js) {
				$tmp .= $js;
			}
			$out = '<script type="text/javascript">';
            $out .= '$(document).ready(function(){';
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

	/**
	 * Trigger the render process once the script has finished
	 */
	public function __destruct() {
		$this->render();
	}
}


/**
 * Base class from which all other classes are sub-classed.
 * Provides append(), prepend(), wrap(), and as_string() methods which can be
 * used by all extending classes.
 */
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