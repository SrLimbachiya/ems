<?php

use yii\db\Migration;

/**
 * Class m241217_154004_department_master
 */
class m241217_154004_department_master extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableSchema = $this->db->schema->getTableSchema('department_master');
        if (!$tableSchema) {
            echo "Table Doesn't Exist\nCreating 'department_master' Table.\n";
            $this->createTable('department_master', [
                'id' => $this->integer()->notNull(),
                'name' => $this->string(100),
                'status' => $this->string(10),
                'created_at' => $this->integer(),
                'created_by' => $this->integer(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'ip' => $this->string(20),
            ]);
        } else {
            echo "Table 'department_master' Exists\nChecking For Columns\n";
            $existingColumns = array_map('strtolower', $tableSchema->columnNames);
            $columnsToAdd = [
                'id' => $this->integer()->notNull(),
                'name' => $this->string(100),
                'status' => $this->string(10),
                'created_at' => $this->integer(),
                'created_by' => $this->integer(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'ip' => $this->string(20),
            ];

            foreach ($columnsToAdd as $columnName => $columnDefinition) {
                if (!in_array(strtolower($columnName), $existingColumns)) {
                    $this->addColumn('department_master', $columnName, $columnDefinition);
                }
            }

            $command = $this->db->createCommand("SHOW INDEX FROM department_master");
            $existingIndexes = $command->queryAll();

            $indexes = array(
                0 =>
                    array(
                        'name' => 'PRIMARY',
                        'columns' =>
                            array(
                                0 => 'id',
                            ),
                        'isUnique' => true,
                    ),
            );

            $existingIndexNames = array_column($existingIndexes, 'Key_name');

            foreach ($indexes as $index) {
                if (!in_array($index['name'], $existingIndexNames)) {
                    if ($index['isUnique']) {
                        $this->createIndex($index['name'], 'department_master', $index['columns'], true);
                    } else {
                        $this->createIndex($index['name'], 'department_master', $index['columns']);
                    }
                }
            }

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241217_154004_department_master cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241217_154004_department_master cannot be reverted.\n";

        return false;
    }
    */
}
