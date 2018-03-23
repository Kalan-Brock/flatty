<?

// Flatty Core, by Kalan Brock @ The Biggest Nerd

namespace Flatty;

class Flatty {

    public $path;
    protected $result;
    protected $key;

    function __construct($key, $path = '/flatty/database/') {
        $this->path = $_SERVER['DOCUMENT_ROOT'].$path;
        $this->key = $key;
        $this->get();
    }

    public function exists()
    {
        return $this->result && $this->result !== '';
    }

    public function result()
    {
        if(!$this->result)
            return false;

        return $this->result;
    }

    public function get()
    {
        if(!$this->key)
            $this->result = false;

        if(!file_exists($this->path.$this->key.'.json'))
            $this->result = false;

        try {
            $this->result = json_decode(@file_get_contents($this->path.$this->key . '.json'), true);
        } catch(\Exception $e)
        {
            $this->result = false;
        }
    }

    public function save($value)
    {
        try {
            $clean_value = json_encode($value);
            $file = $this->path . $this->key . '.json';

            if(!file_exists(dirname($file)))
                mkdir(dirname($file), 0777, true);

            file_put_contents($file, $clean_value);
            $this->result = $value;

        } catch(\Exception $e) {
            echo('Flatty file write permission error :(');  die();
        }
    }

    public function count()
    {
        return count($this->result);
    }

    public function isArray()
    {
        return is_array($this->result);
    }

    public function json()
    {
        return $this->result ? $this->result : '';
    }
}