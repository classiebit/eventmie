<?php

/**
 * Axios response helpers
 * 
 * To provide a global way to through and show errors on client side
 * 
 * source- https://devdojo.com/tutorials/custom-global-helpers-in-laravel
*/

use Illuminate\Http\Response;

if ( !function_exists('error') )
{

    /**
     * error
     * 
     * param errors
     * string or array
     * 
     * param status
     * http status code
     * source- https://gist.github.com/jeffochoa/a162fc4381d69a2d862dafa61cda0798
     * 
    */
    function error($errors = null, $status = 422)
    {   
        // laravel default error style
        $err_response = ['error' => ['']];
        
        // if errors is array then push all to error
        if(is_array($errors))
        {
            foreach($errors as $key => $val)
                $err_response['error'][$key] = $val;
        }
        else
        {
            $err_response['error'][0] = $errors;
        }
        
        return response(['errors'=>$err_response], $status);
    }

    /**
     * error_redirect
     * 
     * param errors
     * string or array
     * 
     * redirect to previous page with errors
    */
    function error_redirect($errors = null)
    {   
        if(request()->wantsJson())
            return response()->json(['status' => false, 'message' => $errors], 422);

        // laravel default error style
        $err_response = [];
        
        // if errors is array then push all to error
        if(is_array($errors))
        {
            foreach($errors as $key => $val)
                $err_response[] = $val;
        }
        else
        {
            $err_response[] = $errors;
        }
        
        return redirect()->back()->withErrors($err_response);
    }

    /**
     * success_redirect
     * 
     * param message
     * string
     * 
     * param url
     * string
     * 
     * redirect to provided url with success message
    */
    function success_redirect($message = null, $url = null)
    {   
        if(request()->wantsJson())
            return response()->json(['status' => true, 'message' => $message], 200);

        if(checkPrefix()) {
            return response()->json(['redirect_url' => $url, 'status' => true]);
        }
        return redirect($url)->with('status', $message);
    }
	
}