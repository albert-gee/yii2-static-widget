<?php
use yii\db\Migration;

/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */
class m170109_102616_add_static_widget_table extends Migration
{
    public function up()
    {
        $this->createTable('static_widget', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
        ]);

        $this->createTable('static_widget_translation', [
            'id' => $this->primaryKey(),
            'static_widget_id' => $this->integer(),
            'language_id' => $this->integer(),
            'content' => $this->string(),
            'description' => $this->string()
        ]);

        $this->addForeignKey('static_widget_translation:language_id',
            'static_widget_translation', 'language_id', 'language', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('static_widget_translation:language_id', 'static_widget_translation');
        $this->dropTable('static_widget_translation');
        $this->dropTable('static_widget');
    }

}