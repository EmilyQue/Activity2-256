<?php
namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class Login2Controller extends Controller
{
    //authenticates user credentials
    public function index(Request $request) {
        try {
        //1. process form data
        //get posted form data
        $username = $request->input('username');
        $password = $request->input('password');
        
        //2. create object model
        //save posted form data in user object model
        $user = new UserModel(0, $username, $password);
        
        //3. execute business service
        //call security business service
        $service = new SecurityService();
        $status = $service->authenticate($user);
        
        //4. process results from business service (navigation)
        //render a failed or success response view and pass the user model to it
        if ($status) {
            $data = ['model' => $user];
            return view('loginSuccess2')->with($data);
        }
        
        else {
            return view('loginFail2');
            }
        }
        catch (Exception $e){
            //best practice: call all exceptions, log the exception, and display a common error page (or use a global exception handler)
            //log exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
}