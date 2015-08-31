<?php
App::uses('HtmlHelper', 'View/Helper');

class MHelper extends HtmlHelper
{
    /**
     * Initialize an HTML document and the head
     *
     * @param string $title
     * @param string $description
     * @param string $lang
     * @return string
     */
    public function html($title = '', $description = '', $lang = 'en') {
        $out = '<!DOCTYPE html>';
        $out .= '<html lang="' . $lang . '">';
        $out .= '<head>';
        $out .= '<meta charset="utf-8">';
        $out .= '<title>' . $title . '</title>';
        $out .= '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>';
        $out .= '<meta name="description" content="' . $description . '">';

        return $out;
    }

    /**
     * Initialize an HTML 5 document and the head
     *
     * @param string $title The name of the current page
     * @param string $description The description of the current page
     * @param string $lang The language of the current page. By default 'en' because we are American
     * @return string
     */
    public function html5($title = '', $description = '', $lang = 'en') {
        $out = $this->html($title, $description, $lang);

        // Script JS for IE and HTML 5
        $out .= '<!--[if lt IE 9]>';
        $out .= '<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>';
        $out .= '<![endif]-->';

        return $out;
    }

    /**
     * Close the head element and initialize the body element
     *
     * @param string $classBody Class for the body element
     * @return string
     */
    public function body($classBody = '') {
        $out = '</head>';
        $out .= ($classBody != '') ? '<body class="' . $classBody . '">' : '<body>';
        return $out;
    }

    /**
     * Close the body element and the html element
     *
     * @return string
     */
    public function end() {
        $out = '</body>';
        $out .= '</html>';

        return $out;
    }

    /**
     * Close div elements
     *
     * @param int $nb Number of div you want to close
     * @param string $tag type tag to close
     * @return string End tags div
     */
    public function close($nb = 1, $tag = 'div') {
        $out = '';
        for ($i = 0; $i < $nb; $i++) {
            $out .= '</'.$tag.'>';
        }
        return $out;
    }

    /**
     * Open a header element
     *
     * @param array $options Options of the header element
     * @return string Tag header
     */
    public function header($options = array()) {
        $out = parent::tag('header', null, $options);
        return $out;
    }

    /**
     * Close the header element
     *
     * @return string End tag header
     */
    public function closeHeader() {
        return '</header>';
    }

    /**
     * Open a Materialize container
     *
     * @param array $options Options of the div element
     * @return string Div element with the class 'container'
     */
    public function container($options = array()) {
        $out = '';
        $class = 'container';
        if (isset($options['class'])) {
            $class .= ' ' . $options['class'];
        }
        $out .= parent::div($class, null, $options);
        return $out;
    }

    /**
     * Creates links with waves
     *
     * @param string $title The content to be wrapped by <a> tags.
     * @param string|array $url Cake-relative URL or array of URL parameters, or external URL (starts with http://)
     * @param array $options Array of options and HTML attributes.
     * @param bool|string $confirmMessage JavaScript confirmation message.
     *  This argument is deprecated as of 2.6. Use `confirm` key in $options instead.
     * @return string An `<a />` element.
     * @return string link with waves
     */
    public function link($title, $url = null, $options = array(), $confirmMessage = false) {
        $class = 'waves-effect';

        if(isset($options['waves'])) {
            if($options['waves'] === false) {
                $class = '';
            } elseif(is_string($options['waves'])) {
                $class .= ' waves-' . $options['waves'];
            }
        }

        // Active class
        if(is_array($url) && isset($options['active'])) {
            $isActive = true;
            $reqParams = $this->request->params;

            // Check Controller
            if(isset($url['controller']) && $url['controller'] !== $reqParams['controller']) {
                $isActive = false;
            }

            if(isset($url['action']) && $url['action'] !== $reqParams['action']) {
                $isActive = false;
            }

            if($isActive) {
                $class .= empty($class) ? $options['active'] : ' '.$options['active'];
            }
        }

        // Append class option
        if(!empty($options['class'])) {
            $class .= empty($class) ? $options['class'] : ' '.$options['class'];
        }

        if(!empty($class)) {
            $options['class'] = $class;
        }

        // Remove new custom options
        if(isset($options['active'])) {
            unset($options['active']);
        }
        if(isset($options['waves'])) {
            unset($options['waves']);
        }

        return parent::link($title, $url, $options, $confirmMessage);
    }



    public function sideNav($type, $options = array()) {
        $out = '';
        $class = 'row';
        if (isset($options['class'])) {
            $class .= ' ' . $options['class'];
        }
        $out .= parent::div($class, null, $options);
        return $out;
    }

    public function closeSideNav() {
        return $this->close(1, 'nav');
    }
}