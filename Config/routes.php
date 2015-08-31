<?php
Router::connect('/materialize', array('plugin' => 'materialize', 'controller' => 'materialize'));
Router::connect('/materialize/index/*', array('plugin' => 'materialize', 'controller' => 'materialize'));
Router::connect('/materialize/getting-started/*', array('plugin' => 'materialize', 'controller' => 'materialize', 'action' => 'gs'));
Router::connect('/materialize/m-helper/*', array('plugin' => 'materialize', 'controller' => 'materialize', 'action' => 'm'));
Router::connect('/materialize/m-form-helper/*', array('plugin' => 'materialize', 'controller' => 'materialize', 'action' => 'mf'));
Router::connect('/materialize/:action/*', array('plugin' => 'materialize', 'controller' => 'materialize'));