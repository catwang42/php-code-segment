<?php 

    $hash = password_hash('correct horse battery staple', PASSWORD_DEFAULT);
    // specify a cost 
    $hash = password_hash('correct horse battery staple', PASSWORD_DEFAULT, ['cost' => 14]);

    class Password {
	    public static function hash($password) {
	        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 14]);
	    }

	    public static function verify($password, $hash) {
	        return password_verify($password, $hash);
	    }
	}

	class User {
    // Store password options so that rehash & hash can share them:
	    const HASH = PASSWORD_DEFAULT;
	    const COST = 14;

	    // Internal data storage about the user:
	    public $data;

	    // Mock constructor:
	    public function __construct() {
	        // Read data from the database, storing it into $data such as:
	        //  $data->passwordHash  and  $data->username
	        $this->data = new stdClass();
	        $this->data->passwordHash = 'dbd014125a4bad51db85f27279f1040a';
	    }

	    // Mock save functionality
	    public function save() {
	        // Store the data from $data back into the database
	    }

	    // Allow for changing a new password:
	    public function setPassword($password) {
	        $this->data->passwordHash = password_hash($password, self::HASH, ['cost' => self::COST]);
	    }

	    // Logic for logging a user in:
	    public function login($password) {
	        // First see if they gave the right password:
	        echo "Login: ", $this->data->passwordHash, "\n";
	        if (password_verify($password, $this->data->passwordHash)) {
	            // Success - Now see if their password needs rehashed
	            if (password_needs_rehash($this->data->passwordHash, self::HASH, ['cost' => self::COST])) {
	                // We need to rehash the password, and save it.  Just call setPassword
	                $this->setPassword($password);
	                $this->save();
	            }
	            return true; // Or do what you need to mark the user as logged in.
	        }
	        return false;
	    }
	}


?>