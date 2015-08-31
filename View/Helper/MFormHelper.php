<?php
App::uses('FormHelper', 'View/Helper');

/**
 * M Form helper library.
 *
 * Automatic generation of HTML FORMs from given data.
 *
 * @package       Cake.View.Helper
 * @property      MHelper $M
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html
 */
class MFormHelper extends FormHelper
{
    public $helpers = array('M','Html');

    /**
     * Generates a form input element complete with label and wrapper div
     *
     * ### Options
     *
     * See each field type method for more information. Any options that are part of
     * $attributes or $options for the different **type** methods can be included in `$options` for input().i
     * Additionally, any unknown keys that are not in the list below, or part of the selected type's options
     * will be treated as a regular html attribute for the generated input.
     *
     * - `type` - Force the type of widget you want. e.g. `type => 'select'`
     * - `label` - Either a string label, or an array of options for the label. See FormHelper::label().
     * - `div` - Either `false` to disable the div, or an array of options for the div.
     *	See HtmlHelper::div() for more options.
     * - `options` - For widgets that take options e.g. radio, select.
     * - `error` - Control the error message that is produced. Set to `false` to disable any kind of error reporting (field
     *    error and error messages).
     * - `errorMessage` - Boolean to control rendering error messages (field error will still occur).
     * - `empty` - String or boolean to enable empty select box options.
     * - `before` - Content to place before the label + input.
     * - `after` - Content to place after the label + input.
     * - `between` - Content to place between the label + input.
     * - `format` - Format template for element order. Any element that is not in the array, will not be in the output.
     *	- Default input format order: array('before', 'label', 'between', 'input', 'after', 'error')
     *	- Default checkbox format order: array('before', 'input', 'between', 'label', 'after', 'error')
     *	- Hidden input will not be formatted
     *	- Radio buttons cannot have the order of input and label elements controlled with these settings.
     *
     * ### NEW Options
     * - `inline` - For widgets that can be displayed inline e.g. checkbox
     * - `icon` - For widgets that are able to render icons e.g. text, textarea.
     *
     * @param string $fieldName This should be "Modelname.fieldname"
     * @param array $options Each type of input takes different options.
     * @return string Completed form widget.
     * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#creating-form-elements
     */
    public function input($fieldName, $options = array())
    {
        $this->setEntity($fieldName);
        $options = $this->_parseOptions($options);

        $inline = $this->_extractOption('inline', $options, false);
        unset($options['inline']);

        // Checkbox
        if($options['type'] === 'checkbox') {
            if(!$inline) {
                $options = $this->addBefore($options,'<p>');
                $options = $this->addAfter($options,'</p>');
            }
        }

        // Icon
        $icon = $this->_extractOption('icon', $options, false);
        unset($options['icon']);

        if($options['type'] === 'text' || $options['type'] === 'textarea') {
            if($icon) {
                $options = $this->addBefore($options, '<i class="'.$icon.' prefix"></i>');
            }
        }

        return parent::input($fieldName, $options);
    }

    /**
     * Creates a textarea widget
     *
     * @param string $fieldName
     * @param array $options
     * @return string
     */
    public function textarea($fieldName, $options = array())
    {
        $options = $this->addClass($options, 'materialize-textarea');

        // Validate
        $validate = $this->_extractOption('validate', $options, true);
        unset($options['validate']);

        if($validate) {
            $options = $this->addClass($options, 'validate');
            if($this->isFieldError($fieldName)) {
                $options = $this->addClass($options, 'invalid');
            }
        }

        return parent::textarea($fieldName, $options);
    }

