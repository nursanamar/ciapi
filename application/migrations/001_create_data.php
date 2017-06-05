<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_data extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'name' => array(
                                'type' => 'TEXT',
                                'constraint' => '100',
                        ),
                        'addres' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'phone' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('datas');
        }

        public function down()
        {
                $this->dbforge->drop_table('data');
        }
}
