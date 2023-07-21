<?php
class ResponseModel implements JsonSerializable
{
    public $success = false;
    public $error = null;
    public $data = null;

    public function __construct($success = false, $error = null)
    {
        $this->success = $success;
        $this->error = $error;
    }

    public function jsonSerialize()
    {
        if ($this->success) {
            return [
                "success" => $this->success,
                "data" => $this->data,
            ];
        } else {
            return [
                "success" => $this->success,
                "error" => $this->error,
            ];
        }
    }

    public function dd()
    {
        header("Content-type: application/json");
        echo json_encode($this, JSON_PRETTY_PRINT);
        die();
    }
}
