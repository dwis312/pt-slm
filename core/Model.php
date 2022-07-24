<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_FILE_EXT = 'extention';
    public const RULE_FILE_TYPE = 'type';
    public const RULE_FILE_SIZE = 'size';

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function loadDataFile($data)
    {
        $data['post_file'] = $this->loadFile();
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function valiadate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $rule['match'] = $this->getLabel($rule['match']);
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }

                if ($ruleName === self::RULE_UNIQUE) {

                    $className = $rule['class'];
                    $uniqueAttr = $attribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = App::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute)]);
                    }
                }

                if ($ruleName === self::RULE_FILE_EXT) {
                    $nama_file = $_FILES['post_file']['name'];

                    $daftar_photo = ['jpg', 'jpeg', 'png'];
                    $ekstensi_file = explode('.', $nama_file);
                    $ekstensi_file = strtolower(end($ekstensi_file));

                    if (!in_array($ekstensi_file, $daftar_photo)) {
                        $this->addErrorForRule($attribute, self::RULE_FILE_EXT);
                    }
                }

                if ($ruleName === self::RULE_FILE_TYPE) {
                    $tipe_file = $_FILES['post_file']['type'];

                    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
                        $this->addErrorForRule($attribute, self::RULE_FILE_TYPE);
                    }
                }
                if ($ruleName === self::RULE_FILE_SIZE) {
                    $ukuran_file = $_FILES['post_file']['size'];
                    if ($ukuran_file > 3000000) {
                        $this->addErrorForRule($attribute, self::RULE_FILE_SIZE);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    private function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';

        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            // self::RULE_REQUIRED => 'This field is required',
            self::RULE_REQUIRED => 'Bagian ini tidak boleh kosong',
            // self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_EMAIL => 'Alamat email tidak valid',
            // self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MIN => 'Min {min} karakter',
            // self::RULE_MAX => 'Min length of this field must be {max}',
            self::RULE_MAX => 'Min {max} karakter',
            // self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_MATCH => 'Harus sama dengan {match}',
            // self::RULE_UNIQUE => 'Record with this {field} already exists',
            self::RULE_UNIQUE => '{field} sudah digunakan',
            self::RULE_FILE_EXT => 'File formats only JPG, JPEG and PNG',
            self::RULE_FILE_TYPE => 'File format not photo',
            self::RULE_FILE_SIZE => 'Maximum file size 1MB',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

    public function labels(): array
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function loadFile()
    {
        $nama_file = $_FILES['post_file']['name'];
        $ekstensi_file = explode('.', $nama_file);
        $ekstensi_file = strtolower(end($ekstensi_file));

        // Generate nama file baru
        $nama_file_baru = uniqid()  . '-' . date('Ymd');
        $nama_file_baru .= '.';
        $nama_file_baru .= $ekstensi_file;

        if ($_FILES['post_file']['error'] !== 4) {
            return [
                'name' => $nama_file_baru,
                'type' => $_FILES['post_file']['type'],
                'size' => $_FILES['post_file']['size'],
                'tmp_name' => $_FILES['post_file']['tmp_name'],
            ];
        }
    }
}
