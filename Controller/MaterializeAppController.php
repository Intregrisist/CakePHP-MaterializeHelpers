<?php
App::uses('AppController', 'Controller');

/**
 * Materialize Controller
 * Used to show off the Materialize plugin.
 *
 * @property SessionComponent $Session
 */
class MaterializeAppController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Session');

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Materialize.M','Materialize.MForm');

    /**
     * index function
     */
    public function index() {

    }
}