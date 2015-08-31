<?php
App::uses('AppController', 'Controller');

/**
 * Materialize Controller
 * Used to show off the Materialize plugin.
 *
 * @property SessionComponent $Session
 */
class MaterializeController extends MaterializeAppController
{
    public $layout = 'materialize';

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Session');

    public $helpers = array('BsHelpers.BsForm');

    /**
     * Helpers
     *
     * @var array
     */
//    public $helpers = array('Materialize.M', 'Materialize.MForm');

    /**
     * index function
     */
    public function index()
    {

    }

    public function gs()
    {
        $this->set('title_for_layout', __('Getting Started'));
    }

    public function m()
    {
        $this->set('title_for_layout', __('Materialize Helper'));
    }

    public function mf()
    {
        $this->set('title_for_layout', __('Materialize Form Helper'));
    }
}