    /**
     * Creates a set of radio widgets. Will create a legend and fieldset
     * by default. Use $attributes to control this.
     *
     * ### Attributes:
     *
     * - `separator` - define the string in between the radio buttons
     * - `between` - the string between legend and input set or array of strings to insert
     *    strings between each input block
     * - `legend` - control whether or not the widget set has a fieldset & legend
     * - `value` - indicate a value that is should be checked
     * - `label` - boolean to indicate whether or not labels for widgets show be displayed
     * - `hiddenField` - boolean to indicate if you want the results of radio() to include
     *    a hidden input with a value of ''. This is useful for creating radio sets that non-continuous
     * - `disabled` - Set to `true` or `disabled` to disable all the radio buttons.
     * - `empty` - Set to `true` to create an input with the value '' as the first option. When `true`
     *   the radio label will be 'empty'. Set this option to a string to control the label value.
     *
     * ### M Attributes:
     *
     * - `inline` - bool (false) will wrap each input with a p tag if not set to true.
     * - `gap` - bool (false) will add the class "with-gap" to input tags if set to true.
     *
     * @param string $fieldName
     * @param array $options
     * @param array $attributes
     * @return string
     */
    public function radio($fieldName, $options = array(), $attributes = array())
    {
        // Inline
        $inline = $this->_extractOption('inline', $attributes, false);
        unset($attributes['inline']);

        // Gap
        $gap = $this->_extractOption('gap', $attributes, false);
        unset($attributes['gap']);

        if($gap) {
            $attributes = $this->addClass($attributes, 'with-gap');
        }

        // Legend
        $legend = $this->_extractOption('legend', $attributes, __(Inflector::humanize($this->field())));
        $attributes['legend'] = false;

        // Between
        $between = null;
        if (isset($attributes['between'])) {
            $between = $attributes['between'];
            unset($attributes['between']);
        }

        // Add Separator attributes
        if(!$inline) {
            $attributes['separator'] = '</p>' . $this->_extractOption('separator', $attributes, '') . '<p>';
        }

        $out = parent::radio($fieldName, $options, $attributes);

        if(!$inline) {
            $out = $this->Html->tag('p', $out, array('escape'=>false));
        }

        if ($legend) {
            $out = $this->Html->useTag('fieldset', '', $this->Html->useTag('legend', $legend) . $between . $out);
        }

        return $out;
    }

    /**
     * Creates a checkbox switch input.
     * TODO: REDO
     *
     * @param $fieldName
     * @param array $options
     * @return string
     */
    public function checkboxSwitch($fieldName, $options = array())
    {
        $on = $this->_extractOption('on', $options, 'On');
        $off = $this->_extractOption('off', $options, 'Off');
        $label = $this->_extractOption('label', $options, null);
        $switch = $this->_extractOption('switch', $options, array());
        $lever = '<span class="lever"></span>';

        $out = $off . parent::checkbox($fieldName, $options) . $lever . $on;

        $out = $this->Html->tag('label', $out, $label);

        $switch = $this->addClass($switch, 'switch');
        $out = $this->Html->tag('div', $out, $switch);

        return $out;
    }

    /**
     * Creates file input widget
     * TODO: REDO
     *
     * @param string $fieldName Name of a field, in the form "Modelname.fieldname"
     * @param array $options Array of HTML attributes.
     * @return string A generated file input.
     */
    public function file($fieldName, $options = array())
    {
        $btnOptions = $this->_extractOption('button', $options, array());
        if(isset($options['button'])) {
            unset($options['button']);
        }

        $btnText = $this->_extractOption('text', $btnOptions, 'FILE');
        if(isset($btnOptions['text'])) {
            unset($btnOptions['text']);
        }

        // TODO: pro
        $out = '<div class="file-field input-field">';
            $out .= '<input class="file-path validate" type="text" />';
            $out .= '<div class="btn">';
                $out .= $this->Html->tag('span', $btnText, $btnOptions);
                $out .=  parent::file($fieldName, $options);
            $out .= '</div>';
        $out .= '</div>';
        return $out;
    }

    public function range() {

    }

    /*
     * TODO: We need a good date/time picker if we are going to use this.
    public function date($fieldName, $dateFormat = 'DMY', $attributes = array())
    {
        $labelOptions = array_merge($attributes, array('type'=>'date'));
        $label = $this->_getLabel($fieldName, $labelOptions);
        if (isset($attributes['label'])) {
            unset($attributes['label']);
        }

        $options = $this->_initInputField($fieldName, $attributes);
        $options = $this->addClass($options, 'datepicker');
        $options['type'] = 'date';

        $out = '';

        if($label) {
            $out .= $label;
        }

        $out .= $this->Html->useTag('input', $options['name'], array_diff_key($options, array('name' => null)));

        return $out;
    }
    */

