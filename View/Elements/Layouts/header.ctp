<style>
    /* Stupid Logo Fix */
    nav .side-nav .brand-logo {
        position: relative;
    }

    /* Fixed Sidebar */
    header, main, footer {
        padding-left: 240px;
    }
    @media only screen and (max-width : 992px) {
        header, main, footer {
            padding-left: 0;
        }
    }
</style>
<style>
    /* Extra Styles */
    .side-nav .logo {
        padding: 0;
        text-align: center;
    }
    .side-nav .logo:hover {
        background: inherit;
    }
    .side-nav .logo .brand-logo {
        border-bottom: 1px solid #cccccc;
    }
</style>
<header>
    <nav>
        <ul id="slide-out" class="side-nav fixed">
            <li class="logo">
                <?= $this->M->link('Materialize Plugin', array('action'=>'index'),array('waves'=>'teal','class'=>'brand-logo')); ?>
            </li>
            <li><?= $this->M->link('Getting Started', array('action'=>'gs'),array('waves'=>'red')); ?></li>
            <ul class="collapsible" data-collapsible="accordion">
                <li class="bold">
                    <?= $this->M->link(
                        'Materialize<i class="mdi-navigation-arrow-drop-down"></i>',
                        array('action'=>'m'),
                        array('waves'=>'red','class'=>'collapsible-header','escape'=>false,'active'=>'active')); ?>
                    <div class="collapsible-body" style="">
                        <ul>
                            <li><?= $this->M->link('Layout', '#m_layout', array('waves'=>'teal')); ?></li>
                            <li><?= $this->M->link('Grid', '#m_grid', array('waves'=>'teal')); ?></li>
                            <li><?= $this->M->link('Link', '#m_link', array('waves'=>'teal')); ?></li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <?= $this->M->link(
                        'Materialize Form<i class="mdi-navigation-arrow-drop-down"></i>',
                        array('action'=>'mf'),
                        array('waves'=>'red','class'=>'collapsible-header','escape'=>false,'active'=>'active')); ?>
                    <div class="collapsible-body" style="">
                        <ul>
                            <li><?= $this->M->link('Forms', '#mf_layout', array('waves'=>'teal')); ?></li>
                            <li><?= $this->M->link('Elements', '#mf_layout', array('waves'=>'teal')); ?></li>
                            <li><?= $this->M->link('Utilities', '#mf_grid', array('waves'=>'teal')); ?></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </ul>
        <div class="nav-wrapper">
            <div class="container">
                <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
                <a href="#" class="brand-logo"><?= $this->fetch('title'); ?></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="components.html">Components</a></li>
                    <li><a href="javascript.html">JavaScript</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>