<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Include the Highlighter class
use Highlight\Highlighter;

class DefaultController extends Controller
{
    /**
    * Index route
    *
    * @return Response
    */
    public function index()
    {
        // Create a new instance of Highlighter
        $highlighter = new Highlighter();

        // Define the language that you want to use to highlight
        $language = "javascript";
        $language = "php";
        $language = "sublime";

        /**
         * Some example code to highlight in JavaScript
         */
        $code = <<<EOF
<?php

    namespace App\Http\Controllers;
    
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Routing\Controller as BaseController;
    
    class Controller extends BaseController
    {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        public function __construct() {
            // something;
        }

        public function index() {
            return 'something';
        }
    }

?>
EOF;

        // Create the markup with styles ready to highlight in the view
        // as first argument the language type and as second the code
        $markupHighlightedCodeObject = $highlighter->highlight($language, $code);

        // Send the markup with styles to some blade view (default.blade.php) that you want
        // In this case the parameter "code" contains our code in the view
        return view("default", [
            "code" => $markupHighlightedCodeObject
        ]);
    }
}