    /**
     * Adds the given content to the after parameter
     *
     * @param array $options
     * @param null $content
     * @param string $key
     * @return array
     */
    public function addBefore($options = array(), $content = null, $key = 'before')
    {
        if (isset($options[$key]) && trim($options[$key])) {
            $options[$key] .= $content;
        } else {
            $options[$key] = $content;
        }
        return $options;
    }

    /**
     * Adds the given content to the after parameter
     *
     * @param array $options
     * @param null $content
     * @param string $key
     * @return array
     */
    public function addAfter($options = array(), $content = null, $key = 'after')
    {
        if (isset($options[$key]) && trim($options[$key])) {
            $options[$key] = $content . $options[$key];
        } else {
            $options[$key] = $content;
        }
        return $options;
    }

    /**
     * Adds the given class to the element options if it does not exist.
     *
     * @param array $options Array options/attributes to add a class to
     * @param string $class The class name being added.
     * @param string $key the key to use for class.
     * @return array Array of options with $key set.
     */
    public function addClass($options = array(), $class = null, $key = 'class') {
        if (isset($options[$key]) && trim($options[$key])) {
            $oClasses = explode(' ', $options[$key]);
            $nClasses = explode(' ', $class);
            foreach($nClasses as $nClass) {
                if(!in_array($nClass, $oClasses)) {
                    $options[$key] .= ' ' . $class;
                    $oClasses[] = $nClass;
                }
            }
        } else {
            $options[$key] = $class;
        }
        return $options;
    }

    /**
     * Generate format options
     *
     * @param array $options Options list.
     * @return array
     */
    protected function _getFormat($options) {
        if ($options['type'] === 'hidden') {
            return array('input');
        }
        if (is_array($options['format']) && in_array('input', $options['format'])) {
            return $options['format'];
        }

//        if ($options['type'] === 'date') {
//            array('before', 'label', 'between', 'input', 'after', 'error');
//        }

        if ($options['type'] === 'checkbox') {
            return array('before', 'input', 'between', 'label', 'after', 'error');
        }
        return array('before', 'input', 'label', 'between', 'after', 'error');
    }

    /**
     * Generates an input element
     *
     * @param array $args The options for the input element
     * @return string The generated input element
     */
    protected function _getInput($args)
    {
        extract($args);
        switch($type) {
            case 'checkbox-switch':
                return $this->switch($fieldName, $options);
//            case 'date':
//                return $this->date();
            default:
                return parent::_getInput($args);
        }
    }

    protected function _addInputError($fieldName, $options)
    {
        $error = $this->_extractOption('error', $options, null);
        if($error === false) {
            return $options;
        }

        $validate = $this->_extractOption('validate', $options, true);
        if($validate) {
            $options = $this->addClass($options, 'validate');
            $options = $this->addClass($options, 'invalid');
        }

        $errMsg = $this->error($fieldName, $error);
        if($errMsg) {
            $options = $this->addClass($options, 'invalid');

            $content = '<p class="error">' . $errMsg . '</p>';


            $options = $this->addAfter($options,$content);
        }

        return $options;
    }

    /**
     * Generate div options for input
     *
     * @param array $options Options list.
     * @return array
     */
    protected function _divOptions($options)
    {
        $div = $this->_extractOption('div', $options, array());

        if($options['type'] === 'checkbox' && !isset($div['class'])) {
            $div['class'] = '';
        }

        $divClasses = array(
            'text'     => 'input-field',
            'textarea' => 'input-field',
            'select'   => 'input-field',
            'switch'   => 'switch',
            'field'    => 'file-field input-field',
            'range'    => 'range-field'
        );

        if(isset($divClasses[$options['type']])) {
            $div = $this->addClass($div, $divClasses[$options['type']]);
        }

        $col = $this->_extractOption('col', $options, false);
        if($col) {
            $div = $this->addClass($div, $col);
        }

        $options['div'] = $div;

        if(!isset($options['type'])) {
            $options['type'] = 'text';
        }

        return parent::_divOptions($options);
    }
}