use Hash;
use Auth;
use Validator;

public function verifyAccount(Request $request){
              
              $email = $request->email;
              $password = $request->password;
          
               
              $validator = Validator::make($request->all(), [
                  'email' => 'required|email',
                  'password' => 'required'
              ]);
               
              if ($validator->fails()) {
                 
                   return response()->json(['status' => 'failed','message' => $validator->messages()->first(), ]);
      
              }else{
         
             if(Auth::guard('tutor')->attempt(['email' => $request->email, 'password' => $request->password])){
              return response()->json([
                  'status' => 'success',
                  'message' => 'Login Succesfull', 
              ]);
  
             }else{
              return response()->json([
                  'status' => 'failed',
                  'message' => 'Invalid Credintial', 
              ]);
  
             }
          }
             
        }