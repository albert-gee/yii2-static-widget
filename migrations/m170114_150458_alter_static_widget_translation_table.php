<?php
/**
 * @author Albert Gainutdinov <xalbert.einsteinx@gmail.com>
 */

use yii\db\Migration;

class m170114_150458_alter_static_widget_translation_table extends Migration
{
    public function up()
    {
        $this->alterColumn('static_widget_translation', 'content', $this->text());
    }

    public function down()
    {
        return true;
    }
}