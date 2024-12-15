<?php

use yii\db\Migration;

/**
 * Class m241215_085000_employee_records
 */
class m241215_085000_employee_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableSchema = $this->db->schema->getTableSchema('employee_records');
        if (!$tableSchema) {
            echo "Table Doesn't Exist\nCreating 'employee_records' Table.\n";
            $this->createTable('employee_records', [
                'id' => $this->primaryKey(),
                'employee_code' => $this->string(50),
                'first_name' => $this->string(50),
                'middle_name' => $this->string(50),
                'last_name' => $this->string(50),
                'department' => $this->integer(),
                'designation' => $this->integer(),
                'birth_date' => $this->date(),
                'joining_date' => $this->date(),
                'retirement_date' => $this->string(50),
                'gender' => $this->string(50),
                'category' => $this->string(50),
                'country' => $this->string(50),
                'state' => $this->string(50),
                'city' => $this->string(50),
                'pincode' => $this->string(10),
                'address' => $this->string(500),
                'phone_no' => $this->string(50),
                'email' => $this->string(80),
                'status' => $this->string(10),
                'created_at' => $this->integer(),
                'created_by' => $this->integer(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'ip' => $this->string(20),
            ]);
        } else {
            echo "Table 'employee_records' Exists\nChecking For Columns\n";
            $existingColumns = array_map('strtolower', $tableSchema->columnNames);
            $columnsToAdd = [
                'employee_code' => $this->string(50),
                'first_name' => $this->string(50),
                'middle_name' => $this->string(50),
                'last_name' => $this->string(50),
                'department' => $this->integer(),
                'designation' => $this->integer(),
                'birth_date' => $this->date(),
                'joining_date' => $this->date(),
                'retirement_date' => $this->string(50),
                'gender' => $this->string(50),
                'category' => $this->string(50),
                'country' => $this->string(50),
                'state' => $this->string(50),
                'city' => $this->string(50),
                'pincode' => $this->string(10),
                'address' => $this->string(500),
                'phone_no' => $this->string(50),
                'email' => $this->string(80),
                'status' => $this->string(10),
                'created_at' => $this->integer(),
                'created_by' => $this->integer(),
                'updated_at' => $this->integer(),
                'updated_by' => $this->integer(),
                'ip' => $this->string(20),
            ];

            foreach ($columnsToAdd as $columnName => $columnDefinition) {
                if (!in_array(strtolower($columnName), $existingColumns)) {
                    $this->addColumn('employee_records', $columnName, $columnDefinition);
                }
            }

            $command = $this->db->createCommand("SHOW INDEX FROM employee_records");
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
                        $this->createIndex($index['name'], 'employee_records', $index['columns'], true);
                    } else {
                        $this->createIndex($index['name'], 'employee_records', $index['columns']);
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
        echo "m241215_085000_employee_records cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241215_085000_employee_records cannot be reverted.\n";

        return false;
    }
    */
}
