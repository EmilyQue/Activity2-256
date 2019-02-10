<?php
namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Validation\ValidationException;

class Login3Controller extends Controller
{
    //authenticates user credentials
    public function index(Request $request) {
        try {
         //validate the form date (note will automatically redirect back to login
         //view if errors
         $this->validateForm($request);
            
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
            return view('loginSuccess3')->with($data);
        }
        
        else {
            return view('loginFail3');
            }
        }
        catch (ValidationException $e1) {
            //note: this exception must be caught before exception bc validationexception extends from exception
            //must rethrow this exception in order for laravel to display your submitted page with errors
            //catch and rethrow data validation exception (so we can catch all others in our next exception catch block
            throw $e1;
        }
        
        catch (Exception $e){
            //best practice: call all exceptions, log the exception, and display a common error page (or use a global exception handler)
            //log exception and display exception view
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    private function validateForm(Request $request){
        //best practice: centralize your rules so you have a consistent architecture and even reuse your rules
        //bad practice: not using a defined data validation framework, putting rules all over your code, doing only on client side or database
        //setup data validation rules for login form
        $rules = ['username' => 'Required | Between:4,10 | Alpha', 
                  'password' => 'Required | Between:4,10'];
        
        //run data validation rules
        $this->validate($request, $rules);
    }
}