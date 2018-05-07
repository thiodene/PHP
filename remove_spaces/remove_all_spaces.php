# Normal white Spaces
$string = str_replace(' ', '', $string);

# Different white spaces (For JSON especially -> json_decode won't work with special spaces!!!)
$string = preg_replace('/\s+/', '', $string);
