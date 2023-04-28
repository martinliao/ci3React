<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Menu_Preferences extends CI_Migration
{
    /**
     * Config settings
     * @var array
     */
    private $settings;

    private function get_settings()
    {
        // Load configs(Example)
        $this->config->load('smarty_acl', TRUE);
        //Get tables array
        $tables = $this->config->item('tables', 'smarty_acl');
        //Tables prefix
        $this->settings['prefix'] = $tables['prefix'] ? $tables['prefix'].'_' : '';
        // Table names
        $this->settings['user_access'] = 'user_access';
        $this->settings['user_menu'] = 'user_menu';
        $this->settings['user_submenu'] = 'user_submenu';
        $this->settings['roles'] = $this->settings['prefix'].$tables['roles'];
    }

    public function up()
    {
        $this->get_settings();
        /**************** Start Create Tables ****************/
        $this->dbforge->add_field(array(
            'id_menu' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array('type' => 'VARCHAR', 'constraint' => '25', 'unsigned' => TRUE,),
            'icon' => array('type' => 'VARCHAR', 'constraint' => '30', 'unsigned' => TRUE,),
            'is_active' => array('type' => 'INT', 'constraint' => 1, 'default' => 0, ),
            'no_order' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE,),
        ));
        $this->dbforge->add_key('id_menu', TRUE);
        $this->dbforge->create_table($this->settings['user_menu']);
        /**************** End Create Tables ****************/
        /**************** Start Set Foreign Keys ****************/
        /**************** End Set Foreign Keys ****************/
        /**************** Start Insert Data ****************/
        $this->db->insert($this->settings['user_menu'],['id_menu' => 1, 'title' => 'Admin Menu', 'icon' => 'fa fa-laptop', 'is_active' => 1, 'no_order' => 2]);
        $this->db->insert($this->settings['user_menu'],['id_menu' => 6, 'title' => 'Dashboard', 'icon' => 'fa fa-fw fa fa-tachometer', 'is_active' => 1, 'no_order' => 1]);
        $this->db->insert($this->settings['user_menu'],['id_menu' => 9, 'title' => 'Settings', 'icon' => 'fa fa-fw fa fa-cogs', 'is_active' => 1, 'no_order' => 3]);
        $this->db->insert($this->settings['user_menu'],['id_menu' => 10, 'title' => 'Master Data', 'icon' => 'fa fa-fw fa fa-database', 'is_active' => 1, 'no_order' => 4]);
        $this->db->insert($this->settings['user_menu'],['id_menu' => 11, 'title' => 'Shortener Link', 'icon' => 'fa fa-fw fa fa-calendar-plus-o', 'is_active' => 1, 'no_order' => 5]);
        /**************** End Insert Data ****************/
        /**************** Start Create Tables ****************/
        $this->dbforge->add_field(array(
            'id_access' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_menu' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE,),
            'id_role' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE,),
        ));
        $this->dbforge->add_key('id_access', TRUE);
        $this->dbforge->create_table($this->settings['user_access']);
        /**************** End Create Tables ****************/
        /**************** Start Set Foreign Keys ****************/
        $this->db->query('ALTER TABLE '.$this->settings['user_access'].' ADD FOREIGN KEY (id_menu) REFERENCES '.$this->settings['user_menu'].'(id_menu) ON DELETE CASCADE ON UPDATE RESTRICT');
        /**************** End Set Foreign Keys ****************/
        /**************** Start Insert Data ****************/
        $this->db->insert($this->settings['user_access'],['id_access' => 1, 'id_menu' => 1, 'id_role' => 1]);
        $this->db->insert($this->settings['user_access'],['id_access' => 67, 'id_menu' => 6, 'id_role' => 1]);
        $this->db->insert($this->settings['user_access'],['id_access' => 71, 'id_menu' => 9, 'id_role' => 1]);
        $this->db->insert($this->settings['user_access'],['id_access' => 75, 'id_menu' => 10, 'id_role' => 1]);
        $this->db->insert($this->settings['user_access'],['id_access' => 77, 'id_menu' => 11, 'id_role' => 1]);
        /**************** End Insert Data ****************/
        /**************** Start Create Tables ****************/
        $this->dbforge->add_field(array(
            'id_submenu' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_menu' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE,),
            'title' => array('type' => 'VARCHAR', 'constraint' => '25', 'unsigned' => TRUE,),
            'icon' => array('type' => 'VARCHAR', 'constraint' => '30', 'unsigned' => TRUE,),
            'url' => array('type' => 'VARCHAR', 'constraint' => '25', 'unsigned' => TRUE,),
            'is_active' => array('type' => 'INT', 'constraint' => 1, 'default' => 0, ),
            'no_urut' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE,),
        ));
        $this->dbforge->add_key('id_submenu', TRUE);
        $this->dbforge->create_table($this->settings['user_submenu']);
        /**************** End Create Tables ****************/
        /**************** Start Set Foreign Keys ****************/
        $this->db->query('ALTER TABLE '.$this->settings['user_submenu'].' ADD FOREIGN KEY (id_menu) REFERENCES '.$this->settings['user_menu'].'(id_menu) ON DELETE CASCADE ON UPDATE RESTRICT');
        /**************** End Set Foreign Keys ****************/
        /**************** Start Insert Data ****************/
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 1, 'id_menu' => 1, 'title' => 'User Management', 'icon' => 'fa fa-fw fa-users',  'url' => 'user', 'is_active' => 1, 'no_urut' => 2]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 2, 'id_menu' => 1, 'title' => 'Role management', 'icon' => 'fa fa-fw fa-cogs',   'url' => 'role', 'is_active' => 1, 'no_urut' => 1]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 3, 'id_menu' => 1, 'title' => 'Menu Management', 'icon' => 'fa fa-fw fa-code',   'url' => 'menu', 'is_active' => 1, 'no_urut' => 3]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 6, 'id_menu' => 1, 'title' => 'Access Management', 'icon' => 'fa fa-fw fa-lock', 'url' => 'access', 'is_active' => 1, 'no_urut' => 4]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 12, 'id_menu' => 6, 'title' => 'Dashboard', 'icon' => 'fa fa-fw fa-tachometer',  'url' => 'admin/dashboard', 'is_active' => 1, 'no_urut' => 1]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 38, 'id_menu' => 9, 'title' => 'Site Setting', 'icon' => 'fa fa-fw fa-map',      'url' => 'settings', 'is_active' => 1, 'no_urut' => 1]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 42, 'id_menu' => 10, 'title' => 'Data Divisi', 'icon' => 'fa fa-folder',         'url' => 'divisi', 'is_active' => 1, 'no_urut' => 2]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 44, 'id_menu' => 9, 'title' => 'Backup &amp; Restore', 'icon' => 'fa fa-database', 'url' => 'database', 'is_active' => 1, 'no_urut' => 2]);
        $this->db->insert($this->settings['user_submenu'],['id_submenu' => 45, 'id_menu' => 11, 'title' => 'Short Link', 'icon' => 'fa fa-tachometer',      'url' => 'url', 'is_active' => 1, 'no_urut' => 1]);
        /**************** End Insert Data ****************/
    }

    public function down()
    {
        //Load settings
        $this->get_settings();
        //Drop tables
        $this->dbforge->drop_table($this->settings['admin_preferences']);
    }
}